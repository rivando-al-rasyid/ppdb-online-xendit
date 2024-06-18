<?php

namespace App\Http\Controllers;

use App\Models\TblHasil;
use App\Models\TblPembayaran;
use App\Models\TblPesertaPpdb;
use Illuminate\Http\Request;
use Xendit\Configuration;
use Xendit\Customer\CustomerApi;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\CreateInvoiceRequest;
use Xendit\XenditSdkException;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Xendit\Invoice\InvoiceCallback;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
use App\Models\InformasiSekolah;
use App\Models\Tu;

class PembayaranController extends Controller
{
    private $customerApiInstance;
    private $invoiceApiInstance;

    public function __construct()
    {
        // Set Xendit API key in the constructor
        Configuration::setXenditKey(env('XENDIT_API_KEY'));
        // Create instances of CustomerApi and InvoiceApi to be used throughout the controller
        $this->customerApiInstance = new CustomerApi();
        $this->invoiceApiInstance = new InvoiceApi();
    }

    /**
     * Create a new customer.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createCustomer(Request $request)
    {
        try {
            \DB::beginTransaction();

            $userId = $request->input('id');
            $items = TblHasil::with(['tbl_peserta_ppdb'])->where('status', 'DITERIMA')->get();


            foreach ($items as $item) {
                $idpeserta = $item->tbl_peserta_ppdb->id;
                $student = TblPesertaPpdb::find($idpeserta);

                if ($student->id_user === null) {
                    $namaDepan = $item->tbl_peserta_ppdb->nama_depan;

                    $user = new User();
                    $user->name = $namaDepan;
                    $baseEmail = $namaDepan . '@example.com';
                    $emailExists = User::where('email', $baseEmail)->exists();
                    $randomEmail = $emailExists ? $namaDepan . $userId . '@example.com' : $baseEmail;

                    $user->email = $randomEmail;
                    $originalPassword = $randomEmail; // Storing original password for SMS
                    $user->password = bcrypt($originalPassword);
                    $user->save();
                    $id_user = $user->id;
                    $student->id_user = $id_user;
                    $student->update();

                    $phoneNumber = $item->tbl_peserta_ppdb->tbl_biodata_ortu->no_tlp_ayah;
                    $phoneNumber = $this->formatPhoneNumber($phoneNumber);

                    $client = new \Twilio\Rest\Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));

                    try {
                        $message = $client->messages->create(
                            $phoneNumber,
                            [
                                "from" => env('TWILIO_FROM_NUMBER'),
                                "body" => "Your registration is successful. Email: $randomEmail, Password: $originalPassword"
                            ]
                        );

                        if ($message->sid) {
                            Alert::success('Success', 'Thank you for registering! SMS notification sent successfully.');
                        } else {
                            Alert::error('Error', 'Thank you for registering! However, SMS notification could not be sent.');
                        }
                    } catch (\Twilio\Exceptions\RestException $e) {
                        Alert::error('Error', 'SMS could not be sent. Error: ' . $e->getMessage());
                    }
                }
            }
            \DB::commit();

            Alert::success('Success', 'Customer created successfully!')->persistent(true)->autoClose(3000);
            return redirect()->route('admin.dashboard');
        } catch (ModelNotFoundException $e) {
            \DB::rollBack();
            Alert::error('Error', $e->getMessage())->persistent(true)->autoClose(5000);
            return response()->json(['error' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            \DB::rollBack();
            Alert::error('Error', $e->getMessage())->persistent(true)->autoClose(5000);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    private function formatPhoneNumber($phoneNumber)
    {
        if (substr($phoneNumber, 0, 1) == '0') {
            return '+62' . substr($phoneNumber, 1);
        } elseif (substr($phoneNumber, 0, 2) == '62') {
            return '+' . $phoneNumber;
        } else {
            return '+62' . $phoneNumber;
        }
    }
    public function webhook(Request $request)
    {
        // Parse the incoming JSON payload into an associative array
        $payload = $request->json()->all();

        // Find the payment record based on external_id
        $payment = TblPembayaran::where('external_id', $payload['external_id'])->firstOrFail();

        if ($payment->status == 'settled') {
            return response()->json(['data' => 'Pembayaran berhasil']);
        }

        // Instantiate the InvoiceCallback object from the payload
        $invoice_callback = new InvoiceCallback($payload);

        // Extract necessary information from the callback object
        $external_id = $invoice_callback->getExternalId();
        $status = $invoice_callback->getStatus(); // Assuming getId() was meant to retrieve status

        // Update the payment status in your database
        $payment->status = $status;
        $payment->save();

        // Return the extracted data
        return response()->json([
            'external_id' => $external_id,
            'status' => $status,
        ]);
    }

    public function createInvoice(Request $request)
    {
        try {
            $user = Auth::user();
            $existingInvoice = $this->findExistingInvoice($user);

            if (!$existingInvoice) {
                $data = $this->retrieveCustomerData($user);
                $items = $this->getItemsBasedOnGender($data->jenis_kelamin);

                $total = $this->calculateTotalAmount($items);

                $invoiceCustomerData = $this->prepareInvoiceCustomerData($data, $user);
                $notificationPreference = $this->prepareNotificationPreference();

                $createInvoiceRequest = $this->prepareCreateInvoiceRequest($total, $items, $invoiceCustomerData, $notificationPreference);

                $result = $this->invoiceApiInstance->createInvoice($createInvoiceRequest);

                $pembayaran = $this->createPembayaranEntry($result);
                $this->updatePesertaPpdbInvoiceId($data, $pembayaran);

                return redirect()->away($result['invoice_url']);
            } else {
                return redirect()->away($existingInvoice->tbl_pembayaran->checkout_link);
            }
        } catch (XenditSdkException $e) {
            return $this->handleException($e);
        }
    }

    private function findExistingInvoice($user)
    {
        return TblPesertaPpdb::where('id_user', $user->id)
            ->whereNotNull('id_invoice')
            ->with('tbl_pembayaran')
            ->first();
    }

    private function retrieveCustomerData($user)
    {
        return TblPesertaPpdb::where('id_user', $user->id)->with('tbl_biodata_ortu')->first();
    }

    private function getItemsBasedOnGender($gender)
    {
        $items1 = [
            [
                'name' => 'Satu Stel Dasar Pakaian Putih Dongker',
                'quantity' => 1,
                'price' => 145000,
            ],
            [
                'name' => 'Satu Stel Dasar Pakaian Pramuka',
                'quantity' => 1,
                'price' => 175000,
            ],
            [
                'name' => 'Dasar Baju Batik Sekolah',
                'quantity' => 1,
                'price' => 70000,
            ],
            [
                'name' => 'Dasar Pakaian Muslim ( Khusus Jum’at )',
                'quantity' => 1,
                'price' => 65000,
            ],
            [
                'name' => 'Satu Stel Pakaian Baju Olahraga',
                'quantity' => 1,
                'price' => 115000,
            ],
            [
                'name' => 'Atribut,topi,dasi,pin,lambang (osis,pramuka,lokasi, dan nama siswa)',
                'quantity' => 1,
                'price' => 50000,
            ],
            [
                'name' => 'Dua Helai Jelbab',
                'quantity' => 1,
                'price' => 80000,
            ],
            [
                'name' => 'Sampul Rapor',
                'quantity' => 1,
                'price' => 50000,
            ],
            [
                'name' => 'Uang Osis (1 tahun)',
                'quantity' => 1,
                'price' => 20000,
            ],
        ]; // Items for female
        $items2 = [
            [
                'name' => 'Satu Stel Dasar Pakaian Putih Dongker',
                'price' => 140000,
                'quantity' => 1,
            ],
            [
                'name' => 'Satu Stel Dasar Pakaian Pramuka',
                'price' => 175000,
                'quantity' => 1,
            ],
            [
                'name' => 'Dasar Baju Batik Sekolah',
                'price' => 65000,
                'quantity' => 1,
            ],
            [
                'name' => 'Dasar Pakaian Muslim ( Khusus Jum’at )',
                'price' => 60000,
                'quantity' => 1,
            ],
            [
                'name' => 'Satu Stel Pakaian Baju Olahraga',
                'price' => 115000,
                'quantity' => 1,
            ],
            [
                'name' => 'Atribut, topi, dasi, pin, lambang (osis, pramuka, lokasi, dan nama siswa)',
                'price' => 50000,
                'quantity' => 1,
            ],
            [
                'name' => 'Sampul Rapor',
                'price' => 50000,
                'quantity' => 1,
            ],
            [
                'name' => 'Uang Osis (1 tahun)',
                'price' => 20000,
                'quantity' => 1,
            ],
        ]; // Items for male
        return ($gender === 'P') ? $items1 : $items2;
    }

    private function calculateTotalAmount($items)
    {
        return collect($items)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
    }

    private function prepareInvoiceCustomerData($data, $user)
    {
        return [
            'given_names' => $data->nama_depan,
            'surname' => $data->nama_belakang,
            'email' => $user->email,
            'mobile_number' => (string) $data->tbl_biodata_ortu->no_tlp_ayah,
        ];
    }

    private function prepareNotificationPreference()
    {
        return [
            'invoice_created' => ['sms', 'whatsapp', 'email'],
            'invoice_reminder' => ['sms', 'whatsapp', 'email'],
            'invoice_paid' => ['sms', 'whatsapp', 'email'],
        ];
    }

    private function prepareCreateInvoiceRequest($total, $items, $invoiceCustomerData, $notificationPreference)
    {
        $description = json_encode($invoiceCustomerData, JSON_UNESCAPED_UNICODE);
        $description = substr($description, 1, -1);
        $description = '';
        foreach ($invoiceCustomerData as $key => $value) {
            $description .= "\"$key\":\"$value\",\n"; // Adding line break after each comma
        }

        // Remove the trailing comma and line break
        $description = rtrim($description, ",\n");
        $generateTUB = function ($userId) {
            return 'TUB' . sprintf('%03d', $userId);
        };

        // Assuming you have a way to get the current user ID
        $userId = auth()->user()->id; // or $request->input('user_id') if it's passed in the request

        return new CreateInvoiceRequest([
            'external_id' => $generateTUB($userId),
            'amount' => $total,
            'items' => $items,
            'description' => $description,
            'invoice_duration' => 86400,
            'customer' => $invoiceCustomerData,
            'customer_notification_preference' => $notificationPreference,
            'success_redirect_url' => route('pembayaran.invoice'),
        ]);
    }

    private function createPembayaranEntry($result)
    {
        $pembayaran = new TblPembayaran;
        $pembayaran->invoice_id = $result['id'];
        $pembayaran->external_id = $result['external_id'];
        $pembayaran->description = $result['description'];
        $pembayaran->amount = $result['amount'];
        $pembayaran->status = 'pending';
        $pembayaran->checkout_link = $result['invoice_url'];
        $pembayaran->save();
        return $pembayaran;
    }

    private function updatePesertaPpdbInvoiceId($data, $pembayaran)
    {
        $data->id_invoice = $pembayaran['id'];
        $data->save();
    }
    public function create(Request $request)
    {
        $user = Auth::user();
        $data = $this->retrieveCustomerData($user);
        // $noHp = $data->tbl_biodata_ortu->no_tlp_ayah;
        $items = $this->getItemsBasedOnGender($data->jenis_kelamin);
        $total = $this->calculateTotalAmount($items);

        return view('dashboards.pembayaran.create', compact('user', 'items', 'total'));
    }
    private function handleException($e)
    {
        return response()->json([
            'error' => $e->getMessage(),
            'full_error' => $e->getFullError(),
        ], 500);
    }

    /**
     * Get customer by ID and return the result in a view.
     *
     * @param Request $request
     * @param string $customerId
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */

    /**
     * Get invoice by ID.
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function getInvoiceById(): JsonResponse
    {
        try {
            // Ensure the user is authenticated
            $user = Auth::user();
            $userId = $user->id;

            // Fetch the payment record based on the provided invoice ID
            $existingPembayaran = TblPesertaPpdb::where('id_user', $userId)
                ->whereNotNull('id_invoice')
                ->with('tbl_pembayaran') // Load the related TblPembayaran
                ->first();

            if (!$existingPembayaran || !$existingPembayaran->tbl_pembayaran) {
                throw new \Exception("Invoice details not found for the user.");
            }

            // Get the invoice ID from the tbl_pembayaran if it exists
            $invoiceId = $existingPembayaran->tbl_pembayaran->invoice_id;

            // Use the Xendit Invoice API instance to retrieve the invoice details
            $invoiceDetails = $this->invoiceApiInstance->getInvoiceById($invoiceId);

            // Pass the invoice details to the view
            return response()->json($invoiceDetails);
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error retrieving invoice details: ' . $e->getMessage());
            // Return a JSON response with the error message
            return response()->json(['error' => 'Failed to retrieve invoice details.'], 500);
        }
    }
    public function review()
    {
        $user = Auth::user();
        $userId = $user->id;

        // Fetch the payment record based on the provided invoice ID
        $existingPembayaran = TblPesertaPpdb::where('id_user', $userId)
            ->whereNotNull('id_invoice')
            ->with('tbl_pembayaran') // Load the related TblPembayaran
            ->first();

        if (!$existingPembayaran || !$existingPembayaran->tbl_pembayaran) {
            throw new \Exception("Invoice details not found for the user.");
        }

        // Get the invoice ID from the tbl_pembayaran if it exists
        $invoiceId = $existingPembayaran->tbl_pembayaran->invoice_id;

        // Use the Xendit Invoice API instance to retrieve the invoice details
        $data = $this->invoiceApiInstance->getInvoiceById($invoiceId);

        // Retrieve a Sekolah model and pass it to the view
        return view('dashboards.pembayaran.hasil', compact('data'));
    }
    public function generateAndDisplayInvoice()
    {
        $user = Auth::user();
        $userId = $user->id;

        // Fetch the payment record based on the provided invoice ID
        $existingPembayaran = TblPesertaPpdb::where('id_user', $userId)
            ->whereNotNull('id_invoice')
            ->with('tbl_pembayaran') // Load the related TblPembayaran
            ->first();

        if (!$existingPembayaran || !$existingPembayaran->tbl_pembayaran) {
            throw new \Exception("Invoice details not found for the user.");
        }

        // Get the invoice ID from the tbl_pembayaran if it exists
        $invoiceId = $existingPembayaran->tbl_pembayaran->invoice_id;

        // Use the Xendit Invoice API instance to retrieve the invoice details
        $data = $this->invoiceApiInstance->getInvoiceById($invoiceId);
        $carbonDate = Carbon::instance($data['created']);

        // Define parties
        $client = new Party([
            'name' => $data['merchant_name'],
            // You can add more fields dynamically based on $data if needed
        ]);

        $customer = new Party([
            'name' => $data['customer']['given_names'] . ' ' . $data['customer']['surname'],
            'phone' => $data['customer']['mobile_number'],
            'custom_fields' => [
                'note' => 'Pembayaran Daftar Ulang',
            ],



            // You can add more fields dynamically based on $data if needed
        ]);

        // Define items based on $data
        $items = [];
        foreach ($data['items'] as $item) {
            $items[] = InvoiceItem::make($item['name'])
                ->pricePerUnit($item['price'])
                ->quantity($item['quantity']);
        }
        $tentang = InformasiSekolah::first();
        $tu = Tu::first();

        // Define notes based on $data
        $notes = [
            // Add more dynamic notes based on $data if needed
            '
                            <p>Padang Gelugur, ' . \Carbon\Carbon::parse($tentang->tanggal_laporan)->format('d-m-Y') . '</p>
                            <p style="text-align: center;">Ketua Panitia</p>
                            <br>
                            <br>
                            <br>
                            <p style="text-align: center;">' . $tu->name . '</p>
                            <p style="text-align: center;">NIP. ' . $tu->nip . '</p>
                        '
        ];
        $notes = implode("<br>", $notes);

        // Create the invoice
        $invoice = Invoice::make('receipt')
            ->serialNumberFormat($data['external_id'])
            ->status(__($data['status']))
            ->date($carbonDate)
            ->payUntilDays(1)
            ->seller($client)
            ->buyer($customer)
            ->addItems($items)
            ->notes($notes)
            ->filename($client->name . ' ' . $customer->name)

            // You can continue adding more dynamic data based on $data if needed
            ->logo(public_path('vendor/invoices/gambar2.png'));

        // Return the invoice itself to the browser
        return $invoice->stream();
    }


    /**
     * Expire an invoice by ID.
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function expireInvoice($id)
    {
        try {
            $result = $this->invoiceApiInstance->expireInvoice($id);
            Alert::warning('Warning', 'Invoice expired successfully!')->persistent(true)->autoClose(3000);
            return response()->json($result, 200);
        } catch (XenditSdkException $e) {
            Alert::error('Error', $e->getMessage())->persistent(true)->autoClose(5000);
            return response()->json([
                'error' => $e->getMessage(),
                'full_error' => $e->getFullError(),
            ], 500);
        }
    }

    public function upload(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $item = TblPesertaPpdb::where('id_user', $userId)->firstOrFail();

        $request->validate([
            'payment_proof' => 'required|mimes:jpeg,png,jpg,pdf|max:2048'
        ]);

        $filename = $this->handleFileUpload($request->file('payment_proof'));

        // Update the payment record with the proof of payment
        $this->updatePaymentRecord($item, $filename);

        return redirect()->back()->with('success', 'Proof of payment uploaded successfully.');
    }

    private function handleFileUpload($file)
    {
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('private/payment_proofs', $filename);
        return $filename;
    }

    private function updatePaymentRecord($item, $filename)
    {
        $payment = TblPembayaran::where('id', $item->id_invoice)->first();
        if ($payment) {
            $payment->file_bukti_pembayaran = $filename;
            $payment->save();
        }
    }
}

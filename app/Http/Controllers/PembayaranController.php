<?php

namespace App\Http\Controllers;

use App\Models\TblBiaya;
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

class PembayaranController extends Controller
{
    private $customerApiInstance;
    private $invoiceApiInstance;

    public function __construct()
    {
        // Set Xendit API key in the constructor
        Configuration::setXenditKey("xnd_development_6hbRVAerHEL4QXhL7VgWn0ejJf8aN1fPm8I1PXBS1lpTj7fDpDJLAtmT4qEaaf");

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

                // Check if $student->id_user is null before creating a new user
                if ($student->id_user === null) {
                    $namaDepan = $item->tbl_peserta_ppdb->nama_depan;

                    $user = new User();
                    $user->name = $namaDepan;

                    $baseEmail = $namaDepan . '@example.com';
                    $randomEmail = User::where('email', $baseEmail)->exists()
                        ? $namaDepan . $userId . '@example.com'
                        : $baseEmail;

                    $user->email = $randomEmail;
                    $user->password = bcrypt($randomEmail);
                    $user->save();

                    // Update $student->id_user after creating the user
                    $student->id_user = $user->id;
                    $student->update();

                    // Additional logic for each item in $items collection...
                }

                // End of your existing code...
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
    public function webhook(Request $request)
    {
        // Parse the incoming JSON payload into an associative array
        $payload = $request->json()->all();

        // Instantiate the InvoiceCallback object from the payload
        $invoice_callback = new InvoiceCallback($payload);

        // Extract necessary information from the callback object
        $external_id = $invoice_callback->getExternalId();
        $status = $invoice_callback->getStatus();

        // Get the payment record based on the external_id
        $payment = TblPembayaran::where('external_id', $external_id)->firstOrFail();

        // Check if payment status is already settled
        if ($payment->status == 'settled') {
            return response()->json(['data' => 'Payment has already been processed']);
        }

        // Update payment status based on the webhook callback
        $payment->status = strtolower($status);
        $payment->save();

        return response()->json(['data' => 'Success']);
    }
    /**
     * Create an invoice.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createInvoice(Request $request)
    {
        try {
            // Retrieve customer data from the authenticated user
            $user = Auth::user();
            $biaya = TblBiaya::first();
            $url = app('url')->to('/invoice');

            // Check if any invoice with the same user_id exists
            $existingPembayaran = TblPesertaPpdb::where('id_user', $user->id)
                ->whereNotNull('id_invoice')
                ->with('tbl_pembayaran') // Load the related TblPembayaran
                ->first();

            if (!$existingPembayaran) {
                // If the invoice doesn't exist, proceed to create a new one

                // Prepare customer data for invoice creation
                $data = TblPesertaPpdb::where('id_user', $user->id)->with('tbl_biodata_ortu')->first();

                $no_hp = $data->tbl_biodata_ortu->id;
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
                ];
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
                ];
                if ($data->jenis_kelamin === 'P') {
                    $items = $items1;
                } else {
                    $items = $items2;
                }


                $itemsCollect = collect($items);

                $total = $itemsCollect->sum(function ($item) {
                    return $item['price'] * $item['quantity'];
                });

                $invoiceCustomerData = [
                    'given_names' => $data->nama_depan,
                    'surname' => $data->nama_belakang,
                    'email' => $user->email,
                    'mobile_number' => (string) $no_hp, // Convert to string
                    // Add other necessary customer data here
                ];

                // Prepare customer notification preference
                $notificationPreference = [
                    'invoice_created' => ['sms', 'whatsapp', 'email'],
                    'invoice_reminder' => ['sms', 'whatsapp', 'email'],
                    'invoice_paid' => ['sms', 'whatsapp', 'email'],
                ];

                // Use $this->invoiceApiInstance for consistency
                $createInvoiceRequest = new CreateInvoiceRequest([
                    'external_id' => (string) Str::uuid(),
                    'amount' => $total,
                    'items' => $items,
                    'description' => 'test',
                    'invoice_duration' => 86400,
                    'customer' => $invoiceCustomerData,
                    'customer_notification_preference' => $notificationPreference,
                    'success_redirect_url' => $url,
                ]);

                // Create the invoice
                $result = $this->invoiceApiInstance->createInvoice($createInvoiceRequest);

                // Create TblPembayaran entry
                $pembayaran = new TblPembayaran;
                $pembayaran->invoice_id = $result['id'];
                $pembayaran->external_id = $result['external_id'];
                $pembayaran->description = $result['description'];
                $pembayaran->amount = $result['amount'];
                $pembayaran->status = 'pending';
                $pembayaran->checkout_link = $result['invoice_url'];
                $pembayaran->save();

                // Update id_invoice field in TblPesertaPpdb model
                $data->id_invoice = $pembayaran['id'];
                $data->save();

                // Success message and redirection
                return redirect()->away($result['invoice_url']);
            } else {
                // If the invoice already exists, redirect to the checkout link
                return redirect()->away($existingPembayaran->tbl_pembayaran->checkout_link);
            }
        } catch (XenditSdkException $e) {
            // Error handling
            return response()->json([
                'error' => $e->getMessage(),
                'full_error' => $e->getFullError(),
            ], 500);
        }
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

    public function getInvoiceById()
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

            // Get the invoice ID from the tbl_pembayaran if it exists
            $invoiceId = $existingPembayaran->tbl_pembayaran->invoice_id;

            // Use the Xendit Invoice API instance to retrieve the invoice details
            $invoiceDetails = $this->invoiceApiInstance->getInvoiceById($invoiceId);

            // Pass the invoice details to the view
            return view('dashboards.pembayaran.cetak', compact('invoiceDetails'));
        } catch (XenditSdkException $e) {
            // Handle Xendit SDK exceptions
            Alert::error('Error', $e->getMessage())->persistent(true)->autoClose(5000);
            return response()->json(['error' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            // Handle other exceptions
            Alert::error('Error', 'An error occurred.')->persistent(true)->autoClose(5000);
            return response()->json(['error' => 'An error occurred'], 500);
        }
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Retrieve a Sekolah model and pass it to the view
        $biaya = TblBiaya::first();
        $user = Auth::user();
        return view('dashboards.pembayaran.create', compact('biaya', 'user'));
    }
}

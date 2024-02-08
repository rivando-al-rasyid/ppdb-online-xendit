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
use App\Models\Pembayaran;
use RealRashid\SweetAlert\Facades\Alert;

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
            $items = TblHasil::with(['peserta', 'orang_tua'])->where('status', 'DITERIMA')->get();

            foreach ($items as $item) {
                $idpeserta = $item->peserta->id;
                $student = TblPesertaPpdb::find($idpeserta);

                // Check if $student->id_user is null before creating a new user
                if ($student->id_user === null) {
                    $namaDepan = $item->peserta->nama_depan;
                    $namaBelakang = $item->peserta->nama_belakang;
                    $no_hp = $item->orang_tua->no_tlp_ayah;

                    $user = new User();
                    $user->name = $namaDepan;
                    $user->surname = $namaBelakang;

                    $baseEmail = $namaDepan . '@example.com';
                    $randomEmail = User::where('email', $baseEmail)->exists()
                        ? $namaDepan . $userId . '@example.com'
                        : $baseEmail;

                    $user->email = $randomEmail;
                    $user->password = bcrypt($randomEmail);
                    $user->no_hp = $no_hp;
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
            $sekolah = TblBiaya::first();
            $url = app('url')->to('/invoice');


            // Check if any invoice with the same user_id exists
            $existingPembayaran = TblPembayaran::where('user_id', $user->id)->first();

            if (!$existingPembayaran) {
                // If the invoice doesn't exist, proceed to create a new one

                // Prepare customer data for invoice creation
                $invoiceCustomerData = [
                    'given_names' => $user->name,
                    'surname' => $user->surname,
                    'email' => $user->email,
                    'mobile_number' => (string) $user->no_hp, // Convert to string
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
                    'amount' => $sekolah->amount,
                    'description' => $sekolah->deskripsi_tagihan,
                    'invoice_duration' => 86400,
                    'customer' => $invoiceCustomerData,
                    'customer_notification_preference' => $notificationPreference,
                    'success_redirect_url' => $url,
                ]);

                // Create the invoice
                $result = $this->invoiceApiInstance->createInvoice($createInvoiceRequest);

                $pembayaran = new TblPembayaran;
                $pembayaran->invoice_id = $result['id'];
                $pembayaran->external_id = $result['external_id'];
                $pembayaran->description = $result['description'];
                $pembayaran->amount = $result['amount'];
                $pembayaran->payer_email = $user->email;
                $pembayaran->status = 'pending';
                $pembayaran->user_id = $user->id;
                $pembayaran->checkout_link = $result['invoice_url'];
                $pembayaran->save();

                Alert::success('Success', 'Invoice created successfully!')->persistent(true)->autoClose(3000);
                return redirect()->away($result['invoice_url']);
            } else {
                // If the invoice already exists, redirect to the checkout link
                Alert::info('Info', 'Invoice already exists!')->persistent(true)->autoClose(3000);
                return redirect()->away($existingPembayaran->checkout_link);
            }
        } catch (XenditSdkException $e) {
            Alert::error('Error', $e->getMessage())->persistent(true)->autoClose(5000);
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

    public function showInvoice()
    {
        try {
            // Ensure the user is authenticated
            $user = Auth::user();
            $userId = $user->id;

            $pembayaran = TblPembayaran::where('user_id', $userId)->first();

            if (!$pembayaran) {
                Alert::error('Error', 'Pembayaran not found')->persistent(true)->autoClose(5000);
                return response()->json(['error' => 'Pembayaran not found'], 404);
            }

            $invoiceId = $pembayaran->invoice_id;

            // Use $this->invoiceApiInstance for consistency
            $result = $this->invoiceApiInstance->getInvoiceById($invoiceId);

            // Check if the status from the API response is different from the current status
            if ($result['status'] !== $pembayaran->status) {
                // Update the status of the Pembayaran object
                $pembayaran->status = $result['status'];

                // Save the updated Pembayaran object
                $pembayaran->save();
            }

            // Pass the invoice details to the view using compact
            return view('dashboards.pembayaran.berhasil', compact('result'));
        } catch (XenditSdkException $e) {
            Alert::error('Error', $e->getMessage())->persistent(true)->autoClose(5000);
            return response()->json(['error' => $e->getMessage()], 500);
        } catch (\Exception $e) {
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
        $sekolah = TblBiaya::first();
        $user = Auth::user();
        return view('dashboards.pembayaran.create', compact('sekolah', 'user'));
    }
}

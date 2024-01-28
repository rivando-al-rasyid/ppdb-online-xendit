<?php

namespace App\Http\Controllers;

use App\Models\PesertaPPDB;
use Illuminate\Http\Request;
use Xendit\Configuration;
use Xendit\Customer\CustomerApi;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\CreateInvoiceRequest;
use Xendit\XenditSdkException;
use App\Models\Sekolah;
use App\Models\User;
use App\Models\Hasil;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Pembayaran;


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
            $items = Hasil::with(['peserta', 'orang_tua'])->where('status', 'DITERIMA')->get();

            foreach ($items as $item) {
                $idpeserta = $item->peserta->id;
                $student = PesertaPPDB::find($idpeserta);

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

            // Additional logic after processing $items...

            return redirect()->route('admin.dashboard');
        } catch (ModelNotFoundException $e) {
            \DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
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
     * Create an invoice.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createInvoice(Request $request)
    {
        try {
            // Retrieve customer data from the authenticated user
            $user = Auth::user();
            $sekolah = Sekolah::first();

            // Check if any invoice with the same user_id exists
            $existingPembayaran = Pembayaran::where('user_id', $user->id)->first();

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
                ]);

                // Create the invoice
                $result = $this->invoiceApiInstance->createInvoice($createInvoiceRequest);

                $pembayaran = new Pembayaran;
                $pembayaran->external_id = $result['external_id'];
                $pembayaran->description = $result['description'];
                $pembayaran->amount = $result['amount'];
                $pembayaran->status = 'pending';
                $pembayaran->user_id = $user->id;
                $pembayaran->checkout_link = $result['invoice_url'];
                $pembayaran->save();

                return redirect()->away($result['invoice_url']);
            } else {
                // If the invoice already exists, redirect to the checkout link
                return redirect()->away($existingPembayaran->checkout_link);
            }
        } catch (XenditSdkException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'full_error' => $e->getFullError(),
            ], 500);
        }
    }
    /**
     * Get invoice by ID.
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInvoiceById($id)
    {
        try {
            $result = $this->invoiceApiInstance->getInvoiceById($id);
            return response()->json($result, 200);
        } catch (XenditSdkException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'full_error' => $e->getFullError(),
            ], 500);
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
            return response()->json($result, 200);
        } catch (XenditSdkException $e) {
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
        $sekolah = Sekolah::first();
        $user = Auth::user();

        return view('dashboards.pembayaran.create', compact('sekolah', 'user'));
    }
}

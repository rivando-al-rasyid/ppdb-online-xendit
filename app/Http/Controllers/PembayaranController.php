<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $user_id = auth()->user()->id; // Get the currently authenticated user's ID
        $pembayaran = Pembayaran::where('user_id', $user_id)->first();

        if ($pembayaran) {
            return redirect()->route('pembayaran.hasil');
        } else {
            return view('pembayaran.create', compact('user'));
        }
    }

    public function hasil(Request $request)
    {
        $user = $request->user();
        $user_id = auth()->user()->id; // Get the currently authenticated user's ID
        $pembayaran = Pembayaran::where('user_id', $user_id)->first();

        if ($pembayaran) {
            $token = $pembayaran->token;
            return view('pembayaran.hasil', compact('token', "user"));
        } else {
            return redirect()->route('pembayaran.create');
        }
    }


    public function create(Request $request)
    {
        $Amount = 250000; // Assuming quantity is always 1
        $ItemName = "Baju Sekolah";
        $params = array(
            'transaction_details' => array(
                'order_id' => Str::uuid(),
                'gross_amount' => $Amount,
            ),
            'item_details' => array(
                array(
                    'price' => $Amount,
                    'quantity' => 1,
                    'name' => $ItemName,
                )
            ),
            'customer_details' => array(
                'first_name' => $request->customer_first_name,
                'email' => $request->customer_email,
                'phone' => $request->customer_phone,
            ),

            'enabled_payments' => array('credit_card', 'bca_va', 'bni_va', 'bri_va')
        );
        $auth = base64_encode(env('MIDTRANS_SERVER_KEY'));

        $response = Http::withHeaders([

            'Content-Type' => 'application/json',

            'Authorization' => "Basic $auth",

        ])->post('https://app.sandbox.midtrans.com/snap/v1/transactions', $params);
        $response = json_decode($response->body());
        $payment = new Pembayaran;
        $payment->order_id = $params['transaction_details']['order_id'];
        $payment->status = 'pending';
        $payment->price = $Amount;
        $payment->customer_first_name = $request->customer_first_name;
        $payment->customer_email = $request->customer_email;
        $payment->item_name = $ItemName;
        $payment->user_id = $request->user_id;
        $payment->checkout_link = $response->redirect_url;
        $payment->token = $response->token;
        $payment->save();
        return response()->json($response);
    }
    public function webhook(Request $request)
    {
        try {
            $auth = base64_encode(env('MIDTRANS_SERVER_KEY'));

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => "Basic $auth",
            ])->get("https://api.sandbox.midtrans.com/v2/$request->order_id/status");

            if ($response->successful()) {
                $responseBody = json_decode($response->body());

                // Check if the payment record exists
                $payment = Pembayaran::where('order_id', $responseBody->order_id)->first();

                if (!$payment) {
                    // Payment record not found, handle this case accordingly
                    return response()->json('Payment record not found', 404);
                }

                if ($payment->status === 'settlement' || $payment->status === 'capture') {
                    return response()->json('Payment has been already processed');
                }

                if ($responseBody->transaction_status === 'capture') {
                    // Update payment status to capture
                    $payment->status = 'capture';
                } elseif ($responseBody->transaction_status === 'settlement') {
                    // Update payment status to settlement
                    $payment->status = 'settlement';
                } elseif ($responseBody->transaction_status === 'pending') {
                    // Update payment status to pending
                    $payment->status = 'pending';
                } elseif ($responseBody->transaction_status === 'deny') {
                    // Update payment status to deny
                    $payment->status = 'deny';
                } elseif ($responseBody->transaction_status === 'expire') {
                    // Update payment status to expire
                    $payment->status = 'expire';
                } elseif ($responseBody->transaction_status === 'cancel') {
                    // Update payment status to cancel
                    $payment->status = 'cancel';
                }

                $payment->save();
                Alert::success('Success', 'Payment created successfully');
                return response()->json("berhasil");
            } else {
                Alert::error('Error', 'Failed to create payment');
                // Handle unsuccessful response, maybe log the error or return an appropriate response.
                return response()->json('Failed to fetch payment status', $response->status());
            }
        } catch (\Exception $e) {
            // Handle exceptions, log the error, and return an appropriate response.
            return response()->json('Error: ' . $e->getMessage(), 500);
        }
    }
    public function berhasil()
    {
        // Handle successful payment redirect logic here

        // Display a success sweet alert
        Alert::success('Success', 'Payment successful');

        return view('payment.finish');
    }

    public function gagal()
    {
        // Handle unfinished payment redirect logic here

        // Display a warning sweet alert
        Alert::warning('Warning', 'Payment not completed');

        return view('payment.unfinish');
    }

    public function error()
    {
        // Handle payment error redirect logic here

        // Display an error sweet alert
        Alert::error('Error', 'Payment error occurred');

        return view('payment.error');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Xendit\Invoice\InvoiceCallback;
use Xendit\Configuration;


class XenditWebhookController extends Controller
{
    public function __construct()
    {
        // Set Xendit API key and webhook URL in the constructor
        Configuration::setXenditKey("xnd_development_6hbRVAerHEL4QXhL7VgWn0ejJf8aN1fPm8I1PXBS1lpTj7fDpDJLAtmT4qEaaf");
    }

    public function handleInvoiceCallback(Request $request)
    {
        // Validate Xendit signature (optional but recommended)
        $this->validateXenditSignature($request);

        // Process the callback payload
        $payload = json_decode($request->getContent(), true);
        $invoiceCallback = new InvoiceCallback($payload);

        // Implement your logic to handle the callback
        $this->simulateInvoiceCallback($invoiceCallback);

        return response()->json(['success' => true], 200);
    }

    private function validateXenditSignature(Request $request)
    {
        // Implement Xendit signature validation logic if needed
        // You can find details in the Xendit documentation
    }

    private function simulateInvoiceCallback(InvoiceCallback $invoiceCallback)
    {
        // Implement your logic to handle the callback
        // For example, log the callback data, update your database, etc.
        // You can use $invoiceCallback->getId(), $invoiceCallback->getStatus(), etc.
    }

}

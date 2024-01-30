<!-- resources/views/invoice-details.blade.php -->

@extends('layouts.app') <!-- Assuming you have a layout file -->

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Invoice Details</div>

                    <div class="card-body">
                        <p><strong>Invoice ID:</strong> {{ $result['id'] }}</p>
                        <p><strong>Amount:</strong> {{ number_format($result['amount']) }} {{ $result['currency'] }}</p>
                        <p><strong>Status:</strong> {{ $result['status'] }}</p>
                        <p><strong>Expiry Date:</strong> {{ $result['expiry_date']->format('Y-m-d H:i:s') }}</p>
                        <p><strong>Payment Method:</strong> {{ $result['payment_method'] }}</p>
                        <!-- Display other relevant invoice details -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

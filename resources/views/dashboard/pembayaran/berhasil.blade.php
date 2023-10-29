@extends('layouts.app') {{-- Assuming you have a layout file --}}

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Payment Successful!</div>

                    <div class="card-body">
                        <p>Thank you for your payment! Here are the payment details:</p>
                        <ul>
                            <li><strong>Payment ID:</strong> {{ $pembayaran->external_id }}</li>
                            <li><strong>Amount:</strong> {{ $pembayaran->amount }} IDR</li>
                            <li><strong>Description:</strong> {{ $pembayaran->description }}</li>
                            <li><strong>Name:</strong> {{ $pembayaran->given_names }} {{ $pembayaran->surname }}</li>
                            <li><strong>Email:</strong> {{ $pembayaran->email }}</li>
                            <li><strong>Mobile Number:</strong> {{ $pembayaran->mobile_number }}</li>
                            <li><strong>Status:</strong> {{ $pembayaran->status }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

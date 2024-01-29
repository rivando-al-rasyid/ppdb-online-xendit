@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Your Invoice</div>

                    <div class="card-body">
                        <h5>Invoice Details:</h5>
                        <ul>
                            <li><strong>Amount:</strong> IDR {{ $sekolah->amount }} </li>
                            <li><strong>Description:</strong> {{ $sekolah->deskripsi_tagihan }}</li>
                        </ul>

                        <h5>Customer Information:</h5>
                        <ul>
                            <li><strong>Given Names:</strong> {{ $user->name }}</li>
                            <li><strong>Surname:</strong> {{ $user->surname }}</li>
                            <li><strong>Email:</strong> {{ $user->email }}</li>
                            <li><strong>Mobile Number:</strong> {{ $user->mobile_number }}</li>
                            {{-- Add other necessary customer data here --}}
                        </ul>
                        <form action="{{ route('pembayaran.store') }}" method="POST">
                            @csrf <!-- Add CSRF token for security, needed for POST requests -->

                            {{-- Add any payment-related fields here --}}

                            {{-- Add other payment-related fields as needed --}}

                            <button type="submit" class="btn btn-primary">Create Payment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

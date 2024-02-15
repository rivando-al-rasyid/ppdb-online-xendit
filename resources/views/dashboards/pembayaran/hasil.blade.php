@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="container mb-5 mt-3">
                <div class="row align-items-center">
                    <div class="col-xl-9">
                        <p class="text-muted fs-5">Invoice >> <strong>ID: #{{ $invoiceDetails['external_id'] }}</strong></p>
                    </div>
                    <div class="col-xl-3 text-end">
                        <a class="btn btn-light text-uppercase border-0" data-mdb-ripple-color="dark">
                            <i class="fas fa-print text-primary"></i> Print
                        </a>
                        <a class="btn btn-light text-uppercase" data-mdb-ripple-color="dark">
                            <i class="far fa-file-pdf text-danger"></i> Export
                        </a>
                    </div>
                    <hr class="my-3">
                </div>

                <div class="container">
                    <div class="col-md-12 text-center">
                        <i class="fab fa-mdb fa-4x text-primary"></i>
                        <p class="fs-5">MDBootstrap.com</p>
                    </div>

                    <div class="row">
                        <div class="col-xl-8">
                            <ul class="list-unstyled text-muted">
                                <li>To: <span class="text-primary">{{ $user->name }}</span></li>
                                {{-- Add other customer details here --}}
                            </ul>
                        </div>
                        <div class="col-xl-4">
                            <p class="text-muted">Invoice</p>
                            <ul class="list-unstyled text-muted">
                                <li><i class="fas fa-circle text-primary"></i> <span class="fw-bold">ID:</span>
                                    #{{ $invoiceDetails['external_id'] }}</li>
                                <li><i class="fas fa-circle text-primary"></i> <span class="fw-bold">Creation Date:</span>
                                    {{ $invoiceDetails['created_at'] }}</li>
                                <li><i class="fas fa-circle text-primary"></i> <span class="me-1 fw-bold">Status:</span>
                                    @if ($invoiceDetails['status'] === 'PAID')
                                        <span class="badge bg-success text-white fw-bold">Paid</span>
                                    @else
                                        <span
                                            class="badge bg-warning text-black fw-bold">{{ $invoiceDetails['status'] }}</span>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="row my-2 mx-1 justify-content-center">
                        {{-- Display invoice items and amounts --}}
                    </div>

                    <div class="row">
                        <div class="col-xl-8">
                            <p class="ms-3 text-muted">Add additional notes and payment information</p>
                        </div>
                        <div class="col-xl-3">
                            {{-- Display invoice subtotal, tax, and total amount --}}
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-xl-10">
                            <p>Thank you for your purchase</p>
                        </div>
                        <div class="col-xl-2">
                            {{-- Display payment button --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

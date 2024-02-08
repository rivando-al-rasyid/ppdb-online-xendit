@extends('tu.layouts.app')

@push('style')
    <link href="{{ asset('adminkit/datatables/dataTables.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="mb-4 d-sm-flex align-items-center justify-content-between">
            <h1 class="mb-0 text-gray-800 h3">Dashboard</h1>
        </div>

        <!-- Content Row -->
        <div class="mt-5 row">
            <div class="col-12">
                <h1>Data Pembayaran</h1>
            </div>
            <div class="col-12">
                <div class="mt-3 card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <!-- Define table headers here -->
                                        <th>Invoice ID</th>
                                        <th>Payer Email</th>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Checkout Link</th>
                                        <!-- Add other headers as needed -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Loop through payment data and display in rows -->
                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td>{{ $payment->invoice_id }}</td>
                                            <td>{{ $payment->payer_email }}</td>
                                            <td>{{ $payment->description }}</td>
                                            <td>{{ $payment->amount }}</td>
                                            <td>{{ $payment->status }}</td>
                                            <td>{{ $payment->checkout_link }}</td>
                                            <!-- Add cells for other fields -->
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- Page level plugins -->
    <script src="{{ asset('adminkit/datatables/jquery.min.js') }}"></script>
    <script src="{{ asset('adminkit/datatables/dataTables.min.js') }}"></script>
@endpush

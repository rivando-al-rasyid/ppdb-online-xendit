@extends('tu.layouts.app')

@push('style')
    <link href="{{ asset('adminkit/datatables/dataTables.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="mb-4 d-sm-flex align-items-center justify-content-between">
            <h1 class="mb-0 text-gray-800 h3">Dashboard</h1>
            <a href="{{ route('tu.download') }}" class="shadow-sm d-none d-sm-inline-block btn btn-sm btn-primary"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <!-- Content Row -->
        <div class="mt-5 row">
            <div class="col-12">
                <h1>Data Peserta PPDB</h1>
            </div>
            <div class="col-12">
                <div class="mt-3 card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID User</th>
                                        <th>Order ID</th>
                                        <th>Status</th>
                                        <th>Price</th>
                                        <th>Item Name</th>
                                        <th>Customer First Name</th>
                                        <th>Customer Email</th>
                                        <th>Checkout Link</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pembayarans as $pembayaran)
                                        <tr>
                                            <td>{{ $pembayaran->user_id }}</td>
                                            <td>{{ $pembayaran->order_id }}</td>
                                            <td>{{ $pembayaran->status }}</td>
                                            <td>{{ $pembayaran->price }}</td>
                                            <td>{{ $pembayaran->item_name }}</td>
                                            <td>{{ $pembayaran->customer_first_name }}</td>
                                            <td>{{ $pembayaran->customer_email }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
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

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
                <h1>Data Pembayaran Pakaian</h1>
            </div>
            <div class="col-12">
                <div class="mt-3 card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID User</th>
                                        <th>Nama</th>
                                        <th>OrderID</th>
                                        <th>harga</th>
                                        <th>Item</th>
                                        <th>Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $items)
                                        <tr>
                                            <td>{{ $items->user_id }}</td>
                                            <td>{{ $items->customer_first_name }}</td>
                                            <td>{{ $items->order_id }}</td>
                                            <td>{{ $items->price }}</td>
                                            <td>{{ $items->item_name }}</td>
                                            <td>{{ $items->status }}</td>

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

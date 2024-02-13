@extends('tu.layouts.app')
@push('style')
    <link href="{{ asset('sbadmin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">
            <div class="row mt-5">
                <div class="col-12">
                    <h1>Data Peserta PPDB</h1>
                </div>
                <div class="col-12">
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>nama orang tua</th>
                                            <th>id invoice</th>
                                            <th>amount</th>
                                            <th>status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($items as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }} </td>
                                                <td>{{ $item->nama_depan }} {{ $item->nama_belakang }}</td>
                                                <td>{{ $item->tbl_biodata_ortu->nama_ayah }} </td>
                                                <td>{{ $item->tbl_pembayaran->invoice_id ?? 'null' }}</td>
                                                <td>{{ $item->tbl_pembayaran->amount ?? 'null' }}</td>
                                                <td>{{ $item->tbl_pembayaran->status ?? 'null' }}</td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="16">No records found.</td>
                                            </tr>
                                        @endforelse
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
        <script src="{{ asset('sbadmin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('sbadmin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('sbadmin/js/demo/admin.js') }}"></script>
    @endpush

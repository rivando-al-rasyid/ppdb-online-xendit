@extends('tu.layouts.app')
@section('title', 'Data Orang Tua Peserta PPDB')
@push('style')
    <link href="{{ asset('sbadmin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('sbadmin/vendor/datatables/Buttons/css/buttons.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('sbadmin/vendor/datatables/Buttons/css/buttons.bootstrap4.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->

        <!-- Content Row -->
        <div class="row">
            <div class="row mt-5">
                <div class="col-12">
                    <h1>Data Orang Tua Peserta PPDB</h1>
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
                                            <th>Alamat</th>
                                            <th>Nama Ayah</th>
                                            <th>No Telepon Ayah</th>
                                            <th>Nama Ibu</th>
                                            <th>No Telepon Ibu</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Depan</th>
                                            <th>Alamat</th>
                                            <th>Nama Ayah</th>
                                            <th>No Telepon Ayah</th>
                                            <th>Nama Ibu</th>
                                            <th>No Telepon Ibu</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                        @forelse ($items as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama_depan }} {{ $item->nama_belakang }}</td>
                                                <td>{{ $item->alamat }}</td>
                                                <td>{{ $item->tbl_biodata_ortu->nama_ayah }}</td>
                                                <td>{{ $item->tbl_biodata_ortu->no_tlp_ayah }}</td>
                                                <td>{{ $item->tbl_biodata_ortu->nama_ibu }}</td>
                                                <td>{{ $item->tbl_biodata_ortu->no_tlp_ibu }}</td>
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
    </div>
@endsection
@push('script')
    <!-- Page level plugins -->

    <script src="{{ asset('sbadmin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('sbadmin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('sbadmin/vendor/datatables/pdfmake-0.2.7/pdfmake.min.js') }}"></script>
    <script src="{{ asset('sbadmin/vendor/datatables/pdfmake-0.2.7/vfs_fonts.js') }}"></script>
    <script src="https://cdn.datatables.net/v/bs4/jszip-3.10.1/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.js">
    </script>
    <script src="{{ asset('sbadmin/js/demo/admin.js') }}"></script>
@endpush

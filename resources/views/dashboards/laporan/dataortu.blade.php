@extends('tu.layouts.app')
@section('title', 'Data Orang Tua Peserta PPDB')
@push('style')
    <link href="{{ asset('sbadmin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
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
                                            <th>JK</th>
                                            <th>No Pendaftaran</th>
                                            <th>Nama Ayah</th>
                                            <th>No Telepon Ayah</th>
                                            <th>Nama Ibu</th>
                                            <th>No Telepon Ibu</th>
                                            <th>Nama Wali</th>
                                            <th>No Telepon Wali</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>JK</th>
                                            <th>No Pendaftaran</th>
                                            <th>Nama Ayah</th>
                                            <th>No Telepon Ayah</th>
                                            <th>Nama Ibu</th>
                                            <th>No Telepon Ibu</th>
                                            <th>Nama Wali</th>
                                            <th>No Telepon Wali</th>

                                        </tr>
                                    </tfoot>

                                    <tbody>
                                        @forelse ($items as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }} </td>
                                                <td>{{ $item->nama_depan }} {{ $item->nama_belakang }}</td>
                                                <td>{{ $item->jenis_kelamin }} </td>
                                                <td>{{ $item->id }} </td>
                                                <td>{{ $item->tbl_biodata_ortu->nama_ayah }}</td>
                                                <td>{{ $item->tbl_biodata_ortu->no_tlp_ayah }}</td>
                                                <td>{{ $item->tbl_biodata_ortu->nama_ibu }}</td>
                                                <td>{{ $item->tbl_biodata_ortu->no_tlp_ibu }}</td>
                                                <td>{{ $item->tbl_biodata_wali->nama_wali ?? ' ' }}</td>
                                                <td>{{ $item->tbl_biodata_wali->no_tlp_wali ?? ' ' }}</td>

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
    <script src="{{ asset('sbadmin/js/demo/admin.js') }}"></script>
@endpush

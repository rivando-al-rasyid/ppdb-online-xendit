@extends('tu.layouts.app')
@section('title', 'Data Orang Tua Peserta PPDB')

@push('style')
    <!-- Custom Bootstrap Theme CSS -->
    <link href="{{ asset('path/to/your/custom/bootstrap-theme.css') }}" rel="stylesheet">
    <!-- Tabulator CSS -->
    <link href="https://unpkg.com/tabulator-tables@5.3.4/dist/css/tabulator.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="row mt-5">
                <div class="col-12">
                    <h1>Biodata Orangtua Peserta PPDB</h1>
                </div>
                <div class="col-12">
                    <div class="card mt-3">
                        <div class="card-body">
                            <div id="Tabel" class="table-responsive"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- Tabulator JS -->
    <script src="https://unpkg.com/tabulator-tables@5.3.4/dist/js/tabulator.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tableData = @json($items);

            var table = new Tabulator("#Tabel", {
                data: tableData,
                layout: "fitColumns",
                responsiveLayout: "hide",
                columns: [
                    {title: "No", formatter: "rownum", hozAlign: "center"},
                    {title: "Nama", field: "nama_depan", formatter: function(cell, formatterParams, onRendered){
                        var item = cell.getData();
                        return item.nama_depan + " " + item.nama_belakang;
                    }},
                    {title: "JK", field: "jenis_kelamin"},
                    {title: "No Pendaftaran", field: "id"},
                    {title: "Nama Ayah", field: "tbl_biodata_ortu.nama_ayah"},
                    {title: "No Telepon Ayah", field: "tbl_biodata_ortu.no_tlp_ayah"},
                    {title: "Nama Ibu", field: "tbl_biodata_ortu.nama_ibu"},
                    {title: "No Telepon Ibu", field: "tbl_biodata_ortu.no_tlp_ibu"},
                    {title: "Nama Wali", field: "tbl_biodata_wali.nama_wali"},
                    {title: "No Telepon Wali", field: "tbl_biodata_wali.no_tlp_wali"}
                ],
                pagination: "local",
                paginationSize: 10,
            });
        });
    </script>
@endpush

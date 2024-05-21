@extends('tu.layouts.app')
@section('title', 'Data Peserta PPDB')

@push('style')
    <!-- AG Grid CSS -->
    <link href="https://unpkg.com/ag-grid-community/styles/ag-grid.css" rel="stylesheet">
    <link href="https://unpkg.com/ag-grid-community/styles/ag-theme-alpine.css" rel="stylesheet">
    <style>
        /* Ensure the container and grid have a defined height and width */
        .ag-theme-alpine {
            height: 100%;
            width: 100%;
        }

        #Tabel-container {
            width: 100%;
            /* Set width to 100% */
            overflow: auto;
            /* Enable scrolling */
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row mt-5">
            <div class="col-12">
                <h1>Data Peserta PPDB</h1>
            </div>
            <div class="col-12">
                <div class="card mt-3">
                    <div class="card-body">
                        <div id="Tabel-container"> <!-- Container with defined height -->
                            <div id="Tabel" class="ag-theme-alpine"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- AG Grid JS -->
    <script src="https://unpkg.com/ag-grid-community/dist/ag-grid-community.noStyle.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tableData = @json($items);

            var columnDefs = [{
                    headerName: "No",
                    valueGetter: "node.rowIndex + 1"
                },
                {
                    headerName: "No Pendaftaran",
                    field: "id"
                },
                {
                    headerName: "Nama Depan",
                    field: "nama_depan"
                },
                {
                    headerName: "Nama Belakang",
                    field: "nama_belakang"
                },
                {
                    headerName: "JK",
                    field: "jenis_kelamin"
                },
                {
                    headerName: "NISN",
                    field: "nisn"
                },
                {
                    headerName: "NIK",
                    field: "nik"
                },
                {
                    headerName: "No KK",
                    field: "no_kk"
                },
                {
                    headerName: "Tanggal Lahir",
                    field: "tanggal_lahir"
                },
                {
                    headerName: "Tempat Lahir",
                    field: "tempat_lahir"
                },
                {
                    headerName: "Agama",
                    field: "agama"
                },
                {
                    headerName: "Asal Sekolah",
                    field: "asal_sekolah"
                },
                {
                    headerName: "Alamat",
                    field: "alamat"
                },
                {
                    headerName: "Nilai Rata rata",
                    field: "nilai_rata_rata"
                },
                {
                    headerName: "Nama Ayah",
                    field: "tbl_biodata_ortu.nama_ayah"
                },
                {
                    headerName: "No Telepon Ayah",
                    field: "tbl_biodata_ortu.no_tlp_ayah"
                },
                {
                    headerName: "Nama Ibu",
                    field: "tbl_biodata_ortu.nama_ibu"
                },
                {
                    headerName: "No Telepon Ibu",
                    field: "tbl_biodata_ortu.no_tlp_ibu"
                },
                {
                    headerName: "Nama Wali",
                    field: "tbl_biodata_wali.nama_wali"
                },
                {
                    headerName: "No Telepon Wali",
                    field: "tbl_biodata_wali.no_tlp_wali"
                },
                {
                    headerName: "KIP",
                    field: "tbl_kartu.kip"
                },
                {
                    headerName: "KKS",
                    field: "tbl_kartu.kks"
                },
                {
                    headerName: "KPS",
                    field: "tbl_kartu.kps"
                },
                {
                    headerName: "PKH",
                    field: "tbl_kartu.pkh"
                }
            ];

            var gridOptions = {
                columnDefs: columnDefs,
                rowData: tableData,
                domLayout: 'autoHeight', // Adjusts grid height to content
                defaultColDef: {
                    resizable: true // Enable column resizing
                }
            };

            var eGridDiv = document.querySelector('#Tabel');
            new agGrid.Grid(eGridDiv, gridOptions);
        });
    </script>
@endpush

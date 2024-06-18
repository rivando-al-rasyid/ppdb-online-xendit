@extends('tu.layouts.app')
@section('title', 'Data Peserta PPDB')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row mt-5">
            <div class="col-12">
                <h1>Data Peserta PPDB</h1>
            </div>
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <iframe src="{{ route('tu.laporan.diterima') }}" type="application/pdf"
                            style="width: 100%; height: 800px;" onload="this.style.visibility='visible';"
                            style="visibility:hidden;">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

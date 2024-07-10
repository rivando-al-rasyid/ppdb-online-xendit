@extends('layouts.app')
@section('title', 'Data Peserta PPDB')

@section('content')
    <div class="card-body">
        <iframe src="{{ route('pembayaran.yeah') }}" type="application/pdf"
            style="width: 100%; height: 800px; visibility:hidden;" onload="this.style.visibility='visible';" async>
        </iframe>
    </div>
@endsection

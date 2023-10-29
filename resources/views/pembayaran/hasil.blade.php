@extends('layouts.app')

@section('content')
    <div class="card w-100 h-100 position-relative overflow-hidden">
        <iframe src="{{ $invoiceUrl }}" frameborder="0" style="height: calc(100vh - 250px); width: 100%;"
            data-simplebar=""></iframe>
    </div>
@endsection

<!-- resources/views/invoices/show.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Invoice Details</h1>
    <p>Invoice ID: {{ $invoice['id'] }}</p>
    <!-- Display other invoice details as needed -->
@endsection

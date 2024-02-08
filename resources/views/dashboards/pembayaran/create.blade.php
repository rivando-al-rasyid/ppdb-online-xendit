@extends('layouts.app')

@section('content')
    <h5>Invoice Details:</h5>
    <ol class="list-group list-group-numbered">
        <li class="list-group-item">Satu Stel Dasar Pakaian Putih Dongker</li>
        <li class="list-group-item">Satu Stel Dasar Pakaian Pramuka</li>
        <li class="list-group-item">Satu Stel Dasar Baju Batik Sekolah</li>
        <li class="list-group-item">Satu Stel Dasar Pakaian Muslim (Khusus Jum’at)</li>
        <li class="list-group-item">Satu Stel Pakaian Baju Olahraga</li>
        <li class="list-group-item">Atribut, topi, dasi, pin, lambang (OSIS, Pramuka, Lokasi, dan Nama
            Siswa)</li>
    </ol>
    <ul>

        <li><strong>Amount:</strong> IDR {{ $sekolah->amount }} </li>
        <li><strong>Description:</strong> {{ $sekolah->deskripsi_tagihan }}</li>
    </ul>

    <h5>Customer Information:</h5>
    <ul>

        <li><strong>Nama:</strong> {{ $user->name }}</li>
        <li><strong>Nama Belakang:</strong> {{ $user->surname }}</li>
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>nomor HP:</strong> {{ $user->no_hp }}</li>
        {{-- Add other necessary customer data here --}}
    </ul>
    <form action="{{ route('pembayaran.store') }}" method="POST">
        @csrf <!-- Add CSRF token for security, needed for POST requests -->
        <button type="submit" class="btn btn-primary">bayar</button>
    </form>
@endsection

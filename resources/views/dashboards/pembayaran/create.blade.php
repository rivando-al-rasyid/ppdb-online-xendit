@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Deskripsi:</h5>
            <ol class="list-group list-group-numbered">
                <li class="list-group-item">Satu Stel Dasar Pakaian Putih Dongker</li>
                <li class="list-group-item">Satu Stel Dasar Pakaian Pramuka</li>
                <li class="list-group-item">Satu Stel Dasar Baju Batik Sekolah</li>
                <li class="list-group-item">Satu Stel Dasar Pakaian Muslim (Khusus Jum’at)</li>
                <li class="list-group-item">Satu Stel Pakaian Baju Olahraga</li>
                <li class="list-group-item">Atribut, topi, dasi, pin, lambang (OSIS, Pramuka, Lokasi, dan Nama Siswa)</li>
            </ol>

            <h5 class="card-title mt-4">Data Siswa:</h5>
            <ul class="list-group">
                <li class="list-group-item"><strong>Nama:</strong> {{ $user->name }}</li>
                <li class="list-group-item"><strong>Nama Belakang:</strong> {{ $user->surname }}</li>
                <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
                <li class="list-group-item"><strong>nomor HP:</strong> {{ $user->no_hp }}</li>
                {{-- Add other necessary customer data here --}}
            </ul>

            <form action="{{ route('pembayaran.store') }}" method="POST">
                @csrf <!-- Add CSRF token for security, needed for POST requests -->
                <button type="submit" class="btn btn-primary mt-4">bayar</button>
            </form>
        </div>
    </div>
@endsection

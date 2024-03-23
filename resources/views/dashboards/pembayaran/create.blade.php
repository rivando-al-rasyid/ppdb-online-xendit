@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Formulir Pembayaran dan Informasi Siswa</h2>
            <h5 class="card-title">Deskripsi:</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Barang</th>
                        <th>Quantity</th>
                        <th>Harga (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ number_format($item['price'], 0, ',', '.') }}</td>

                        </tr>
                    @endforeach
                    <td colspan="2">Jumlah</td>
                    <td>{{ $total }}</td>
                </tbody>
            </table>

            <h5 class="card-title mt-4">Data Siswa:</h5>
            <table class="table">
                <tbody>
                    <tr>
                        <th scope="row">Nama</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    {{-- Add other necessary customer data here --}}
                </tbody>
            </table>
            <div class="row">
                <div class="col-auto"> <!-- Use col-auto to only take up as much space as needed -->
                    <form action="{{ route('pembayaran.store') }}" method="POST" class="d-inline-block mr-2">
                        <!-- d-inline-block for inline display, mr-2 for a little space to the right -->
                        @csrf
                        <button type="submit" class="btn btn-primary mt-4">Bayar</button>
                    </form>
                    <a href="{{ route('pembayaran.invoice') }}" class="btn btn-success mt-4 d-inline-block">Bukti
                        Pembayaran</a>
                    <!-- d-inline-block for inline display -->
                </div>
            </div>


        </div>
    </div>
@endsection

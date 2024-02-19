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

            <form action="{{ route('pembayaran.store') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary mt-4">Bayar</button>
            </form>
        </div>
    </div>
@endsection

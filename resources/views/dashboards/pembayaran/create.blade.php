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
                    <tr>
                        <td colspan="2">Jumlah</td>
                        <td>
                            {{ number_format(
                                array_reduce(
                                    $items,
                                    function ($carry, $item) {
                                        return $carry + $item['price'] * $item['quantity'];
                                    },
                                    0,
                                ),
                                0,
                                ',',
                                '.',
                            ) }}
                        </td>
                    </tr>
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
                <div class="col-auto">
                    <form action="{{ route('pembayaran.store') }}" method="POST" class="d-inline-block me-2">
                        @csrf
                        <button type="submit" class="btn btn-primary mt-4">Bayar</button>
                    </form>
                    <a href="{{ route('pembayaran.invoice') }}" class="btn btn-success mt-4 d-inline-block">Bukti Sah
                        Pembayaran</a>
                    <button type="button" class="btn btn-info mt-4 d-inline-block" data-bs-toggle="modal"
                        data-bs-target="#uploadModal">Upload Bukti Pembayaran</button>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="uploadModalLabel">Upload Bukti Pembayaran</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('pembayaran.upload') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="paymentProof">Pilih File Bukti Pembayaran</label>
                                    <input type="file" class="form-control" id="paymentProof" name="payment_proof"
                                        required>
                                </div>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Modal -->
        </div>
    </div>

    @if ($pembayaran && $pembayaran->status !== 'settled')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var uploadModal = new bootstrap.Modal(document.getElementById('uploadModal'));
                uploadModal.show();
            });
        </script>
    @endif
@endsection

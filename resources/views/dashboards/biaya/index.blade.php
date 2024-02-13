@extends('admin.layouts.app')

@section('title', $biaya ? 'Edit Sekolah' : 'Tambah Sekolah')

@section('content')
    <div id="content">
        <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">{{ $biaya ? 'Edit Sekolah' : 'Tambah Sekolah' }}</h1>
            <!-- Form Content -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.biaya.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="deskripsi_tagihan">Deskripsi Pembayaran :</label>

                                </div>
                                <div class="form-group">
                                    <label for="amount_laki">total biaya daftar ulang Laki:</label>
                                    <input type="text" class="form-control" id="amount_laki" name="amount_laki"
                                        value="{{ $biaya ? $biaya->amount_laki : old('amount_laki') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="amount_perempuan">total biaya daftar ulang perempuan:</label>
                                    <input type="text" class="form-control" id="amount_perempuan" name="amount_perempuan"
                                        value="{{ $biaya ? $biaya->amount_perempuan : old('amount_perempuan') }}" required>
                                </div>
                                <button type="submit"
                                    class="btn btn-primary">{{ $biaya ? 'Update Information' : 'Add Information' }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Form Content -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
@endsection

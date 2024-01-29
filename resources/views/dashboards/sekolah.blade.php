@extends('admin.layouts.app')

@section('title', $sekolah ? 'Edit Sekolah' : 'Tambah Sekolah')

@section('content')
    <div id="content">

        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">{{ $sekolah ? 'Edit Sekolah' : 'Tambah Sekolah' }}</h1>

            <!-- Form Content -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form method="POST"
                        action="{{ $sekolah ? route('admin.sekolah.update', ['id' => $sekolah->id]) : route('admin.sekolah.store') }}">
                        @csrf
                        @if ($sekolah)
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $sekolah ? $sekolah->name : old('name') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Description:</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ $sekolah ? $sekolah->deskripsi : old('deskripsi') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $sekolah ? $sekolah->email : old('email') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value="{{ $sekolah ? $sekolah->phone : old('phone') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="amount">Amount:</label>
                            <input type="number" class="form-control" id="amount" name="amount"
                                value="{{ $sekolah ? $sekolah->amount : old('amount') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi_tagihan">Invoice Description:</label>
                            <textarea class="form-control" id="deskripsi_tagihan" name="deskripsi_tagihan" required>{{ $sekolah ? $sekolah->deskripsi_tagihan : old('deskripsi_tagihan') }}</textarea>
                        </div>

                        <button type="submit"
                            class="btn btn-primary">{{ $sekolah ? 'Update Information' : 'Add Information' }}</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

@endsection

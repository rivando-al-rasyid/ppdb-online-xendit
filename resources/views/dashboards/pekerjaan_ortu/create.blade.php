@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Pekerjaan Orangtua</h1>
        <p class="mb-4">
            Tambah Data Pekerjaan Orangtua
        </p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <a href="{{ route('admin.pekerjaan_ortu.index') }}" class="btn btn-warning mb-2">Back</a>
                <form action="{{ route('admin.pekerjaan_ortu.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_pekerjaan" class="form-label">Pekerjaan Ortu</label>
                        <input type="text" class="form-control" id="nama_pekerjaan" name="nama_pekerjaan" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>

    </div>
@endsection

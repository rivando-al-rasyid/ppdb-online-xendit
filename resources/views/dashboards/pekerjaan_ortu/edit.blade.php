@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Pekerjaan Orangtua</h1>
        <p class="mb-4">
            Edit Data Pekerjaan Orangtua
        </p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <a href="{{ route('admin.pekerjaan_ortu.index') }}" class="btn btn-warning mb-2">Back</a>
                <form action="{{ route('admin.pekerjaan_ortu.update', $data->id) }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="form-group">
                        <label>Nama Pekerjaan Orangtua</label>
                        <input type="text" class="form-control" value="{{ $data->nama_pekerjaan }}"
                            name="nama_pekerjaan">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>

    </div>
@endsection

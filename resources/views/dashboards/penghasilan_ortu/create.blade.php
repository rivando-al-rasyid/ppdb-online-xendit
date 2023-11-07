@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Penghasilan Ortu</h1>
        <p class="mb-4">
            Tambah Data Penghasilan Ortu
        </p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <a href="{{ route('admin.penghasilan_ortu.index') }}" class="btn btn-warning mb-2">Back</a>

                <form action="{{ route('admin.penghasilan_ortu.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="penghasilan_ortu" class="form-label">Penghasilan Ortu</label>
                        <input type="number" class="form-control" id="penghasilan_ortu" name="penghasilan_ortu" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>

    </div>
@endsection

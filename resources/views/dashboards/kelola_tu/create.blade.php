@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <h1 class="h3 mb-2 text-gray-800">TU</h1>
        <p class="mb-4">Tambah Data TU</p>

        <div class="card mb-4">
            <div class="card-body">
                <a href="{{ route('kelola_tu.index') }}" class="btn btn-warning mb-3">Back</a>
                <form action="{{ route('kelola_tu.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama TU</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Password Confirmation</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                            required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection

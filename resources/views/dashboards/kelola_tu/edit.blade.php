@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <h1 class="h3 mb-2 text-gray-800">Data Tata Usaha</h1>
        <p class="mb-4">Edit Data Tata Usaha</p>

        <div class="card mb-4">
            <div class="card-body">
                <a href="{{ route('admin.kelola_tu.index') }}" class="btn btn-warning mb-3">Back</a>
                <form action="{{ route('admin.kelola_tu.update', $data->id) }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama User</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $data->email }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" minlength="6">
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Password Confirmation</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                            minlength="6">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h2 class="mt-4">Create Payment</h2>
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('pembayaran.store') }}" method="POST">
                    @csrf <!-- Add CSRF token for security, needed for POST requests -->
                    <div class="mb-3">
                        <label for="user_id" class="form-label">First Name</label>
                        <input type="number" class="form-control" id="user_id" name="user_id" value="{{ $user->id }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="customer_first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="customer_first_name" name="customer_first_name"
                            value="{{ $user->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="customer_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="customer_email" name="customer_email"
                            value="{{ $user->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="customer_phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="customer_phone" name="customer_phone"
                            value="{{ $user->phone }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Payment</button>
                </form>
            </div>
        </div>
    </div>
@endsection

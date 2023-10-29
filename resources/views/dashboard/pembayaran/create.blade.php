@extends('dashboard.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">tagihan anda!</div>

                    <div class="card-body">
                        <ul>
                            <li><strong>Nama:</strong> {{ $user->name }} </li>
                            <li><strong>email:</strong> {{ $user->email }} </li>
                            <li><strong>Amount:</strong> {{ $sekolah->amount }} </li>
                            <li><strong>Description:</strong> {{ $sekolah->deskripsi_tagihan }}</li>
                        </ul>
                        <form action="{{ route('pembayaran.store') }}" method="POST">
                            @csrf <!-- Add CSRF token for security, needed for POST requests -->
                            <button type="submit" class="btn btn-primary">Create Payment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

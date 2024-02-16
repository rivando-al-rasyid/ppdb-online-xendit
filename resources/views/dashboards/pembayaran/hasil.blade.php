@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Embedded Content</h5>
        </div>
        <div class="card-body">
            <iframe src="https://example.com" width="100%" height="400px"></iframe>
        </div>
    </div>
@endsection

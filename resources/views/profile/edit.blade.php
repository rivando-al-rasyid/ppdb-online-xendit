@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <!-- Main body content goes here -->
    <div class="container py-5 d-flex justify-content-center align-items-center">
        <div class="row">
            <div class="col-lg-6">
                <div class="bg-white shadow p-4 rounded-lg mb-4 h-100">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="col-lg-6">
                <div class="bg-white shadow p-4 rounded-lg h-100">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
@endsection

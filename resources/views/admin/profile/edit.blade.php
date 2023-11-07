@extends('admin.layouts.app')

@section('content')
    <div>
        <div class="bg-white shadow p-4 rounded-lg mb-4 h-100">
            @include('admin.profile.partials.update-profile-information-form')
        </div>
    </div>

    <div>
        <div class="bg-white shadow p-4 rounded-lg h-100">
            @include('admin.profile.partials.update-password-form')
        </div>
    </div>
@endsection

<div class="mb-4">
    <h2 class="text-lg font-medium text-gray-900" id="profile-info-label">
        {{ __('Profile Information') }}
    </h2>
    <p class="mt-1 text-sm text-gray-600">
        {{ __("Update your account's profile information and email address.") }}
    </p>
</div>

<form id="send-verification" method="post" action="{{ route('tu.verification.send') }}" class="mb-4">
    @csrf
</form>

<form method="post" action="{{ route('tu.profile.update') }}" class="mt-4">
    @csrf
    @method('patch')

    <div class="mb-3">
        <label for="name" class="form-label">{{ __('Name') }}</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}"
            required autofocus autocomplete="name" aria-labelledby="profile-info-label name">
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">{{ __('Email') }}</label>
        <input type="email" class="form-control" id="email" name="email"
            value="{{ old('email', $user->email) }}" required autocomplete="email"
            aria-labelledby="profile-info-label email">
        <x-input-error class="mt-2" :messages="$errors->get('email')" />
    </div>

    <div class="row">
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </div>

        <div class="col-md-8">
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </div>
</form>

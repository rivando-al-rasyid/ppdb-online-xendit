<div class="container mt-5">
    <h2 class="h4 text-gray-900 mb-4">
        Update Password
    </h2>

    <p class="mt-1 text-sm text-gray-600 mb-4">
        Ensure your account is using a long, random password to stay secure.
    </p>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">

        @csrf
        @method('put')

        <div class="mb-3">
            <label for="current_password" class="form-label">{{ __('Current Password') }}</label>
            <input type="password" class="form-control" id="current_password" name="current_password"
                autocomplete="current-password">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">{{ __('New Password') }}</label>
            <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </div>

        @if (session('status') === 'password-updated')
            <div class="alert alert-success mt-3">
                {{ __('Saved.') }}
            </div>
        @endif
    </form>
</div>

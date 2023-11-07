<div class="mb-4">
    <h2 class="text-lg font-medium text-gray-900" id="profile-info-label">
        {{ __('Update Password ') }}
    </h2>
    <p class="mt-1 text-sm text-gray-600">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </p>
</div>
<form method="post" action="{{ route('tu.password.update') }}" class="mt-3">
    @csrf
    @method('put')

    <div class="mb-3">
        <label for="current_password" class="form-label">Current Password</label>
        <input type="password" class="form-control" id="current_password" name="current_password"
            autocomplete="current-password">
        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">New Password</label>
        <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
    </div>

    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
            autocomplete="new-password">
        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
    </div>

    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Save</button>

        @if (session('status') === 'password-updated')
            <p class="text-sm text-gray-600">Saved.</p>
        @endif
    </div>
</form>
1

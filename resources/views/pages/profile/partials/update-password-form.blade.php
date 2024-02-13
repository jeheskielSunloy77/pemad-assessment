<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Update Password
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Ensure your account is using a long, random password to stay secure.
            {{ $errors }}
        </p>
    </header>

    <form action="{{ route('password.update') }}" method="POST" class="mt-6 space-y-6">
        @csrf
        @method('PUT')

        <div class="space-y-1">
            <x-input-label value="Current Password" for="update_password_current_password" />
            <x-text-input id="update_password_current_password" name="current_password" type="password"
                autocomplete="current-password" placeholder="Enter your current password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" />
        </div>

        <div class="space-y-1">
            <x-input-label value="New Password" for="update_password_password" />
            <x-text-input id="update_password_password" name="password" type="password" autocomplete="new-password"
                placeholder="Enter your new password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" />
        </div>

        <div class="space-y-1">
            <x-input-label value="Confirm Passoword" for="update_password_password_confirmation" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                autocomplete="new-password" placeholder="Enter your confirmation password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" />
        </div>

        <div class="flex items-center flex-col gap-4">
            <x-primary-button class="w-full" type="submit">
                Update Profile
            </x-primary-button>
            <x-flash-message message="{{ session('password-message') }}" />
        </div>
    </form>
</section>

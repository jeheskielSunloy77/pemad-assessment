<x-layouts.auth>
    <div>
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>
        <form method="POST" action="{{ route('password.confirm') }}"class="space-y-4">
            @csrf
            <div>
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input value="{{ old('password') }}" id="password" class="block mt-1 w-full" type="password"
                    name="password" required autocomplete="current-password" placeholder="Enter your password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <x-primary-button class="w-full">
                Confirm
            </x-primary-button>
        </form>
    </div>
</x-layouts.auth>

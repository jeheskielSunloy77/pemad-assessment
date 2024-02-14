<x-layouts.auth>
    <div>

        <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input value="{{ old('email') }}" id="email" type="email" name="email" required autofocus
                    autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" />
            </div>

            <div class="space-y-1">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input value="{{ old('password') }}" id="password" type="password" name="password" required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" />
            </div>

            <div class="space-y-1">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input value="{{ old('password_confirmation') }}" id="password_confirmation" type="password"
                    name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" />
            </div>

            <div class="flex items-center justify-end ">
                <x-primary-button>
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </form>
    </div>

</x-layouts.auth>

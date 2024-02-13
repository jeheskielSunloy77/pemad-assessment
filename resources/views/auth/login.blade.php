<x-layouts.auth>

    <div>
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <form method="POST" action="{{ route('login') }}"class="space-y-4">
            @csrf
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input value="{{ old('email') }}" id="email" class="block mt-1 w-full" type="email"
                    name="email" required autofocus autocomplete="username" placeholder="Enter your email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input value="{{ old('password') }}" id="password" class="block mt-1 w-full" type="password"
                    name="password" required autocomplete="current-password" placeholder="Enter your password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between">
                <label for="remember" class="inline-flex items-center">
                    <input value="{{ old('remember') }}" id="remember" type="checkbox"
                        class="rounded dark:bg-black border-gray-300 dark:border-gray-700 text-black shadow-sm focus:ring-black dark:focus:ring-white dark:focus:ring-offset-gray-800"
                        name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black dark:focus:ring-white-800"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <x-primary-button class="inline-flex items-center justify-center w-full">
                {{ __('Log in') }}
            </x-primary-button>
            <p class="text-sm text-center text-gray-600 dark:text-gray-400">
                Don't have an account yet?
                <a class="underline hover:text-gray-900 dark:hover:text-gray-100" href="{{ route('register') }}">
                    {{ __('register here!') }}
                </a>
            </p>
        </form>
    </div>
</x-layouts.auth>

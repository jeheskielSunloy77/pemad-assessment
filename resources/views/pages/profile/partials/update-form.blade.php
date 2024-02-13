@php($user = auth()->user())

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Profile Information
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Update your account's profile information and email address.
        </p>
    </header>
    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form action="{{ route('profile.update') }}" class="mt-6 space-y-6" method="POST">
        @csrf
        @method('PATCH')

        <div class="space-y-1">
            <x-input-label for="name" value="Name" />
            <x-text-input id="name" name="name" type="text" required autofocus autocomplete="name"
                placeholder="Enter your name" value="{{ old('name', $user->name) }}" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="space-y-1">
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" required autocomplete="username"
                placeholder="Enter your email" value="{{ old('email', $user->email) }}" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm text-gray-800 dark:text-gray-200">
                        Your email address is unverified.

                        <button form="send-verification" type="submit"
                            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            Click here to re-send the verification email.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="font-medium text-sm text-green-600 dark:text-green-400">
                            A new verification link has been sent to your email address.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center flex-col gap-4">
            <x-primary-button class="w-full" type="submit">
                Update Profile
            </x-primary-button>
            <x-flash-message message="{{ session('message') }}" />
        </div>
    </form>
</section>

@php
    $theme = Cookie::get('theme');
    $user = request()->user();
@endphp

<x-dropdown align="right" width="48">
    <x-slot name="trigger">
        <button>
            <img class="w-10 h-10 rounded-full border p-0.5 dark:border-gray-600 hover:opacity-80 transition-opacity"
                src="{{ $user->avatar_url ?? 'https://api.dicebear.com/7.x/adventurer/svg?scale=120&seed=' . $user->id }}"
                alt="User Avatar">
        </button>
    </x-slot>
    <x-slot name="content">
        <div class="divide-y divide-gray-100 dark:bg-black dark:divide-gray-900">
            <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                <div>
                    {{ $user->name }}
                </div>
                <div class="font-medium truncate">
                    {{ $user->email }}
                </div>
            </div>
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
                <li>
                    <a href="/"
                        class="flex items-center gap-3 px-4 py-2 hover:bg-gray-100 dark:hover:bg-[#090909] dark:hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-black dark:text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <a href="/profile"
                        class="flex items-center gap-3 px-4 py-2 hover:bg-gray-100 dark:hover:bg-[#090909] dark:hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-black dark:text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                        Profile
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('theme.update', $theme === 'dark' ? 'light' : 'dark') }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="flex items-center gap-3 px-4 py-2 hover:bg-gray-100 dark:hover:bg-[#090909] dark:hover:text-white w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-black dark:text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="{{ $theme === 'light' ? 'M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z' : 'M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z' }}" />
                            </svg>
                            {{ $theme === 'light' ? 'Dark' : 'Light' }} Mode
                        </button>
                    </form>
                </li>
            </ul>
            <form method="POST" action="{{ route('logout') }}" class="py-1">
                @csrf
                <button type="submit"
                    class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-[#090909] dark:text-gray-200 dark:hover:text-white w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 text-black dark:text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                    </svg>
                    Sign out
                </button>
            </form>
        </div>
    </x-slot>
</x-dropdown>

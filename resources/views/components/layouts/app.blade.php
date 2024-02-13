@props(['title' => 'Page Title'])
@php
    $user = auth()->user();
    $theme = Cookie::get('theme');
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ $theme }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}">
    <meta name="description" content="Page Description">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

@if ($theme === 'dark')
    <style>
        :root {
            color-scheme: dark;
        }
    </style>
@endif


<body class="text-black dark:text-white" x-data="{ sidebarOpen: true }">
    <header
        class="fixed top-0 z-40 left-0 w-screen flex h-16 items-center justify-between gap-4 border-b dark:border-b-gray-800 bg-gray-100/40 dark:bg-[#090909] px-6">
        <div class="flex items-center gap-2">
            <x-application-logo class="h-6 w-6 hidden lg:block" />
            <x-icon-button class="lg:hidden" @click="sidebarOpen = !sidebarOpen">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
                </svg>
            </x-icon-button>
            <h2 class="font-bold">Pemad App</h2>
        </div>
        <div class="flex items-center gap-4">
            <x-layouts.partials.avatar />
        </div>
    </header>
    <aside x-show="sidebarOpen" x-bind:class="sidebarOpen ? 'translate-x-0 ease-out' : 'hidden lg:block'"
        class="fixed left-0 top-[4rem] h-[calc(100vh-4rem)] z-50 w-72 border-r dark:border-r-gray-800 bg-gray-100/40 dark:bg-[#090909]">
        <div class="flex h-full max-h-screen flex-col gap-2 pt-6">
            <div class="flex-1 overflow-auto py-2">
                <nav class="grid items-start px-4 text-sm font-medium gap-2">
                    <x-layouts.partials.nav-link href="{{ route('home') }}" route="home">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        Home
                    </x-layouts.partials.nav-link>
                    @if ($user->role === 'admin')
                        <x-layouts.partials.admin-nav />
                    @elseif ($user->role === 'user')
                        <x-layouts.partials.user-nav />
                    @elseif ($user->role === 'client')
                        <x-layouts.partials.client-nav />
                    @endif
                    <hr class="my-2 border-t dark:border-gray-800">
                    <x-layouts.partials.nav-link href="/profile" route="profile">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                        Profile
                    </x-layouts.partials.nav-link>
                </nav>
            </div>
        </div>
    </aside>

    <div class="mt-16 lg:ml-72">
        {{ $slot }}
    </div>
</body>

</html>

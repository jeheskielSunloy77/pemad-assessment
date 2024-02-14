@php($theme = Cookie::get('theme'))

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ $theme }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Page Title' }}</title>
    <meta name="description" content="Page Description">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@if ($theme === 'dark')
    <style>
        :root {
            color-scheme: dark;
        }
    </style>
@endif

<body class="font-sans text-black dark:text-white antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50 dark:bg-[#090909]">
        <div>
            <a href="/">
                <x-application-logo class="w-14 h-14" />
            </a>
        </div>
        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-black overflow-hidden sm:rounded-lg border dark:border-gray-900 bg-card text-card-foreground shadow-sm">
            {{ $slot }}
        </div>
    </div>
</body>

</html>

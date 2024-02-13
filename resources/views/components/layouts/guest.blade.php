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

<body class="font-sans text-black dark:text-white antialiased bg-white dark:bg-black">
    {{ $slot }}
</body>

</html>

@props(['href', 'route'])

<a class="flex items-center gap-3 rounded-md px-3 py-2 transition-colors {{ request()->routeIs($route . '*') ? 'bg-black text-white dark:bg-white dark:text-black hover:bg-black/90' : 'text-gray-900 dark:text-gray-50 hover:bg-gray-200 dark:hover:bg-gray-900' }}"
    href="{{ $href }}">
    {{ $slot }}
</a>

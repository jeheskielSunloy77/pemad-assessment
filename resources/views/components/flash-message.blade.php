@props(['message' => false])

@if ($message)
    <div x-data="{ isVisible: true }" x-init="setTimeout(() => { isVisible = false }, 5000)">
        <div x-show="isVisible"
            {{ $attributes->merge(['class' => 'flex items-center px-4 py-2 border-t-4 border-black bg-gray-50 dark:bg-[#090909] dark:border-white']) }}
            role="alert">
            <svg class="flex-shrink-0 w-4 h-4 dark:text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <div class="ms-3 text-sm font-medium text-gray-800 dark:text-gray-300">
                {{ $message }}
            </div>
        </div>
    </div @endif

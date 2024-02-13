<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'p-1 dark:hover:bg-gray-900 rounded dark:hover:text-gray-200 hover:bg-gray-200 hover:text-gray-700']) }}>
    {{ $slot }}
</button>

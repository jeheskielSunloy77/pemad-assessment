<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'px-4 py-2 bg-red-600 dark:bg-red-500 border border-transparent rounded-md font-semibold text-sm text-white tracking-widest hover:bg-red-500 dark:hover:bg-red-500/90 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

@props(['columns' => [], 'label' => '', 'route' => '', 'data' => []])

<div class="border dark:border-gray-900 relative shadow-sm sm:rounded-md overflow-hidden">
    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
        <div class="w-full md:w-1/2 xl:w-1/3">
            <form class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="absolute left-2.5 top-2.5 h-4 w-4 text-gray-500 dark:text-gray-400">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                </svg>
                <x-text-input class="pl-8" placeholder="Search {{ $label }}" type="search" name="q"
                    value="{{ request('q') }}" />
            </form>
        </div>
        <div
            class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
            {{ $actions ?? '' }}
            <a href="{{ route($route . '.show', 'new') }}">
                <x-primary-button class="w-full">Add {{ $label }}</x-primary-button>
            </a>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="text-xs uppercase bg-gray-50 dark:bg-[#090909]">
                <tr>
                    @foreach ($columns as $column)
                        <th scope="col" class="px-4 py-3">{{ $column }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="text-gray-500 dark:text-gray-400">
                {{ $slot }}
            </tbody>
        </table>
    </div>
    {{ $data->links() }}
</div>

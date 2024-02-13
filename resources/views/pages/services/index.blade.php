@php
    $isMyServices = request()->has('mine');
    $isFiltered = !empty(request()->all());

    $isUserRoute = isset($isUserRoute) ? $isUserRoute : false;
    $route = $isUserRoute ? 'browse-services' : 'services';

@endphp
<x-layouts.app title="{{ $pageTitle }}">
    <main class="dark:bg-black p-3 sm:p-5 min-h-[93.7vh]">
        <div class="mx-auto container px-4 lg:px-6">

            <x-data-grid.table label="service" route="{{ $route }}" :columns="$columns" :data="$services">
                @if (isset($isUserRoute))
                    <x-slot name="actions">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <x-secondary-button class="relative">
                                    Filters
                                    @if ($isFiltered)
                                        <span
                                            class="absolute -top-1 -right-1 bg-black dark:bg-white rounded-full text-white dark:text-black w-4 h-4 text-xs">
                                            !
                                        </span>
                                    @endif
                                </x-secondary-button>
                            </x-slot>
                            <x-slot name="content">
                                <div class="divide-y divide-gray-100 dark:bg-black dark:divide-gray-900">
                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                        aria-labelledby="avatarButton">
                                        <li>
                                            <a href="{{ route('browse-services.index') }}"
                                                class="flex items-center gap-3 px-4 py-2 {{ !$isFiltered
                                                    ? 'bg-black dark:bg-white text-white dark:text-black hover:bg-black/90 dark:hover:bg-gray-100'
                                                    : 'hover:bg-gray-100 dark:hover:bg-[#090909] dark:hover:text-white' }}">
                                                All Services
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('browse-services.index', ['from' => 'user']) }}"
                                                class="flex items-center gap-3 px-4 py-2 {{ request()->from === 'user' ? 'bg-black dark:bg-white text-white dark:text-black hover:bg-black/90 dark:hover:bg-gray-100' : 'hover:bg-gray-100 dark:hover:bg-[#090909] dark:hover:text-white' }}">
                                                Offered Services
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('browse-services.index', ['from' => 'client']) }}"
                                                class="flex items-center gap-3 px-4 py-2 {{ request()->from === 'client' ? 'bg-black dark:bg-white text-white dark:text-black hover:bg-black/90 dark:hover:bg-gray-100' : 'hover:bg-gray-100 dark:hover:bg-[#090909] dark:hover:text-white' }}">
                                                Requested Services
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('browse-services.index', ['mine' => 'true']) }}"
                                                class="flex items-center gap-3 px-4 py-2 {{ request()->has('mine')
                                                    ? 'bg-black dark:bg-white text-white dark:text-black hover:bg-black/90 dark:hover:bg-gray-100'
                                                    : 'hover:bg-gray-100 dark:hover:bg-[#090909] dark:hover:text-white' }}">
                                                My Services
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </x-slot>
                        </x-dropdown>

                    </x-slot>
                @endif
                @foreach ($services as $service)
                    <tr class="border-b dark:border-gray-900 dark:hover:bg-[#090909] hover:bg-gray-50">
                        <th scope="row"
                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $service->name }}
                        </th>
                        @if (!$isMyServices)
                            <td class="px-4 py-3 flex items-center gap-2">
                                <img src="{{ $service->user->avatar_url }}" alt="{{ $service->user->name }}"
                                    class="w-8 h-8 rounded-full border dark:border-gray-900">

                                {{ $service->user->name }}
                            </td>
                        @endif
                        <td class="px-4 py-3 capitalize">{{ $service->type }}</td>
                        <td class="px-4 py-3 capitalize">{{ $service->language }}</td>
                        <td class="px-4 py-3">{{ $service->created_at->format('M d, Y') }}</td>
                        <td class="px-4 py-3 flex items-center gap-2">
                            <x-data-grid.view-button route="{{ isset($isUserRoute) ? 'browse-services' : 'services' }}"
                                id="{{ $service->id }}" />
                            @if ($isMyServices || !isset($isUserRoute))
                                <x-data-grid.delete-button route="services" id="{{ $service->id }}" />
                            @endif
                        </td>
                    </tr>
                @endforeach
            </x-data-grid.table>
        </div>
    </main>
</x-layouts.app>

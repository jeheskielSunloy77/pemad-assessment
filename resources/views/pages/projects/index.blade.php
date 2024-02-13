@php
    $route = 'projects';
    $columns = ['service name', 'Client', 'user', 'status', 'price', 'payment due', 'paid at', 'Created At', 'actions'];

    if (isset($isUserRoute)) {
        $route = 'my-projects';
        array_splice($columns, 2, 1);
    }
@endphp
<x-layouts.app title="{{ $pageTitle }}">
    <main class="dark:bg-black p-3 sm:p-5 min-h-[93.7vh]">
        <div class="mx-auto container px-4 lg:px-6">

            <x-data-grid.table label="project" route="{{ $route }}" :columns="$columns" :data="$projects">
                @foreach ($projects as $project)
                    <tr class="border-b dark:border-gray-900 dark:hover:bg-[#090909] hover:bg-gray-50">
                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $project->service->name }}
                        </th>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <img src="{{ $project->client->user->avatar_url }}"
                                    alt="{{ $project->client->user->name }}"
                                    class="w-8 h-8 rounded-full border dark:border-gray-900">

                                {{ $project->client->user->name }}
                            </div>
                        </td>
                        @if (!isset($isUserRoute))
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <img src="{{ $project->user->avatar_url }}" alt="{{ $project->user->name }}"
                                        class="w-8 h-8 rounded-full border dark:border-gray-900">

                                    {{ $project->user->name }}
                                </div>
                            </td>
                        @endif
                        <td class="px-4 py-3 capitalize">{{ $project->status }}</td>
                        <td class="px-4 py-3">${{ $project->price }}</td>
                        <td class="px-4 py-3">
                            {{ $project->payment_due_date ? $project->payment_due_date->format('M d, Y h:i A') : '-' }}
                        </td>
                        <td class="px-4 py-3">
                            {{ $project->paid_at ? $project->paid_at->format('M d, Y h:i A') : '-' }}
                        </td>
                        <td class="px-4 py-3">{{ $project->created_at->format('M d, Y') }}</td>
                        <td class="px-4 py-3 flex items-center gap-2">
                            <x-data-grid.view-button route="{{ $route }}" id="{{ $project->id }}" />
                            <x-data-grid.delete-button route="projects" id="{{ $project->id }}" />
                        </td>

                    </tr>
                @endforeach
            </x-data-grid.table>
        </div>
    </main>
</x-layouts.app>

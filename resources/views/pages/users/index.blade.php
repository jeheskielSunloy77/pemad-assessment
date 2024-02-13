<x-layouts.app title="{{ $pageTitle }}">
    <main class="dark:bg-black p-3 sm:p-5 min-h-[93.7vh]">
        <div class="mx-auto container px-4 lg:px-6">

            @php($columns = ['Name', 'Email', 'Role', 'Created At', 'actions'])
            <x-data-grid.table label="user" route="users" :columns="$columns" :data="$users">
                @foreach ($users as $user)
                    <tr class="border-b dark:border-gray-900 dark:hover:bg-[#090909] hover:bg-gray-50">
                        <th scope="row"
                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white flex items-center gap-2">
                            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}"
                                class="w-8 h-8 rounded-full border dark:border-gray-900">
                            {{ $user->name }}
                        </th>
                        <td class="px-4 py-3">{{ $user->email }}</td>
                        <td class="px-4 py-3 capitalize">{{ $user->role }}</td>
                        <td class="px-4 py-3">{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="px-4 py-3 flex items-center gap-2">
                            <x-data-grid.view-button route="users" id="{{ $user->id }}" />
                            <x-data-grid.delete-button route="users" id="{{ $user->id }}" />
                        </td>

                    </tr>
                @endforeach
            </x-data-grid.table>
        </div>
    </main>
</x-layouts.app>

<x-layouts.app title="User Profile | Pemad App">
    <main class="dark:bg-black">
        <div class="container mx-auto sm:px-6 lg:px-8 space-y-6 max-w-3xl py-10">
            <div class="p-4 sm:p-8 rounded-lg border dark:border-gray-800 shadow-sm">
                @include('pages.profile.partials.update-form')
            </div>
            <div class="p-4 sm:p-8 rounded-lg border dark:border-gray-800 shadow-sm">
                @include('pages.profile.partials.update-password-form')
            </div>
            <div class="p-4 sm:p-8 rounded-lg border dark:border-gray-800 shadow-sm">
                @include('pages.profile.partials.delete-form')
            </div>
        </div>
    </main>
</x-layouts.app>

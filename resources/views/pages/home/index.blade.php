@php($theme = Cookie::get('theme', 'light'))

@auth
    <x-layouts.app title="Home | Pemad App">
        <main class="bg-white dark:bg-black">
            <div class="mx-auto container py-2 lg:py-6 px-4 lg:px-12">
                @include('pages.home.partials.features')
                @include('pages.home.partials.app-flow')
        </main>
        </div>
    </x-layouts.app>
@endauth


@guest
    <x-layouts.guest title="Wellcome | Pemad App">
        <main class="mx-auto container py-2 lg:py-6 px-4 lg:px-12">
            <section class="min-h-screen flex items-center justify-center">
                @include('pages.home.partials.hero')
            </section>
            @include('pages.home.partials.features')
            @include('pages.home.partials.app-flow')
        </main>
    </x-layouts.guest>
@endguest

@php
    $taskConditionsTabs = [
        [
            'title' => 'CRUD Operations',
            'content' => 'Contains CRUD operations for all of the database tables. Check out the <i class="text-gray-800 dark:text-gray-200">controllers</i> on <i class="text-gray-800 dark:text-gray-200">app/Http/Controllers/*</i>',
            'icon' => 'check',
        ],
        [
            'title' => 'Database Migation and Seeder',
            'content' => 'Contain database migrations and seeder for all of the database tables. Check out the migrations and seeder on <i class="text-gray-800 dark:text-gray-200">database/migrations/*</i> and <i class="text-gray-800 dark:text-gray-200">database/seeders/DatabaseSeeder.php</i>',
            'icon' => 'check',
        ],
        [
            'title' => 'Database Structure',
            'content' => 'The database structure is built based on the requirements. Check out the database structure on <i class="text-gray-800 dark:text-gray-200">database/migrations/*</i> and <i class="text-gray-800 dark:text-gray-200">app/Models/*</i>',
            'icon' => 'check',
        ],
        [
            'title' => 'Repository Pattern',
            'content' => 'Using <strong class="text-gray-800 dark:text-gray-200">Repository Pattern</strong> to separate the database layer from the application layer. This makes the application more scalable and maintainable.. Check out the repositories on <i class="text-gray-800 dark:text-gray-200">app/Repositories/*</i>',
            'icon' => 'check',
        ],
        [
            'title' => 'Code Documentation',
            'content' => 'The code is well documented and as per requested i wrote some some <strong class="text-gray-800 dark:text-gray-200">comments on most of the methods</strong>. I also <strong class="text-gray-800 dark:text-gray-200">Typed</strong> all of the methods so that the code is more readable and maintainable.',
            'icon' => 'check',
        ],
        [
            'title' => 'Application GUI',
            'content' => 'Contains beautiful and responsive GUI for the application. It is built using Tailwind CSS, AlpineJS and Laravel Blade. <strong class="text-gray-800 dark:text-gray-200">Custom built</strong> by bare hands.',
            'icon' => 'check',
        ],
        [
            'title' => 'Proudly Built by Myself',
            'content' => 'The application is designed, built and tested <strong class="text-gray-800 dark:text-gray-200">100% by myself</strong> and is not a copy of any other project, neither is it a template. It is a custom built application.',
            'icon' => 'check',
        ],
    ];
    $todosTabs = [
        [
            'title' => 'Test the project to maximum coverage',
            'content' => 'Test the project to maximum coverage using Pest and Laravel Dusk.',
            'icon' => 'uncheck',
        ],
        [
            'title' => 'Deploy the project',
            'content' => 'Deploy the project to a <strong class="text-gray-800 dark:text-gray-200">production environment</strong> via AWS cloud services.',
            'icon' => 'uncheck',
        ],
        [
            'title' => 'CI/CD pipeline',
            'content' => 'Create a CI/CD pipeline for the project using Github Actions.',
            'icon' => 'uncheck',
        ],
    ];
    $otherFeatures = [
        [
            'title' => 'Authentication',
            'content' => 'Added authentication system for the application. The user can register, login, reset password and more. The implementation follows all the 
            <strong class="text-gray-800 dark:text-gray-200">best practices</strong> for authentication.',
        ],
        [
            'title' => 'Fully Dockerized',
            'content' => 'Using <strong class="text-gray-800 dark:text-gray-200">Docker Compose</strong> for running the application in a containerized environment and to serve its dependencies like <strong class="text-gray-800 dark:text-gray-200">MySQL</strong> and <strong class="text-gray-800 dark:text-gray-200">Memcached</strong>. Check out the <i class="text-gray-800 dark:text-gray-200">docker-compose.yml</i> file on the root of the project.',
        ],
        [
            'title' => 'UI Dark Mode',
            'content' => 'Added a dark mode feature for the application. The user can toggle between light and dark mode via a button on user dropdown. The implementation of the dark mode is done using <strong class="text-gray-800 dark:text-gray-200">TailwindCSS</strong>.',
        ],
        [
            'title' => 'Models Authorization',
            'content' => 'Added <strong class="text-gray-800 dark:text-gray-200">Policies</strong> for all models in the application, for ensuring no user can make unauthorized request. Check out the policies on <i class="text-gray-800 dark:text-gray-200">app/Policies/*</i>',
        ],
        [
            'title' => 'Email Notification',
            'content' => 'Implement email notification system for user authentication and more. Please add your email credentials on <i class="text-gray-800 dark:text-gray-200">.env</i> like file to use the email notification.',
        ],
        [
            'title' => 'Caching',
            'content' => 'Using <strong class="text-gray-800 dark:text-gray-200">Memcached</strong> for caching layer on the <strong class="text-gray-800 dark:text-gray-200">repository</strong>. Making the application more performant and scalable. See the implementation onon <i class="text-gray-800 dark:text-gray-200">app/Repositories/AppRepository.php</i> and <i class="text-gray-800 dark:text-gray-200">app/Livewire/Dashboard.php</i>',
        ],
    ];
@endphp

<section id="features" class="container mx-auto sm:px-6 lg:px-8 space-y-6 md:space-y-12 max-w-4xl py-10"
    x-data="{ openTab: null }">
    <header class="space-y-4">
        <h1 class="text-3xl font-bold text-center underline underline-offset-8 decoration-yellow-500">Features
        </h1>
        <p class="text-center text-gray-600 dark:text-gray-300">Here are some of the features of the application.</p>
    </header>
    <div>
        <h2 class="mb-2 text-lg font-semibold">Task Conditions:</h2>
        <x-accordion :tabs="$taskConditionsTabs" />
    </div>
    <div>
        <h2 class="mb-2 text-lg font-semibold">Other Features:</h2>
        <x-accordion :tabs="$otherFeatures" />
    </div>
    <div>
        <h2 class="mb-2 text-lg font-semibold">Todos:</h2>
        <x-accordion :tabs="$todosTabs" />
    </div>
</section>

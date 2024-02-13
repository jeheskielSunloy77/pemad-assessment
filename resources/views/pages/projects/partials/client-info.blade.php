<section class="space-y-6 border-t dark:border-gray-800 pt-2">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Client Information
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            You can check out the client information below.
        </p>
    </header>

    <fieldset disabled class="grid grid-cols-2 gap-6">
        <div class="space-y-1">
            <x-input-label for="company_name" :value="__('Company Name')" />
            <x-text-input id="company_name" type="text" value="{{ $projectClient->company_name }}" />
        </div>
        <div class="space-y-1">
            <x-input-label for="client_name" :value="__('Client Name')" />
            <x-text-input id="client_name" type="text" value="{{ $projectClient->user->name }}" />
        </div>
    </fieldset>
</section>

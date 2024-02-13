 <section class="space-y-6 border-t dark:border-gray-800 pt-2">
     <header>
         <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
             Service Information
         </h2>

         <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
             You can check out the service information below.
         </p>
     </header>

     <fieldset disabled class="grid grid-cols-2 gap-6">
         <div class="space-y-1 col-span-2">
             <x-input-label for="name" :value="__('Name')" />
             <x-text-input id="name" type="text" value="{{ $projectService->name }}" />
         </div>
         <div class="space-y-1">
             <x-input-label for="type" :value="__('Type')" />
             <x-text-input id="type" type="text" value="{{ $projectService->type }}" />
         </div>
         <div class="space-y-1">
             <x-input-label for="language" :value="__('Language')" />
             <x-text-input id="language" type="text" value="{{ $projectService->language }}" />
         </div>
         <div class="space-y-1 col-span-2">
             <x-input-label for="description" :value="__('Description')" />
             <x-text-input id="description" type="text" rows="5" textArea
                 value="{{ $projectService->description }}" />
         </div>
     </fieldset>
 </section>

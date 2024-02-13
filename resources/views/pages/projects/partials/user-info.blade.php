 <section class="space-y-6 border-t dark:border-gray-800 pt-2">
     <header>
         <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
             User Information
         </h2>

         <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
             You can check out the user information below.
         </p>
     </header>

     <fieldset disabled class="grid grid-cols-2 gap-6">
         <div class="space-y-1">
             <x-input-label for="user_name" :value="__('Full Name')" />
             <x-text-input id="user_name" type="text" value="{{ $projectUser->name }}" />
         </div>
         <div class="space-y-1">
             <x-input-label for="user_email" :value="__('Email')" />
             <x-text-input id="user_email" type="text" value="{{ $projectUser->email }}" />
         </div>
     </fieldset>
 </section>

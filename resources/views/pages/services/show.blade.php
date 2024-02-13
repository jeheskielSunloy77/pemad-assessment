 @php
     $serviceTypes = ['translation' => 'translation', 'transcribing' => 'transcribing', 'writing' => 'writing', 'editing' => 'editing', 'proofreading' => 'proofreading', 'other' => 'other'];
     $languages = ['english' => 'english', 'bahasa' => 'bahasa', 'french' => 'french', 'spanish' => 'spanish', 'german' => 'german', 'italian' => 'italian', 'portuguese' => 'portuguese', 'dutch' => 'dutch', 'russian' => 'russian', 'chinese' => 'chinese', 'japanese' => 'japanese', 'arabic' => 'arabic', 'other' => 'other'];
     $editable = !$service || (isset($isUserRoute) && $service->user_id === auth()->user()->id);
 @endphp
 <x-layouts.app>
     <main class="dark:bg-black p-3 sm:p-5 min-h-[93.7vh]">
         <form method="POST" class="mx-auto max-w-screen-xl px-4 lg:px-12 space-y-6"
             action="{{ $formAction ?? ($service ? route('services.update', $service->id) : route('services.store')) }}">
             @csrf
             @method($service ? 'PUT' : 'POST')

             <section class="space-y-6">
                 <header>
                     <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                         Service Information
                     </h2>

                     <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                         Fill all the service information using the form below.
                     </p>
                 </header>

                 <fieldset @if (!$editable) disabled @endif class="grid grid-cols-2 gap-6">

                     <div class="space-y-1 col-span-2">
                         <x-input-label for="name" :value="__('Name')" />
                         <x-text-input id="name" name="name" type="text" required autocomplete="name"
                             placeholder="Enter name of the service"
                             value="{{ old('name', $service->name ?? null) }}" />
                         <x-input-error :messages="$errors->get('name')" />
                     </div>
                     <div class="space-y-1">
                         <x-input-label for="type" :value="__('Type')" />
                         <x-select id="type" name="type" required :options="$serviceTypes"
                             defaultValue="{{ old('type', $service->type ?? null) }}">
                         </x-select>

                         <x-input-error :messages="$errors->get('type')" />
                     </div>
                     <div class="space-y-1">
                         <x-input-label for="language" :value="__('Language')" />
                         <x-select id="language" name="language" required :options="$languages"
                             defaultValue="{{ old('language', $service->language ?? null) }}">
                         </x-select>

                         <x-input-error :messages="$errors->get('language')" />
                     </div>
                     <div class="space-y-1 col-span-2">
                         <x-input-label for="description" :value="__('Description')" />
                         <x-text-input id="description" name="description" type="text" required textArea
                             rows="5" placeholder="Describe the service"
                             value="{{ old('description', $service->description ?? null) }}" />
                         <x-input-error :messages="$errors->get('description')" />
                     </div>
                 </fieldset>


                 <div class="flex items-center gap-4">
                     <a href="{{ $backRoute }}">
                         <x-secondary-button>
                             Go Back
                         </x-secondary-button>
                     </a>
                     @if ($editable)
                         <x-primary-button type="submit">
                             Submit Form
                         </x-primary-button>
                     @endif

                     <x-flash-message message="{{ session('message') }}" />
                 </div>
             </section>
         </form>
     </main>
 </x-layouts.app>

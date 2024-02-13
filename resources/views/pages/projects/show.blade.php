 @php
     $user = auth()->user();
     $projectStatus = ['application' => 'application', 'planing' => 'planing', 'ongoing' => 'ongoing', 'finished' => 'finished'];
     $projectService = $project ? $project->service : null;
     $projectClient = $project ? $project->client : null;
     $projectUser = $project ? $project->user : null;
 @endphp
 <x-layouts.app>
     <main class="dark:bg-black p-3 min-h-[93.7vh]">
         <form method="POST"
             action="{{ $formAction ?? ($project ? route('projects.update', $project->id) : route('projects.store')) }}"
             class="mx-auto max-w-screen-xl px-4 lg:px-12 pb-8 space-y-6">
             @csrf
             @method($project ? 'PUT' : 'POST')
             <section class="space-y-6">
                 <header>
                     <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                         Project Information
                     </h2>

                     <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                         Fill all the project information using the form below.
                     </p>
                 </header>
                 <div class="grid grid-cols-2 gap-6">

                     @if ($user->role !== 'user')
                         <div class="space-y-1">
                             <x-input-label for="user_id" :value="__('User')" />
                             <x-select id="user_id" name="user_id" required :options="$users"
                                 defaultValue="{{ old('user_id', $project->user_id ?? null) }}">
                             </x-select>
                             <x-input-error :messages="$errors->get('user_id')" />
                         </div>
                     @endif
                     @if ($user->role !== 'client')
                         <div class="space-y-1">
                             <x-input-label for="client_id" :value="__('Client')" />
                             <x-select id="client_id" name="client_id" required :options="$clients"
                                 defaultValue="{{ old('client_id', $project->client_id ?? null) }}">
                             </x-select>
                             <x-input-error :messages="$errors->get('client_id')" />
                         </div>
                     @endif
                     <div class="space-y-1">
                         <x-input-label for="service_id" :value="__('Service')" />
                         <x-select id="service_id" name="service_id" required :options="$services"
                             defaultValue="{{ old('service_id', $project->service_id ?? null) }}">
                         </x-select>
                         <x-input-error :messages="$errors->get('service_id')" />
                     </div>
                     <div class="space-y-1">
                         <x-input-label for="status" :value="__('Status')" />
                         <x-select id="status" name="status" required :options="$projectStatus"
                             defaultValue="{{ old('status', $project->status ?? null) }}">
                         </x-select>
                         <x-input-error :messages="$errors->get('status')" />
                     </div>
                     <div class="space-y-1">
                         <x-input-label for="price" :value="__('Price')" />
                         <x-text-input id="price" name="price" type="number" required
                             placeholder="Price of the project in USD"
                             value="{{ old('price', $project->price ?? null) }}" />
                         <x-input-error :messages="$errors->get('price')" />
                     </div>
                     <div class="space-y-1">
                         <x-input-label for="payment_due_date" :value="__('Payment Due Date')" />
                         <x-text-input id="payment_due_date" name="payment_due_date" type="datetime-local"
                             min="{{ now()->format('Y-m-d\TH:i') }}"
                             value="{{ old('payment_due_date', $project->payment_due_date ?? null) }}" />
                         <x-input-error :messages="$errors->get('payment_due_date')" />
                     </div>
                     <div class="space-y-1">
                         <x-input-label for="paid_at" :value="__('Paid At')" />
                         <x-text-input id="paid_at" name="paid_at" type="datetime-local"
                             min="{{ isset($project->payment_due_date) ? $project->payment_due_date->format('Y-m-d\TH:i') : '' }}"
                             value="{{ old('paid_at', $project->paid_at ?? null) }}" />
                         <x-input-error :messages="$errors->get('paid_at')" />
                     </div>
                 </div>


                 <div class="flex items-center gap-4">
                     <a href="{{ $backRoute }}">
                         <x-secondary-button>
                             Go Back
                         </x-secondary-button>
                     </a>
                     <x-primary-button>
                         Submit Form
                     </x-primary-button>
                     <x-flash-message message="{{ session('message') }}" />
                 </div>
             </section>
             @if ($project)
                 @include('pages.projects.partials.service-info')

                 @if ($user->role === 'client')
                     @include('pages.projects.partials.user-info')
                 @elseif($user->role === 'user')
                     @include('pages.projects.partials.client-info')
                 @else
                     @include('pages.projects.partials.client-info')
                     @include('pages.projects.partials.user-info')
                 @endif
             @endif
         </form>
     </main>
 </x-layouts.app>

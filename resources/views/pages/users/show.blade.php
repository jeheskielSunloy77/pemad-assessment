 @php($roles = ['user' => 'user', 'client' => 'client', 'admin' => 'admin'])
 <x-layouts.app>
     <main class="dark:bg-black p-3 sm:p-5 min-h-[93.7vh]">
         <form method="POST" action="{{ $user ? route('users.update', $user->id) : route('users.store') }}"
             class="mx-auto max-w-screen-xl px-4 lg:px-12 space-y-6" x-data="{ role: '{{ old('role', $user->role ?? null) }}' }">
             @csrf
             @method($user ? 'PUT' : 'POST')

             <div class="space-y-6">
                 <header>
                     <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                         User Information
                     </h2>

                     <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                         Fill all the user information using the form below.
                     </p>
                 </header>

                 <div class="grid grid-cols-2 gap-6">

                     <div class="space-y-1 col-span-2">
                         <x-input-label for="name" :value="__('Name')" />
                         <x-text-input id="name" name="name" type="text" required autocomplete="name"
                             placeholder="Enter your fullname name" value="{{ old('name', $user->name ?? null) }}" />
                         <x-input-error :messages="$errors->get('name')" />
                     </div>
                     <div class="space-y-1">
                         <x-input-label for="email" :value="__('Email')" />
                         <x-text-input id="email" name="email" type="email" required autocomplete="email"
                             placeholder="Enter your email address" value="{{ old('email', $user->email ?? null) }}" />
                         <x-input-error :messages="$errors->get('email')" />
                     </div>
                     <div class="space-y-1">
                         <x-input-label for="role" :value="__('Role')" />

                         <x-select id="role" name="role" required :options="$roles"
                             defaultValue="{{ old('role', $user->role ?? null) }}" x-model="role">
                         </x-select>

                         <x-input-error :messages="$errors->get('role')" />
                     </div>

                     @if (!$user)
                         <div class="space-y-1">
                             <x-input-label for="password" :value="__('Password')" />
                             <x-text-input id="password" name="password" type="password" required
                                 placeholder="*******************" />
                             <x-input-error :messages="$errors->get('password')" />
                         </div>
                         <div class="space-y-1">
                             <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                             <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                                 required placeholder="*******************" />
                             <x-input-error :messages="$errors->get('password_confirmation')" />
                         </div>
                     @else
                         <input type="hidden" name="init_role" value="{{ $user->role }}">
                     @endif
                 </div>
             </div>
             <div class="space-y-6 border-t dark:border-gray-800 pt-2" x-show="role==='client'">
                 <header>
                     <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                         Client Information
                     </h2>

                     <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                         Fill all the client information using the form below.
                     </p>
                 </header>

                 <div class="grid grid-cols-2 gap-6">

                     <div class="space-y-1">
                         <x-input-label for="company_name" :value="__('Company Name')" />
                         <x-text-input id="company_name" name="company_name" type="text"
                             placeholder="Enter your company name" x-bind:disabled="role !=='client'"
                             value="{{ old('company_name', $user->client->company_name ?? null) }}" />
                         <x-input-error :messages="$errors->get('company_name')" />
                     </div>
                     <div class="space-y-1">
                         <x-input-label for="bank_account_number" :value="__('Bank Account Number')" />
                         <x-text-input id="bank_account_number" name="bank_account_number" type="number" min="10000000"
                             max="99999999999" placeholder="Enter the bank account number"
                             x-bind:disabled="role !=='client'"
                             value="{{ old('bank_account_number', $user->client->bank_account_number ?? null) }}" />
                         <x-input-error :messages="$errors->get('bank_account_number')" />
                     </div>
                     <div class="space-y-1">
                         <x-input-label for="bank_account_name" :value="__('Bank Account Name')" />
                         <x-text-input id="bank_account_name" name="bank_account_name" type="text"
                             placeholder="Enter the bank account number" x-bind:disabled="role !=='client'"
                             value="{{ old('bank_account_name', $user->client->bank_account_name ?? null) }}" />
                         <x-input-error :messages="$errors->get('bank_account_name')" />
                     </div>
                 </div>
             </div>


             <div class="flex items-center gap-4">
                 <a href="{{ route('users.index') }}">
                     <x-secondary-button>
                         Go Back
                     </x-secondary-button>
                 </a>
                 <x-primary-button type="submit">
                     Submit Form
                 </x-primary-button>
                 <x-flash-message message="{{ session('message') }}" />
             </div>
         </form>
     </main>
 </x-layouts.app>

 @php($roles = ['user' => 'user', 'client' => 'client'])

 <x-layouts.auth>
     <form method="POST" action="{{ route('register') }}" class="space-y-4" x-data="{ role: '{{ old('role') }}' }">
         @csrf
         <div class="space-y-1">
             <x-input-label for="name" :value="__('Name')" />
             <x-text-input value="{{ old('name') }}" id="name" type="text" name="name" required autofocus
                 autocomplete="name" placeholder="Enter your name" />
             <x-input-error :messages="$errors->get('name')" />
         </div>

         <div class="space-y-1">
             <x-input-label for="email" :value="__('Email')" />
             <x-text-input value="{{ old('email') }}" id="email" type="email" name="email" required
                 autocomplete="email" placeholder="Enter your email" />
             <x-input-error :messages="$errors->get('email')" />
         </div>

         <div class="space-y-1">
             <x-input-label for="password" :value="__('Password')" />

             <x-text-input value="{{ old('password') }}" id="password" type="password" name="password" required
                 autocomplete="new-password" placeholder="Enter your password" />

             <x-input-error :messages="$errors->get('password')" />
         </div>

         <div class="space-y-1">
             <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

             <x-text-input value="{{ old('password_confirmation') }}" id="password_confirmation" type="password"
                 name="password_confirmation" required autocomplete="new-password"
                 placeholder="Confirm your password" />

             <x-input-error :messages="$errors->get('password_confirmation')" />
         </div>
         <div class="space-y-1">
             <x-input-label for="role" :value="__('Role')" />
             <x-select id="role" name="role" required :options="$roles" defaultValue="{{ old('role') }}"
                 x-model="role" />

             <x-input-error :messages="$errors->get('role')" />
         </div>
         <div class="space-y-6 border-t pt-2" x-show="role==='client'">
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
                     max="99999999999" placeholder="Enter the bank account number" x-bind:disabled="role !=='client'"
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

         <x-primary-button class="inline-flex items-center justify-center w-full">
             {{ __('Register') }}
         </x-primary-button>
         <p class="text-sm text-center text-gray-600 dark:text-gray-400">
             Already have an account?
             <a class="underline hover:text-gray-900 dark:hover:text-gray-100" href="{{ route('login') }}">
                 {{ __('login here!') }}
             </a>
         </p>
     </form>
 </x-layouts.auth>

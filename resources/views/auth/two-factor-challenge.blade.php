<x-guest-layout>
    <div x-data="{ recovery: false }">
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400" x-show="! recovery">
            {{ __('This is a secure area of the application. Please enter the authentication code from your authenticator app.') }}
        </div>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400" x-show="recovery" x-cloak>
            {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
        </div>

        <form method="POST" action="{{ route('two-factor.login.store') }}">
            @csrf
            
            <div x-show="! recovery">
                <x-input-label for="code" :value="__('Authentication Code')" />
                <x-text-input id="code" class="block mt-1 w-full"
                    type="text"
                    inputmode="numeric"
                    name="code"
                    autofocus
                    autocomplete="one-time-code" />
                <x-input-error :messages="$errors->get('code')" class="mt-2" />
            </div>

            <div x-show="recovery" x-cloak>
                <x-input-label for="recovery_code" :value="__('Recovery Code')" />
                <x-text-input id="recovery_code" class="block mt-1 w-full"
                    type="text"
                    name="recovery_code"
                    autocomplete="one-time-code" />
                <x-input-error :messages="$errors->get('recovery_code')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="button" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 underline cursor-pointer"
                        x-show="! recovery"
                        x-on:click="recovery = true; $nextTick(() => { $refs.recovery_code.focus() })">
                    {{ __('Use a recovery code') }}
                </button>

                <button type="button" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 underline cursor-pointer"
                        x-show="recovery"
                        x-cloak
                        x-on:click="recovery = false; $nextTick(() => { $refs.code.focus() })">
                    {{ __('Use an authentication code') }}
                </button>

                <x-primary-button class="ms-4">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
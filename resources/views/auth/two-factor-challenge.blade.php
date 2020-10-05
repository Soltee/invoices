<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <a href="/dashboard" class="italic font-black text-blue-600 text-2xl">
                <img src="{{ asset('/img/invoice.svg') }}" class="">
                {{-- <x-jet-authentication-card-logo /> --}}
            </a>
        </x-slot>

        <div x-data="{ recovery: false }">
            <div class="mb-4 text-sm text-blue-600" x-show="! recovery">
                {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
            </div>

            <div class="mb-4 text-sm text-blue-600" x-show="recovery">
                {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
            </div>

            <x-jet-validation-errors class="mb-4" />

            <form method="POST" action="/two-factor-challenge">
                @csrf

                <div class="mt-4" x-show="! recovery">
                    <x-jet-label value="{{ __('Code') }}" class="text-blue-600"/>
                    <x-jet-input class="block mt-1 w-full" type="text" name="code" autofocus x-ref="code" autocomplete="one-time-code" />
                </div>

                <div class="mt-4" x-show="recovery">
                    <x-jet-label value="{{ __('Recovery Code') }}" class="text-blue-600" />
                    <x-jet-input class="block mt-1 w-full" type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="button" class="text-sm text-blue-600 hover:text-blue-500 text-white underline cursor-pointer"
                                    x-show="! recovery"
                                    x-on:click="
                                        recovery = true;
                                        $nextTick(() => { $refs.recovery_code.focus() })
                                    ">
                        {{ __('Use a recovery code') }}
                    </button>

                    <button type="button" class="text-sm text-blue-600 hover:text-blue-500 text-white underline cursor-pointer"
                                    x-show="recovery"
                                    x-on:click="
                                        recovery = false;
                                        $nextTick(() => { $refs.code.focus() })
                                    ">
                        {{ __('Use an authentication code') }}
                    </button>

                    <x-jet-button class="ml-4 bg-blue-600 hover:bg-blue-500 text-white">
                        {{ __('Login') }}
                    </x-jet-button>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>

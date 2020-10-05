<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <a href="/dashboard" class="italic font-black text-blue-600 text-2xl">
                <img src="{{ asset('/img/invoice.svg') }}" class="">
                {{-- <x-jet-authentication-card-logo /> --}}
            </a>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label value="{{ __('Email') }}" class="text-blue-600" />
                <x-jet-input class="block mt-1 w-full " type="email" name="email" value="{{ old('email') ?? 'example@gmail.com' }}" required autofocus  />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Password') }}" class="text-blue-600" />
                <x-jet-input class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" value="11111111" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <input type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray-600 text-blue-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-blue-500 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                {{-- <x-jet-button class="ml-4">
                    {{ __('Login') }}
                </x-jet-button> --}}
                <button type="submit" class=" ml-3 inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
                    Login
                </button>
            </div>

            <div class="flex justify-start items-center">
                
                <a class="underline text-md text-center text-blue-500 hover:text-gray-900" href="{{ route('register') }}">
                    {{ __('Signup') }}
                </a>
            </div>

        </form>
    </x-jet-authentication-card>
</x-guest-layout>

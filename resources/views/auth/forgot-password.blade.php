<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <a href="/dashboard" class="italic font-black text-blue-600 text-2xl">
                Invoice.
                {{-- <x-jet-authentication-card-logo /> --}}
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-blue-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-jet-label value="{{ __('Email') }}" class="text-blue-600"/>
                <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="bg-blue-600 text-white px-4 py-3 hover:bg-blue-500">
                    {{ __('Email Password Reset Link') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>

@extends('layouts.guest')
@section('title', 'Login')

@section('head')

@endsection
@section('content')
<div class="w-full max-w-md  flex flex-col items-center">
    <a href="/" class="italic font-black text-blue-600 text-2xl">
        <img src="/img/invoice.svg" class="">
    </a>

    <div class="bg-white w-full px-6 py-3 mt-4 shadow rounded-lg">    

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <div class="flex w-full justify-center items-center mt-3 mb-6">
            <p class="text-blue-500 mr-3">Not a User? </p>
            <a class="underline text-lg text-center text-blue-500 hover:text-gray-900" href="{{ route('register') }}">
                {{ __('Signup') }}
            </a>
        </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label for="email"  class="text-blue-600">Email</label>
                    <input class="block mt-1 w-full px-3 py-2 border border-gray-200 " type="email" name="email" value="{{ old('email') ?? 'example@gmail.com' }}" required autofocus  />
                </div>

                <div class="mt-4">
                    <label for="password"  class="text-blue-600">Password</label>
                    <input class="block mt-1 w-full px-3 py-2 border border-gray-200" type="password" name="password" required autocomplete="current-password" value="11111111" />
                </div>

                <div class="block mt-4">
                    <label class="flex items-center">
                        <input type="checkbox" class="form-checkbox" name="remember">
                        <span class="ml-2 text-sm text-gray-600 text-blue-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class=" ml-3 inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
                        Login
                    </button>
                </div>

                

            </form>
    </div>
</div>
@endsection


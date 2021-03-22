@extends('layouts.guest')
@section('title', 'Register')

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


            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <label for="name"  class="text-blue-600">Name</label>
                    <input class="block mt-1 w-full px-3 py-2 border border-gray-200 " type="name" name="name" value="" required autofocus  />
                </div>

                <div class="mt-4">
                    <label for="email"  class="text-blue-600">Email</label>
                    <input class="block mt-1 w-full px-3 py-2 border border-gray-200 " type="email" name="email" value="" required autofocus  />
                </div>

                <div class="mt-4">
                    <label for="password"  class="text-blue-600">Password</label>
                    <input class="block mt-1 w-full px-3 py-2 border border-gray-200" type="password" name="password" required autocomplete="current-password" value="" />
                </div>

                <div class="mt-4">
                    <label for="password"  class="text-blue-600">Confirm Password</label>
                    <input class="block mt-1 w-full px-3 py-2 border border-gray-200" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                <div class="flex items-center justify-between mt-4">
                    <a class="underline text-sm text-blue-600 hover:text-blue-500 text-white" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                    <button type="submit" class=" ml-3 inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
                        Register
                    </button>
                </div>

                

            </form>
    </div>
</div>
@endsection



@extends('layouts.app')

@section('content')
    <div class="max-w-screen-lg mx-auto flex flex-col">
        <!-- Hero Section -->
        <div class="flex justify-center items-center px-6 py-6 flex-col items-center">
            <div class="text-3xl md:text-4xl text-blue-600 flex flex-col  items-center">
                <p class="m-0 p-0">
                    <span class="font-bold text-5xl">Free</span> & <span class="font-bold text-5xl">Easy</span> 
                </p>
                <span class="-mt-4">Invoicing For Freelancers.</span>
            </div>
            <p class="mt-4 text-md text-blue-600 opacity-75 max-w-lg mx-auto text-center">
                Easy-to-use & saves you time. Start exploring all features of <span class="italic font-bold">invoice.</span> today.
            </p>

            <div class="mt-4">
                <img src="{{ asset('/img/hero.png') }}" class="object-contain w-full rounded-lg shadow-lg">
            </div>
        </div>
    </div>
@endsection

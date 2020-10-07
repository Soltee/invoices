@extends('layouts.app')

@section('title', 'Free Invoicing.')

@section('head')

@endsection

@section('content')
    <div class="max-w-screen-lg mx-auto flex flex-col">
        <!-- Contact Us -->
        <div class="mt-8  px-6">
            <div class=" flex flex-col md:flex-row justify-center px-3 py-3 ">
                
                <div class="mb-4 md:mb-0 w-full md:w-1/3 md:px-2 mt-12">
                    <h1 class="text-2xl text-blue-600">Contact Us</h1>
                    <p class="text-lg mt-4 text-blue-600 opacity-75">
                        We would like to hear from you. If you have any questions, feel free to message us by filling out the given form.
                    </p>
                    <ul class="m-0 mt-5 flex flex-row opacity-50">
                        <a href="#" class="mr-3 text-blue-600 w-12 border border-transparent hover:border-blue-600 rounded-full hover:opacity-75">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather text-blue-600 w-12 h-12 p-1 feather-twitter">
                                <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                            </svg>
                        </a>
                        <a href="#" class="mr-3 text-blue-600 w-12 border border-transparent hover:border-blue-600 rounded-full hover:opacity-75">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather text-blue-600 w-12 h-12 p-1 feather-facebook">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg>
                        </a>
                        <a href="#" class="mr-3 text-blue-600 w-12 border border-transparent hover:border-blue-600 rounded-full hover:opacity-75">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather text-blue-600 w-12 h-12 p-1 feather-instagram">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                        </a>
                    </ul>
                </div>

                <div class="w-full md:w-2/3 px-2 py-2 rounded shadow">
                    <form method="POST" action="{{ route('contact.save') }}">
                        @csrf
                        <div class="flex flex-col mb-6 w-full">
                            <label for="name" class="mb-2 text-blue-600 text-md">Name</label>
                            <input type="text" id="name" name="name" 
                                class="w-full px-3 py-2 rounded border border-gray-300
                                    @error('name') border-red-600 @enderror"
                                value="{{ old('name') }}"
                                placeholder="Rakesh..">
                        </div>

                        <div class="flex flex-col mb-6 w-full">
                            <label for="email" class="mb-2 text-blue-600 text-md">Email</label>
                            <input type="text" id="email" name="email" 
                                class="w-full px-3 py-2 rounded border border-gray-300
                                    @error('email') border-red-600 @enderror"
                                value="{{ old('email') }}"
                                placeholder="rakesh@gmail.com">
                        </div>

                        <div class="flex flex-col mb-6 w-full">
                            <label for="message" class="mb-2 text-blue-600 text-md">message</label>
                            <textarea name="message" class="w-full h-40 border border-gray-300 @error('message') border-red-600 @enderror px-2 py-2" >
                                {{ old('message') }}
                            </textarea>
                        </div>

                        <div class="flex flex-col w-full">
                            <button class="w-full px-3 py-3 rounded bg-blue-600 hover:bg-blue-500 text-white">Send Now</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

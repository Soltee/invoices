<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" href="/img/invoice.svg">
        <meta name="theme-color" content="#ffffff" />
        <title>@yield('title')</title>
        @yield('head')

        <!-- Chrome, Firefox OS and Opera -->
        <meta name="theme-color" content="#ffffff">
        <!-- Windows Phone -->
        <meta name="msapplication-navbutton-color" content="#ffffff">
        <!-- iOS Safari -->
        <meta name="apple-mobile-web-app-status-bar-style" content="#ffffff">


        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.2.1/dist/alpine.js" defer></script>

        @yield('head')


    </head>
    <body>
        @include('sweetalert::alert')

        <!--- Header -->
        <div>
           <nav class="">
                <div class="relative max-w-screen-lg mx-auto flex justify-between items-center px-6 py-4 md:py-6">
                    <div class="flex items-center">

                        <a href="/" class="ml-3 md:ml-0 italic font-black text-blue-600">
                            <img src="/img/invoice.svg" class="">
                        </a>
                    </div>

                    <!-- Large Screen -->
                    <div class="flex-1 space-x-10 ">
                        <ul class="hidden lg:flex lg:flex-row justify-center lg:items-center lg:m-0">
                            <li class="list-none mb-3 lg:mb-0">
                                <a href="/#features" class="px-3 py-3 ml-3 text-blue-600 hover:opacity-50">
                                    Features
                                </a>
                            </li>
                            <li class="list-none mb-3 lg:mb-0">
                                <a href="/#faqs" class="px-3 py-3 ml-3 text-blue-600 hover:opacity-50">
                                    FAQs
                                </a>
                            </li>
                            <li class="list-none mb-3 lg:mb-0">

                                <a href="{{ route('contact') }}" class="px-3 py-3 ml-3 text-blue-600 hover:opacity-50">
                                    Contact Us
                                </a>
                            </li>
                            <li class="list-none">

                                <a href="/#" class="px-3 py-3 ml-3 text-blue-600 hover:opacity-50">
                                    About Us
                                </a>
                            </li>

                            <!--- Auth button links only on small screen -->
                            <div class="flex flex-col mt-5 lg:hidden">
                                
                                <a href="/login" class="px-3 py-3 ml-3 rounded-lg text-blue-600 border border-blue-600 hover:border-none hover:border-transparent w-40  hover:text-white hover:bg-blue-600 text-center mb-4">
                                    Login
                                </a>

                                <a href="/register" class="px-3 py-3 ml-3 border border-blue-600 text-center w-40 rounded-lg bg-blue-600 hover:bg-blue-500 text-white mb-3">
                                    Signup for Free
                                </a>

                            </div>
                        </ul>
                    </div>


                    @auth
                        <div 
                            x-data="{ open: false }"
                            class="relative flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                            <img 
                                x-on:click="open = !open"
                                class="h-10 w-10 rounded-full object-cover cursor-pointer" 
                                src="{{ Auth::user()->profile_photo_url }}" 
                                alt="{{ Auth::user()->name }}" />

                           
                            <div 
                                x-show.transition.60ms="open"
                                x-on:click.away="open = false"
                                class="z-10 bg-white absolute right-0 top-0 mt-10 rounded shadow w-40 flex flex-col items-start">
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Manage Account
                                </div>
                                <a href="/dashboard" class="w-full text-left block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                    Dashboard
                                </a>
                                <a href="/user/profile" class="w-full text-left block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                    Profile
                                </a>

                                <form class="w-full" action="/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>

                    @else
                        <div class="hidden lg:block ml-4 flex items-center justify-end">
                            <a href="/login" class="px-6 py-2 rounded-lg text-blue-600 border border-blue-600 hover:border-none hover:border-transparent  hover:text-white hover:bg-blue-600">
                                Login
                            </a>
                            <a href="/register" class="ml-3 px-6 py-2 border border-blue-600 rounded-lg bg-blue-600 hover:bg-blue-500 text-white">
                                Sign up for free
                            </a>
                        </div>

                    @endif

                    <!-- Small Screen -->
                        <div 
                            x-data="{ menu : false }"
                            class="ml-3 flex items-center">
                            <svg 
                                x-on:click="menu = !menu;" 
                                xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" 
                                class="lg:hidden h-10 w-10 border rounded border-blue-600 p-1 text-blue-600 cursor-pointer hover:opacity-75">
                                <line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line>
                            </svg>
                            <div x-show.transition.60ms="menu"
                                class="bg-white shadow rounded-lg lg:hidden lg:rounded-none lg:bg-transparent absolute left-0 right-0 top-0 h-auto mx-6 mt-65 lg:mt-0 lg:mx-0 lg:static py-3 lg:py-0 z-10 lg:z-0"
                                >
                                
                                <ul class=" flex flex-col lg:flex-row lg:static lg:items-center lg:m-0">
                                    <li class="list-none mb-3 lg:mb-0">
                                        <a href="#" class="px-3 py-3 ml-3 text-blue-600 hover:opacity-50">
                                            Features
                                        </a>
                                    </li>
                                    <li class="list-none mb-3 lg:mb-0">

                                        <a href="{{ route('contact') }}" class="px-3 py-3 ml-3 text-blue-600 hover:opacity-50">
                                            Contact Us
                                        </a>
                                    </li>
                                    <li class="list-none">

                                        <a href="#" class="px-3 py-3 ml-3 text-blue-600 hover:opacity-50">
                                            About Us
                                        </a>
                                    </li>

                                    <!--- Auth button links only on small screen -->
                                    @guest
                                    <div class="flex flex-col mt-5 lg:hidden">
                                        
                                        <a href="/login" class="px-3 py-3 ml-3 rounded-lg text-blue-600 border border-blue-600 hover:border-none hover:border-transparent w-40  hover:text-white hover:bg-blue-600 text-center mb-4">
                                            Login
                                        </a>

                                        <a href="/register" class="px-3 py-3 ml-3 border border-blue-600 text-center w-40 rounded-lg bg-blue-600 hover:bg-blue-500 text-white mb-3">
                                            Signup for Free
                                        </a>

                                    </div>
                                    @else
                                    
                                    @endif
                                </ul>
                            </div>

                        </div>

                    
                </div>
           </nav> 
        </div>

        <!-- Content -->
        <div>
            @yield('content')
        </div>

        <div class="mt-6">
            <footer class="bg-blue-600">
                <div class="max-w-screen-lg mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 px-4 py-6">

                    <!-- General Links -->
                    <div class="flex flex-col mb-4 sm:mb-0">
                        <h4 class="text-md text-white mb-3 uppercase font-bold px-2">General</h4>

                        <ul class="m-0 flex flex-col">
                            <a href="#" class="mb-3 text-white px-2 border rounded border-transparent hover:border-white hover:opacity-75">
                                About Us
                            </a>
                            <a href="#features" class="mb-3 text-white px-2 border rounded border-transparent hover:border-white hover:opacity-75">
                                Features
                            </a>
                            <a href="{{ route('contact') }}" class="mb-3 text-white px-2 border rounded border-transparent hover:border-white hover:opacity-75">
                                Contact Us
                            </a>
                            <a href="#faqs" class="mb-3 text-white px-2 border rounded border-transparent hover:border-white hover:opacity-75">
                                FAQs
                            </a>
                            <a href="#" class="mb-3 text-white px-2 border rounded border-transparent hover:border-white hover:opacity-75">
                                Sitemap
                            </a>
                        </ul>
                    </div>

                    <!-- Legal Links -->
                    <div class="flex flex-col mb-4 sm:mb-0">
                        <h4 class="text-md text-white mb-3 uppercase font-bold px-2">Legal</h4>

                        <ul class="m-0 flex flex-col">
                            <a href="#" class="mb-3 text-white px-2 border rounded border-transparent hover:border-white hover:opacity-75">
                                Terms & Conditions
                            </a>
                            <a href="#" class="mb-3 text-white px-2 border rounded border-transparent hover:border-white hover:opacity-75">
                                Privacy Policy
                            </a>
                            <a href="#" class="mb-3 text-white px-2 border rounded border-transparent hover:border-white hover:opacity-75">
                                Cookies Policy
                            </a>
                        </ul>
                    </div>

                    <!-- Social Links -->
                    <div class="flex flex-col md:items-end px-2 md:w-40 md:pr-2">
                        <h4 class="text-md text-white mb-3 uppercase font-bold ">Social</h4>

                        <ul class="m-0 flex flex-col">
                            <a href="#" class="mb-3 text-white w-10 border border-transparent hover:border-white rounded-full hover:opacity-75">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather text-white w-10 h-10 p-1 feather-twitter">
                                    <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                                </svg>
                            </a>
                            <a href="#" class="mb-3 text-white w-10 border border-transparent hover:border-white rounded-full hover:opacity-75">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather text-white w-10 h-10 p-1 feather-facebook">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                </svg>
                            </a>
                            <a href="#" class="mb-3 text-white w-10 border border-transparent hover:border-white rounded-full hover:opacity-75">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather text-white w-10 h-10 p-1 feather-instagram">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>
                            </a>
                        </ul>
                    </div>
                </div>

                <!-- Copyright -->
                <div class="flex justify-center items-center py-4 bg-blue-500">
                    <p class="text-white">Copyright © 2020 <span class="italic font-black font-bold">Invoice.</span>.</p>
                </div>
            </footer>
        </div>

        @stack('scripts')
    </body>
</html>

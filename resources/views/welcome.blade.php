@extends('layouts.app')

@section('title', 'Free Invoicing.')

@section('head')

@endsection

@section('content')
    <div class="max-w-screen-lg mx-auto flex flex-col">
        <!-- Hero Section -->
        <div class="flex justify-center items-center px-6 py-6 flex-col items-center">
            <div class="text-3xl md:text-4xl text-blue-600 flex flex-col  items-center">
                <p class="m-0 p-0">
                    <span class="font-bold text-5xl">Free</span> & <span class="font-bold text-5xl">Easy</span> 
                </p>
                <span class="">Invoicing For Freelancers.</span>
            </div>
            <p class="mt-4 text-md text-blue-600  max-w-lg mx-auto text-center">
                Easy-to-use. Start exploring all features of <span class="italic font-bold">invoice.</span> today.
            </p>

            <div class="mt-4">
                <img src="/img/dashboard.png" class="object-contain w-full rounded-lg shadow-lg">
            </div>
        </div>


        <!-- Social Proof -->
        <div class="mt-16">
            <div class="flex flex-col md:flex-row justify-center items-center px-6 py-6">
                <div class="md:w-1/3 flex justify-center mb-3 md:mb-0">
                    <img src="/img/marc.jpg" class="w-40 h-40 rounded-full object-cover object-center">
                </div>
                <div class="flex flex-col md:w-2/3 flex justify-center items-center md:items-start">
                    <p class="text-blue-600 text-lg font-bold text-center md:text-left italic">Invoices is such an awesome tool for a freelancer like me. So I definitely recommend it. </p>

                    <span class="mt-3 text-blue-600 opacity-75 font-medium">Lanzo Site, freelancer</span>
                </div>
            </div>
        </div>

        <!-- Benefits -->
        <div id="features" class="mt-24  px-6 py-6">
            <div class="flex  flex-col md:flex-row ">
                <img src="/img/features.svg" class="w-full md:w-1/2">

                <div class="w-full md:w-1/2 md:ml-3 flex flex-col items-start my-6 md:my-8">
                    <h3 class="text-xl text-blue-600 font-bold text-center">Features</h3>

                    <div class="mt-4">
                        <div class="mb-4">    
                            <li class="text-2xl font-bold text-blue-600"> Unlimited Client Creation.</li>
                            <p class="text-blue-600 mt-3">
                                There is no restriction of how many clients can be created.
                            </p>
                        </div>

                        <div class="mb-4">    
                            <li class="text-2xl font-bold text-blue-600"> Unlimited Projects for Clients Creation.</li>
                            <p class="text-blue-600 mt-3">
                                There is no restriction of how many project can be created for a particular client.
                            </p>
                        </div>

                        <div class="mb-3">    
                            <li class="text-2xl font-bold text-blue-600"> Unlimited Invoice Generation.</li>
                            <p class="text-blue-600 mt-3">
                                You can create any number of invoices for the client & projects that you have created.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQS -->
        <div id="faqs" class="mt-24  px-6 py-6 flex flex-col">
            <div class="mb-10">
                <h2  class="text-xl text-blue-600 font-bold text-center">Do you have any questions?</h2>
            </div>
            <div
            x-data="{tab:''}"
            class="flex flex-col md:flex-row">
                <div class="w-full">
                    <div 
                        class="border-t border-blue-300 flex flex-col mb-4">
                        <div 
                         class="flex justify-between items-center py-3">
                            <h3 
                                x-on:click="tab = 'free'"
                                :class=" (tab === 'free') ? '' : ''"
                                class="text-blue-600 cursor-pointer hover:bg-custom-light-orange  rounded-t rounded-l rounded-r-none hover:text-white font-semibold text-2xl font-bold">It is really free?</h3>

                            <div
                                >
                                <svg 
                                    x-show="tab === ''"
                                    x-on:click="tab = 'free';" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="border rounded-full p-1 border-blue-600 hover:bg-blue-600 hover:text-white h-8 w-8 text-blue-600 cursor-pointer"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                <svg 
                                    x-on:click="tab = '';"
                                    x-show="tab === 'free'"
                                    xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                    class="border rounded-full p-1 border-blue-600 hover:bg-blue-600 hover:text-white h-8 w-8 text-blue-600 cursor-pointer"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            </div>
                        </div>

                        <div x-show.transition.50ms="tab === 'free'"
                            x-transition:enter="transition-transform transition-opacity ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform -translate-y-2"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-end="opacity-0 transform -translate-y-3"
                            >
                            <p class="text-blue-600">
                                Yes! 
                                <span class="font-bold italic text-xl">Invoice.</span> is a free invoice web application to manage invoices.
                            </p>
                        </div>

                    </div>


                    <div 
                        class="border-t border-blue-300 flex flex-col mb-4">
                        <div 
                         class="flex justify-between items-center py-3">
                            <h3 
                                x-on:click="tab = 'card'"
                                :class=" (tab === 'card') ? '' : ''"
                                class="text-blue-600 cursor-pointer hover:bg-custom-light-orange  rounded-t rounded-l rounded-r-none hover:text-white font-semibold text-2xl font-bold">Do I need credit card?</h3>
                            <div
                                >
                                <svg 
                                    x-show="tab === ''"
                                    x-on:click="tab = 'card';" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="border rounded-full p-1 border-blue-600 hover:bg-blue-600 hover:text-white h-8 w-8 text-blue-600 cursor-pointer"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                <svg 
                                    x-on:click="tab = '';"
                                    x-show="tab === 'card'"
                                    xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                    class="border rounded-full p-1 border-blue-600 hover:bg-blue-600 hover:text-white h-8 w-8 text-blue-600 cursor-pointer"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            </div>
                            
                        </div>

                        <div x-show.transition.50ms="tab === 'card'"
                            x-transition:enter="transition-transform transition-opacity ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform -translate-y-2"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-end="opacity-0 transform -translate-y-3"
                            >
                            <p class="text-blue-600">
                                No! 
                                <span class="font-bold italic text-xl">Invoice.</span> is  free forever.
                            </p>
                        </div>

                    </div>
                    <div 
                        class="border-t border-blue-300 flex flex-col mb-4">
                        <div 
                         class="flex justify-between items-center py-3">
                            <h3 
                                x-on:click="tab = 'application'"
                                :class=" (tab === 'application') ? '' : ''"
                                class="text-blue-600 cursor-pointer hover:bg-custom-light-orange  rounded-t rounded-l rounded-r-none hover:text-white font-semibold text-2xl font-bold">Does it work on Windows or Mac or Linux?</h3>
                            <div
                                >
                                <svg 
                                    x-show="tab === ''"
                                    x-on:click="tab = 'application';" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="border rounded-full p-1 border-blue-600 hover:bg-blue-600 hover:text-white h-8 w-8 text-blue-600 cursor-pointer"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                <svg 
                                    x-on:click="tab = '';"
                                    x-show="tab === 'application'"
                                    xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                    class="border rounded-full p-1 border-blue-600 hover:bg-blue-600 hover:text-white h-8 w-8 text-blue-600 cursor-pointer"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            </div>
                        </div>

                        <div x-show.transition.50ms="tab === 'application'"
                            x-transition:enter="transition-transform transition-opacity ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform -translate-y-2"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-end="opacity-0 transform -translate-y-3"
                            >
                            <p class="text-blue-600">
                                <span class="font-bold italic text-xl">Invoice.</span>
                                 is a web based app. So it works on all major platforms including Windows, Mac & Linux.
                            </p>
                        </div>

                    </div>
                </div>

            </div>

        </div>

        <!-- One more time Signup -->
        <div class="mt-16  px-6 py-6">
            <div class=" flex flex-col md:flex-row items-center justify-center px-3 py-3 shadow rounded-lg">
                
                <h2 class="text-blue-600 text-2xl font-bold text-center md:text-left ">Convinced? Try <span class="italic font-bold text-2xl px-2">invoice.</span> by signing up today?</h2>

                <a href="/register" class="mt-3 md:mt-0 md:ml-5 px-10 py-4 border border-blue-600 text-center text-xl rounded-lg bg-blue-600 hover:bg-blue-500 text-white">
                    Signup for Free
                </a>

            </div>
        </div>
    </div>
@endsection

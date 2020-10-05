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
            <p class="mt-4 text-md text-blue-600  max-w-lg mx-auto text-center">
                Easy-to-use & saves you time. Start exploring all features of <span class="italic font-bold">invoice.</span> today.
            </p>

            <div class="mt-4">
                <img src="{{ asset('/img/hero.png') }}" class="object-contain w-full rounded-lg shadow-lg">
            </div>
        </div>


        <!-- Social Proof -->
        <div class="mt-16">
            <div class="flex flex-col md:flex-row justify-center items-center px-6 py-6">
                <div class="md:w-1/3 flex justify-center mb-3 md:mb-0">
                    <img src="{{ asset('/img/marc.jpg') }}" class="w-40 h-40 rounded-full object-cover object-center">
                </div>
                <div class="flex flex-col md:w-2/3 flex justify-center items-center md:items-start">
                    <p class="text-blue-600 text-lg font-bold text-center md:text-left italic">Invoice definitely saves me anywhere from one to two hours a week. The invoice tracking is excellent and the reporting for year end is super, super helpful—I can just run off a couple of reports, send them to my accountant...it’s a three button process at the end of the year.</p>

                    <span class="mt-3 text-blue-600 opacity-75 font-medium">Lanzo Deferer - Owner, myproduction.com</span>
                </div>
            </div>
        </div>

                
        
        <!-- FAQS -->
        <div class="mt-24  px-6 py-6">
            <div class="mb-8">
                <h2 id="faqs" class="text-2xl text-blue-600 font-bold text-center">Do you have any questions?</h2>
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
                                class="text-blue-600 cursor-pointer hover:bg-custom-light-orange  rounded-t rounded-l rounded-r-none hover:text-white font-semibold text-lg font-bold">It is really free?</h3>

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
                                class="text-blue-600 cursor-pointer hover:bg-custom-light-orange  rounded-t rounded-l rounded-r-none hover:text-white font-semibold text-lg font-bold">Do I need credit card?</h3>
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
                                <span class="font-bold italic text-xl">Invoice.</span> doesnot required credit card whatsoever.
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
                                class="text-blue-600 cursor-pointer hover:bg-custom-light-orange  rounded-t rounded-l rounded-r-none hover:text-white font-semibold text-lg font-bold">Do I work on Windows or Mac or Linux?</h3>
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
                                 works on all major platforms including Windows, Mac & Linux.
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

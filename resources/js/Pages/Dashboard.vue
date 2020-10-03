<template>
    <app-layout>
        <template #header>
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                            
                    <span class="px-3 py-1 text-indigo-600  rounded">Dashboard</span>
                        
                </div>
            </div>
        </template>

        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-5 px-5 flex flex-col">

                    <span class="text-lg font-bold mb-2 text-gray-900 ">Invoices</span>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="bg-white overflow-hidden shadow-md sm:rounded-lg flex  flex-col items-start px-5 py-3 bg-green-600">
                            <h3 class="text-xl font-black mb-3 text-white">
                                $ 2999
                            </h3>
                            <span class="font-sm mt-2 text-white opacity-75">Paid today</span>
                        </div>

                        <div class="bg-white overflow-hidden shadow-md sm:rounded-lg flex  flex-col items-start px-5 py-3 ">
                            <h3 class="text-xl font-black mb-3">
                                $ 2999
                            </h3>
                            <span class="font-sm mt-2 text-gray-900 opacity-50">Pending</span>
                        </div>

                        <div class="bg-white overflow-hidden shadow-md sm:rounded-lg flex  flex-col items-start px-5 py-3 bg-gray-300 text-white">
                            <h3 class="text-xl font-black mb-3 text-gray-900">
                                $ 4999
                            </h3>
                            <span class="font-sm mt-2 text-gray-900 opacity-50">Total</span>
                        </div>
                        
                    </div>

                    <!-- About -->
                    <span class="mt-8 text-lg font-bold mb-2 text-gray-900 ">Invoices</span>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="bg-white overflow-hidden shadow-md sm:rounded-lg flex  flex-col items-start px-5 py-3 bg-green-600">
                            <h3 class="text-xl font-black mb-3 text-white">
                                100
                            </h3>
                            <span class="font-sm mt-2 text-white opacity-75">Invoices</span>
                        </div>

                        <div class="bg-white overflow-hidden shadow-md sm:rounded-lg flex  flex-col items-start px-5 py-3 ">
                            <h3 class="text-xl font-black mb-3">
                                299
                            </h3>
                            <span class="font-sm mt-2 text-gray-900 opacity-50">Clients</span>
                        </div>

                        <div class="bg-white overflow-hidden shadow-md sm:rounded-lg flex  flex-col items-start px-5 py-3 bg-gray-300 text-white">
                            <h3 class="text-xl font-black mb-3 text-gray-900">
                                300
                            </h3>
                            <span class="font-sm mt-2 text-gray-900 opacity-50">Projects</span>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../Layouts/AppLayout'
    import Welcome from './../Jetstream/Welcome'

    export default {
        components: {
            AppLayout,
            Welcome,
        },
    }
</script>

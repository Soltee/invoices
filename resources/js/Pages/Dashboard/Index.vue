<template>
    <app-layout>
        <template #header>
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                            
                    <span class="px-3 py-1 text-indigo-600  rounded">Dashboard</span>
                        
                </div>
            </div>
        </template>

        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-3 md:py-5 md:px-5 flex flex-col">

                    <span class="text-xl font-bold mb-2 text-gray-900 ">Invoices : This Month</span>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="bg-white overflow-hidden shadow-md rounded sm:rounded-lg flex  flex-col items-start px-5 py-3 bg-blue-600">
                            <h3 class="text-xl font-black mb-3 text-white">
                                 {{ current_mth_invoice_sent }} <span class="text-sm font-sm">Sent</span>
                            </h3>
                            <span class="font-sm mt-2 text-white opacity-75">
                                <strong class="opacity-1">$ {{ current_mth_invoice_sent_tot }}</strong> 
                            </span>
                        </div>

                        <div class="bg-white overflow-hidden shadow-md rounded sm:rounded-lg flex  flex-col items-start px-5 py-3 ">
                            <h3 class="text-xl font-black mb-3">
                                {{ current_mth_invoice_pend }} <span class="text-sm font-sm">Pending</span>
                            </h3>
                            <span class="font-sm mt-2 text-gray-900 opacity-50">
                                <strong class="opacity-1">$ {{ current_mth_invoice_pend_tot }}</strong>
                                
                            </span>
                        </div>

                        <div class="bg-white overflow-hidden shadow-md rounded sm:rounded-lg flex  flex-col items-start px-5 py-3 bg-gray-100 text-white">
                            <h3 class="text-xl font-black mb-3 text-blue-600">
                                {{ current_mth_invoice_overall }} <span class="text-sm font-sm">Total</span>
                            </h3>
                            <span class="font-sm mt-2 text-blue-600">
                                <strong class="opacity-1">$ {{ current_mth_invoice_overall_total }}</strong>
                                
                            </span>
                        </div>
                        
                    </div>

                    <!-- Overall -->
                    <span class="mt-12 text-xl font-bold mb-2 text-gray-900 ">Overall</span>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="bg-white overflow-hidden shadow-md rounded sm:rounded-lg flex  flex-col items-start px-5 py-3 bg-blue-600">
                            <h3 class="text-xl font-black mb-3 text-white">
                                {{ overall_sent }} <span class="text-sm font-sm">Sent</span>
                            </h3>
                            <span class="font-sm mt-2 text-white opacity-75">
                                <strong class="opacity-1">$ {{ overall_sent_total }}</strong> Sent 
                            </span>
                        </div>

                        <div class="bg-white overflow-hidden shadow-md rounded sm:rounded-lg flex  flex-col items-start px-5 py-3 ">
                            <h3 class="text-xl font-black mb-3">
                                {{ overall_pending }} <span class="text-sm font-sm">Pending</span>
                            </h3>
                            <span class="font-sm mt-2 text-gray-900 opacity-50">
                                <strong class="opacity-1">$ {{ overall_pending_total }}</strong>
                                Pending
                            </span>
                        </div>

                        <div class="bg-white overflow-hidden shadow-md rounded sm:rounded-lg flex  flex-col items-start px-5 py-3 bg-gray-100 text-white">
                            <h3 class="text-xl font-black mb-3 text-blue-600">
                                {{ overall }} <span class="text-sm font-sm">Total</span>
                            </h3>
                            <span class="font-sm mt-2 text-blue-600">
                                <strong class="opacity-1">$ {{ overall_total }}</strong>
                                Total
                            </span>
                        </div>
                        
                    </div>

                    <div class="mt-12">
                        <chart 
                            :data="invoices_data_by_month"
                            :height="250"
                            ></chart>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../../Layouts/AppLayout'
    import Welcome from './../../Jetstream/Welcome'
    import Chart from './../../Shared/Chart'
    import { Line } from 'vue-chartjs'

    export default {
        props : {
            current_mth_invoice_sent     : Number,
            current_mth_invoice_sent_tot : String,
            current_mth_invoice_pend     : Number,
            current_mth_invoice_pend_tot : String,
            current_mth_invoice_overall  : Number,
            current_mth_invoice_overall_total : String,
            overall_sent                 : Number,
            overall_sent_total           : String,
            overall_pending              : Number,
            overall_pending_total        : String,
            overall                      : Number,
            overall_total                : String,
            invoices_data_by_month       : Array
        },
        components: {
            AppLayout,
            Welcome,
            Chart
        },
        metaInfo: {
          // if no subcomponents specify a metaInfo.title, this title will be used
          title: 'Dashboard',
          // all titles will be injected into this template
          titleTemplate: '%s | My Awesome Dashboard'
        },
        data(){
            return {
            }
        },

    };
</script>

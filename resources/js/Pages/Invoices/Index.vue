<template>
	<app-layout>
        <template #header>
            <div class="flex justify-between items-center">
	            <div class="flex items-center">
	        		<inertia-link class="btn-indigo" href="/dashboard" preserve-scroll>
			        		
			       		<span class="px-3 py-1 text-indigo-600 hover:text-indigo-500 hover:opacity-50 rounded">Dashboard</span>
			        	
			        </inertia-link>
	    			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right text-indigo-600"><polyline points="9 18 15 12 9 6"></polyline></svg>
			        		
			       	<span class="px-3 py-1 text-indigo-600  rounded">Invoices</span>
			        	
	    		</div>

 				<div class="flex items-center">
			        <inertia-link class="btn-indigo" href="/invoices/create" preserve-scroll>
			            <span class="px-3 py-3 bg-indigo-600 hover:bg-indigo-500 text-white rounded">New Invoice</span>
			        </inertia-link>
		      	</div>
		    </div>
        </template>

	        <div class="py-6">
	            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
	                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
	                    <div class="bg-white rounded shadow px-3 py-3">

						    <div class="mb-6 flex items-center">
						        <input class="flex-1 px-3 py-3 rounded border border-indigo-500 focus:border-indigo-600" v-model="keyword"  />
						        <!-- <div class="py-3 px-3">
						        <multiselect 
									v-model="selectedFilter" 
									:options="options"  
									placeholder="Filters" 
									label="name" track-by="name">
									
								</multiselect>
						    	</div> -->

						    	<button
						    		@click="
						    			keyword = '';
						    			selectedFilter = '';
						    		"
						    	    class="px-3 py-3 rounded-r bg-red-600 text-white">Reset</button>
						    </div>

							<div  class=" overflow-x-auto">
						        <div  class="inline-block min-w-full  rounded-lg overflow-hidden">
						            <table class="min-w-full leading-normal">
						                <thead>
						                    <tr>
						                        <!-- <th
						                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
						                            Status
						                        </th> -->
						                        <th
						                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
						                            Grand Total
						                        </th>
						                        <th
						                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
						                            Filename
						                        </th>
						                        <th
						                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
						                            Created
						                        </th>

						                        <th
						                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-right text-xs font-semibold text-custom-light-black uppercase tracking-wider">
						                            Action
						                        </th>
						                      
						                    </tr>
						                </thead>
						                <tbody>
						                    <tr  v-for="invoice in invoices.data" >
						                       
						                        
						                       <!--  <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
						                        	<div class="flex items-center">
						                        		<span 
						                        			v-text="(Number(invoice.is_paid)) ? 'Paid' : 'Unpaid' "
						                        			:class="(Number(invoice.is_paid)) ? 'bg-green-600 hover:bg-green-500' : 'bg-red-600'"
						                        			class="mr-3 px-2 py-2 rounded text-white " 
						                        			>
						                        		</span>
						                        	</div>
						                        </td> -->
						                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
						                            <p class="text-gray-900 whitespace-no-wrap font-black">$ {{ invoice.grand_total }}</p>
						                        </td>
						                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
						                            <p class="text-gray-900 whitespace-no-wrap font-black">{{ invoice.file_name }}</p>
						                        </td>

						                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
						                            <p class="text-gray-900 whitespace-no-wrap">{{ format(invoice.created_at) }}</p>
						                        </td>

						                        
						                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200">
						                            <div class="flex justify-end items-center">
						                            	<!-- <span 
						                            		@click="
						                            			selected = invoice.id;
						                            			sendInvoice();
						                            			"
						                        			v-text="(Number(invoice.is_sent)) ? 'Sent' : 'Send Now.' "
						                        			:class="(Number(invoice.is_sent)) ? 'bg-green-600 cursor-auto' : 'bg-yellow-300 hover:opacity-50 cursor-pointer'"
						                        			class="mr-3 px-2 py-2 rounded text-white " 
						                        			>
						                        		</span> -->
						                                <a 	:href="`${invoice.link}`"
						                                    class="hover:font-semibold" 
						                                     >
						                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye text-gray-900 hover:opacity-75"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
						                                </a>

						                             

						                                <div @click="
						                                	selected = invoice.id;
						                                	toggleDeleteModal();"
						                                    class="flex items-center px-3 py-3 hover:opacity-50 text-md font-bold text-white rounded cursor-pointer">
						                                             
						                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete text-red-600 hover:text-red-500 ml-3"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
						                                </div>

						                                <!-- Confirm -->
						                                <transition name="fade">
						                                	<div 
																v-if="deleteModal"
																class="fixed  inset-0  rounded-lg flex flex-col  justify-center rounded-lg z-20">
															        <div @click="toggleDeleteModal();" class="h-full w-full bg-gray-300" >
															            
															    	</div>
																<div class="absolute  bg-white left-0 right-0  mx-auto  max-w-xl shadow-lg rounded-lg p-6 z-30">
																	<div class="text-right">
																            <button @click="toggleDeleteModal();"  type="button" class=" cursor-pointer" data-dismiss="modal" aria-label="Close">
																                <svg   width="18" height="18" viewBox="0 0 18 18" class="hover:opacity-75 fill-current text-gray-900">
																                  <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
																                </svg>
																            </button>

																        </div>
																        <div class="flex flex-col items-center">
																        	<svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle text-yellow-600 h-10 w-10 "><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
																            <p class="mt-4 text-lg font-semibold text-green-800 text-center">Invoice will be deleted?</p>
																            <div class="mt-6 mb-3 flex justify-end">
																                <button @click="toggleDeleteModal();" class="cursor-pointer text-gray-900 px-4 py-3 rounded-lg mr-4">Cancel</button>
																                <button @click="deleteInvoice();" class="cursor-pointer bg-red-600 hover:bg-red-500 text-white px-4 py-3 rounded-lg">Delete</button>
																            </div>
																    </div>

															    </div>

															</div>


						                                </transition>

						                            </div> 
						                        </td>
						                    </tr>
						                            
						                    <tr v-if="invoices.data.length < 1">
						                        <td class="">
						                            <div class=" flex flex-col justify-center w-full items-center">
											      		<svg class="h-10 w-10 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM6.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm7 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm2.16 6H4.34a6 6 0 0 1 11.32 0z"/></svg>
											      		<p class="mt-3">Oops! No Invoices .</p>
										     		</div>
						                            </td>
						                        </tr>
						                </tbody>
						            </table>

						        </div>
						    </div>

						    <div class="my-6">

						    	<pagination :links="invoices.links" />
						    </div>
						</div>

	                </div>
	            </div>
	        </div>
		
    </app-layout>
</template>
<script>
    import AppLayout from './../../Layouts/AppLayout'
	import Pagination from './../../Shared/Pagination'
	import throttle from 'lodash/throttle'
	import axios from 'axios'
	var dayjs = require('dayjs')
	import 'sweetalert2/dist/sweetalert2.min.css';
	import VueSweetalert2 from 'vue-sweetalert2';
	import Multiselect from 'vue-multiselect'

	export default {
		components: {
			AppLayout,
            Pagination,
            Multiselect
        },
		props :  {
			invoices : Object,
			search  : String,
			filter   : String,
		},
		data (){
			return {
				processing : false,
        		keyword: this.search,
        		selectedFilter  : {
        			name : this.filter,
					language  : this.filter
        		},
        		deleteModal:false,
        		selected : null,
        		options  : [
					{
						name : 'Sent',
						language  : 'Sent'
					}
        		]
			}
		},
		watch: {
			keyword: {
			    handler: throttle(function() {
			    	if(this.keyword.length > 0){
				        this.$inertia.replace(route('invoices', {
				        	search :this.keyword,
				        	filter :this.selectedFilter.name
				        }));
			    	}
			      }, 150),
			   	deep: true,
			},
			selectedFilter: {
				handler: throttle(function() {
			        this.$inertia.replace(route('invoices', {
			        	search :this.keyword,
			        	filter :this.selectedFilter.name
			        }))
			      }, 150),
			   	deep: true,
			}
		},
		metaInfo() {
	        return {
	            title: `Invoices`,
	            meta: [
	                { name: 'description', content: ''},
	            ]
	        }
        },
		methods:{
			reset() {
		      	this.keyword  = '';
		    },
		    format(date){
		    	return dayjs(date).format('ddd, MMM D, YYYY h:mm A');
		    },
		    toggleDeleteModal(){
		    	this.deleteModal = !this.deleteModal;
		    },
		    deleteInvoice(){
		    	this.processing   = false;
		    	axios.delete(`/invoices/${this.selected}`)
				.then(res => {
					this.processing = false;
					if(res.status === 204){

						this.$swal(`Invoice deleted.`);
						this.deleteModal = false;
						this.$inertia.reload({preserveScroll: true, preserveState: false})

					}
				}).catch(err => {

					this.processing = false;
					this.$swal(`Our server may have been a problem. Please try again.`);

				});
		    },
		    sendInvoice(){
		    	this.processing   = true;

		    	axios.get(`/invoices/${this.selected}/send`)
		    	.then(res => {
					this.$swal(`Invoice sent.`);
		    		this.processing   = false;
		    		this.$inertia.reload({preserveScroll: true, preserveState: false})
		    	}).catch(e => {
		    		this.processing   = false;
		    		this.deleteModal = false;
		    		console.log(e);
		    	});

		    }
		}
	};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>


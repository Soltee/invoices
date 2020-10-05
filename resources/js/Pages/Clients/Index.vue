<template>
	<app-layout>
        <template #header>
        	<div class="flex justify-between items-center">
	            <div class="flex items-center">
	        		<inertia-link class="btn-indigo" href="/dashboard" preserve-scroll>
			        		
			       		<span class="px-3 py-1 text-indigo-600 hover:text-indigo-500 hover:opacity-50 rounded">Dashboard</span>
			        	
			        </inertia-link>
	    			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right text-indigo-600"><polyline points="9 18 15 12 9 6"></polyline></svg>
			        		
			       	<span class="px-3 py-1 text-indigo-600  rounded">Clients</span>
			        	
	    		</div>

 				<div class="flex items-center">
		      		<transition name="fade">
						<div v-if="$page.flash.success" id="Message" class=" mr-4 px-10 py-3 rounded text-green-600 bg-green-300 flex items-center">

				        	<span class="mr-3">{{ $page.flash.success }}</span>

				        </div>

				    </transition>
			        <inertia-link class="btn-indigo" href="/clients/create" preserve-scroll>
			            <span class="px-3 py-3 bg-indigo-600 hover:bg-indigo-500 text-white rounded">New</span>
			        </inertia-link>
		      	</div>
		    </div>
        </template>

	        <div class="py-6">
	            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
	                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
						<div class="bg-white rounded shadow mt-6 px-3 py-3">
						    <div class="mb-6 flex justify-between items-center">
						        <input class="px-3 py-3 rounded border border-indigo-500 focus:border-indigo-600" v-model="keyword"  />
						      	
						        <button
						    		@click="
						    			keyword = '';
						    			selectedFilter = '';
						    		"
						    	    class="px-3 py-3 rounded bg-red-600 text-white">Reset</button>
						    </div>

							<div  class=" overflow-x-auto">
						        <div  class="inline-block min-w-full  rounded-lg overflow-hidden">
						            <table class="min-w-full leading-normal">
						                <thead>
						                    <tr>
						                        <th
						                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
						                            Projects
						                        </th>
						                        <th
						                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
						                            Invoices
						                        </th>
						                        <th
						                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
						                            Name
						                        </th>
						                        <th
						                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
						                            Email
						                        </th>
						                        <th
						                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
						                            Created at
						                        </th>
						                        <th
						                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-right text-xs font-semibold text-custom-light-black uppercase tracking-wider">
						                            Action
						                        </th>
						                      
						                    </tr>
						                </thead>
						                <tbody>
						                    <tr  v-for="client in clients.data" >
						                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
						                            <p class="text-gray-900 whitespace-no-wrap">
						                                {{ 	client.projects }}
						                            </p>
						                        </td>
						                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
						                            <p class="text-gray-900 whitespace-no-wrap">
						                                {{ 	client.invoices }}
						                            </p>
						                        </td>
						                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
						                            <p class="text-gray-900 whitespace-no-wrap"> {{ client.name }}</p>
						                        </td>
						                         <td class="px-5 whitespace-no-wrap py-3 border-b border-gray-200 bg-white text-sm">
						                            <p class="text-gray-900 whitespace-no-wrap">{{ client.email }}</p>
						                        </td>
						                         <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
						                            <p class="text-gray-900 whitespace-no-wrap">{{ format(client.created) }}</p>
						                        </td>
						                        
						                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200">
						                            <div class="flex justify-end items-center">
						                                <a 	:href="`/clients/${client.id}-${client.name}`"
						                                    class="hover:font-semibold" 
						                                     >
						                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye text-gray-900 hover:opacity-75"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
						                                </a>

						                             

						                                <div @click="
						                                	selected = client.id;
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
																        <div class="">
																            <p class="mt-4 text-lg font-semibold text-green-800 text-center">Are you sure?</p>
																            <div class="mt-6 mb-3 flex justify-end">
																                <button @click="toggleDeleteModal();" class="cursor-pointer text-gray-900 px-4 py-3 rounded-lg mr-4">Cancel</button>
																                <button @click="deleteClient();" class="cursor-pointer bg-red-600 hover:bg-red-500 text-white px-4 py-3 rounded-lg">Delete</button>
																            </div>
																    </div>

															    </div>

															</div>


						                                </transition>

						                            </div>
						                        </td>
						                    </tr>
						                            
						                    <tr v-if="clients.data.length < 1">
						                        <td class="">
						                            <div class=" flex flex-col justify-center w-full items-center">
											      		<svg class="h-10 w-10 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM6.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm7 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm2.16 6H4.34a6 6 0 0 1 11.32 0z"/></svg>
											      		<p class="mt-3">Oops! No clients .</p>
										     		</div>
						                            </td>
						                        </tr>
						                </tbody>
						            </table>

						        </div>
						    </div>

						    <div class="my-6">

						    	<pagination :links="clients.links" />
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
	var dayjs = require('dayjs')

	export default {
		components: {
			AppLayout,
            Pagination
        },
		props :  {
			clients : Object,
			search  : String
		},
		metaInfo: {
          // if no subcomponents specify a metaInfo.title, this title will be used
          title: 'Clients',
          // all titles will be injected into this template
          titleTemplate: '%s | My Awesome Clients'
        },
		data (){
			return {
				processing : false,
        		keyword: this.search,
        		deleteModal:false,
        		selected : null,
			}
		},
		watch: {
			keyword: {
			    handler: throttle(function() {
			        this.$inertia.replace(route('clients', {search :this.keyword}))
			      }, 150),
			   	deep: true,
			},
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
		    deleteClient(){
		    	this.$inertia.delete(`/clients/${this.selected}`, {
			        onStart: () => this.processing = true,
			        onFinish: () => {
			        		this.processing = false;
			        	},
			    });
		    }
		}
	};
</script>
<template>
	<app-layout>
        <template #header>
            <div class="flex justify-between items-center">
	            <div class="flex items-center">
	        		<inertia-link class="btn-indigo" href="/dashboard" preserve-scroll>
			        		
			       		<span class="px-3 py-1 text-indigo-600 hover:text-indigo-500 hover:opacity-50 rounded">Dashboard</span>
			        	
			        </inertia-link>
	    			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right text-indigo-600"><polyline points="9 18 15 12 9 6"></polyline></svg>
			        		
			       	<span class="px-3 py-1 text-indigo-600  rounded">Projects</span>
			        	
	    		</div>

 				<div class="flex items-center">
		      		<transition name="fade">
						<div v-if="$page.flash.success" id="Message" class=" mr-4 px-10 py-3 rounded text-green-600 bg-green-300 flex items-center">

				        	<span class="mr-3">{{ $page.flash.success }}</span>

				        </div>

				    </transition>
			        <span 
			        	@click="toggleCreateProjectModal();"
			        	class="cursor-pointer px-3 py-3 bg-indigo-600 hover:bg-indigo-500 text-white rounded">New Project</span>

			        <!-- New Project -->
					<transition name="fade">
                    	<div 
							v-if="createModal"
							class="fixed  inset-0  rounded-lg flex flex-col  justify-center rounded-lg z-20">
					        <div @click="toggleCreateProjectModal();" class="h-full w-full bg-gray-300" >
					            
					    	</div>
							<div class="absolute  bg-white left-0 right-0  mx-auto  max-w-xl shadow-lg rounded-lg p-6 z-30">
								<div class="text-right">
						            <button @click="toggleCreateProjectModal();"  type="button" class=" cursor-pointer" data-dismiss="modal" aria-label="Close">
						                <svg   width="18" height="18" viewBox="0 0 18 18" class="hover:opacity-75 fill-current text-gray-900">
						                  <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
						                </svg>
						            </button>

						        </div>

						        <!--- Form -->
  								<form @submit.prevent="createProject">
							        <div>
							        	<div class="mb-4 flex justify-between items-center">
									    	<div class="flex items-center">
										        	
								        		<span class="font-semibold text-md">New Project</span>

										    </div>

									        
									        <button  type="submit" class="px-3 py-3 bg-indigo-600 hover:bg-indigo-500 text-white rounded">

									      	    <span class="ml-2">Create</span>
									        </button>

									    </div>
									    <div v-if="processing" class="spinner"></div>

							        	<div v-else class="w-full  flex flex-col">
								        	<div class="mb-6 flex flex-col w-full"> 
									    		<label for="client">Client:</label>
												<multiselect 
													v-model="form.client" 
													:options="options"  
													placeholder="Select one" 
													label="name" track-by="name"></multiselect>

												<h5 class="text-md font-semibold mt-2 text-yellow-400">NOTE: Client cannot be changed later on.</h5>
							    				<!-- Err -->
							    				<div class="mt-2">
							    				<div 
							    					v-if="clientErr.length > 0"
							    					v-for="err in clientErr" 
							    					class="text-red-500 text-md font-semibold mb-2">
							    						{{ err }}
							    				</div>
							    				</div>

									    	</div>
									    	<div class="mb-6 flex flex-col"> 
									    		<label for="project_name">Project name:</label>
							    				<input id="project_name" type="text" class="px-3 py-3 rounded border border-indigo-500" v-model="form.project_name" />

							    				<!-- Err -->
							    				<div class="mt-2">
							    				<div 
							    					v-if="nameErr.length > 0"
							    					v-for="err in nameErr" 
							    					class="text-red-500 text-md font-semibold mb-2">
							    						{{ err }}
							    				</div>
							    				</div>
									    	</div>

									    	<div class="mb-6 flex flex-col"> 
									    		<label for="amount">Amount: ($)</label>
							    				<input id="amount" type="number" class="px-3 py-3 rounded border border-indigo-500" v-model="form.amount" />
									    	</div>

									    	<!-- Err -->
						    				<div class="mt-2">
						    					<div 
							    					v-if="amountErr.length > 0"
							    					v-for="err in amountErr" 
							    					class="text-red-500 text-md font-semibold mb-2">
							    						{{ err }}
							    				</div>
						    				</div>

						    				<div class="mb-6 flex flex-col"> 
									    		<label for="amount">Status:</label>

									    		<div class="flex ">
										    			
										      	    <span 
										      	    	@click="form.is_completed = !form.is_completed" class="mr-3 cursor-pointer px-3 py-3  text-blue-600 hover:opacity-50 rounded"

										      	    	>Toggle Status</span>
										      	    <span 
										      	    	class="mr-3 cursor-pointer px-3 py-3 text-white rounded"
										      	    	v-text="(form.is_completed) ? 'Completed' : 'Incomplete'"
										      	    	:class="(form.is_completed) ? 'bg-green-600' : 'bg-red-600'"></span>
									    		</div>
									    	</div>


									    </div>

							        </div>
							    </form>

						    </div>

						</div>

                    </transition>
		      	</div>
		    </div>
        </template>


	        <div class="py-6">
	            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
	                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
	                    <div class="bg-white rounded shadow px-3 py-3">

						    <div class="mb-6 flex ">
						        <input class="flex-1 px-3 py-3 rounded-l border border-indigo-500 focus:border-indigo-600" v-model="keyword"  />
						        <div class="inline-block relative w-40">
								  <select v-model="selectedFilter" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-4 pr-8  shadow leading-tight focus:outline-none focus:shadow-outline">
								    <option disabled="">Status</option>
								    <option value="completed">Completed</option>
								    <option value="incomplete">Incomplete</option>
								  </select>
								  <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
								    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
								  </div>
								</div>
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
						                        <th
						                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
						                            Status
						                        </th>
						                        <th
						                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
						                            Invoices
						                        </th>
						                        <th
						                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
						                            Amount
						                        </th>
						                        <th
						                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
						                            Name</th>
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
						                    <tr  v-for="project in projects.data" >
						                       
						                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">

						                        	<svg v-if="Number(project.is_completed)"
						                        		xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
						                        		class="w-10 h-10 text-green-600"><polyline points="20 6 9 17 4 12"></polyline></svg>
						                        	<svg 
						                        		v-else
						                        		xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-10 h-10 text-red-600"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
						                        </td>
						                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
						                            <p class="text-gray-900 whitespace-no-wrap font-black">{{ project.invoices }}</p>
						                        </td>
						                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
						                            <p class="text-gray-900 whitespace-no-wrap font-black">$ {{ project.amount }}</p>
						                        </td>

						                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
						                            <p class="text-gray-900 whitespace-no-wrap font-black">{{ project.name }}</p>
						                        </td>
						                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
						                            <p class="text-gray-900 whitespace-no-wrap">{{ format(project.created) }}</p>
						                        </td>

						                        
						                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200">
						                            <div class="flex justify-end items-center">
						                                <a 	:href="`/projects/${project.id}-${project.name}`"
						                                    class="hover:font-semibold" 
						                                     >
						                                    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-gray-900 hover:opacity-75"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
						                                </a>

						                             

						                                <div @click="
						                                	selected = project.id;
						                                	toggleDeleteModal();"
						                                    class="flex items-center px-3 py-3 hover:opacity-50 text-md font-bold text-white rounded cursor-pointer">
						                                             
						                                    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-red-600 hover:text-red-500 ml-3"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
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
																                <svg   width="18" height="18" viewBox="0 0 18 18" class="w-8 h-8 hover:opacity-75 fill-current text-gray-900">
																                  <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
																                </svg>
																            </button>

																        </div>
																        <div class="">
																            <p class="mt-4 text-lg font-semibold text-green-800 text-center">Are you sure?</p>
																            <div class="mt-6 mb-3 flex justify-end">
																                <button @click="toggleDeleteModal();" class="cursor-pointer text-gray-900 px-4 py-3 rounded-lg mr-4">Cancel</button>
																                <button @click="deleteProject();" class="cursor-pointer bg-red-600 hover:bg-red-500 text-white px-4 py-3 rounded-lg">Delete</button>
																            </div>
																    </div>

															    </div>

															</div>


						                                </transition>

						                            </div>
						                        </td>
						                    </tr>
						                            
						                    <tr v-if="projects.data.length < 1">
						                        <td class="">
						                            <div class=" flex flex-col justify-center w-full items-center">
											      		<svg class="h-10 w-10 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM6.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm7 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm2.16 6H4.34a6 6 0 0 1 11.32 0z"/></svg>
											      		<p class="mt-3">Oops! No Projects .</p>
										     		</div>
						                            </td>
						                        </tr>
						                </tbody>
						            </table>

						        </div>
						    </div>

						    <div class="my-6">

						    	<pagination :links="projects.links" />
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
			projects : Object,
			clients  : Object,
			search   : String,
			filter   : String,
		},
		data (){
			return {
				processing : false,
        		keyword: this.search,
        		selectedFilter  : this.filter,
        		createModal:false,
        		deleteModal:false,
        		selected : null,
        		form :{
        			client : {},
        			project_name : '',
        			amount : '',
        			is_completed : false,
        		},
        		options : [],
        		clientErr: [],
        		nameErr: [],
        		amountErr : []
			}
		},
		metaInfo() {
	        return {
	            title: `Projects`,
	            meta: [
	                { name: 'description', content: ' '},
	            ]
	        }
        },
		mounted(){
			this.clients.data.forEach((client) => {
				this.options.push(client);
			});
		},
		watch: {
			keyword: {
			    handler: throttle(function() {
			    	if(this.keyword.length > 0){
				        this.$inertia.replace(route('projects', {
				        	search :this.keyword,
				        	filter :this.selectedFilter
				        }));
			    	}
			      }, 150),
			   	deep: true,
			},
			selectedFilter: {
				handler: throttle(function() {
			        this.$inertia.replace(route('projects', {
			        	search :this.keyword,
			        	filter :this.selectedFilter
			        }))
			      }, 150),
			   	deep: true,
			}
		},
		methods:{
			reset() {
		      	this.keyword  = '';
		    },
		    format(date){
		    	return dayjs(date).format('ddd, MMM D, YYYY h:mm A');
		    },
		    toggleCreateProjectModal(){
		    	this.createModal = !this.createModal;
		    },
		    createProject(){
				this.processing = true;

				//Remove all errors
				this.clientErr        = [];
				this.nameErr        = [];
				this.amountErr      = [];

				let { client, project_name, amount, is_completed } = this.form;
				const form = {
					client : client.id,
					project_name   : project_name,
					amount : amount,
					is_completed : is_completed
				}

				//Post
     		    axios.post(`/projects`, form)
					.then(res => {
						this.processing = false;
						if(res.status === 201){
							this.$swal(`${this.form.project_name} is created.`);
							this.form = {
			        			client          : {},
			        			project_name    : '',
								amount          : '',
								is_completed    : false,
			        		}
			        		this.toggleCreateProjectModal();
			        		this.$inertia.reload({preserveScroll: true, preserveState: false})

						}
					}).catch(err => {

						this.processing = false;
						let { client, project_name, amount } = err.response.data.errors;

						if(client){
							this.clientErr = client;
						}

						if(project_name){
							this.nameErr = project_name;
						}

						if(amount){
							this.amountErr = amount;
						}

					});
     	
			},
		    deleteProject(){
		    	axios.delete(`/projects/${this.selected.id}`)
				.then(res => {
					this.processing = false;
					if(res.status === 204){

						this.$swal(`Project deleted.`);
						this.deleteModal = false;
						this.$inertia.reload({preserveScroll: true, preserveState: false})

					}
				}).catch(err => {

					this.processing = false;
					this.$swal(`Our server may have been a problem. Please try again.`);

				});
		    },
		    toggleDeleteModal(){
		    	this.deleteModal = !this.deleteModal;
		    },
		    updateProject(){
		    	this.processing   = true;
	    		this.processing   = false;
		    }
		}
	};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>


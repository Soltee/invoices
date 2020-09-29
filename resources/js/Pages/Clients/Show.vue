<template>
	<div class="bg-white rounded shadow mt-6 px-3 py-3">


	    <div class="mb-6 flex flex-col ">
	    	<div class="flex items-center">
		        <inertia-link class="btn-indigo" href="/clients" preserve-scroll>
		        	<div class="flex items-center">
		        		
		        		<span class="px-3 py-1 bg-indigo-600 hover:bg-indigo-500 text-white rounded"><</span>
		        	</div>

		        </inertia-link>
		        <span class="ml-3 font-semibold text-md"> {{ client.first_name  }} {{ client.last_name }}</span>

		    </div>

		    <div class="mt-4">
		    
		    	<div class="flex items-center">
		    		<label class="w-24 mr-3">Email</label>
		    	 	<h2 class="text-lg font-semibold text-gray-700 capitalize">{{  client.email }}</h2>

		    	</div>
		    	<div class="flex items-center">
		    		<label class="w-24 mr-3">Gender</label>
		    	 	<h2 class="text-lg font-md opacity-50 text-gray-700 ">{{  client.gender }}</h2>

		    	</div>

		    	<div class="flex items-center">
		    		<label class="w-24 mr-3">Invoices</label>

		    	</div>
		    </div>

	    </div>

	    <div class="">
		    <div class="mb-6 flex justify-between items-center">
		    	<!-- Search -->
		    	<div class="relative flex ">
		    		
		      		<input class="px-3 py-3 pr-10 rounded border border-indigo-500 focus:border-indigo-600" v-model="keyword"  />
		    		<svg 
		    			v-if="search"
		    			@click="
		    				search = false; 
		    				keyword = '';" 
		    			xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute right-0 top-0 right-3 mt-2 w-8 h-8 text-red-600"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>

		    	</div>
		      	
		      	<div class="flex items-center">
			        
			        <span 
			        	@click="toggleNewProjectModal();" 
			        	class="px-3 py-3 cursor-pointer bg-indigo-600 hover:bg-indigo-500 text-white rounded">New</span>
			        </span> 


			        <!-- New Project -->
			        <transition name="fade">
                    	<div 
							v-if="newProjectModal"
							class="fixed  inset-0  rounded-lg flex flex-col  justify-center rounded-lg z-20">
					        <div @click="toggleNewProjectModal();" class="h-full w-full bg-gray-300" >
					            
					    	</div>
							<div class="absolute  bg-white left-0 right-0  mx-auto  max-w-xl shadow-lg rounded-lg p-6 z-30">
								<div class="text-right">
						            <button @click="toggleNewProjectModal();"  type="button" class=" cursor-pointer" data-dismiss="modal" aria-label="Close">
						                <svg   width="18" height="18" viewBox="0 0 18 18" class="hover:opacity-75 fill-current text-gray-900">
						                  <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
						                </svg>
						            </button>

						        </div>

						        <!--- Form -->
  								<form @submit.prevent="create">
							        <div>
							        	<div class="mb-4 flex justify-between items-center">
									    	<div class="flex items-center">
										        	
								        		<span class="ml-3 font-semibold text-md">New Client</span>

										    </div>

									        
									        <button  type="submit" class="px-3 py-3 bg-indigo-600 hover:bg-indigo-500 text-white rounded">

									      	    <span class="ml-2">Create</span>
									        </button>

									    </div>
									    <div v-if="processing" class="spinner"></div>

							        	<div v-else class="w-full  flex flex-col">
									    	<div class="mb-6 flex flex-col"> 
									    		<label for="project_name">Project name:</label>
							    				<input id="project_name" type="text" class="px-3 py-3 rounded border border-indigo-500" v-model="form.project_name" />

							    				<!-- Err -->
							    				<div class="mt-2">
							    				<div 
							    					v-if="projectNameErr.length > 0"
							    					v-for="err in projectNameErr" 
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

									    </div>

							        </div>
							    </form>

						    </div>

						</div>


                    </transition>
		      	</div>
		    </div>

			<div  class=" overflow-x-auto">
		        <div  class="inline-block min-w-full  rounded-lg overflow-hidden">
		            <table class="min-w-full leading-normal">
		                <thead>
		                    <tr>
		                        <th
		                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
		                            Name
		                        </th>
		                        <th
		                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
		                            Amount
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

		                	<!-- Loading-->
		             		<div v-if="processing" class="spinner text-center py-3"></div>

		                	<!-- Searched Projects -->
		                	<tr 
		                		v-if="!processing & search"
		                		v-for="data in searchData.data" >
		                		<td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
		                            <p class="text-gray-900 whitespace-no-wrap">
		                                {{ 	data.name }}
		                            </p>
		                        </td>
		                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
		                            <p class="text-gray-900 font-bold whitespace-no-wrap">
		                                $ {{ 	data.amount }}
		                            </p>
		                        </td>
		                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
		                            <p class="text-gray-900 whitespace-no-wrap">{{ format(data.created) }}</p>
		                        </td>
		                        
		                	</tr>

		                	<!-- If Not Search is true-->
		                    <tr v-if="!search"  v-for="project in projects.data" >
		                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
		                            <p class="text-gray-900 whitespace-no-wrap">
		                                {{ 	project.name }}
		                            </p>
		                        </td>
		                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
		                            <p class="text-gray-900 font-bold whitespace-no-wrap">
		                                $ {{ 	project.amount }}
		                            </p>
		                        </td>
		                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
		                            <p class="text-gray-900 whitespace-no-wrap">{{ format(project.created) }}</p>
		                        </td>
		                        
		                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200">
		                            <div class="flex justify-end items-center">

		                                <div @click="toggleDeleteModal();"
		                                    class="flex items-center px-3 py-3 hover:opacity-50 text-md font-bold text-white rounded cursor-pointer">
		                                             
		                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete text-red-600 hover:text-red-500 ml-3"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
		                                </div>

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
												                <button @click="deleteClient(project.id);" class="cursor-pointer bg-red-600 hover:bg-red-500 text-white px-4 py-3 rounded-lg">Delete</button>
												            </div>
												    </div>

											    </div>

											</div>


		                                </transition>

		                            </div>
		                        </td>
		                    </tr>
		                     
		                    <!-- No projects -->  
		                    <tr v-if="projects.length < 1">
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
		    	<!-- If Search -->
		    	<div v-if="search" class="-mb-1 flex flex-wrap">
		    		<div  v-for="(link, key) in searchData.links">
		    			<span 
		    				@click="
		    					searchEndpoint = link.url;
		    					searchProjects();"
		    				:key="key" 
		    				class="mr-1 mb-1 cursor-pointer px-4 py-3 text-sm border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500" 
		    				:class="{ 'bg-white': link.active, 'ml-auto': link.label === 'Next' }" >
		    					{{ link.label }}
		    			</span>

		    		</div>
		    	</div>
		    	<!-- If NOt Search -->
		    	<div v-if="!search">
		    		<pagination :links="projects.links" />
		    	</div>
		    </div>
		</div>





		
	</div>
</template>
<script>
    import AppLayout from './../../Layouts/AppLayout'
	import Pagination from './../../Shared/Pagination'
	var dayjs = require('dayjs')
	import throttle from 'lodash/throttle'
	import axios from 'axios'
	import VueSweetalert2 from 'vue-sweetalert2';
	import 'sweetalert2/dist/sweetalert2.min.css';

	export default {
		layout  : AppLayout,
		components: {
            Pagination
        },
		props :  {
			client : Object,
			projects : Object,

		},
		data (){
			return {
				keyword     : this.search,
				deleteModal :false,
				processing  :false,
				form : {
					client          : this.client.id,
					project_name    : '',
					amount          : '',
 				},
 				projectNameErr : [],
 				amountErr      : [],
 				newProjectModal : false,
 				searchEndpoint : '',
 				search       : false,
 				searchData   : [],
 				searchErr    : [],
			}
		},
		watch: {
			keyword(){
				this.searchEndpoint = `/clients/projects/${this.client.id}/search?keyword=${this.keyword}`;
			    this.searchProjects();
			}
		},
		methods:{
			searchProjects(){
				this.processing = true;
				this.search     = true;

				axios.get(`${this.searchEndpoint}`)
					.then(res => {
						this.processing = false;
						if(res.status === 200){
							this.searchData = res.data;
							console.log(res.data);
						}
					}).catch(err => {
						this.processing = false;
						this.searchErr.push('Oops! Server error.');
					});
			},
			create(){
				this.processing = true;

				//Remove all errors
				this.projectNameErr = [];
				this.amountErr      = [];

				//Post
     		    axios.post(`/clients/project`, this.form)
					.then(res => {
						this.processing = false;
						if(res.status === 201){
							this.$swal(`${this.form.project_name} is created.`);
							this.form = {
			        			project_name    : '',
								amount          : ''
			        		}
						}
					}).catch(err => {

						this.processing = false;
						let { project_name, amount } = err.response.data.errors;

						if(project_name){
							this.projectNameErr = project_name;
						}

						if(amount){
							this.amountErr = amount;
						}

					});
     	
			},
			toggleDeleteModal(){
				this.deleteModal = !this.deleteModal;
			},
			toggleNewProjectModal(){
				this.newProjectModal = !this.newProjectModal;
			},
			deleteClient(id){
				this.deleteModal = false;
			},
			format(date){
		    	return dayjs(date).format('ddd, MMM D, YYYY h:mm A');
		    },
		}

	};
</script>

<style>
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
<template>
	<app-layout>
        <template #header>
        	<div class="flex justify-between items-center">
        		<div class="flex items-center">
	        		<inertia-link class="btn-indigo" href="/dashboard" preserve-scroll>
			        		
			       		<span class="px-3 py-1 text-indigo-600 hover:text-indigo-500 hover:opacity-50 rounded">Dashboard</span>
			        	
			        </inertia-link>
        			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right text-indigo-600"><polyline points="9 18 15 12 9 6"></polyline></svg>
        			<inertia-link class="btn-indigo" href="/projects" preserve-scroll>
			        		
			       		<span class="px-3 py-1 text-indigo-600 hover:text-indigo-500 hover:opacity-50 rounded">Projects</span>
			        	
			        </inertia-link>

			        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right text-indigo-600"><polyline points="9 18 15 12 9 6"></polyline></svg>

			       	<span class="px-3 py-1 text-indigo-600  rounded">
			       		 {{ project.name  }}
			       	</span>
        		</div>
	            

	            <div>
			    	<span 
				        	@click="toggleEditProjectModal();" 
				        	class="px-3 py-2 cursor-pointer bg-yellow-600 hover:bg-yellow-500 text-white rounded">Edit</span>
				    </span>

				    <!-- Edit Project -->
			        <!-- Edit Modal -->
						<transition name="fade">
				        	<div 
								v-if="editProjectModal"
								class="fixed  inset-0  rounded-lg flex flex-col  justify-center rounded-lg z-20">
							        <div @click="toggleEditProjectModal();" class="h-full w-full bg-gray-300" >
							            
							    	</div>
								<div class="absolute  bg-white left-0 right-0  mx-auto  max-w-xl shadow-lg rounded-lg p-6 z-30 h-full overflow-y-scroll">
									<div class="text-right">
								            <button @click="toggleEditProjectModal();"  type="button" class=" cursor-pointer" data-dismiss="modal" aria-label="Close">
								                <svg   width="18" height="18" viewBox="0 0 18 18" class="hover:opacity-75 fill-current text-gray-900">
								                  <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
								                </svg>
								            </button>

								    </div>
								    <!--- Edit Project -->
									<form @submit.prevent="updateProject">
								        <div>

								        	<div class="mb-4 flex justify-between items-center">

										    	<div class="flex items-center">
											        	
									        		<span class="font-semibold text-md">Edit Project</span>

											    </div>

										        
										        <button  type="submit" class="px-3 py-3 bg-indigo-600 hover:bg-indigo-500 text-white rounded">

										      	    <span class="ml-2">Save</span>
										        </button>

										    </div>
										    <div v-if="processing" class="spinner"></div>

								        	<div v-else class="w-full  flex flex-col">
								        		<!-- {{selected.id}} -->
								        		<div class="mb-6 flex flex-col w-full"> 
									    			<label for="client">Client:</label>
													
													<h5 class="text-md font-semibold text-yellow-400">{{ client.first_name }} {{ client.last_name }}</h5>
												</div>
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

							    				<!-- Description -->
							    				<div class="mb-6">
							    				
							    					<VueTrix v-model="form.description" placeholder="Project Description"/>

							    				</div>
							    				<!-- Err -->
							    				<div class="mt-2">
							    					<div 
								    					v-if="descriptionErr.length > 0"
								    					v-for="err in descriptionErr" 
								    					class="text-red-500 text-md font-semibold mb-2">
								    						{{ err }}
								    				</div>
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
								    </form>


							    </div>

							</div>
				        </transition>
					<!-- Delete Modal -->

					<span 
				        	@click="toggleDeleteModal();" 
				        	class="ml-3 px-3 py-2 cursor-pointer bg-red-600 hover:bg-red-500 text-white rounded">Delete</span>
				    </span>
					<!-- Delete Modal -->
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
							                <button @click="deleteProject();" class="cursor-pointer bg-red-600 hover:bg-red-500 text-white px-4 py-3 rounded-lg">Delete</button>
							            </div>
							    </div>

						    </div>

						</div>
			        </transition>
			    </div>
        	</div>
        </template>

        	<div class="py-6">
	            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
	                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
						<div class="bg-white rounded shadow  px-3 py-3">


							<div class="mb-6 flex flex-col md:flex-row">

							    <div class="w-full md:w-1/2 flex flex-col">
								    <label class="px-2 py-2 text-left rounded mb-0">Project Info</label>
							    	<div class="flex mb-3">
							    		<label class="w-24 border rounded-l py-2 px-2">Name</label>
							    	 	<h2 class="text-lg font-semibold text-gray-700 capitalize border rounded-r py-2 px-2">{{  project.name }}</h2>

							    	</div>
							    	<div class="flex mb-3">
							    		<label class="w-24 border rounded-l py-2 px-2">Amount</label>
							    	 	<h2 class="text-lg font-semibold text-gray-700 capitalize border rounded-r py-2 px-2">$ {{  project.amount }}</h2>

							    	</div>
							    	<div class="flex mb-3">
							    		<label class="w-24 border rounded-l py-2 px-2">Status</label>
							    	 	<h2 
							    	 		class="text-lg font-semibold text-white  border rounded py-2 px-2"
							    	 		v-text="(Number(project.is_completed)) ? 'Completed' : 'Incomplete' "
			                        		:class="(Number(project.is_completed)) ? 'bg-green-600 hover:bg-green-500' : 'bg-yellow-300'">
							    	 			
							    	 		</h2>

							    	</div>

							    	<div class="flex mb-3">
							    		<label class="w-24 border rounded-l py-2 px-2">Description</label>
							    	 	<p class="text-lg font-semibold text-gray-700  border rounded py-2 px-2"
							    	 		v-html="project.description">
							    	 	</p>

							    	</div>

							    </div>

							    <div class="w-full md:w-1/2 md:ml-5 flex flex-col">
								    <label class="px-2 py-2 text-left rounded mb-0">Client Info</label>

							    	<div class="flex mb-3">
							    		<label class="w-24 border rounded-l py-2 px-2">Name</label>
							    	 	<a 
							    	 		:href="`/clients/${client.id}-${client.first_name}`"
							    	 		class="text-lg font-semibold text-gray-700 capitalize border rounded-r py-2 px-2">{{  client.first_name }} {{ client.last_name }}</a>

							    	</div>
							    	<div class="flex mb-3">
							    		<label class="w-24 border rounded-l py-2 px-2">Email</label>
							    	 	<h2 class="text-lg font-semibold text-gray-700 capitalize border rounded-r py-2 px-2"> {{  client.email }}</h2>

							    	</div>
							    	<div class="flex mb-3">
							    		<label class="w-24 border rounded-l py-2 px-2">Gender</label>
							    	 	<h2 class="text-lg font-semibold text-gray-700 capitalize border rounded-r py-2 px-2">{{  client.gender }}</h2>

							    	</div>

							    </div>
						    </div>

						  
						    <!--- ProjectsInvoices -->
					        <!-- Projects -->
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
						                            Discount
						                        </th>
						                        <th
						                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
						                            Amount
						                        </th>
						                        <th
						                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
						                            Created
						                        </th>
						                        <th
						                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
						                            Action
						                        </th>
						                      
						                    </tr>
						                </thead>
						                <tbody>

						                	<!-- Loading-->
						             		<div v-if="processing" class="spinner text-center py-3"></div>

						                    <tr   v-for="invoice in invoices.data" >
						                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
						                           <div class="flex items-center">
						                        		<span 
						                        			v-text="(Number(invoice.is_paid)) ? 'Paid' : 'Unpaid' "
						                        			:class="(Number(invoice.is_paid)) ? 'bg-green-600 hover:bg-green-500' : 'bg-red-600'"
						                        			class="mr-3 px-2 py-2 rounded text-white " 
						                        			>
						                        		</span>
						                        	</div>
						                        </td>
						                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
						                            <p class="text-gray-900 font-bold whitespace-no-wrap">
						                                $ {{ 	invoice.discount }}
						                            </p>
						                        </td>
						                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
						                            <p class="text-gray-900 font-bold whitespace-no-wrap">
						                                $ {{ 	invoice.grand_total }}
						                            </p>
						                        </td>
						                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
						                            <p class="text-gray-900 whitespace-no-wrap">{{ format(invoice.updated_at) }}</p>
						                        </td>

						                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
						                            <a 	:href="`/invoices/${invoice.id}`"
						                                    class="hover:font-semibold" 
						                                     >
						                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye text-gray-900 hover:opacity-75"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
						                                </a>
						                        </td>
						                        
						                    </tr>
						                    <tr >
						                        	<td v-if="invoices.data.length < 1 " class="">
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

						    <!-- Pagination -->
						    <div class="my-6">
						    	<div>
						    		<pagination :links="invoices.links" />
						    	</div>
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
	var dayjs = require('dayjs')
	import throttle from 'lodash/throttle'
	import axios from 'axios'
	import VueSweetalert2 from 'vue-sweetalert2';
	import 'sweetalert2/dist/sweetalert2.min.css';
	import VueTrix from "vue-trix";

	export default {
		components: {
			AppLayout,
            Pagination,
            VueTrix
        },
		props :  {
			client   : Object,
			project  : Object,
			invoices : Object,

		},
		data (){
			return {
				processing  :false,
				deleteModal :false,
 				editProjectModal : false,
				form : {
					client          : this.client.id,
					project_name    : this.project.name,
					amount          : this.project.amount,
					description          : this.project.description,
					is_completed    : Number(this.project.is_completed)
 				},
 				projectNameErr : [],
 				descriptionErr : [],
 				amountErr      : [],
 				clientErr      : []
			}
		},
		metaInfo() {
	        return {
	            title: `Projects | ${this.project.name}`,
	            meta: [
	                { name: 'description', content: 'Details of. ' + this.project.name},
	            ]
	        }
        },
		methods:{
			updateProject(){
				this.processing = true;

				//Remove all errors
				this.projectNameErr = [];
				this.amountErr      = [];
				this.descriptionErr      = [];
				this.clientErr      = [];

				//PUt
     		    axios.put(`/projects/${this.project.id}`, this.form)
					.then(res => {
						this.processing = false;
						if(res.status === 200){
							this.$swal(`${this.form.project_name} is updated.`);
							this.projectForm = {
			        			project_name    : '',
								amount          : '',
								is_completed    : false,
								description     : ''
			        		}
			        		this.$inertia.reload({preserveScroll: true, preserveState: false})

						}
					}).catch(err => {

						this.processing = false;
						let { client, project_name, description, amount } = err.response.data.errors;

						if(client){
							this.clientErr = client;
						}

						if(project_name){
							this.projectNameErr = project_name;
						}

						if(amount){
							this.amountErr = amount;
						}

						if(description){
							this.descriptionErr = description;
						}

					});
     	
			},
			deleteProject(){
				this.processing = true;



				axios.delete(`/projects/${this.project.id}`)
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
			toggleEditProjectModal(){
				this.editProjectModal = !this.editProjectModal;
			},
			toggleDeleteModal(){
				this.deleteModal = !this.deleteModal;
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
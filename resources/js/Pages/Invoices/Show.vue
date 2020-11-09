<template>
	<app-layout>
        <template #header>
        	<div class="flex justify-between items-center">
				<div class="flex items-center">
	        		<inertia-link class="btn-indigo" href="/dashboard" preserve-scroll>
			        		
			       		<span class="px-3 py-1 text-indigo-600 hover:text-indigo-500 hover:opacity-50 rounded">Dashboard</span>
			        	
			        </inertia-link>
	    			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right text-indigo-600"><polyline points="9 18 15 12 9 6"></polyline></svg>

			        <inertia-link class="btn-indigo" href="/invoices" preserve-scroll>
		
			       		<span class="px-3 py-1 text-indigo-600  rounded">Invoices</span>
			        	
			        </inertia-link>

			        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right text-indigo-600"><polyline points="9 18 15 12 9 6"></polyline></svg>

			       	<span class="px-3 py-1 text-indigo-600  rounded">
			       		 {{ client.first_name  }} {{ client.last_name }}
			       	</span>
	    		</div>

	    		<transition name="fade">
					<div v-if="$page.flash.success" id="Message" class=" mr-4 px-10 py-3 rounded text-green-600 bg-green-300 flex items-center">

			        	<span class="mr-3">{{ $page.flash.success }}</span>

			        </div>

			    </transition>

                <div>
			    	<span 
				        	@click="toggleEditInvoice();" 
				        	class="px-3 py-2 cursor-pointer bg-yellow-600 hover:bg-yellow-500 text-white rounded">Edit</span>
				    </span>

				    <!-- Edit INvoice -->
			        <transition name="fade">
	                	<div 
							v-if="editInvoice"
							class="fixed  inset-0  rounded-lg flex flex-col  justify-center rounded-lg z-20">
					        <div @click="toggleEditInvoice();" class="h-full w-full bg-gray-300" >
					    	</div>
							<div class="absolute  bg-white left-0 right-0  mx-auto  max-w-xl shadow-lg rounded-lg p-6 z-30">
								<div class="text-right">
						            <button @click="toggleEditInvoice();"  type="button" class=" cursor-pointer" data-dismiss="modal" aria-label="Close">
						                <svg   width="18" height="18" viewBox="0 0 18 18" class="hover:opacity-75 fill-current text-gray-900">
						                  <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
						                </svg>
						            </button>

						        </div>

						        <!--- Edit Form -->
									<form @submit.prevent="updateInvoice">
							        <div>
							        	<div class="mb-4 flex justify-between items-center">
									    	<div class="flex items-center">
										        	
								        		<span class="ml-3 font-semibold text-md">Edit</span>

										    </div>

									        
									        <button  type="submit" class="px-3 py-3 bg-indigo-600 hover:bg-indigo-500 text-white rounded">

									      	    <span class="ml-2">Save</span>
									        </button>

									    </div>
									    <div v-if="processing" class="spinner"></div>

							        	<div v-else class="w-full  flex flex-col">
									    	

							    	<div class="w-full flex flex-col mb-6 md:mb-0">

							    		<div class="mb-6 flex flex-col w-full"> 
								    		<label for="client">Client:</label>
											<multiselect 
												v-model="form.client" 
												:options="options"  
												placeholder="Select one" 
												label="name" track-by="name"></multiselect>


						    				<div 
						    					v-if="$page.errors.client" 
						    					class="text-red-500 text-md font-semibold mt-2">
						    						{{ $page.errors.client }}
						    				</div>

								    	</div>

								    	<div class="mb-6 flex flex-col w-full"> 
								    		<label for="project">Project:</label>
								    		<div v-if="clientProjects.length > 0">
								    			<multiselect 
													v-model="form.project" 
													:options="clientProjects"  
													placeholder="Select Project" 
													label="name" track-by="name"></multiselect>
								    		</div>
						    				<div 
						    					v-if="$page.errors.project" 
						    					class="text-red-500 text-md font-semibold mt-2">
						    						{{ $page.errors.project }}
						    				</div>

								    	</div>

								    	<div class="mb-6 flex flex-col w-full"> 
								    		<label for="discount">Discount:</label>
						    				<input id="due" type="number" min="0" class="px-3 py-3 rounded border border-indigo-500 w-full" v-model="form.discount" />
						    				<div 
						    					v-if="$page.errors.discount" 
						    					class="text-red-500 text-md font-semibold mt-2">
						    						{{ $page.errors.discount }}
						    				</div>

								    	</div>
								    	<div class="mb-6 flex flex-col w-full"> 
								    		<label for="due">Due Date:</label>
						    				<input id="due" type="date" class="px-3 py-3 rounded border border-indigo-500 w-full" v-model="form.due" />

						    				<div 
						    					v-if="$page.errors.due" 
						    					class="text-red-500 text-md font-semibold mt-2">
						    						{{ $page.errors.due }}
						    				</div>

								    	</div>


							    		<div v-if="form.project">
							    			
								    		<div class="mb-3 flex items-center">
								    			<label class="px-2 py-2 font-md font-semibold">Fee</label>
								    			<span class="px-2 py-2">$ {{ form.amount }} </span>
								    		</div>
								    		<div class="mb-3 flex items-center">
								    			<label class="px-2 py-2 font-md font-semibold">Discount</label>
								    			<span class="px-2 py-2">$ {{ form.discount }} </span>
								    		</div>
								    		<div class="mb-3 flex items-center">
								    			<label class="px-2 py-2 font-md font-semibold">Grand</label>
								    			<span class="px-2 py-2">$ {{ form.grand }} </span>
								    		</div>

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

	                    	<div class="mb-6 ">
						    	<div class="flex justify-between items-center">

								    
								    <label class="px-2 py-2 text-center rounded mr-2 border">Status</label>
								    <div class="flex items-center">
								    	<!-- <span 
			                        			v-text="(Number(invoice.is_paid)) ? 'Paid' : 'Unpaid' "
			                        			:class="(Number(invoice.is_paid)) ? 'bg-green-600 hover:bg-green-500' : 'bg-red-600'"
			                        			class="mr-3 px-2 py-2 rounded text-white " 
			                        			>
			                        		</span>  -->

			                        	<span 
									    	
					                        v-if="Number(invoice.is_sent)"
			                        		class=" px-2 py-2 bg-indigo-600 text-white rounded"
			                        		>Sent</span>

			                        	<div v-else class="relative">
			                        		<div class="flex items-center rounded border">
				                        			
					                        	<span 
					                       
					                        			v-text="(Number(invoice.is_sent)) ? 'Sent' : 'Not Sent' "
					                        			:class="(Number(invoice.is_sent)) ? 'bg-green-600 hover:bg-green-500' : 'text-gray-900'"
					                        			class="mr-3 px-2 py-2 rounded text-white cursor-pointer" 
					                        			>
					                        		</span> 
					                        	<svg 
					                        		@click="sendNow = !sendNow"
					                        		 width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down text-gray-900 cursor-pointer"><polyline points="6 9 12 15 18 9"></polyline></svg>
			                        		</div>
				                        	
				                        	<span 
				                        		@click="
				                        	    	sendInvoice();
				                        	    	"
				                        		v-if="sendNow"
				                        		class="absolute left-0
				                        		top-0 mt-10 cursor-pointer px-2 py-2 bg-indigo-600 hover:bg-indigo-500 text-white rounded"
				                        		v-text="(Number(invoice.is_sent)) ? '' : 'Send Now' "></span>
			                        	</div>
									    
								    </div>
								    
							    </div>

						    </div>

						    <!-- INvoice Info -->
						    <div class="flex flex-col md:flex-row mb-6">
								<div class="w-full md:w-1/2 md:mr- flex flex-col">
							    	<div class="flex  mb-3">
							    		<label class="w-24 border rounded-l py-2 px-2">ID:</label>
							    	 	<h2 class="text-lg font-semibold text-gray-700 capitalize border rounded-r py-2 px-2">{{  invoice.generatedId }} </h2>

							    	</div>
							    	<div class="flex  mb-3">
							    		<label class="w-24 border rounded-l py-2 px-2">Payment</label>
							    	 	<h2 class="text-lg font-semibold text-gray-700 capitalize border rounded-r py-2 px-2">{{  invoice.payment_type }}</h2>

							    	</div>
							    	<div class="flex  mb-3">
							    		<label class="w-24 border rounded-l py-2 px-2">Due Date</label>
							    	 	<h2 class="text-lg font-semibold text-gray-700 capitalize border rounded-r py-2 px-2">{{  format(invoice.due) }}</h2>

							    	</div>

							    	<div class="flex  mb-3">
							    		<label class="w-24 border rounded-l py-2 px-2">Created At</label>
							    	 	<h2 class="text-lg font-semibold text-gray-700 capitalize border rounded-r py-2 px-2">{{  format(invoice.created_at) }}</h2>

							    	</div>

							    </div>
							    <div class="w-full md:w-1/2 flex flex-col">
							    	<div class="flex  mb-3">
							    		<label class="w-32 border rounded-l py-2 px-2">Subtotal</label>
							    	 	<h2 class="text-lg font-md  text-gray-700 border rounded-r py-2 px-2">$ {{  invoice.sub_total }}</h2>

							    	</div>
							    	<div class="flex  mb-3">
							    		<label class="w-32 border rounded-l py-2 px-2">Discount:</label>
							    	 	<h2 class="text-lg font-semibold text-gray-700 capitalize border rounded-r py-2 px-2">$ {{  invoice.discount }} </h2>

							    	</div>
							    	<div class="flex  mb-3">
							    		<label class="w-32 border rounded-l py-2 px-2">Grand Total:</label>
							    	 	<h2 class="text-lg font-semibold text-gray-700 capitalize border rounded-r py-2 px-2">$ {{  invoice.grand_total }} </h2>

							    	</div>
						    	</div>
						    </div>

						    <!--Relationship-->
						    <div class="border-t  pt-4 flex flex-col md:flex-row">
							    <!-- Client -->
						    	<div class="w-full md:w-1/2 md:mr- flex flex-col">
							    	<h3 class="font-md mb-2">Client Info</h3>
							    	<div class="flex  mb-3">
							    		<label class="w-24 border rounded-l py-2 px-2">Name</label>
							    	 	<h2 class="text-lg font-semibold text-gray-700 capitalize border rounded-r py-2 px-2">{{  client.first_name }} {{ client.last_name }}</h2>

							    	</div>
							    	<div class="flex  mb-3">
							    		<label class="w-24 border rounded-l py-2 px-2">Email</label>
							    	 	<h2 class="text-lg font-semibold text-gray-700 capitalize border rounded-r py-2 px-2">{{  client.email }}</h2>

							    	</div>
							    	<div class="flex  mb-3">
							    		<label class="w-24 border rounded-l py-2 px-2">Gender</label>
							    	 	<h2 class="text-lg font-md text-gray-700 border rounded-r py-2 px-2">{{  client.gender }}</h2>

							    	</div>

							    </div>

							    <!-- Project -->
							    <div class="w-full md:w-1/2 flex flex-col">
							    	<h3 class="font-md mb-2">Project Info</h3>
							    	<div class="flex  mb-3">
							    		<label class="w-24 border rounded-l py-2 px-2">Name</label>
							    	 	<h2 class="text-lg font-semibold text-gray-700 capitalize border rounded-r py-2 px-2">{{  project.name }} </h2>

							    	</div>
							    	<div class="flex  mb-3">
							    		<label class="w-24 border rounded-l py-2 px-2">Amount</label>
							    	 	<h2 class="text-lg font-semibold text-gray-700 capitalize border rounded-r py-2 px-2">$ {{  project.amount }}</h2>

							    	</div>

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
	import throttle from 'lodash/throttle'
	import axios from 'axios'
	var dayjs = require('dayjs')
	import 'sweetalert2/dist/sweetalert2.min.css';
	import VueSweetalert2 from 'vue-sweetalert2';
	import Multiselect from 'vue-multiselect'


	export default {
		components: {
			AppLayout,
			Multiselect,
        },
		props :  {
			client  : Object,
			project : Object,
			invoice : Object,
			clients : Array
		},
		data (){
			return {
				processing : false,
				editInvoice: false,
				sendNow : false,
				options : [],
				form : {
					client     : {},
        			project    : {},
        			due        : dayjs(this.invoice.due).format('YYYY-MM-DD'),
        			amount     : this.invoice.sub_total,
        			discount   : this.invoice.discount,
        			grand      : this.invoice.grand_total,
				},
        		clientProjects : []
			}
		},
		metaInfo() {
	        return {
	            title: `Invoices | ${this.client.first_name} ${this.client.last_name}`,
	            meta: [
	                { 
	                	name: 'description', 
	                	content: `Details of ${this.client.first_name}'s ${this.project.name}.`,
	                }
	            ]
	        }
        },
		mounted(){
			this.clients.forEach((client) => {
				this.options.push({
					id   : client.id,
					name : client.name,
					language  : client.name
				});
			});

			let clientName = `${this.client.first_name} ${this.client.last_name}`;
			this.form.client = {
				id   : this.client.id,
				name : clientName,
				language  : clientName
			}

			this.form.project = {
				amount  : this.project.amount,
				id   : this.project.id,
				name : this.project.name,
				language  : this.project.name
			}
		},
		watch: {
			'form.client': function (newVal, oldVal){
				this.getClientProjects();
		         //to work with cha/nges in someOtherProp
		         console.log(oldVal);
		    },
		    'form.project': function (newVal, oldVal){
		    	this.calculateAmounts('amount');
		    },
		    'form.discount' : function(newVal, oldVal){
		    	this.calculateAmounts('discount');
		    },
		},
		methods:{
		    format(date){
		    	return dayjs(date).format('ddd, MMM D, YYYY h:mm A');
		    },
		    toggleDeleteModal(){
		    	this.deleteModal = !this.deleteModal;
		    },
		    deleteInvoice(){
		    	this.processing   = false;
		    	this.$inertia.delete(`/invoices/${this.selected}`);

		    	this.processing   = true;
		    },
		    sendInvoice(){
		    	this.processing   = true;

		    	axios.get(`/invoices/${this.invoice.id}/send`)
		    	.then(res => {
					this.$swal(`Invoice sent.`);
		    		this.processing   = false;
		    		this.$inertia.reload({preserveScroll: true, preserveState: false})
		    	}).catch(e => {
		    		this.processing   = false;
		    		console.log(e);
		    	});

		    },
		    toggleEditInvoice(){
		    	this.editInvoice = !this.editInvoice;
		    },
		    updateInvoice(){
		    	this.processing = true;
		    	let { client, project, amount, discount, grand, due  } = this.form;
		    	let form = {
		    		client     : client.id,
        			project    : project.id,
        			due        : due,
        			amount     : amount,
        			discount   : discount,
        			grand      : grand
		    	}
		    	this.$inertia.put(`/invoices/${this.invoice.id}`, form);
		    	this.processing = false;
		    	this.editInvoice = false;
		    },
		    getClientProjects(){
		    	// console.log(this.form.client);
		    	axios.get(`/client_projects/${this.form.client.id}`)
		    	.then(res => {
		    		if(res.status === 200){
		    			res.data.projects.forEach((p) => {
		    				this.clientProjects.push({
		    					id        : p.id,
								name      : p.name,
								language  : p.name,
								amount    : p.amount
		    				})
		    			});
		    		}
		    	}).catch(err => {
		    		console.log(err);
		    	})
		    },
		    calculateAmounts(type){
		    	if(this.form.project){
		    		let { id, name, amount } = this.form.project;
		    		this.form.amount  = amount;

		    		if(type === 'discount'){
		    			this.form.grand   = Number(amount) + Number(this.form.discount);
		    		} else {
		    			if(this.form.discount){
		    				this.form.grand  = Number(this.form.discount) + Number(amount);
		    			} else {
		    				this.form.grand   = amount;
		    			}
		    		}
		    	}
		    }
		}
	};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

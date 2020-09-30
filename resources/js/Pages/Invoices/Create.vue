<template>
	<app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Invoices
            </h2>
        </template>

	        <div class="py-6">
	            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
	                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
	                    <div class="bg-white rounded shadow px-3 py-3">

						    <form @submit.prevent="createInvoice">

							    <div class="mb-6 flex justify-between items-center">
							    	<div class="flex items-center">
								        <inertia-link class="btn-indigo" href="/clients" preserve-scroll>
								        	<div class="flex items-center">
								        		
								        		<span class="px-3 py-1 bg-indigo-600 hover:bg-indigo-500 text-white rounded"><</span>
								        		<span class="ml-3 font-semibold text-md">New Invoice</span>
								        	</div>

								        </inertia-link>

								        <transition name="fade">
											<div v-if="$page.flash.success" id="Message" class=" ml-4 px-10 py-3 rounded text-green-600 bg-green-300 flex items-center">

									        	<span class="mr-3">{{ $page.flash.success }}</span>

									        </div>

									    </transition>

								    </div>

							        
							        <button  type="submit" class="px-3 py-3 bg-indigo-600 hover:bg-indigo-500 text-white rounded">
							        	<div v-if="processing" class="spinner"></div>

							      	    <span class="ml-2">Create</span>
							        </button>
							    </div>

							    <div class="flex flex-col">
								    <!-- Client -->
								    

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
							</form>
							

							
						</div>

	                </div>
	            </div>
	        </div>
		
    </app-layout>
</template>
<script>
    import AppLayout from './../../Layouts/AppLayout'
	import throttle from 'lodash/throttle'
	import Multiselect from 'vue-multiselect'

	export default {
		components: {
			AppLayout,
            Multiselect,
        },
		props :  {
			clients : Array
		},
		data (){
			return {
				processing    : false,
				options: [
			       
			    ],
        		form  : { 
        			client     : '',
        			project    : '',
        			due        : '',
        			amount     : 0,
        			discount   : 0,
        			grand      : 0
         		},
         		clientProjects : []
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
			reset() {
				this.form = {
					client     : '',
        			project    : '',
        			due        : '',
        			amount     : 0,
        			discount   : 0,
        			grand      : 0
				}
		    },
		    
		    createInvoice(){
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
		    	this.$inertia.post(`/invoices`, form);
		    	this.processing = false;
		    	this.reset();
		    },
		    getClientProjects(){
		    	console.log(this.form.client);
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

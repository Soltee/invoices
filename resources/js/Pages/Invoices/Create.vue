<template>
	<div class="px-6 py-6 flex flex-col w-full">
	    <div class="flex justify-between items-center w-full mb-5">
            <div class="flex items-center">
        		<inertia-link class="btn-indigo" href="/invoices" preserve-scroll>
		        		
		       		<span class="px-3 py-1 text-indigo-600 hover:text-indigo-500 hover:opacity-50 rounded">Invoices</span>
		        	
		        </inertia-link>
    			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right text-indigo-600"><polyline points="9 18 15 12 9 6"></polyline></svg>
		        		
		       	<span class="px-3 py-1 text-indigo-600  rounded">New Invoice</span>

    		</div>

	    </div>

	    <div class="flex flex-row items-center justify-center mb-5">
	    	<span 
	    		@click="removeClient"
	    		:class="(form.client.name ? 'text-indigo-600' : 'cursor-pointer hover:opacity-50')" 
	    		class="border px-6 py-2 border-indigo-600 rounded-full bold text-lg text-indigo-600  ">
	    		Client</span>
			<svg :class="(form.client.name ? 'text-indigo-600' : '')" fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="140" height="2" viewBox="0 0 140 1">
			  <line id="Line_1" data-name="Line 1" x2="140" transform="translate(0 0.5)" fill="currentColor" stroke="currentColor" stroke-width="1"/>
			</svg>

	    	<span 
	    		@click="removeProject"
	    		:class="(form.client.name ? 'text-indigo-600 cursor-pointer hover:opacity-50' : '')"
	    		class="border  px-6 py-2 border-gray-300 rounded-full text-md text-gray-900">
	    	Project</span>
	    	<svg 
	    		:class="((form.client.name && form.project) ? 'text-indigo-600' : '')" fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="140" height="2" viewBox="0 0 140 1">
			  <line id="Line_1" data-name="Line 1" x2="140" transform="translate(0 0.5)" fill="currentColor" stroke="currentColor" stroke-width="1"/>
			</svg>

	    	<span 
	    		:class="((form.client.name && form.project) ? 'text-indigo-600' : '')" 
	    		class="border px-6 py-2 border-gray-300 rounded-full text-md text-gray-900">

	    	Form</span>

	    </div>
	    <!-- v-if="!form.client.name" -->
        <div v-if="!form.client.name" class="border border-gray-300 rounded-lg p-2 mb-5">

			<div 
			class=" p-4 flex flex-row  rounded-md items-center shadow bg-gray-50">
	    		<label for="invoice_number" class="w-full mb-3 md:mb-0 md:w-56  uppercase text-lg bold">CHOOSE CLIENT</label>
				
				<multiselect 
					v-model="form.client" 
					:options="options"  
					placeholder="Select one" 
					label="name" track-by="name" class=""
					></multiselect>


			</div>
		</div>
		 <!-- v-if="form.client.name && !form.project" -->
		<div  v-if="form.client.name && !form.project" class="border bordeer-gray-300 rounded-lg p-2 mb-5">
			<div 
			class=" p-4 flex flex-row  rounded-md items-center shadow bg-gray-50">
	    		<label for="invoice_number" class="w-full mb-3 md:mb-0 md:w-56  uppercase text-lg bold">CHOOSE PROJECT</label>
				
				<multiselect 
					v-model="form.project" 
					:options="clientProjects"  
					placeholder="Select one" 
					label="name" track-by="name" class=""
					></multiselect>


			</div>
		</div>
        <div v-if="form.client.name && form.project" class="border bordeer-gray-300 rounded-lg p-2">
        	<!-- Header -->
        	<div class="header px-3 py-2">
        		<div class="flex flex-col items-end">
        			<label for="invoice_number" class="uppercase text-xs bold">INVOICE NO</label>
        			<input type="text" class="px-3 py-2 rounded border border-gray-300 hover:border-transparent active:border-transparent uppercase bold text-lg" v-model="form.num" placeholder="#000001">
        			<!-- Err -->
	    				<div class="mt-2">
	    				<div 
	    					v-if="numErr.length > 0"
	    					v-for="err in numErr" 
	    					class="text-red-500 text-md font-semibold mb-2">
	    						{{ err }}
	    				</div>
	    				</div>
        		</div>
        	</div>

        	<!-- Biiling From & TO -->
        	<div class="mt-4 billing px-3 py-2 flex flex-col md:flex-row justify-between ">
        		<div class="flex flex-col items-start w-full md:w-1/2 md:pr-2 md:border-r md:border-indigo-300">
        			<label for="invoice_number" class="uppercase text-xs bold">BILL FROM</label>
        			<input type="text" class="mt-2 px-3 py-2 rounded border border-gray-300 hover:border-transparent active:border-transparent w-full" v-model="form.from.name" placeholder="NAME OF YOUR BUSINESS" >
        			<!-- Err -->
    				<div class="mt-2">
    				<div 
    					v-if="bsNameErr.length > 0"
    					v-for="err in bsNameErr" 
    					class="text-red-500 text-md font-semibold mb-2">
    						{{ err }}
    				</div>
    				</div>
        			<textarea class="mt-2 px-3 py-2 rounded border border-gray-300 hover:border-transparent active:border-transparent w-full" v-model="form.from.about" rows="6">
        				
        			</textarea>

        		</div>
        		<div class="flex flex-col md:items-end w-full mt-5 md:mt-0 md:w-1/2 md:ml-2">

        			<div class="flex items-center">
        				<label for="invoice_number" class="uppercase text-xs bold">BILL TO</label>
        			</div>

        			<div class="mt-2">
        				
	        			<input type="text" class=" px-3 py-2 rounded border border-gray-300 hover:border-transparent active:border-transparent w-full uppercase" v-model="form.client.name" placeholder="Business name of your client">
	        			<input type="text" class="mt-2 px-3 py-2 rounded border border-gray-300 hover:border-transparent active:border-transparent w-full" v-model="form.client.email" placeholder="Email">
	        			<textarea class="mt-2 px-3 py-2 rounded border border-gray-300 hover:border-transparent active:border-transparent w-full" v-model="form.client.about" rows="6">
        				</textarea>

        			</div>
        			<div>
        				
        			</div>
        				
        		</div>
        	</div>

        	<!-- Date & TOTALS -->
        	<div class="mt-12  flex flex-col md:flex-row   px-3 py-5 border-t border-gray-300">
        		<div class="flex flex-col w-full md:w-1/2">
        			
	        		<div class="flex flex-col ">
	        			<label for="invoice_number" class="uppercase text-xs bold">INVOICE DATE</label>
	        			<input type="date" class="px-2 py-1 rounded border border-gray-300 hover:border-transparent active:border-transparent uppercase bold text-lg" v-model="form.dates.created" >
	        			<!-- Err -->
	    				<div class="mt-2">
	    				<div 
	    					v-if="createdErr.length > 0"
	    					v-for="err in createdErr" 
	    					class="text-red-500 text-md font-semibold mb-2">
	    						{{ err }}
	    				</div>
	    				</div>
	        		</div>
	        		<div class="flex flex-col mt-4">
	        			<label for="invoice_number" class="uppercase text-xs bold">DELIVERY DATE</label>
	        			<input type="date" class="px-2 py-1 rounded border border-gray-300 hover:border-transparent active:border-transparent uppercase bold text-lg" v-model="form.dates.delivery" >
	        			<!-- Err -->
	    				<div class="mt-2">
	    				<div 
	    					v-if="deliveryErr.length > 0"
	    					v-for="err in deliveryErr" 
	    					class="text-red-500 text-md font-semibold mb-2">
	    						{{ err }}
	    				</div>
	    				</div>
	        		</div>
        		</div>
        		<!-- TOTALS -->
        		<div class="flex flex-col w-full mt-4  md:ml-4 md:mt-0 md:w-1/2">
        				
        			<div class="flex items-center justify-between ">
	        			<label for="invoice_number" class="uppercase text-xs bold">Subtotal</label>
	        			<div class="flex flex-row items-end">

		        			<input type="text" class="ml-3 px-1 py-1 rounded  uppercase bold text-lg" v-model="form.amount" disabled>
		        			<span v-text="`USD`" class="text-indigo-600"></span>
		        		</div>
	        		</div>
	        		<div class="flex items-center justify-between">
	        			<label for="invoice_number" class="uppercase text-xs bold">Sales Tax (10%)</label>
	        			<div class="flex flex-row items-end">
	        				
	        			<input type="text" class="ml-3 px-1 py-1 rounded  uppercase bold text-lg" v-model="form.tax" disabled>
	        			<span v-text="`USD`" class="text-indigo-600"></span>
	        			</div>
	        		</div>

	        		<div class="flex items-center justify-between ">
	        			<label for="invoice_number" class="uppercase text-xs bold">Total</label>
	        			<div class="flex items-end">
		        			<input type="text" class="ml-3 px-1 py-1 rounded  uppercase bold text-lg" v-model="form.grand" disabled>
		        			<span v-text="`USD`" class="text-indigo-600"></span>
	        			</div>
	        		</div>
        		</div>


        	</div>
	        
	        <button  @click="createInvoice" class="fixed bottom-0 right-0 mb-10 mr-10 px-3 py-3 bg-indigo-600 hover:bg-indigo-500 text-white rounded">
	      	    <span class="">Create & Send</span>
	        </button>

        </div>

         <!-- Loading -->
        <transition name="fade">
        	<div 
				v-if="processing"
				class="fixed inset-0 rounded-lg flex flex-col  justify-center rounded-lg z-20">

				<div class="h-full w-full " >
															            
			    </div>
				<div class="absolute left-0 right-0  mx-auto  max-w-xl z-30">
			        <div class="flex flex-col items-center">
						<div class="loader"></div>
				    </div>
				</div>

			</div>


        </transition>





	</div>


</template>
<script>
    // import AppLayout from './../../Layouts/AppLayout'
	import throttle from 'lodash/throttle'
	import Multiselect from 'vue-multiselect'
	import 'sweetalert2/dist/sweetalert2.min.css';
	import VueSweetalert2 from 'vue-sweetalert2';
	export default {
		components: {
			// AppLayout,
            Multiselect,
            VueSweetalert2
        },
		props :  {
			clients : Array
		},
		data (){
			return {
				processing    : false,
				options: [
			       
			    ],
			    showClientInfo : false,
        		form  : { 
        			num      : '',
        			from     : {
        				name  : '',
        				about : `Birauta -17 Pokhara
Nepal

Company Number: 989090900
VAT: 7364958472
`
        			},
        			client     : {
        				about : ``
        			},
        			project    : '',
        			due        : '',
        			amount     : 0,
        			tax        : 0,
        			grand      : 0,
        			dates    : {
        				created  :'',
        				delivery :'',
        			}
         		},
         		numErr   : '',
         		bsNameErr   : '',
         		deliveryErr : '',
         		createdErr  : '',
         		clientProjects : [],
         		

			}
		},
		metaInfo() {
	        return {
	            title: `Invoices | New Invoice`,
	            meta: [
	                { name: 'description', content: 'Create a new invoice'},
	            ]
	        }
        },
		mounted(){
			this.clients.forEach((client) => {
				this.options.push({
					id   : client.id,
					name : client.name,
					language  : client.name,
					email  : client.email,
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
					num        : '',
					client     : '',
        			project    : '',
        			due        : '',
        			amount     : 0,
        			discount   : 0,
        			tax        : 0,
        			grand      : 0
				}
		    },
		    removeClient(){
		    	this.form.client = {
		    		about : ''
		    	}
		    },
		    removeProject(){
		    	this.form.project = ''
		    },
		    createInvoice(){
		    	this.processing = true;
		    	this.createdErr = '';
		    	this.deliveryErr = '';

		    	let { num, from, client, project, amount, discount, grand, tax, dates  } = this.form;
		    	let form = {
		    		num        : num,
		    		from_name  : from.name,
		    		from_about : from.about,
		    		client     : client.id,
		    		client_name : client.name, 
		    		client_email : client.email, 
        			project    : project.id,
        			project_name    : project.name,
        			// due        : due,
        			amount     : amount,
        			tax        : tax,
        			discount   : discount,
        			grand      : grand,
        			created    : dates.created,
        			delivery   : dates.delivery
		    	}
		    	axios.post(`/invoices`, form)
		    	.then(res => {
						this.processing = false;
						if(res.status === 201){
							this.$swal(`Invoice is created.`);
							this.form = {
			        			num        : '',
					    		from_name  : '',
					    		from_about : '',
					    		client     : {
					    			about : ''
					    		},
			        			project    : '',
			        			amount     : '',
			        			tax        : '',
			        			discount   : 0,
			        			grand      : 0,
			        			created    : '',
			        			delivery   : '',
			        			tax        : 0

			        		}
			        		this.toggleCreateProjectModal();
			        		this.$inertia.reload({preserveScroll: true, preserveState: false})

						}
					}).catch(err => {

						this.processing = false;
						let {
							client, 
							amount, 
							grand,
							from_name,
		    				from_about,
							num,
							tax,
							created,
							delivery } = err.response.data.errors;

						if(num){
							this.numErr = num;
						}

						if(from_name){
							this.bsNameErr = from_name;
						}

						if(delivery){
							this.deliveryErr = delivery;
						}
						if(created){
							this.createdErr = created;
						}

						// if(project_name){
						// 	this.nameErr = project_name;
						// }

						// if(description){
						// 	this.descriptionErr = description;
						// }

						// if(amount){
						// 	this.amountErr = amount;
						// }

					});
		  //   	this.processing = false;	
		  //   	this.$swal(`Invoice created.`);
				// this.$inertia.reload({preserveScroll: true, preserveState: false})

		  //   	this.reset();
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


		    		this.form.tax = Math.round((10/100) * Number(amount), 2);

		    		this.form.grand = Number(this.form.amount) + Number(this.form.tax);

		    		// if(type === 'discount'){
		    		// 	this.form.grand   = Number(amount) + Number(this.form.discount);
		    		// } else {
		    		// 	if(this.form.discount){
		    		// 		this.form.grand  = Number(this.form.discount) + Number(amount);
		    		// 	} else {
		    		// 		this.form.grand   = amount;
		    		// 	}
		    		// }
		    	}
		    }
		}
	};
</script>
<style>
.loader {
  border: 16px solid #f3f3f3; /* Light grey */
  border-top: 16px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 120px;
  height: 120px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

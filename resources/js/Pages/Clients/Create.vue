<template>
	<div class="bg-white rounded shadow mt-6 px-3 py-3">

  		<form @submit.prevent="create">

		    <div class="mb-6 flex justify-between items-center">
		    	<div class="flex items-center">
			        <inertia-link class="btn-indigo" href="/clients" preserve-scroll>
			        	<div class="flex items-center">
			        		
			        		<span class="px-3 py-1 bg-indigo-600 hover:bg-indigo-500 text-white rounded"><</span>
			        		<span class="ml-3 font-semibold text-md">New Client</span>
			        	</div>

			        </inertia-link>

			        <transition name="fade">
						<div v-if="$page.flash.success" id="Message" class=" ml-4 px-10 py-3 rounded text-green-600 bg-green-300 flex items-center">

				        	<span class="mr-3">{{ $page.flash.success }}</span>
				        	<!-- <svg @click="$page.flash === '';" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-red-600"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> -->

				        </div>

				    </transition>

			    </div>

		        
		        <button  type="submit" class="px-3 py-3 bg-indigo-600 hover:bg-indigo-500 text-white rounded">
		        	<div v-if="processing" class="spinner"></div>

		      	    <span class="ml-2">Create</span>
		        </button>
		    </div>

		    <div class="flex flex-col md:flex-row">
			    <!-- Client -->
			    <div class="w-full  md:w-1/2 flex flex-col mb-6 md:mb-0">
			    	<h3 class="text-md font-semibold mb-2">Client Info</h3>
			    	<div class="mb-6 flex flex-col"> 
			    		<label for="first_name">First name:</label>
	    				<input id="first_name" type="text" class="px-3 py-3 rounded border border-indigo-500" v-model="form.first_name" />

	    				<div 
	    					v-if="$page.errors.first_name" 
	    					class="text-red-500 text-md font-semibold mt-2">
	    						{{ $page.errors.first_name }}
	    				</div>

			    	</div>

			    	<div class="mb-6 flex flex-col"> 
			    		<label for="last_name">Last name:</label>
	    				<input id="last_name" type="text" class="px-3 py-3 rounded border border-indigo-500" v-model="form.last_name" />
	    				<div 
	    					v-if="$page.errors.last_name" 
	    					class="text-red-500 text-md font-semibold mt-2">
	    						{{ $page.errors.last_name }}
	    				</div>
			    	</div>

			    	<div class="mb-6 flex flex-col"> 
			    		<label for="email">Email:</label>
	    				<input id="email" type="email" class="px-3 py-3 rounded border border-indigo-500" v-model="form.email" />
	    				<div 
	    					v-if="$page.errors.email" 
	    					class="text-red-500 text-md font-semibold mt-2">
	    						{{ $page.errors.email }}
	    				</div>

			    	</div>

			    	<div class="mb-6 flex flex-col"> 
			    		<label for="gender">Gender:</label>
			    		<select v-model="form.gender" class="border border-indigo-500 rounded w-full px-3 py-3">
			    			<option>Choose Gender</option>
			    			<option value="MALE">MALE</option>
			    			<option value="FEMALE">FEMALE</option>
			    		</select>
			    		<div 
	    					v-if="$page.errors.gender" 
	    					class="text-red-500 text-md font-semibold mt-2">
	    						{{ $page.errors.gender }}
	    				</div>
			    	</div>

			    </div>

			    <!-- Project -->
			    <div class="w-full md:w-1/2 md:ml-5 flex flex-col">
			    	<h3 class="text-md font-semibold mb-2">Project Info</h3>
			    	<div class="mb-6 flex flex-col"> 
			    		<label for="project_name">Project name:</label>
	    				<input id="project_name" type="text" class="px-3 py-3 rounded border border-indigo-500" v-model="form.project_name" />
	    				<div 
	    					v-if="$page.errors.project_name" 
	    					class="text-red-500 text-md font-semibold mt-2">
	    						{{ $page.errors.project_name }}
	    				</div>
			    	</div>

			    	<div class="mb-6 flex flex-col"> 
			    		<label for="amount">Amount: ($)</label>
	    				<input id="amount" type="number" class="px-3 py-3 rounded border border-indigo-500" min="0" v-model="form.amount" />
			    	</div>

			    	<div 
	    					v-if="$page.errors.amount" 
	    					class="text-red-500 text-md font-semibold mt-2">
	    						{{ $page.errors.amount }}
	    				</div>

			    </div>
		    </div>
		</form>



		
	</div>
</template>
<script>
    import AppLayout from './../../Layouts/AppLayout'
    import VueToast from 'vue-toast-notification';

	export default {
		layout  : AppLayout,
		components: {
            
        },
		props :  {

		},
		data (){
			return {
				processing :false,
				form : {
					first_name    : '',
					last_name     : '',
					email         : '',
					gender        : '',
					project_name  : '',
					amount        : ''
 				}
			}
		},
		methods:{
			create(){
     		    this.$inertia.post('/clients', this.form, {
			        onStart: () => this.processing = true,
			        onFinish: () => {
			        		this.processing = false;
			        		this.form = {
			        			first_name    : '',
								last_name     : '',
								email         : '',
								gender        : '',
								project_name  : '',
								amount        : ''
			        		}
			        	},
			    });

     		    this.form = {
			        			first_name    : '',
								last_name     : '',
								email         : '',
								gender        : '',
								project_name  : '',
								amount        : ''
			        		}
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
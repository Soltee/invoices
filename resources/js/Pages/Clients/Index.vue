<template>
	<div class="bg-white rounded shadow mt-6 p-2">
	    <div class="mb-6 flex justify-between items-center">
	      <input class="px-3 py-3 rounded border border-indigo-500 focus:border-indigo-600" v-model="keyword"  />
	      
	      <inertia-link class="btn-indigo" href="/clients/create" preserve-scroll>
	        <span class="px-3 py-3 bg-indigo-600 hover:bg-indigo-500 text-white rounded">New</span>
	      </inertia-link>
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
	                            <p class="text-gray-900 whitespace-no-wrap"> {{ client.name }}</p>
	                        </td>
	                         <td class="px-5 whitespace-no-wrap py-3 border-b border-gray-200 bg-white text-sm">
	                            <p class="text-gray-900 whitespace-no-wrap">{{ client.email }}</p>
	                        </td>
	                         <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
	                            <p class="text-gray-900 whitespace-no-wrap">{{ client.created_at }}</p>
	                        </td>
	                        
	                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200">
	                            <div class="flex justify-end items-center">
	                                <a 
	                                    class="hover:font-semibold" 
	                                     >
	                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye text-gray-900 hover:opacity-75"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
	                                </a>

	                             

	                                <div 
	                                    class="flex items-center px-3 py-3 hover:opacity-50 text-md font-bold text-white rounded cursor-pointer">
	                                             
	                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete text-red-600 hover:text-red-500 ml-3"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
	                                </div>

	                            </div>
	                        </td>
	                    </tr>
	                            
	                    <tr v-if="clients.length < 1">
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
</template>
<script>
    import AppLayout from './../../Layouts/AppLayout'
	import Pagination from './../../Shared/Pagination'
	import throttle from 'lodash/throttle'

	export default {
		layout  : AppLayout,
		components: {
            Pagination
        },
		props :  {
			clients : Object,
			search  : String
		},
		data (){
			return {
        		keyword: this.search,
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
		}
	};
</script>
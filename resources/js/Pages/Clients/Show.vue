<template>
	<app-layout>
        <template #header>
        	<div class="flex justify-between items-center">
        		<div class="flex items-center">
	        		<inertia-link class="btn-indigo" href="/dashboard" preserve-scroll>
			        		
			       		<span class="px-3 py-1 text-indigo-600 hover:text-indigo-500 hover:opacity-50 rounded">Dashboard</span>
			        	
			        </inertia-link>
        			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right text-indigo-600"><polyline points="9 18 15 12 9 6"></polyline></svg>
        			<inertia-link class="btn-indigo" href="/clients" preserve-scroll>
			        		
			       		<span class="px-3 py-1 text-indigo-600 hover:text-indigo-500 hover:opacity-50 rounded">Clients</span>
			        	
			        </inertia-link>

			        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right text-indigo-600"><polyline points="9 18 15 12 9 6"></polyline></svg>

			       	<span class="px-3 py-1 text-indigo-600  rounded">
			       		 {{ client.first_name  }} {{ client.last_name }}
			       	</span>
        		</div>
	            

	            <div>
			    	<span 
				        	@click="toggleEditClient();" 
				        	class="px-3 py-2 cursor-pointer bg-yellow-600 hover:bg-yellow-500 text-white rounded">Edit</span>
				    </span>

				    <!-- Edit Client -->
			        <transition name="fade">
	                	<div 
							v-if="editClientModal"
							class="fixed  inset-0  rounded-lg flex flex-col  justify-center rounded-lg z-20">
					        <div @click="toggleEditClient();" class="h-full w-full bg-gray-300" >
					            
							<!-- editClientModal -->
					    	</div>
							<div class="absolute  bg-white left-0 right-0  mx-auto  max-w-xl shadow-lg rounded-lg p-6 z-30">
								<div class="text-right">
						            <button @click="toggleEditClient();"  type="button" class=" cursor-pointer" data-dismiss="modal" aria-label="Close">
						                <svg   width="18" height="18" viewBox="0 0 18 18" class="hover:opacity-75 fill-current text-gray-900">
						                  <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
						                </svg>
						            </button>

						        </div>

						        <!--- Edit Form -->
									<form @submit.prevent="updateClient">
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
									    	<div class="mb-6 flex flex-col"> 
									    		<label for="first_name">First name:</label>
							    				<input id="first_name" type="text" class="px-3 py-3 rounded border border-indigo-500" v-model="clientForm.first_name" />

							    				<!-- Err -->
							    				<div class="mt-2">
							    				<div 
							    					v-if="firstNameErr.length > 0"
							    					v-for="err in firstNameErr" 
							    					class="text-red-500 text-md font-semibold mb-2">
							    						{{ err }}
							    				</div>
							    				</div>
									    	</div>

									    	<div class="mb-6 flex flex-col"> 
									    		<label for="last_name">Last name:</label>
							    				<input id="last_name" type="text" class="px-3 py-3 rounded border border-indigo-500" v-model="clientForm.last_name" />

							    				<!-- Err -->
							    				<div class="mt-2">
							    				<div 
							    					v-if="lastNameErr.length > 0"
							    					v-for="err in lastNameErr" 
							    					class="text-red-500 text-md font-semibold mb-2">
							    						{{ err }}
							    				</div>
							    				</div>
									    	</div>

									    	<div class="mb-6 flex flex-col"> 
									    		<label for="email">Email:</label>
							    				<input id="email" type="email" class="px-3 py-3 rounded border border-indigo-500" v-model="clientForm.email" />
									    	</div>

									    	<!-- Err -->
						    				<div class="mt-2">
						    				<div 
						    					v-if="emailErr.length > 0"
						    					v-for="err in emailErr" 
						    					class="text-red-500 text-md font-semibold mb-2">
						    						{{ err }}
						    				</div>
						    				</div>

						    				<div class="mb-6 flex flex-col"> 
									    		<label for="gender">Gender:</label>
											    <select v-model="clientForm.gender" class="border border-indigo-500 rounded w-full px-3 py-3 text-gray-900">
									    			<option 
									    			class="text-gray-800" disabled value="">Choose Gender</option>
													<option value="MALE">MALE</option>
													<option value="FEMALE">FEMALE</option>
									    		</select>
									    	</div>

									    	<!-- Err -->
						    				<div class="mt-2">
						    				<div 
						    					v-if="genderErr.length > 0"
						    					v-for="err in genderErr" 
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

	                <!-- Delete Modal -->

					<span 
				        	@click="
				        		selected = client.id;
				        		toggleDeleteClientModal();" 
				        	class="ml-3 px-3 py-2 cursor-pointer bg-red-600 hover:bg-red-500 text-white rounded">Delete</span>
				    </span>
					<!-- Delete Modal -->
					<transition name="fade">
			        	<div 
							v-if="deleteClientModal"
							class="fixed  inset-0  rounded-lg flex flex-col  justify-center rounded-lg z-20">
						        <div @click="toggleDeleteClientModal();" class="h-full w-full bg-gray-300" >
						            
						    	</div>
							<div class="absolute  bg-white left-0 right-0  mx-auto  max-w-xl shadow-lg rounded-lg p-6 z-30">
								<div class="text-right">
							            <button @click="toggleDeleteClientModal();"  type="button" class=" cursor-pointer" data-dismiss="modal" aria-label="Close">
							                <svg   width="18" height="18" viewBox="0 0 18 18" class="hover:opacity-75 fill-current text-gray-900">
							                  <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
							                </svg>
							            </button>

							        </div>
							        <div class="">
							            <p class="mt-4 text-lg font-semibold text-green-800 text-center">Are you sure?</p>
							            <div class="mt-6 mb-3 flex justify-end">
							                <button @click="toggleDeleteClientModal();" class="cursor-pointer text-gray-900 px-4 py-3 rounded-lg mr-4">Cancel</button>
							                <button @click="deleteClient();" class="cursor-pointer bg-red-600 hover:bg-red-500 text-white px-4 py-3 rounded-lg">Delete</button>
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


							<div class="mb-6 ">

							    <div class="">
							    	

							    	<div class="flex mb-3">
							    		<label class="w-24 border rounded-l py-2 px-2">Name</label>
							    	 	<h2 class="text-lg font-semibold text-gray-700 capitalize border rounded-r py-2 px-2">{{  client.first_name }}  {{ client.last_name }}</h2>

							    	</div>
							    	<div class="flex mb-3">
							    		<label class="w-24 border rounded-l py-2 px-2">Email</label>
							    	 	<h2 class="text-lg font-semibold text-gray-700 capitalize border rounded-r py-2 px-2">{{  client.email }}</h2>

							    	</div>
							    	<div class="flex mb-3">
							    		<label class="w-24 border rounded-l py-2 px-2">Email</label>
							    	 	<h2 class="text-lg font-semibold text-gray-700 capitalize border rounded-r py-2 px-2">{{  client.gender }}</h2>

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
								        	class="px-3 py-3 cursor-pointer bg-indigo-600 hover:bg-indigo-500 text-white rounded">New Project</span>
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
														    	<div class="mb-6 flex flex-col"> 
														    		<label for="project_name">Project name:</label>
												    				<input id="project_name" type="text" class="px-3 py-3 rounded border border-indigo-500" v-model="projectForm.project_name" />

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
												    				<input id="amount" type="number" class="px-3 py-3 rounded border border-indigo-500" v-model="projectForm.amount" />
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

							    <!-- Projects -->
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
							                		v-for="project in searchData.data" >
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
							                            	<a 	:href="`/projects/${project.id}-${project.name}`"
						                                    class="hover:font-semibold" 
						                                     >
							                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye text-gray-900 hover:opacity-75"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
							                                </a>
							                            	<!-- <svg 
							                            		@click="
														    		selected = project
														    		toggleEditProjectModal();"
														    	viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
														    	class="text-yellow-600 hover:text-yellow-500 w-6 h-6 cursor-pointer hover:opacity-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>


							                                <div @click="
							                                	selected = project;
							                                	toggleDeleteModal();"
							                                    class="flex items-center px-3 py-3 hover:opacity-50 text-md font-bold text-white rounded cursor-pointer">
							                                             
							                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete text-red-600 hover:text-red-500 ml-3"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
							                                </div> -->

							                                

							                            </div>
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
							                            	<a 	:href="`/projects/${project.id}-${project.name}`"
						                                    class="hover:font-semibold" 
						                                     >
						                                    	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye text-gray-900 hover:opacity-75"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
						                                	</a>
														    <!-- <svg 
														    	@click="
														    		selected = project;
														    		toggleEditProjectModal();"
														    	viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
														    	class="text-yellow-600 hover:text-yellow-500 w-6 h-6 cursor-pointer hover:opacity-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>

							                                <div @click="
							                                	selected = project; toggleDeleteProjectModal();"
							                                    class="flex items-center px-3 py-3 hover:opacity-50 text-md font-bold text-white rounded cursor-pointer">
							                                             
							                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete text-red-600 hover:text-red-500 ml-3"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
							                                </div> -->

							                                

							                            </div>
							                        </td>
							                    </tr>
							                     
							                    <!-- No projects -->  
							                    <tr v-if="!search">
						                        	<td v-if="projects.data.length < 1 " class="">
						                            <div class=" flex flex-col justify-center w-full items-center">
											      		<svg class="h-10 w-10 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM6.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm7 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm2.16 6H4.34a6 6 0 0 1 11.32 0z"/></svg>
											      		<p class="mt-3">Oops! No Projects .</p>
										     		</div>
						                            </td>
						                        </tr>

						                        <tr v-if="search">
						                        	<td v-if="searchData.data.length < 1" class="">
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

							    <!-- Pagination -->
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


							<!-- Edit  Project Modal -->
							<transition name="fade">
					        	<div 
									v-if="editProjectModal"
									class="fixed  inset-0  rounded-lg flex flex-col  justify-center rounded-lg z-20">
								        <div @click="toggleEditProjectModal();" class="h-full w-full bg-gray-300" >
								            
								    	</div>
									<div class="absolute  bg-white left-0 right-0  mx-auto  max-w-xl shadow-lg rounded-lg p-6 z-30">
										<div class="text-right">
									            <button @click="toggleEditProjectModal();"  type="button" class=" cursor-pointer" data-dismiss="modal" aria-label="Close">
									                <svg   width="18" height="18" viewBox="0 0 18 18" class="hover:opacity-75 fill-current text-gray-900">
									                  <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
									                </svg>
									            </button>

									    </div>
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
											    	<div class="mb-6 flex flex-col"> 
											    		<label for="project_name">Project name:</label>
									    				<input id="project_name" type="text" class="px-3 py-3 rounded border border-indigo-500" v-model="projectForm.project_name" />

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
									    				<input id="amount" type="number" class="px-3 py-3 rounded border border-indigo-500" v-model="projectForm.amount" />
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

					        <!-- Delete Modal -->
							<!-- <transition name="fade">
					        	<div 
									v-if="deleteProjectModal"
									class="fixed  inset-0  rounded-lg flex flex-col  justify-center rounded-lg z-20">
								        <div @click="toggleDeleteProjectModal();" class="h-full w-full bg-gray-300" >
								            
								    	</div>
									<div class="absolute  bg-white left-0 right-0  mx-auto  max-w-xl shadow-lg rounded-lg p-6 z-30">
										<div class="text-right">
									            <button @click="toggleDeleteProjectModal();"  type="button" class=" cursor-pointer" data-dismiss="modal" aria-label="Close">
									                <svg   width="18" height="18" viewBox="0 0 18 18" class="hover:opacity-75 fill-current text-gray-900">
									                  <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
									                </svg>
									            </button>

									        </div>
									        <div class="">
									            <p class="mt-4 text-lg font-semibold text-green-800 text-center">Are you sure?</p>
									            <div class="mt-6 mb-3 flex justify-end">
									                <button @click="toggleDeleteProjectModal();" class="cursor-pointer text-gray-900 px-4 py-3 rounded-lg mr-4">Cancel</button>
									                <button @click="deleteProject();" class="cursor-pointer bg-red-600 hover:bg-red-500 text-white px-4 py-3 rounded-lg">Delete</button>
									            </div>
									    </div>

								    </div>

								</div>
					        </transition> -->
							
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

	export default {
		components: {
			AppLayout,
            Pagination
        },
		props :  {
			client : Object,
			projects : Object,

		},
		data (){
			return {
				keyword     : this.search,
				processing  :false,
				clientForm  : {
					first_name      : this.client.first_name,
					last_name       : this.client.last_name,
					email           : this.client.email,
					gender          : this.client.gender
				},
				firstNameErr        : [],
				lastNameErr         : [],
				emailErr            : [],
				genderErr           : [],
				projectForm : {
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
 				selected     : {},
 				editProjectModal : false,
 				editClientModal   : false,
 				deleteProjectModal : false,
 				deleteClientModal  : false
			}
		},
		metaInfo() {
	        return {
	            title: `Clients | ${this.client.first_name} ${this.client.last_name}`,
	            meta: [
	                { name: 'description', content: 'Connect and follow ' + this.client.first_name },
	                { property: 'og:title', content: this.client.first_name + ' - Epiloge'},
	                { property: 'og:description', content: 'Connect and follow ' + this.client.first_name},
	            ]
	        }
        },
		watch: {
			keyword(){
				this.searchEndpoint = `/clients/projects/${this.client.id}/search?keyword=${this.keyword}`;
			    this.searchProjects();
			},
			selected(){
				if(this.editProjectModal){

					this.projectForm = {
						client        : this.client.id,
						project_name  : this.selected.name,
						amount        : this.selected.amount
					}

				}
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
			updateClient(){
				this.processing = true;

				//Remove all errors
				this.firstNameErr   = [];
				this.lastNameErr    = [];
				this.emailErr       = [];
				this.genderErr      = [];

				//UPDATE
     		    axios.put(`/clients/${this.client.id}`, this.clientForm)
					.then(res => {
						this.processing = false;
						if(res.status === 200){
							this.$swal(`${this.clientForm.first_name} is updated.`);
							this.clientForm = {
			        			first_name      : '',
								last_name       : '',
								email           : '',
								gender          : ''			        		
							}
							this.editClientModal = false;
							this.$inertia.reload({preserveScroll: true, preserveState: false})
						}
					}).catch(err => {

						this.processing = false;
						let { first_name, last_name, email, gender } = err.response.data.errors;

						if(first_name){
							this.firstNameErr = first_name;
						}

						if(last_name){
							this.lastNameErr = last_name;
						}

						if(email){
							this.emailErr = email;
						}

						if(gender){
							this.genderErr = gender;
						}

					});
     	
			},
			deleteClient(){
				this.processing = true;
				this.$inertia.delete(`/clients/${this.selected}`, {
			        onStart: () => this.processing = true,
			        onFinish: () => {
			        		this.processing = false;
			        	},
			    });
			},
			createProject(){
				this.processing = true;

				//Remove all errors
				this.projectNameErr = [];
				this.amountErr      = [];

				//Post
     		    axios.post(`/projects`, this.projectForm)
					.then(res => {
						this.processing = false;
						if(res.status === 201){
							this.$swal(`${this.projectForm.project_name} is created.`);
							this.projectForm = {
			        			project_name    : '',
								amount          : ''
			        		}
			        		this.$inertia.reload({preserveScroll: true, preserveState: false})

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
			updateProject(){
				this.processing = true;

				//Remove all errors
				this.projectNameErr = [];
				this.amountErr      = [];

				//PUt
     		    axios.put(`/projects/${this.selected.id}`, this.projectForm)
					.then(res => {
						this.processing = false;
						if(res.status === 200){
							this.$swal(`${this.projectForm.project_name} is updated.`);
							this.projectForm = {
			        			project_name    : '',
								amount          : ''
			        		}
			        		this.$inertia.reload({preserveScroll: true, preserveState: false})

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
			deleteProject(){
				this.processing = true;



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
			toggleEditClient(){
				this.editClientModal = !this.editClientModal;
			},
			toggleNewProjectModal(){
				this.newProjectModal = !this.newProjectModal;
			},
			toggleEditProjectModal(){
				this.editProjectModal = !this.editProjectModal;
			},
			toggleDeleteProjectModal(){
				this.deleteProjectModal = !this.deleteProjectModal;
			},
			toggleDeleteClientModal(){
				this.deleteClientModal  = !this.deleteClientModal;
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
<template>
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white border-b border-gray-100">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <a href="/dashboard" class="italic font-black text-blue-600 focus:border-none">
                                <img class="w-24" :src="'/img/invoice.svg'">
                                <!-- <jet-application-mark class="block h-9 w-auto" /> -->
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <jet-nav-link 
                                class="text-blue-600"
                                href="/dashboard" :active="$page.currentRouteName == 'dashboard'">
                                Dashboard
                            </jet-nav-link>
                            <jet-nav-link 
                                class="text-blue-600"
                                href="/clients" 
                                :active="
                                    $page.currentRouteName == 'clients' || 
                                    $page.currentRouteName == 'client.create' ||
                                    $page.currentRouteName == 'client.show'
                                ">
                                Clients
                            </jet-nav-link>
                            <jet-nav-link 
                                class="text-blue-600"
                                href="/projects" 
                                :active="
                                    $page.currentRouteName == 'projects' ||
                                    $page.currentRouteName == 'project.show'
                                ">
                                Projects
                            </jet-nav-link>
                            <jet-nav-link 
                                class="text-blue-600"
                                href="/invoices" 
                                :active="
                                    $page.currentRouteName == 'invoices' ||
                                    $page.currentRouteName == 'invoice.create' ||
                                    $page.currentRouteName == 'invoice.show'
                                ">
                                Invoices
                            </jet-nav-link>
                        </div>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <div class="ml-3 relative">
                            <jet-dropdown align="right" width="48">
                                <template #trigger>
                                    <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                        <img class="h-8 w-8 rounded-full object-cover" :src="user.profile_photo_url" :alt="user.name" />
                                    </button>
                                </template>

                                <template #content>
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Manage Account
                                    </div>

                                    <jet-dropdown-link href="/user/profile">
                                        Profile
                                    </jet-dropdown-link>

                                    <!-- Authentication -->
                                    <form @submit.prevent="logout">
                                        <jet-dropdown-link as="button">
                                            Logout
                                        </jet-dropdown-link>
                                    </form>
                                </template>
                            </jet-dropdown>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <jet-responsive-nav-link href="/dashboard" :active="$page.currentRouteName == 'dashboard'">
                        Dashboard
                    </jet-responsive-nav-link>
                    <jet-responsive-nav-link href="/clients" 
                        :active="
                            $page.currentRouteName == 'clients' || 
                            $page.currentRouteName == 'client.create' ||
                            $page.currentRouteName == 'client.show'
                        ">
                        Clients
                    </jet-responsive-nav-link>
                    <jet-responsive-nav-link 
                        class="text-blue-600"
                        href="/projects" 
                        :active="
                            $page.currentRouteName == 'projects' ||
                            $page.currentRouteName == 'project.show'
                        ">
                        Projects
                    </jet-responsive-nav-link>
                    <jet-responsive-nav-link 
                        class="text-blue-600"
                        href="/invoices" 
                        :active="
                            $page.currentRouteName == 'invoices' ||
                            $page.currentRouteName == 'invoice.create' ||
                            $page.currentRouteName == 'invoice.show'
                        ">
                        Invoices
                    </jet-responsive-nav-link>
                    
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="flex items-center px-4">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" :src="user.profile_photo_url" :alt="user.name" />
                        </div>

                        <div class="ml-3">
                            <div class="font-medium text-base text-gray-800">{{ user.name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ user.email }}</div>
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <jet-responsive-nav-link href="/user/profile" :active="$page.currentRouteName == 'profile.show'">
                            Profile
                        </jet-responsive-nav-link>

                    
                        <!-- Authentication -->
                        <form method="POST" @submit.prevent="logout">
                            <jet-responsive-nav-link as="button">
                                Logout
                            </jet-responsive-nav-link>
                        </form>

                        
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header"></slot>
            </div>
        </header>

        <!-- Page Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <slot></slot>
        </main>

        <!-- Modal Portal -->
        <portal-target name="modal" multiple>
        </portal-target>
    </div>
</template>

<script>
    import JetApplicationLogo from './../Jetstream/ApplicationLogo'
    import JetApplicationMark from './../Jetstream/ApplicationMark'
    import JetDropdown from './../Jetstream/Dropdown'
    import JetDropdownLink from './../Jetstream/DropdownLink'
    import JetNavLink from './../Jetstream/NavLink'
    import JetResponsiveNavLink from './../Jetstream/ResponsiveNavLink'

    export default {
        components: {
            JetApplicationLogo,
            JetApplicationMark,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        },

        methods: {
            switchToTeam(team) {
                this.$inertia.put('/current-team', {
                    'team_id': team.id
                }, {
                    preserveState: false
                })
            },

            logout() {
                axios.post('/logout').then(response => {
                    window.location = '/';
                })
            },
        },

        computed: {
            path() {
                return window.location.pathname
            },
            user() {
                return this.$page.props.user
            },
        }
    };
</script>
<style>
    .spinner {
      width: 40px;
      height: 40px;
      margin: 100px auto;
      background-color: #333;

      border-radius: 100%;  
      -webkit-animation: sk-scaleout 1.0s infinite ease-in-out;
      animation: sk-scaleout 1.0s infinite ease-in-out;
    }

    @-webkit-keyframes sk-scaleout {
      0% { -webkit-transform: scale(0) }
      100% {
        -webkit-transform: scale(1.0);
        opacity: 0;
      }
    }

    @keyframes sk-scaleout {
      0% { 
        -webkit-transform: scale(0);
        transform: scale(0);
      } 100% {
        -webkit-transform: scale(1.0);
        transform: scale(1.0);
        opacity: 0;
      }
    }
</style>

<script setup>
    import { ref } from 'vue';
    import { useDark, useToggle } from '@vueuse/core';
    import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue';
    import BreezeDropdown from '@/Components/Dropdown.vue';
    import BreezeDropdownLink from '@/Components/DropdownLink.vue';
    import BreezeNavLink from '@/Components/NavLink.vue';
    import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
    import Sidebar from '@/Layouts/SideBar.vue';
    import Mainpage from '@/Layouts/MainPage.vue';
    import { Link } from '@inertiajs/inertia-vue3';
    import MainPage from './MainPage.vue';
    
    const showingNavigationDropdown = ref(false);
    const isDark = useDark()
    const toggleDark = useToggle(isDark)

    </script>
    
    <template>
        <div>
            <div class="min-h-screen bg-gray-100 dark:bg-slate-600">
                <nav class="bg-white border-b border-gray-100 dark:bg-slate-700 dark:border-gray-600">
                    <!-- Primary Navigation Menu -->
                    <div class="mx-auto px-4 sm:px-6 lg:px-8 ">
                        <div class="flex justify-between h-16">
                            <div class="flex">
                                <!-- Logo -->
                                <div class="shrink-0 flex items-center">
                                    <Link :href="route('dashboard')">
                                        <BreezeApplicationLogo class="block h-9 w-auto dark:fill-white" />
                                    </Link>
                                </div>
    
                                <!-- Navigation Links -->
                                <!-- <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                    <BreezeNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                        Dashboard
                                    </BreezeNavLink>
                                    <BreezeNavLink :href="route('games/index')" :active="route().current('games/index')">
                                        Games
                                    </BreezeNavLink>
                                </div> -->
                            </div>
    
                            <div class="hidden sm:flex sm:items-center sm:ml-6">
                                <button @click="toggleDark()" type="button" id="headlessui-listbox-button-4" aria-haspopup="true" aria-expanded="false" data-headlessui-state="" aria-labelledby="headlessui-listbox-label-3 headlessui-listbox-button-4">
                                    <span class="dark:hidden">
                                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                                            <path d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" class="fill-sky-400/20 stroke-gray-500"></path>
                                            <path d="M12 4v1M17.66 6.344l-.828.828M20.005 12.004h-1M17.66 17.664l-.828-.828M12 20.01V19M6.34 17.664l.835-.836M3.995 12.004h1.01M6 6l.835.836" class="stroke-gray-500"></path>
                                        </svg>
                                    </span>
                                    <span class="hidden dark:inline">
                                        <svg viewBox="0 0 24 24" fill="none" class="w-6 h-6">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M17.715 15.15A6.5 6.5 0 0 1 9 6.035C6.106 6.922 4 9.645 4 12.867c0 3.94 3.153 7.136 7.042 7.136 3.101 0 5.734-2.032 6.673-4.853Z" class="fill-sky-400/20"></path>
                                            <path d="m17.715 15.15.95.316a1 1 0 0 0-1.445-1.185l.495.869ZM9 6.035l.846.534a1 1 0 0 0-1.14-1.49L9 6.035Zm8.221 8.246a5.47 5.47 0 0 1-2.72.718v2a7.47 7.47 0 0 0 3.71-.98l-.99-1.738Zm-2.72.718A5.5 5.5 0 0 1 9 9.5H7a7.5 7.5 0 0 0 7.5 7.5v-2ZM9 9.5c0-1.079.31-2.082.845-2.93L8.153 5.5A7.47 7.47 0 0 0 7 9.5h2Zm-4 3.368C5 10.089 6.815 7.75 9.292 6.99L8.706 5.08C5.397 6.094 3 9.201 3 12.867h2Zm6.042 6.136C7.718 19.003 5 16.268 5 12.867H3c0 4.48 3.588 8.136 8.042 8.136v-2Zm5.725-4.17c-.81 2.433-3.074 4.17-5.725 4.17v2c3.552 0 6.553-2.327 7.622-5.537l-1.897-.632Z" class="fill-white"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M17 3a1 1 0 0 1 1 1 2 2 0 0 0 2 2 1 1 0 1 1 0 2 2 2 0 0 0-2 2 1 1 0 1 1-2 0 2 2 0 0 0-2-2 1 1 0 1 1 0-2 2 2 0 0 0 2-2 1 1 0 0 1 1-1Z" class="fill-white"></path>
                                        </svg>
                                    </span>
                                </button>
                                <!-- Settings Dropdown -->
                                <div class="ml-3 relative ">
                                    <BreezeDropdown align="right" width="48">
                                        <template #trigger>
                                            <span class="inline-flex rounded-md ">
                                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white dark:bg-gray-600 dark:text-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                    {{ $page.props.auth.user.name }}
    
                                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>
    
                                        <template #content>
                                            <BreezeDropdownLink :href="route('logout')" method="post" as="button">
                                                Log Out
                                            </BreezeDropdownLink>
                                        </template>
                                    </BreezeDropdown>
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
                            <BreezeResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                Dashboard
                            </BreezeResponsiveNavLink>
                        </div>
    
                        <!-- Responsive Settings Options -->
                        <div class="pt-4 pb-1 border-t border-gray-200">
                            <div class="px-4">
                                <div class="font-medium text-base text-gray-800">{{ $page.props.auth.user.name }}</div>
                                <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                            </div>
    
                            <div class="mt-3 space-y-1">
                                <BreezeResponsiveNavLink :href="route('logout')" method="post" as="button">
                                    Log Out
                                </BreezeResponsiveNavLink>
                            </div>
                        </div>
                    </div>
                </nav>
    
                <!-- Page Heading -->
                <header class="bg-white shadow" v-if="$slots.header">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <slot name="header" />
                    </div>
                </header>
    
                
                
                <!-- Page Content -->
                <main class="flex">
                    <!-- Page Sidebar -->
                    <Sidebar></Sidebar>
                    <!-- Pages -->
                    <slot />
                    
                </main>
            </div>
        </div>
    </template>
    
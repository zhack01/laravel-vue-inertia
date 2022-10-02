<script setup>
    import SideBarNavLink from '@/Components/SideBarNavLink.vue'
</script>


<template>
    <!-- This is an example component -->
    <div class="ml-0 h-screen ">
        <aside class="w-64 h-screen" aria-label="Sidebar">
            <div class="px-3 py-4 overflow-y-auto bg-white border-b h-screen border-gray-50 drop-shadow-[0_0_1px_rgba(0,0,0,0.10)]">
                <ul class="space-y-2">
                    <li>
                        <SideBarNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            <svg class="w-6 h-6"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                            </svg>
                            <span class="ml-3">Dashboard</span>
                        </SideBarNavLink>
                    </li>
                    <li>
                        <SideBarNavLink :href="route('games-index')" :active="route().current('games-index')">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            <span class="ml-3">Games</span>
                        </SideBarNavLink>
                    </li>
                </ul>
            </div>
        </aside>
        </div>
</template>
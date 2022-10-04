<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import CustomNavLink from '@/Components/CustomNavLink.vue';

defineProps({
    partners:Object
});
</script>
<script>
export default {
    data() {
        return {
            providers: {},
            selectedPartner: 'Select a Partner',
        }
    },
    watch: {
        selectedPartner : function(value){
            axios.post('/games/provider',{id:this.selectedPartner})
            .then(response => {
                console.log(response.data);
                this.providers = response.data;
            });
        }
    },
    mounted() {
        console.log('hi')  
    }
}
</script>
<template>
    <Head title="Games" />
    <BreezeAuthenticatedLayout>
        <div class="p-5 w-full">
            <div class="w-full lg:p-8 bg-white dark:bg-slate-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="hidden space-x-3 sm:-my-px sm:ml-10 sm:flex h-9 ml-1 z-10">
                    <CustomNavLink :href="route('games-index')" :active="route().current('games-index')">Game List</CustomNavLink>
                    <CustomNavLink :href="route('games-add')" :active="route().current('games-add')">Add </CustomNavLink>
                </div>
                <div class="w-full p-5 border rounded overflow-hidden dark:bg-slate-600 dark:border-gray-500 shadow-sm flex">
                    <div class="m-2 w-60">
                        <label for="partner" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100">Partners</label>
                        <select v-model="selectedPartner" id="partner" class="block p-2 mb-6 w-full text-sm text-black bg-gray-50 rounded-md border  focus:ring-blue-500 focus:border-blue-500 dark:bg-white  dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500 border-gray-300" >
                            <option selected value="">Select a Partner</option>
                            <option v-for="partner in partners" :value="partner.id">{{partner.name}}</option>
                        </select>
                    </div>
                    <div class="m-2 w-60">
                        <label for="provider" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Providers</label>
                        <select v-model="selectedProvider" id="provider" class="block p-2 mb-6 w-full text-sm text-black bg-gray-50 rounded-md border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-white  dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="">All</option>
                            <option v-for="provider in providers" :value="provider.id">{{provider.name}}</option>
                        </select>
                    </div>
                    <div class="m-2 w-28">
                        <label for="submit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">&nbsp;</label>
                        <button @click="submit()" class="bg-transparent hover:bg-gray-500 text-gray-700 font-semibold hover:text-white py-1 px-4 border bg-gray-300 hover:border-transparent rounded">View</button>
                    </div>
                </div>
                <div class="border h-auto mt-2">
                    <!-- <table class="table-fixed">
                        <thead>
                            <tr>
                                <th>GameID</th>
                                <th>Game Code</th>
                                <th>Game Name</th>
                                <th>Icon</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="game in games">
                                <td>{{game.game_id}}</td>
                                <td>{{game.game_code}}</td>
                                <td>{{game.game_name}}</td>
                                <td><img src="{{game.icon}}" alt=""></td>
                            </tr>
                        </tbody>
                    </table> -->
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>

</template>

<style scoped>
    .bg-gray-100 {
        background-color: #f7fafc;
        background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
    }

    .border-gray-200 {
        border-color: #edf2f7;
        border-color: rgba(237, 242, 247, var(--tw-border-opacity));
    }

    .text-gray-400 {
        color: #cbd5e0;
        color: rgba(203, 213, 224, var(--tw-text-opacity));
    }

    .text-gray-500 {
        color: #a0aec0;
        color: rgba(160, 174, 192, var(--tw-text-opacity));
    }

    .text-gray-600 {
        color: #718096;
        color: rgba(113, 128, 150, var(--tw-text-opacity));
    }

    .text-gray-700 {
        color: #4a5568;
        color: rgba(74, 85, 104, var(--tw-text-opacity));
    }

    .text-gray-900 {
        color: #1a202c;
        color: rgba(26, 32, 44, var(--tw-text-opacity));
    }

    @media (prefers-color-scheme: dark) {
        .dark\:bg-gray-800 {
            background-color: #2d3748;
            background-color: rgba(45, 55, 72, var(--tw-bg-opacity));
        }

        .dark\:bg-gray-900 {
            background-color: #1a202c;
            background-color: rgba(26, 32, 44, var(--tw-bg-opacity));
        }

        .dark\:border-gray-700 {
            border-color: #4a5568;
            border-color: rgba(74, 85, 104, var(--tw-border-opacity));
        }

        .dark\:text-white {
            color: #fff;
            color: rgba(255, 255, 255, var(--tw-text-opacity));
        }

        .dark\:text-gray-400 {
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--tw-text-opacity));
        }
    }
</style>

<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import CustomNavLink from '@/Components/CustomNavLink.vue';
import CustomPagination from '@/Components/CustomPagination.vue';
import CustomModal from '@/Components/CustomModal.vue';

defineProps({
    partners:Object
});
</script>
<script>
export default {
    data() {
        return {
            games: {},
            providers: {},
            selectedPartner: '',
            selectedProvider: '',
            showModal: false,
            perPage: 10,
            search: ''
        }
    },
    watch: {
        selectedPartner : function(value){
            axios.post('/games/provider',{id:this.selectedPartner})
            .then(response => {
                this.providers = response.data;
            });
        },
        perPage : function(value) {
            this.submit()
        },
        search: function(value){
            this.submit()
        }
    },
    mounted() {
        this.submit()
    },
    methods: {
        submit(url){
            if(this.selectedPartner){
                var page = 1
                var perPage = this.perPage
                var search = this.search
                if(search != ''){
                    search = `&search=${search}`
                }
                var url = url || `/games/list?page=${page}`;
                axios.get(url+`&per_page=${perPage}${search}&partner=${this.selectedPartner}&provider=${this.selectedProvider}`)
                .then(response => {
                    this.games = response.data;
                });
            }
        },
        getForPage(ev, link) {
            ev.preventDefault();
            if (!link.url || link.active) {
                return;
            }
            this.submit(link.url)
        },
        toggleModal(){
            this.showModal = !this.showModal;
        }
    },
    components: {
        
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
                        <select v-model="selectedPartner" id="partner" class="block p-2 mb-6 w-full text-sm text-black bg-gray-50 rounded-md border  focus:ring-blue-500 focus:border-blue-500 dark:focus:border-stake-500   dark:text-gray-100  border-gray-300 dark:bg-slate-500 dark:border-gray-400" >
                            <option selected value="">Select a Partner</option>
                            <option v-for="partner in partners" :value="partner.id">{{partner.name}}</option>
                        </select>
                    </div>
                    <div class="m-2 w-60">
                        <label for="provider" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100">Providers</label>
                        <select v-model="selectedProvider" id="provider" class="block p-2 mb-6 w-full text-sm text-black bg-gray-50 rounded-md border  focus:ring-blue-500 focus:border-blue-500 dark:focus:border-stake-500 dark:bg-slate-500  dark:text-gray-100  border-gray-300 dark:border-gray-400">
                            <option selected value="">All</option>
                            <option v-for="provider in providers" :value="provider.id">{{provider.name}}</option>
                        </select>
                    </div>
                    <div class="m-2 w-28">
                        <label for="submit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">&nbsp;</label>
                        <button @click="submit()" class="bg-transparent font-semibold hover:text-white py-1 px-4 border dark:text-gray-100 h-[38px] bg-blue-500 hover:bg-blue-700 dark:bg-blue-300 dark:hover:bg-blue-500 dark:border-gray-300 rounded text-gray-100">View</button>
                    </div>
                </div>
                
                <div class="border p-5 h-auto mt-2" v-if="games.total > 0">
                    <div class="flex justify-between">
                        <div class="p-4 flex">
                            <label class="text-sm text-gray-700 dark:text-gray-100 h-6 p-1 absolute">
                                <span class="py-2 relative top-0"> Show  </span>
                                <select v-model="perPage" class=" hl-[49px] hr-[49px] py-0.5 h-8 ml-1 text-gray-700  mr-1  " >
                                    <option value="10" selected>10</option>
                                    <option value="50">50</option>
                                    <option v-if="games.total > 0" :value="games.total">All</option>
                                </select> 
                                <span class="py-2 relative top-0"> Entries </span>
                            </label>
                        </div>
                        <div class="p-4">
                            <label for="table-search" class="sr-only">Search</label>
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input v-model="search" type="text" id="table-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5   " placeholder="Search for items">
                            </div>
                        </div>
                    </div>
                    <table class="min-w-max w-full table-auto" >
                        <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">GameID</th>
                            <th class="py-3 px-6 text-left">Game Code</th>
                            <th class="py-3 px-6 text-left">Game Name</th>
                            <th class="py-3 px-6 text-left">ICON</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-600 dark:text-gray-100 text-sm font-light">
                            <tr v-for="game in games.data" class="border-b border-gray-200 hover:bg-gray-100 dark:hover:text-gray-700">
                                <td class="py-3 px-6 text-left whitespace-nowrap" @click="toggleModal()">{{game.game_id}}</td>
                                <td class="py-3 px-6 text-left whitespace-nowrap">{{game.game_code}}</td>
                                <td class="py-3 px-6 text-left whitespace-nowrap">{{game.game_name}}</td>
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center text-sm">
                                        <div class="relative w-16 h-8 mr-3 md:block">
                                            <img class="object-cover w-full h-full" :src="game.icon" onerror="this.onerror=null; this.src='/logo.png'"  />
                                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table> 
                    <CustomPagination :data="games" :getForPage="getForPage"></CustomPagination>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
    <CustomModal :showModal="showModal" :toggleModal="toggleModal" :gameUpdate="gameUpdate">
        
    </CustomModal>
</template>
<style scoped>
    
</style>
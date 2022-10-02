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
            games: {},
            providers: {},
            selectedPartner: '',
            selectedProvider: '',
        }
    },
    watch: {
        selectedPartner : function(value){
            axios.post('/games/provider',{id:this.selectedPartner})
            .then(response => {
                this.providers = response.data;
            });
        }
    },
    mounted() {
        this.submit()
    },
    methods: {
        submit(url){
            if(this.selectedPartner){
                var page = 1
                var url = url || `/games/list?page=${page}`;
                console.log(url+`&partner=${this.selectedPartner}&provider=${this.selectedProvider}`)
                axios.get(url+`&partner=${this.selectedPartner}&provider=${this.selectedProvider}`)
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
        }
    },
    components: {
        'vuetailwind':vuetailwind
    }
}
</script>
<template>
    <Head title="Games" />
    <BreezeAuthenticatedLayout>
        <div class="w-full p-3 mt-1 ml-[0.30rem] border rounded overflow-hidden shadow-lg">
            <div class="hidden space-x-3 sm:-my-px sm:ml-10 sm:flex h-9 ml-1 z-10">
                <CustomNavLink :href="route('games-index')" :active="route().current('games-index')">Game List</CustomNavLink>
                <CustomNavLink :href="route('games-add')" :active="route().current('games-add')">Add </CustomNavLink>
            </div>
            <div class="w-full border rounded overflow-hidden shadow-sm flex">
                <div class="m-2 w-60">
                    <label for="partner" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Partners</label>
                    <select v-model="selectedPartner" id="partner" class="block p-2 mb-6 w-full text-sm text-black bg-gray-50 rounded-md border  focus:ring-blue-500 focus:border-blue-500 dark:bg-white  dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500 border-gray-300" >
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
            <div class="border h-auto mt-2" v-if="games.total > 0">
                <table class="w-full" >
                    <thead>
                    <tr class="text-md font-semibold w-auto tracking-wide text-left text-gray-900 bg-gray-100 border-b border-gray-600">
                        <th class="px-4 py-3">GameID</th>
                        <th class="px-4 py-3">Game Code</th>
                        <th class="px-4 py-3">Game Name</th>
                        <th class="px-4 py-3">ICON</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white">
                        <tr v-for="game in games.data" class="text-gray-700">
                            <td class="px-4 py-3 text-ms font-semibold border">{{game.game_id}}</td>
                            <td class="px-4 py-3 text-ms font-semibold border">{{game.game_code}}</td>
                            <td class="px-4 py-3 text-ms font-semibold border">{{game.game_name}}</td>
                            <td class="px-4 py-3 text-ms font-semibold border">
                                <div class="flex items-center text-sm">
                                    <div class="relative w-16 h-8 mr-3 md:block">
                                        <img class="object-cover w-full h-full" :src="game.icon" alt="" loading="lazy" />
                                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table> 
                <div class="flex justify-center mt-5">
                    <nav class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px" aria-label="Pagination" > 
                        <a
                            v-for="(link, i) of games.links"
                            :key="i"
                            :disabled="!link.url"
                            @click="getForPage($event, link)"
                            href="#"
                            aria-current="page"
                            class="relative inline-flex items-center px-4 py-2 border text-sm font-medium whitespace-nowrap"
                            :class="[
                                link.active
                                    ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
                                    : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
                                    i === 0 ? 'rounded-l-md bg-gray-100 text-gray-700' : '',
                                    i === games.links.length - 1 ? 'rounded-r-md' : '',
                            ]"
                            v-html="link.label"
                        >
                        </a>
                    </nav>
                </div>
                <div class="flex justify-center mt-3">
                    <span class="text-sm text-gray  ">
                        Showing <span class="font-semibold text-gray ">{{games.from}}</span> to <span class="font-semibold text-gray ">{{games.to}}</span> of <span class="font-semibold text-gray ">{{games.total}}</span> Entries
                    </span>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

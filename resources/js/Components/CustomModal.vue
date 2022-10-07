<script setup>
import { compileScript } from '@vue/compiler-sfc';

const props = defineProps({
        showModal:Boolean,
        toggleModal:onclick,
        modalData:Object,
        gameID:Number,
    });
</script>
<script>
    export default {
        data() {
            return {
                gameTypes:{},
                image:'',
                game:{}
            }
        },
        watch: {
          
        },
        mounted() {
            this.gameType()
            this.gameDetails()
        },
        methods: {
            gameType(){
                var url = `/games/game-type`;
                axios.get(url).then(response => {
                    this.gameTypes = response.data;
                }); 
            },
            gameDetails(){
                axios.get('/games/game'+`?id=${this.gameID}`)
                .then(response => {
                    this.image = response.data.icon
                    this.game = response.data
                });
            },
            imgPreview(value){
                const file = value.target.files[0]
                this.image = URL.createObjectURL(file)
            },
            updateGame(){
                axios.post('/games/update',{
                    game_id:this.game.game_id,
                    game_name:this.game.game_name,
                    game_type_id:this.game.game_type_id,
                    game_code:this.game.game_code,
                    secondary_game_code:this.game.secondary_game_code,
                    provider_id:this.game.provider_id,
                    sub_provider_id:this.game.sub_provider_id,
                    min_bet:this.game.min_bet,
                    max_bet:this.game.max_bet,
                    pay_lines:this.game.pay_lines,
                    rtp:this.game.rtp,
                    info:this.game.info,
                    remarks:this.game.remarks,
                    on_maintenance:this.game.on_maintenance,
                }).then(response => {
                   
                }); 
                this.props.toggleModal()
            }
        },
        components: {
            
        }
    }
</script>
<template>
    <div v-if="showModal"  class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
        <div class="relative w-auto my-6 mx-auto max-w-xl">
            <!--content-->
            <div class="rounded-md shadow-lg relative flex flex-col w-[500px] bg-white dark:bg-[#1e1e1e] dark:text-gray-100 outline-none focus:outline-none border dark:border-[#464646] ">
                <!--header-->
                <div class="flex items-start justify-between p-5 border-b border-solid border-gray-100 rounded-t dark:border-[#464646]">
                    <h3 class="text-md font-semibold">
                    Game Details
                    </h3>
                    <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" @click="toggleModal()">
                    <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                        ×
                    </span>
                    </button>
                </div>
                <!--body-->
                <div class="relative p-6 flex-auto">
                    <div class="mb-6 text-center">
                        <div class="mb-6 text-center flex justify-center">
                            <label  style="cursor:pointer;font-size:30px;">
                                <img v-if="image" :src="image"  alt="" class=' max-w-[300px]'>
                                <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-28 h-28">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                                <input type="file" v-on:change="imgPreview" class="hidden">
                            </label>
                        </div>
                        <label for="" style="margin: 0 auto;font-size: 12px;">Image</label>
                    </div>
                    <div class="flex justify-between">
                        <div class="py-4 w-11/12 mr-2">
                            <label for="game-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Game Name</label>
                            <input v-model="game.game_name" type="text" id="game-name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  w-full p-2.5 dark:bg-[#464646] dark:border-[#464646] dark:text-gray-50 dark:placeholder-gray-50 dark:focus:ring-[#1e1e1e] dark:focus:border-[#1e1e1e] dark:shadow-sm-light" required>
                        </div>
                        <div class="py-4 w-11/12 ml-2">
                            <label for="game_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Game Type</label>
                            <select v-model="game.game_type_id" id="game_type" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  w-full p-2.5 dark:bg-[#464646] dark:border-[#464646] dark:text-gray-50 dark:placeholder-gray-50 dark:focus:ring-[#1e1e1e] dark:focus:border-[#1e1e1e] dark:shadow-sm-light" >
                                <option v-for="gametype in gameTypes" :value="gametype.id" >{{gametype.name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="py-4 w-11/12 mr-2">
                            <label for="game-code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Game Code</label>
                            <input v-model="game.game_code" type="text" id="game-code" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  w-full p-2.5 dark:bg-[#464646] dark:border-[#464646] dark:text-gray-50 dark:placeholder-gray-50 dark:focus:ring-[#1e1e1e] dark:focus:border-[#1e1e1e] dark:shadow-sm-light" required>
                        </div>
                        <div class="py-4 w-11/12 ml-2">
                            <label for="secondary_game_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Secondary Game Code</label>
                            <input v-model="game.secondary_game_code" type="text" id="secondary_game_code"  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  w-full p-2.5 dark:bg-[#464646] dark:border-[#464646] dark:text-gray-50 dark:placeholder-gray-50 dark:focus:ring-[#1e1e1e] dark:focus:border-[#1e1e1e] dark:shadow-sm-light placeholder:opacity-40" placeholder="Secondary Game Code" >
                        </div>
                    </div>
                    <div class="flex">
                        <div class="py-4 w-11/12 mr-2">
                            <label for="partner" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Partner</label>
                            <select v-model="game.provider_id" id="partner" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  w-full p-2.5 dark:bg-[#464646] dark:border-[#464646] dark:text-gray-50 dark:placeholder-gray-50 dark:focus:ring-[#1e1e1e] dark:focus:border-[#1e1e1e] dark:shadow-sm-light" >
                                <option v-for="partner in modalData.partners" :value="partner.id" >{{partner.name}}</option>
                            </select>
                        </div>
                        <div class="py-4 w-11/12 ml-2">
                            <label for="provider" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Provider</label>
                            <select v-model="game.sub_provider_id" id="provider" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  w-full p-2.5 dark:bg-[#464646] dark:border-[#464646] dark:text-gray-50 dark:placeholder-gray-50 dark:focus:ring-[#1e1e1e] dark:focus:border-[#1e1e1e] dark:shadow-sm-light" >
                                <option v-for="provider in modalData.providers" :value="provider.id" >{{provider.name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex ">
                        <div class="py-4">
                            <label for="min-bet" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Min.Bet</label>
                            <input v-model="game.min_bet" type="text" id="min-bet" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-11/12 p-2.5 dark:bg-[#464646] dark:border-[#464646] dark:text-gray-50 dark:placeholder-gray-50 dark:focus:ring-[#1e1e1e] dark:focus:border-[#1e1e1e] dark:shadow-sm-light" >
                        </div>
                        <div class="py-4">
                            <label for="max-bet" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Max.Bet</label>
                            <input v-model="game.max_bet" type="text" id="max-bet" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-11/12 p-2.5 dark:bg-[#464646] dark:border-[#464646] dark:text-gray-50 dark:placeholder-gray-50 dark:focus:ring-[#1e1e1e] dark:focus:border-[#1e1e1e] dark:shadow-sm-light" >
                        </div>
                        <div class="py-4">
                            <label for="paylines" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">PayLines</label>
                            <input v-model="game.pay_lines" type="text" id="paylines" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-11/12 p-2.5 dark:bg-[#464646] dark:border-[#464646] dark:text-gray-50 dark:placeholder-gray-50 dark:focus:ring-[#1e1e1e] dark:focus:border-[#1e1e1e] dark:shadow-sm-light" >
                        </div>
                        <div class="py-4">
                            <label for="rtp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">RTP</label>
                            <input v-model="game.rtp" type="text" id="rtp" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-11/12 p-2.5 dark:bg-[#464646] dark:border-[#464646] dark:text-gray-50 dark:placeholdenpmr-gray-50 dark:focus:ring-[#1e1e1e] dark:focus:border-[#1e1e1e] dark:shadow-sm-light" >
                        </div>
                    </div>
                    <div class="flex">
                        <div class="py-4 w-11/12 mr-2">
                            <label for="Info" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Info</label>
                            <textarea v-model="game.info" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-11/12 p-2.5 dark:bg-[#464646] dark:border-[#464646] dark:text-gray-50 dark:placeholdenpmr-gray-50 dark:focus:ring-[#1e1e1e] dark:focus:border-[#1e1e1e] dark:shadow-sm-light" placeholder="Info."></textarea>
                        </div>
                        <div class="py-4 w-11/12 ml-2">
                            <label for="Remarks" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remarks</label>
                            <textarea v-model="game.remarks" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-11/12 p-2.5 dark:bg-[#464646] dark:border-[#464646] dark:text-gray-50 dark:placeholdenpmr-gray-50 dark:focus:ring-[#1e1e1e] dark:focus:border-[#1e1e1e] dark:shadow-sm-light" placeholder="Remarks."></textarea>
                        </div>
                    </div>
                </div>
                <!--footer-->
                <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b dark:border-[#464646]">
                    <button class="text-red-500 bg-transparent border border-solid border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-semibold uppercase text-sm px-[23px] py-[6px] rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150 h-[32px]" type="button" @click="toggleModal()">
                    Close
                    </button>
                    <button @click="updateGame()" class="text-red-500 background-transparent font-semibold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" >
                    Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div v-if="showModal" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
</template>

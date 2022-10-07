<script setup>
const props = defineProps({
        data:Object,
    });
    
</script>
<script>
    export default {
        data() {
            return {
                status:false
            }
        },
        watch: {
          
        },
        mounted() {
            
        },
        methods: {
            updateStatus(id,value){
                console.log(value)
                var value = value == 1 ? 0 : 1
                axios.post('/games/status',{id:id,value:value})
                .then(response => {
                    console.log(response.data)
                });
            }
        },
        components: {
            
        }
    }
</script>
<template>
<label  class="inline-flex relative items-center cursor-pointer" >
    <input v-if="data.on_maintenance == 1" type="checkbox" checked value="" class="sr-only peer" @click="updateStatus(data.game_id,data.on_maintenance)">
    <input v-else type="checkbox" value="" class="sr-only peer" @click="updateStatus(data.game_id,data.on_maintenance)">
    <div class="w-9 h-5 bg-red-600 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-200 rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all  peer-checked:bg-green-500 dark:peer-focus:border-[#464646]" ></div>
</label>
</template>
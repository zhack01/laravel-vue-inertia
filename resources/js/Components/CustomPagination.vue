<script setup>
    defineProps({
        data:Object,
        getForPage:onclick
    });
</script>
<template>
    <div class="flex justify-center mt-5">
        <nav class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px" aria-label="Pagination" > 
            <a
                v-for="(link, i) of data.links"
                :key="i"
                :disabled="!link.url"
                @click="getForPage($event, link)"
                href="#"
                aria-current="page"
                class="custom-page-item relative inline-flex items-center px-4 py-2 border text-sm font-medium whitespace-nowrap"
                :class="[
                    link.active
                        ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
                        : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
                        i === 0 ? 'rounded-l-md bg-gray-100 text-gray-700' : '',
                        i === data.links.length - 1 ? 'rounded-r-md' : '',
                ]"
                v-html="link.label"
            >
            </a>
        </nav>
    </div>
    <div class="flex justify-center mt-3">
        <span class="text-sm text-gray-700 dark:text-gray-100  ">
            Showing <span class="font-semibold text-gray ">{{data.from}}</span> to <span class="font-semibold text-gray ">{{data.to}}</span> of <span class="font-semibold text-gray ">{{data.total}}</span> Entries
        </span>
    </div>
</template>
<style scoped>
</style>
<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() => props.active
    ? 'flex items-center p-2 text-sm font-medium text-gray-600 dark:bg-[#464646] rounded-lg dark:text-white bg-gray-100  hover:text-gray-50 hover:bg-gray-400 dark:hover:bg-[#545454] dark:hover:text-gray-100'
    : 'flex items-center p-2 text-sm font-medium text-gray-600 dark:bg-[#2c2c2c] rounded-lg dark:text-white hover:text-gray-50 hover:bg-gray-400 dark:hover:bg-[#545454] dark:hover:text-gray-100'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>

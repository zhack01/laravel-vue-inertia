<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() => props.active
    ? 'inline-block border-l border-t border-r bo border-gray-300 rounded-t py-2 px-4 text-black dark:border-[#2c2c2c] dark:bg-[#2c2c2c] dark:text-gray-100 font-semibold'
    : 'inline-block border-l border-t border-r py-2 px-4 mb-[1px] rounded-t text-black font-semibold dark:text-gray-100 dark:border-[#1d1d1d] dark:bg-[#121212] '
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>

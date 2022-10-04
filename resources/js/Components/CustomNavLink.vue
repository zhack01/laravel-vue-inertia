<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() => props.active
    ? 'inline-block border-l border-t border-r bo border-gray-300 rounded-t py-2 px-4 text-black dark:border-gray-500 dark:bg-slate-600 dark:text-gray-100 font-semibold'
    : 'inline-block border-l border-t border-r py-2 px-4 rounded-t text-black font-semibold dark:text-gray-100 dark:border-gray-400'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>

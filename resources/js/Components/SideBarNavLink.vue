<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() => props.active
    ? 'flex items-center p-2 text-sm font-medium text-gray-900 rounded-lg dark:text-black bg-gray-100 hover:bg-gray-100 dark:hover:bg-gray-100'
    : 'flex items-center p-2 text-sm font-medium text-gray-900 rounded-lg dark:text-black hover:bg-gray-100 dark:hover:bg-gray-100'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>

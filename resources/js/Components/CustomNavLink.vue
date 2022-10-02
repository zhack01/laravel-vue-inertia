<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() => props.active
    ? 'inline-block border-l border-t border-r bo border-emerald-300 rounded-t py-2 px-4 text-black font-semibold'
    : 'inline-block border-l py-2 px-4 text-black font-semibold'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>

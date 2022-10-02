<script setup>
    defineProps({
        data:Object
    });
</script>
<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>

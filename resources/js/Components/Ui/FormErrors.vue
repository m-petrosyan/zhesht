<script setup>
defineProps({
    errors: Array
});
</script>

<template>
    <p v-if="errors" class="text-red-700">
        <span v-for="(e,i) in errors" :key="i">{{ e }}</span>
    </p>
</template>

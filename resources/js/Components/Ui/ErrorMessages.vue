<script setup>
const props = defineProps({
    messages: Object,
    simple: false
});
</script>

<template>
    <div v-if="Object.keys(messages).length" class="pt-6">
        <div v-if="!simple"
             class="bg-red text-white p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 bg-red text-white text-wrap"
             role="alert">
            <ul v-for="error in messages " :key="error">
                <li>{{ error }}</li>
            </ul>
        </div>
        <p v-else v-for="error in messages" :key="error" class="text-red-600">{{ error }}</p>
    </div>
</template>

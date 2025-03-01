<script setup>
import {computed, ref} from 'vue';

const selectedDate = ref('');
const selectedTime = ref('');

const timeOptions = computed(() => {
    const times = [];
    for (let h = 0; h < 24; h++) {
        times.push(`${String(h).padStart(2, '0')}:00`);
        times.push(`${String(h).padStart(2, '0')}:30`);
    }
    return times;
});
</script>

<template>
    <div class="flex gap-2">
        <input type="date" v-model="selectedDate" class="border rounded-md p-2">
        <select v-model="selectedTime" class="border rounded-md p-2">
            <option v-for="time in timeOptions" :key="time" :value="time">
                {{ time }}
            </option>
        </select>
    </div>
</template>

<style scoped lang="scss">

</style>

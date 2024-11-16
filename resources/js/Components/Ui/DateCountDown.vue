<script setup>
import {onMounted, ref} from 'vue';

const props = defineProps({
    targetDate: {type: String, required: true}
});

const targetDate = ref(null);
const days = ref(0);
const hours = ref(0);
const minutes = ref(0);
const seconds = ref(0);

onMounted(() => {
    targetDate.value = new Date(props.targetDate);
    updateCountdown();
    setInterval(updateCountdown, 1000);
});

const updateCountdown = () => {
    const now = new Date();
    const timeRemaining = targetDate.value - now;

    if (timeRemaining > 0) {
        const totalDays = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
        const remainingDays = totalDays % 365;
        const finalDays = remainingDays % 30;

        const totalHours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const totalMinutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
        const totalSeconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

        days.value = finalDays;
        hours.value = totalHours;
        minutes.value = totalMinutes;
        seconds.value = totalSeconds;
    } else {
        days.value = 0;
        hours.value = 0;
        minutes.value = 0;
        seconds.value = 0;
    }
};
</script>

<template>
    <section class="mt-18">
        <div>
            <span class="label"> {{ days }} d </span>
            <span class="label"> {{ hours }} h </span>
            <span class="label"> {{ minutes }} m </span>
            <span class="label"> {{ seconds }} s </span>
        </div>
    </section>
</template>

<style scoped lang="scss">

</style>

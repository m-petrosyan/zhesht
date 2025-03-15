<script setup>import GuestLayout from "@/Layouts/GuestLayout.vue";
import {formatDateTime} from "@/Helpers/dateFormatHelper.js";
import {Link} from "@inertiajs/vue3";
import {nextTick, onMounted, onUnmounted, ref} from "vue";

defineProps({
    pastTours: {required: true},
});

const activeSection = ref(null);
const sectionRefs = ref({});

const setRefs = (el, year) => {
    if (el) {
        sectionRefs.value[year] = el; // Храним элементы по ключу года
    }
};

let observer = null;

onMounted(async () => {
    await nextTick();

    observer = new IntersectionObserver(
        (entries) => {
            let activeYear = null;

            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const foundYear = Object.keys(sectionRefs.value).find(year => sectionRefs.value[year] === entry.target);
                    if (foundYear) {
                        activeYear = Number(foundYear); // Преобразуем в число
                    }
                }
            });

            if (activeYear !== null) {
                activeSection.value = activeYear;
                console.log("Active Section:", activeSection.value);
            }
        },
        {threshold: 0.5}
    );

    Object.values(sectionRefs.value).forEach(section => {
        if (section) observer.observe(section);
    });
});

onUnmounted(() => {
    if (observer) observer.disconnect();
});
</script>

<template>
    <GuestLayout>
        <section class="bg-main flex flex-col gap-y-10 pt-20 pb-20">
            <div class="sticky w-[25px] h-[3px] bg-orange top-80 left-0"/>

            <div v-for="(data, year) in pastTours"
                 :key="year"
                 class="timebar flex gap-x-5 gap-y-10"
                 :ref="el => setRefs(el, year)">

                <div class="content-center text-white text-sm">
                    <p :class="[
                        'inline-block rotate-90 pl-6 top-20 transition-all duration-300',
                        activeSection === Number(year) ? 'text-orange font-semibold text-2xl' : ''
                    ]">
                        {{ year }}
                    </p>
                </div>

                <div class="w-11/12 flex flex-wrap gap-y-5 gap-x-5">
                    <div v-for="event in data" :key="event.id" class="w-1/6 relative">
                        <img :src="event.tour.poster?.thumb ?? event.tour.banner.thumb"
                             :alt="event.tour.title"
                             class="h-96">
                        <div class="info flex flex-col justify-end h-4/6 absolute bottom-0 w-full">
                            <div class="text-white text-center pb-10">
                                <Link :href="route('event.show', event.tour.id)">
                                    <h3 class="text-3xl">{{ event.tour.title }}</h3>
                                    <div class="mt-5">
                                        <b class="text-2xl">
                                            {{ formatDateTime(event.date_time, 'D MMMM YYYY ') }}
                                        </b>
                                        <p class="text-2xl">{{ event.location }}</p>
                                    </div>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </GuestLayout>
</template>

<style scoped>
.timebar {
    background-image: url("./images/timebar.svg");
    background-repeat: repeat-y;
}
</style>

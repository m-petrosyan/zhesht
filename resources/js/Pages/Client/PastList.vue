<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import {formatDateTime} from "@/Helpers/dateFormatHelper.js";
import {Link} from "@inertiajs/vue3";

defineProps({
    pastTours: {required: true},
})

</script>

<template>
    <GuestLayout>
        <section class="bg-main flex flex-col gap-y-10  pt-20 pb-20">
            <div v-for="(data,year) in pastTours" :key="year" class="flex gap-x-10 gap-y-10">
                <div class="bg-black text-white  content-center">
                    <p class="inline-block rotate-90">{{ year }}</p>
                </div>
                <div class="w-11/12 flex flex-wrap gap-y-5 gap-x-5">
                    <div v-for="tour in data" :key="tour.title" class="w-1/6 relative">
                        <img :src="tour.poster_file?.thumb ?? tour.banner_file.thumb" :alt="tour.title"
                             class="h-96">
                        <div class="info flex flex-col justify-end h-4/6 absolute bottom-0 w-full">
                            <div class="text-white text-center pb-10">
                                <Link :href="route('event.show',tour.id)"
                                      class="">
                                    <h3 class="text-3xl">{{ tour.title }}</h3>
                                    <div v-for="event in tour.events" class="mt-5">
                                        <b class="text-2xl">{{ formatDateTime(event.date_time, 'D MMMM YYYY ') }}</b>
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

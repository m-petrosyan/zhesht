<script setup>
import {Splide, SplideSlide} from "@splidejs/vue-splide";
import "@splidejs/splide/dist/css/splide.min.css";
import {AutoScroll} from "@splidejs/splide-extension-auto-scroll";
import {formatDateTime} from "@/Helpers/dateFormatHelper.js";
import {Link} from "@inertiajs/vue3";

defineProps({
    pastEvents: {required: true}
})

const splideOptions = {
    type: 'loop',
    perPage: 6,
    lazyLoad: true,
    arrows: false,
    pagination: false,
    autoScroll: {
        speed: 1,
        pauseOnHover: true,
        pauseOnFocus: false,
    },
}
</script>

<template>
    <div class="flex bg-main justify-end">
        <Link :href="route('past')">
            <h2 class="text-2xl font-black pr-2">Past events</h2>
        </Link>
    </div>
    <Splide :options="splideOptions" :extensions="{ AutoScroll }" aria-label="Past events">
        <SplideSlide v-for="event in pastEvents" :key="event.id">
            <Link class="relative" :href="route('event.show',event.id)">
                <img :src="event.poster?.thumb ?? event.tour.banner.thumb" :alt="event.tour.title"
                     class="h-96 w-full ">
                <div class="absolute top-0 z-1 h-full w-full bg-[rgba(33,33,33,.2)]"></div>
                <div class="flex flex-col z-2 justify-end h-4/6 absolute bottom-0 w-full">
                    <div class="text-white text-center pb-10">
                        <h3 class="text-3xl">{{ event.tour.title }}</h3>
                        <div class="mt-5">
                            <b class="text-2xl">{{ formatDateTime(event.date_time, 'D MMMM YYYY ') }}</b>
                            <p class="text-2xl">{{ event.location }}</p>
                        </div>
                    </div>
                </div>
            </Link>
        </SplideSlide>
    </Splide>
</template>

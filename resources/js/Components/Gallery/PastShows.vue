<script setup>
import {Splide, SplideSlide} from "@splidejs/vue-splide";
import "@splidejs/splide/dist/css/splide.min.css";
import {AutoScroll} from "@splidejs/splide-extension-auto-scroll";
import {formatDateTime} from "@/Helpers/dateFormatHelper.js";
import {Link} from "@inertiajs/vue3";
import NavLink from "@/Components/NavLink.vue";


defineProps({
    pastTours: {required: true}
})


const splideOptions = {
    type: 'loop',

    perPage: 6,
    // perMove: 1,

    lazyLoad: true,
    arrows: false,
    pagination: false,
    autoScroll: {
        speed: 1,
        pauseOnHover: true,
        pauseOnFocus: false,
    },
    breakpoints: {
        768: {
            // padding: '4rem'
        },
    },
}
</script>

<template>
    <div class="flex bg-main justify-end">
        <NavLink :href="route('past')">
            <h2 class="text-2xl text-black pr-2">Past events</h2>
        </NavLink>
    </div>
    <Splide :options="splideOptions" :extensions="{ AutoScroll }" aria-label="Past events">
        <SplideSlide v-for="item in pastTours" :key="item.id">
            <img :src="item.poster_file?.thumb ?? item.banner_file.thumb" :alt="item.title"
                 class="h-96 w-full">
            <div class="info flex flex-col justify-end h-4/6 absolute bottom-0 w-full">
                <div class="text-white text-center pb-10">
                    <Link :href="route('event.show',item.id)"
                          class="">
                        <h3 class="text-3xl">{{ item.title }}</h3>
                        <div v-for="event in item.events" class="mt-5">
                            <b class="text-2xl">{{ formatDateTime(event.date_time, 'D MMMM YYYY ') }}</b>
                            <p class="text-2xl">{{ event.location }}</p>
                        </div>
                    </Link>
                </div>
            </div>
        </SplideSlide>
    </Splide>
</template>

<script setup>
import {Link} from "@inertiajs/vue3";
import {formatDateTime} from "@/Helpers/dateFormatHelper.js";

defineProps({
    sliderTours: {required: true}
})

const splideOptions = {
    rewind: true,
    autoplay: true,
    interval: 500000,
    lazyLoad: true,
    fixedHeight: '100vh',
    cover: true,
    breakpoints: {
        768: {
            // padding: '4rem'
        },
    },
}
</script>

<template>
    <Splide :options="splideOptions" aria-label="Gallery" class="bg-black">
        <SplideSlide v-for="item in sliderTours" :key="item.id">
            <img
                :src="item.banner_file.large"
                :alt="item.title">
            <div class="info flex flex-col justify-end h-4/6 absolute bottom-0 w-full">
                <div class="text-white text-center pb-10">
                    <Link :href="route('event.show',item.id)"
                          class="">
                        <h3 class="text-6xl">{{ item.title }}</h3>
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

<style lang="scss">
.splide {
    padding: 0;

    .info {
        background: rgb(0, 0, 0);
        background: -moz-linear-gradient(0deg, rgba(0, 0, 0, 0.9023984593837535) 0%, rgba(142, 116, 23, 0.8071603641456583) 35%, rgba(253, 208, 46, 0.5466561624649859) 58%, rgba(253, 208, 46, 0) 100%);
        background: -webkit-linear-gradient(0deg, rgba(0, 0, 0, 0.9023984593837535) 0%, rgba(142, 116, 23, 0.8071603641456583) 35%, rgba(253, 208, 46, 0.5466561624649859) 58%, rgba(253, 208, 46, 0) 100%);
        background: linear-gradient(0deg, rgba(0, 0, 0, 0.9023984593837535) 0%, rgba(142, 116, 23, 0.8071603641456583) 35%, rgba(253, 208, 46, 0.5466561624649859) 58%, rgba(253, 208, 46, 0) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#000000", endColorstr="#fdd02e", GradientType=1);
    }

    .splide__arrow, .splide__arrow:hover {
        svg {
            fill: theme('colors.main');
        }
    }

    .splide__pagination__page {
        &:hover, &.is-active {
            background: theme('colors.main');
        }
    }

}
</style>

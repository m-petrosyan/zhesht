<script setup>
defineProps({
    events: {required: true}
})

const splideOptions = {
    rewind: true,
    autoplay: true,
    interval: 5000,
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
    <Splide :options="splideOptions" aria-label="Gallery">
        <SplideSlide v-for="item in events" :key="item.id">
            <img
                :src="item.poster.large"
                :alt="item.title">
            <div class="info flex flex-col justify-center h-3/6 absolute bottom-0 w-full">
                <div class="text-white text-center">
                    <h3 class="text-6xl">{{ item.title }}</h3>
                    <p>{{ item.location }}</p>
                    <!--                    <button class="text-white border border-white mt-4 py-2 px-5 rounded-3xl text-lg">Tickets</button>-->
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

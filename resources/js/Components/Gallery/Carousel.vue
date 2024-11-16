<script setup>
const splideOptions = {
    rewind: true,
    autoplay: true,
    interval: 3000,
    lazyLoad: true,
    fixedHeight: '100vh',
    cover: true
}
</script>

<template>
    <Splide :options="splideOptions" aria-label="Gallery">
        <SplideSlide>
            <img
                src="https://optim.tildacdn.net/tild3962-3133-4738-b262-353261306262/-/format/webp/King-Gizzard--the-Li.jpg"
                alt="Sample 1">
            <div class="info h-1/3 absolute bottom-0 w-full">
                <div class="mt-20  text-white text-center">
                    <h3 class="text-6xl">King Gizzard & the Lizard Wizard</h3>
                    <p>8, 9, 10 June 2025 — Plovdiv, Bulgaria</p>
                    <button>Tickers</button>
                </div>
            </div>
        </SplideSlide>
        <SplideSlide>
            <img
                src="https://optim.tildacdn.net/tild3431-6462-4533-a337-333361383137/-/format/webp/BG.jpg"
                alt="Sample 1">
            <div class="info h-1/3 absolute bottom-0 w-full">
                <div class="mt-10 text-white text-center">
                    <h3 class="text-6xl">King Gizzard & the Lizard Wizard</h3>
                    <p>8, 9, 10 June 2025 — Plovdiv, Bulgaria</p>
                    <button>Tickers</button>
                </div>
            </div>
        </SplideSlide>
        <!--        <SplideSlide>-->
        <!--            <img-->
        <!--                src="https://optim.tildacdn.net/tild3962-3133-4738-b262-353261306262/-/format/webp/King-Gizzard&#45;&#45;the-Li.jpg"-->
        <!--                alt="Sample 2">-->
        <!--        </SplideSlide>-->
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

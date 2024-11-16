<script setup>
import Carousel from "@/Components/Gallery/Carousel.vue";
import DateCountDown from "@/Components/Ui/DateCountDown.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";

defineOptions({layout: GuestLayout})
</script>

<template>
    <GuestLayout>
        <Carousel/>
        <div class="bg-main pt-20 pb-20">
            <div class="flex flex-col gap-y-20 lg:w-3/5 md:w-full mx-auto">
                <div class="border-b-4 border-black pb-20">
                    <h2 class="text-3xl">
                        Honeycomb Live — concert agency operating worldwide. Here you can find our music events and
                        tours
                        and buy tickets to our concerts.
                    </h2>
                </div>
                <div class="flex gap-x-10 w-full">
                    <div class="w-1/5">
                        <div style="background-image: url('/images/BG.jpg')"
                             class="event-image relative w-52 h-52 bg-cover bg-no-repeat bg-center z-10"/>
                    </div>
                    <div class="w-1/5">
                        <h2 class="text-3xl font-bold mt-14">Boris Grebenshikov</h2>
                    </div>
                    <div class="w-3/5 flex flex-col gap-y-5">
                        <div class="text-lg">
                            <p><b>8 December - London, UK</b> @ Lafayette</p>
                            <p><b>8 December - London, UK</b> @ Lafayette</p>
                            <p><b>8 December - London, UK</b> @ Lafayette</p>
                            <p><b>8 December - London, UK</b> @ Lafayette</p>
                        </div>
                        <p>
                            The legendary Russian musician Boris Grebenshikov (BG+) is going on tour this December with
                            his
                            new program, Square Root Sun, along with the best Aquarium songs of all time. Don’t miss
                            your
                            chance to experience his iconic blend of rock, folk, and poetry live in the UK and Ireland.
                        </p>
                        <div class="flex items-center gap-x-10">
                            <button class="bg-black text-white py-2 px-5 rounded-3xl text-lg">Tickets</button>
                            <DateCountDown targetDate="2024-12-01T00:00:00"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="past bg-past pt-20 pb-20">
            <div class="flex flex-col gap-y-20 w-3/5 mx-auto">
                <div class="border-b-2 border-black pb-4">
                    <h3 class="font-bold text-lg">Past shows</h3>
                </div>
                <div class="flex gap-x-10 w-full opacity-50">
                    <div class="w-1/5">
                        <div
                            style="background-image: url('https://optim.tildacdn.net/tild3962-3133-4738-b262-353261306262/-/format/webp/King-Gizzard--the-Li.jpg')"
                            class="event-image relative w-52 h-52 bg-cover bg-no-repeat bg-center z-10"/>
                    </div>
                    <div class="w-1/5">
                        <h2 class="text-3xl font-bold mt-14">King Gizzard & The Lizard Wizard</h2>
                    </div>
                    <div class="w-3/5 flex flex-col gap-y-5">
                        <div class="text-lg">
                            <p><b>8 December - London, UK</b> @ Lafayette</p>
                            <p><b>8 December - London, UK</b> @ Lafayette</p>
                            <p><b>8 December - London, UK</b> @ Lafayette</p>
                            <p><b>8 December - London, UK</b> @ Lafayette</p>
                        </div>
                        <p>
                            The legendary Russian musician Boris Grebenshikov (BG+) is going on tour this December with
                            his
                            new program, Square Root Sun, along with the best Aquarium songs of all time. Don’t miss
                            your
                            chance to experience his iconic blend of rock, folk, and poetry live in the UK and Ireland.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>

<style scoped lang="scss">
.event-image {
    background-size: 140%;

    &:before {
        content: '';
        left: 0;
        position: absolute;
        background-image: url("/images/frame.png");
        height: 100%;
        width: 100%;
        background-repeat: no-repeat;
    }
}

.past {
    .event-image:before {
        background-image: url("/images/framepast.png");
    }
}
</style>

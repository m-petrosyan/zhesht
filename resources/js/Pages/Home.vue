<script setup>
import Carousel from "@/Components/Gallery/Carousel.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";

defineProps({
    events: {required: true},
    pastEvents: {required: true},
})
</script>

<template>
    <GuestLayout>
        <Carousel :events/>
        <section class="bg-main lg:px-8 px-6 pt-20 pb-20">
            <div class="flex flex-col gap-y-20 lg:w-3/5 md:w-full mx-auto">
                <div class="border-b-4 border-black pb-20">
                    <h2 class="text-3xl">
                        Honeycomb Live — concert agency operating worldwide. Here you can find our music events and
                        tours
                        and buy tickets to our concerts.
                    </h2>
                </div>
                <div v-for="item in events" :key="item.id"
                     class="flex lg:flex-row flex-col sm:gap-x-10 lg:gap-y-0 gap-y-10 lg:w-full sm:w-2/3 mx-auto">
                    <div class="lg:w-3/6 w-full flex flex-col md:flex-row  gap-x-6 lg:gap-x-10">
                        <div class="lg:w-1/2">
                            <!--                            <img :src="item.banner.thumb" :alt="item.title"-->
                            <!--                                 class="event-image mx-auto relative w-52 h-52 bg-cover bg-no-repeat bg-center z-10"/>-->
                            <div :style="{ backgroundImage: `url(${item.banner.thumb})` }"
                                 class="event-image mx-auto relative w-52 h-52 bg-cover bg-no-repeat bg-center z-10"/>
                        </div>
                        <div class="lg:w-1/2">
                            <h2 class="text-3xl font-bold md:mt-14 md:text-start text-center">{{ item.title }}</h2>
                        </div>
                    </div>
                    <div class="lg:w-3/5 w-full flex flex-col gap-y-5">
                        <div class="text-lg">
                            <p><b>{{ item.location }}</b></p>
                        </div>
                        <p v-html="item.content"/>
                        <div class="flex items-center gap-x-10">
                            <button class="bg-black text-white py-2 px-5 rounded-3xl text-lg">Tickets</button>
                            <!--                            <DateCountDown targetDate="2024-12-01T00:00:00"/>-->
                        </div>
                    </div>
                </div>
                <div class="flex lg:flex-row flex-col sm:gap-x-10 lg:gap-y-0 gap-y-10 lg:w-full sm:w-2/3 mx-auto">
                    <div class="lg:w-3/6 w-full flex flex-col md:flex-row  gap-x-6 lg:gap-x-10">
                        <div class="lg:w-1/2">
                            <div style="background-image: url('/images/marduk.jpg')"
                                 class="event-image mx-auto relative w-52 h-52 bg-cover bg-no-repeat bg-center z-10"/>
                        </div>
                        <div class="lg:w-1/2">
                            <h2 class="text-3xl font-bold md:mt-14 md:text-start text-center">Marduk in Tbilisi</h2>
                        </div>
                    </div>
                    <div class="lg:w-3/5 w-full flex flex-col gap-y-5">
                        <div class="text-lg">
                            <p><b>February 2 - Tbilisi, Georgia</b> ...</p>
                        </div>
                        <p>
                            Zhesht Events is proud to announce the coming of mighty Marduk. The legendary Swedish panzer
                            division will land on Armenian soil on a cold winter day of February 4th and set it ablaze
                            with their relentless battle hymns.
                            Local support TBA.
                            Get electronic tickets from Ticketon or the very limited (15) quantity of physical presale
                            tickets from Rocknrolla.
                        </p>
                        <div class="flex items-center gap-x-10">
                            <button class="bg-black text-white py-2 px-5 rounded-3xl text-lg">Tickets</button>
                            <!--                            <DateCountDown targetDate="2024-12-01T00:00:00"/>-->
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <section class="past bg-past lg:px-8 px-6 pt-20 pb-20">
            <div class="flex flex-col gap-y-20 lg:w-3/5 mx-auto">
                <div class="border-b-2 border-black pb-4">
                    <h3 class="font-bold text-lg">Past shows</h3>
                </div>
                <div
                    class="flex lg:flex-row flex-col sm:gap-x-10 lg:gap-y-0 gap-y-10 lg:w-full sm:w-2/3 mx-auto opacity-50">
                    <div class="lg:w-3/6 w-full flex flex-col md:flex-row gap-x-6 lg:gap-x-10">
                        <div class="lg:w-1/2">
                            <div style="background-image: url('/images/BG.jpg')"
                                 class="event-image mx-auto relative w-52 h-52 bg-cover bg-no-repeat bg-center z-10"/>
                        </div>
                        <div class="lg:w-1/2">
                            <h2 class="text-3xl font-bold md:mt-14 md:text-start text-center">Boris
                                Grebenshikov</h2>
                        </div>
                    </div>
                    <div class="lg:w-3/5 w-full flex flex-col gap-y-5">
                        <div class="text-lg">
                            <p><b>January 31 - Kazakhstan, Almaty</b> ...</p>
                            <p><b>February 2 - Tbilisi, Georgia</b> ...</p>
                            <p><b>February 4 - Yerevan, Armenia</b> National Puppet Theatre</p>
                        </div>
                        <p>
                            Zhesht Events is proud to announce the coming of mighty Marduk. The legendary Swedish
                            panzer
                            division will land on Armenian soil on a cold winter day of February 4th and set it
                            ablaze
                            with their relentless battle hymns.
                            Local support TBA.
                            Get electronic tickets from Ticketon or the very limited (15) quantity of physical
                            presale
                            tickets from Rocknrolla.
                        </p>
                        <div class="flex items-center gap-x-10">
                            <button class="bg-black text-white py-2 px-5 rounded-3xl text-lg">Tickets</button>
                            <!--                            <DateCountDown targetDate="2024-12-01T00:00:00"/>-->
                        </div>
                    </div>
                </div>
            </div>
        </section>

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

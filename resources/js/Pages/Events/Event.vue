<script setup>

import GuestLayout from "@/Layouts/GuestLayout.vue";
import {formatDateTime} from "@/Helpers/dateFormatHelper.js";

defineProps({
    event: {required: true},
})
</script>

<template>
    <GuestLayout>
        <section class="bg-main lg:px-8 px-6 pt-20 pb-20">
            <div class="mt-20 flex flex-col gap-y-20 lg:w-7/12 md:w-full mx-auto">
                <div class="flex lg:flex-row flex-col sm:gap-x-14 lg:gap-y-0 gap-y-10 lg:w-full sm:w-2/3 mx-auto">
                    <div class="w-6/12 flex flex-col md:flex-row gap-x-6 lg:gap-x-10">
                        <div :style="{ backgroundImage: `url(${event.poster.large})` }"
                             class="event-image mx-auto relative w-full h-full bg-cover bg-no-repeat bg-center z-10"/>
                    </div>
                    <div class="lg:w-6/12 w-full flex flex-col gap-y-5">
                        <h1 class="text-5xl font-bold md:mt-14 md:text-start text-center">{{ event.title }}</h1>
                        <div class="text-2xl">
                            <p><b>{{ event.location }} <br>
                                {{ formatDateTime(event.date_time, 'D MMMM YYYY') }}
                            </b></p>
                        </div>
                        <p v-html="event.content"/>
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

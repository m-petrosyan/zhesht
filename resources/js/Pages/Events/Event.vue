<script setup>

import GuestLayout from "@/Layouts/GuestLayout.vue";
import {formatDateTime} from "@/Helpers/dateFormatHelper.js";
import {ref} from "vue";

defineProps({
    event: {required: true},
})

const openTickets = ref(false);
</script>

<template>
    <GuestLayout>
        <section class="bg-main lg:px-8 px-6 pt-20 pb-20 min-h-[800px]">
            <div class="mt-20 flex flex-col gap-y-20 lg:w-7/12 md:w-full mx-auto">
                <div class="flex lg:flex-row flex-col sm:gap-x-14 lg:gap-y-0 gap-y-10 lg:w-full sm:w-2/3 mx-auto">
                    <div class="w-6/12 h-96 flex flex-col md:flex-row gap-x-6 lg:gap-x-10">
                        <div :style="{ backgroundImage: `url(${event.poster.large})` }"
                             class="event-image mx-auto relative w-full h-full bg-cover bg-no-repeat bg-center z-10"/>
                    </div>
                    <div class="lg:w-6/12 w-full flex flex-col gap-y-5">
                        <h1 class="text-5xl font-bold md:mt-14 md:text-start text-center">{{ event.title }}</h1>
                        <div class="text-2xl">
                            <p><b>{{ event.location }} <br>
                                {{ formatDateTime(event.date_time, 'D MMMM YYYY HH:mm') }}
                            </b></p>
                        </div>
                        <p v-html="event.content"/>
                        <div v-if="event.tickets.length" class="flex items-center gap-x-10">
                            <div v-if="event.tickets.length > 1">
                                <button @click="openTickets = !openTickets"
                                        class="bg-black text-white py-2 px-5 rounded-3xl text-lg">Tickets
                                </button>
                                <div v-if="openTickets" class="flex flex-col gap-y-2 mt-2">
                                    <a v-for="item in event.tickets"
                                       class="bg-black text-white py-2 px-5 rounded-3xl text-lg"
                                       target="_blank"
                                       :href="item.url">{{ item.title }}</a>
                                </div>
                            </div>
                            <a v-else class="bg-black text-white py-2 px-5 rounded-3xl text-lg"
                               target="_blank"
                               :href="event.tickets[0].url">Tickets</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </GuestLayout>
</template>

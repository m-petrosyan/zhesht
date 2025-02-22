<script setup>

import GuestLayout from "@/Layouts/GuestLayout.vue";
import {formatDateTime} from "@/Helpers/dateFormatHelper.js";
import {ref} from "vue";

defineProps({
    tour: {required: true},
})

const openTickets = ref(false);
</script>

<template>
    <GuestLayout>
        <section class="bg-main lg:px-8 px-6 pt-20 pb-20 min-h-[800px]">
            <div class="mt-20 lg:w-7/12 md:w-full mx-auto">
                <h1 class="text-5xl font-bold text-center block">{{ tour.title }}</h1>
                <div class="lg:w-full mt-4">
                    <div :style="{ backgroundImage: `url(${tour.banner_file.large})` }"
                         class="event-image w-full h-96 bg-cover bg-no-repeat bg-center z-10  rounded-lg"
                    />
                </div>
                <div class="mt-10 px-5">
                    <div class="flex lg:flex-row flex-col gap-8">
                        <div v-for="event in tour.events" :key="event.id"
                             class="lg:w-1/2 flex flex-col gap-y-5">

                            <div class="text-2xl">
                                <p>
                                    <b>{{ event?.location }}<br>
                                        {{ formatDateTime(event.date_time, 'D MMMM YYYY HH:mm') }}</b>
                                </p>
                            </div>

                            <div v-if="event?.tickets.length" class="flex items-center gap-x-10">
                                <div v-if="event?.tickets.length > 1">
                                    <button
                                        @click="openTickets = !openTickets"
                                        class="bg-black text-white py-2 px-5 rounded-3xl text-lg"
                                    >
                                        Tickets
                                    </button>
                                    <div v-if="openTickets" class="flex flex-col gap-y-2 mt-2">
                                        <a
                                            v-for="item in event?.tickets"
                                            class="bg-black text-white py-2 px-5 rounded-3xl text-lg"
                                            target="_blank"
                                            :href="item.url"
                                        >
                                            {{ item.title }}
                                        </a>
                                    </div>
                                </div>
                                <a
                                    v-else
                                    class="bg-black text-white py-2 px-5 rounded-3xl text-lg"
                                    target="_blank"
                                    :href="event?.tickets[0].url"
                                >
                                    Tickets
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="w-full mt-10">
                        <p v-html="tour.content"/>
                    </div>
                </div>
            </div>
        </section>
    </GuestLayout>
</template>

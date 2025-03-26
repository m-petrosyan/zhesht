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
  <GuestLayout :title="tour.title" :description="tour.intro" :image="tour.banner.large">
    <section class="bg-main lg:px-8 px-6 pt-20 pb-20 min-h-[800px]">
      <div class="mt-20 lg:w-7/12 md:w-full mx-auto">
        <div class="lg:w-full mt-4">
          <div :style="{ backgroundImage: `url(${tour.banner.large})` }"
               class="event-image w-full h-96 bg-cover bg-no-repeat bg-center z-10  rounded-lg"
          />
        </div>
        <h1 class="text-5xl font-bold text-center mt-6">{{ tour.title }}</h1>
        <div class="mt-10 px-5">
          <div class="flex lg:flex-row flex-col gap-8">
            <div v-for="event in tour.events" :key="event.id"
                 class="lg:w-1/2 flex flex-col gap-y-5">
              <div class="flex gap-x-5">
                <div v-if="event?.tickets.length" class="flex items-center gap-x-10">
                  <div v-if="event?.tickets.length > 1">
                    <button
                        @click="openTickets = !openTickets"
                        class="bg-black text-white py-2 px-5 rounded-3xl text-lg"
                    >
                      Tickets
                    </button>
                    <div v-show="openTickets" class="flex flex-col gap-y-2 mt-2">
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
                <p class="text-2xl">
                  <b>{{ formatDateTime(event.date_time, 'D MMMM YYYY') }}<br>
                    {{ event?.location }}</b>
                </p>
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

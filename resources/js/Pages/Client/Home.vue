<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import {Link} from '@inertiajs/vue3';
import {formatDateTime} from '@/Helpers/dateFormatHelper.js';

defineProps({
  upcomingTours: {required: true},
  sliderTours: {required: true},
});
</script>

<template>
  <GuestLayout>
    <section class="bg-main lg:px-8 px-6 pt-20 pb-20">
      <div class="flex flex-col gap-y-20 lg:w-3/5 md:w-full mx-auto">
        <div class="border-b-4 border-black pb-10">
          <h2 class="text-3xl">
            Zhesht Events is a concert agency operating in Armenia and Georgia since 2008
          </h2>
          <Link :href="route('past')">
            <h2 class="text-2xl font-black pr-2">See events archive</h2>
          </Link>
        </div>

        <Link v-for="item in upcomingTours" :key="item.id"
              :href="route('event.show',item.slug)"
              class="flex lg:flex-row flex-col sm:gap-x-10 md:gap-x-4 lg:gap-y-0 gap-y-10 lg:w-full sm:w-2/3 mx-auto">
          <div class="lg:w-3/6 w-full flex flex-col md:flex-row gap-x-6 lg:gap-x-12">
            <div class="lg:w-1/6">
              <div :style="{ backgroundImage: `url(${item.banner.thumb})` }"
                   class="event-image mx-auto relative w-52 h-52 bg-cover bg-no-repeat bg-center z-10"/>
            </div>
            <div class="lg:w-2/6">
              <h2 class="text-3xl font-bold md:text-start text-center">{{ item.title }}</h2>
              <div class="mt-4">
                <template v-for="event in item.events" :key="event.id">
                  <div class="text-lg">
                    <b class="text-sm">
                      {{ event.location }}
                      <span class="pl-2">{{ formatDateTime(event.date_time, 'D MMMM YYYY') }}</span>
                    </b>
                  </div>
                </template>
              </div>
            </div>
          </div>
          <div class="lg:w-3/6 w-full flex flex-col gap-y-5">
            <p class="line-clamp-6" v-html="item.intro"/>
            <div class="flex items-center gap-x-10">
              <button class="bg-black text-white py-2 px-5 rounded-3xl text-lg">More</button>
            </div>
          </div>
        </Link>
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

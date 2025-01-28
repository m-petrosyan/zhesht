<script setup>
import {Link} from "@inertiajs/vue3";

const scrollTo = (sectionId) => {
    const section = document.getElementById(sectionId);
    if (section) {
        section.scrollIntoView({behavior: 'smooth', block: 'start'});
    }
}
</script>

<template>
    <div class="w-full">
        <div class="w-full flex justify-end absolute z-10 lg:px-0 px-8">
            <Link :href="route('home')"
                  class="absolute top-2 left-1/2 transform -translate-x-1/2 z-1 px-8">
                <img src="/images/logo.png" alt="logo"/>
            </Link>
            <ul class="hidden md:flex mt-7 gap-x-5 mr-5 text-xl text-white font-bold">
                <li class="cursor-pointer" @click="scrollTo('')">Upcoming showss</li>
                <li class="cursor-pointer" @click="scrollTo('past')">Past Shows</li>
                <li class="cursor-pointer" @click="scrollTo('footer')">Contacts</li>
            </ul>
            <div class="md:hidden block">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                     fill="#f0a903">
                    <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/>
                </svg>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>

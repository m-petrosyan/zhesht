<script setup>
import {Link, usePage} from "@inertiajs/vue3";

const page = usePage();
const invert = page.url.startsWith('/event/') || page.url === '/past';
</script>

<template>
    <div class="w-full">
        <div class="absolute left-3 top-3 z-10">
            <Link :href="route('home')">
                <img :class="{'invert': invert}" src="/images/logo.png" width="130" alt="logo"/>
            </Link>
        </div>
    </div>
</template>

<style scoped>

</style>

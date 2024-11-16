<script setup>
import Navbar from "@/Components/Nav/Navbar.vue";
import Footer from "@/Components/Footer/Footer.vue";
import {Head} from "@inertiajs/vue3";

defineProps({
    title: {type: String, default: ''},
})
</script>

<template>
    <Head>
        <title>{{title}}</title>
    </Head>
    <Navbar/>
    <slot/>
    <Footer/>
</template>

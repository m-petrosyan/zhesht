<script setup>
import Navbar from "@/Components/Nav/Navbar.vue";
import Footer from "@/Components/Footer/Footer.vue";
import {Head} from "@inertiajs/vue3";

defineProps({
  title: {type: String, default: ''},
  description: {type: String, default: ''},
  image: {type: String, default: ''},
})

const cover = '/images/logo.png';
</script>

<template>
  <Head>
    <title>{{title}}</title>
    <meta
        name="description"
        :content="description ??
                       'Prevent cyber attacks, ensure compliance, and secure your data with managed cybersecurity solutions. 24/7 monitoring & expert support. Contact us today!'"
    />
    <meta
        name="og:description"
        :content="description ?? ''"
    />
    <meta
        name="og:title"
        :content="title ?? ''"
    />
    <meta
        name="keywords"
        content=""
    />
    <meta
        name="og:image"
        :content="image ? image : cover"
    />
    <meta
        name="twitter:image"
        :content="image ? image : cover"
    />
  </Head>
  <Navbar/>
  <slot/>
  <Footer/>
</template>

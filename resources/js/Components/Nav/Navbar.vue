<script setup>
import {Link} from "@inertiajs/vue3";
</script>

<template>
    <div class="w-full">
        <div class="absolute left-3 top-3 z-10">
            <Link :href="route('home')">
                <img src="/images/logo.png" width="130" alt="logo"/>
            </Link>
        </div>
    </div>
</template>

<style scoped>

</style>

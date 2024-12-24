<script setup>
import {ref} from 'vue';
import {Head} from '@inertiajs/vue3';
import DashboardNavbar from "@/Components/Nav/DashboardNavbar.vue";

const showingNavigationDropdown = ref(false);
defineProps({
    title: {type: String, default: ''},
})
</script>

<template>
    <Head :title/>
    <div>
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <DashboardNavbar/>

            <main class="max-w-7xl mx-auto dark:bg-gray-800 mt-10 py-5 sm:px-6 lg:px-8 text-white">
                <slot/>
            </main>
        </div>
    </div>
</template>

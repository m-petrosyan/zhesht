<script setup>
import {ref} from 'vue';
import {Head} from '@inertiajs/vue3';
import DashboardNavbar from "@/Components/Nav/DashboardNavbar.vue";
import ErrorMessages from "@/Components/Ui/ErrorMessages.vue";

const showingNavigationDropdown = ref(false);
defineProps({
    title: {type: String, default: ''},
})
</script>

<template>
    <Head :title/>
    <div class="dashboard">
        <div class="min-h-screen bg-gray-100 bg-gray-900 pb-10">
            <DashboardNavbar/>
            <main class="max-w-7xl mx-auto">
                <div class="mt-6 h-8">
                    <slot name="header"/>
                </div>
                <section class="bg-gray-800 mt-4 sm:px-6 lg:px-8 text-white p-5">
                    <ErrorMessages :messages="$page.props.errors"/>
                    <slot/>
                </section>
            </main>
        </div>
    </div>
</template>

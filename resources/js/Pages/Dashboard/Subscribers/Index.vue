<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {formatDateTime} from "@/Helpers/dateFormatHelper.js";

defineProps({
    subscribers: {required: true}
})
</script>

<template>
    <AuthenticatedLayout title="Dashboard">
        <section>
            <table class="min-w-full">
                <thead class="text-left">
                <tr class="leading-[2]">
                    <th>Email</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in subscribers" :key="item.id" class="border-b border-gray-900">
                    <td class="w-48">
                        <p>{{ item.email }}</p>
                    </td>
                    <td class="w-32">
                        <p>
                            {{ formatDateTime(item.created_at, 'D MMMM YYYY HH:mm') }}
                        </p>
                    </td>
                </tr>
                </tbody>
            </table>
        </section>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>

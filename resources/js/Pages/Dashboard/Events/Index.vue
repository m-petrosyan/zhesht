<script setup>
import {router} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import NavLink from "@/Components/NavLink.vue";
import {formatDateTime} from "@/Helpers/dateFormatHelper.js";

defineProps({
    tours: {required: true}
})

const deleteItem = (id) => {
    router.delete(route('db.event.destroy', id))
}
</script>

<template>
    <AuthenticatedLayout title="Dashboard">
        <div class="flex justify-end">
            <NavLink :href="route('db.event.create')"
                     class="px-4 mt-10 py-2 bg-blue-green text-white rounded">
                Create
            </NavLink>
            <!--            <AppButton-->
            <!--                link="event.create"-->
            <!--                text="Create"-->
            <!--                buttonStyle="db-btn"-->
            <!--            />-->
        </div>
        <section>
            <table class="min-w-full">
                <thead class="text-left">
                <tr class="leading-[2]">
                    <th>Banner</th>
                    <th>Poster</th>
                    <th>Title</th>
                    <th>Dates</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in tours" :key="item.id" class="border-b border-gray-900">
                    <td class="w-48">
                        <a :href="route('db.event.edit',item.id)">
                            <img :src="item.banner_file.thumb" alt="event" class="h-24">
                        </a>
                    </td>
                    <td class="w-32">
                        <a :href="route('db.event.edit',item.id)">
                            <img v-if="item.poster_file?.thumb" :src="item.poster_file?.thumb" alt="event" class="h-24">
                        </a>
                    </td>
                    <td>
                        <p> {{ item.title }}</p>
                    </td>
                    <td>
                        <p v-for="event in item.events" :key="event.id">
                            {{ formatDateTime(event.date_time, 'D MMMM YYYY HH:mm') }}
                        </p>
                    </td>
                    <td>
                        <div class="flex justify-end align-center gap-x-3 h-20">
                            <NavLink class="px-4 mt-10 py-2 bg-green text-white rounded"
                                     :href="route('db.event.edit',item.id)">
                                Edit
                            </NavLink>
                            <button class="px-4 mt-10 bg-dark-orange text-white rounded"
                                    @click="deleteItem(item.id)">
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </section>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>

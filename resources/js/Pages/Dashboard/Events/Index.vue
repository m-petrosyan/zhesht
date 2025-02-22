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
            <NavLink :href="route('db.event.create')">
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
                <tr v-for="item in tours" :key="item.id" class="leading-[8] border-b border-gray-900">
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
                        <div class="flex justify-end gap-x-3">
                            <NavLink class="text-green-600" :href="route('db.event.edit',item.id)">
                                Edit
                            </NavLink>
                            <button class="text-red-600" @click="deleteItem(item.id)">
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

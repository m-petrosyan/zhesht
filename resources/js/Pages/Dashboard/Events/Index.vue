<script setup>
import {router} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import NavLink from "@/Components/NavLink.vue";

defineProps({
    events: {required: true}
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
                <tr>
                    <th>Banner</th>
                    <th>Title</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in events" :key="item.id">
                    <td>
                        <a :href="route('db.event.edit',item.id)">
                            <img :src="item.banner_file.thumb" alt="event" height="150" width="150">
                        </a>
                    </td>
                    <td>
                        <p> {{ item.title }}</p>
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

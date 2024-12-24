<script setup>
import {router} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

defineProps({
    events: {required: true}
})

const deleteItem = (id) => {
    router.delete(route('event.destroy', id))
}
</script>

<template>
    <AuthenticatedLayout title="Dashboard">
        <div class="flex justify-end">
            <!--            <AppButton-->
            <!--                link="event.create"-->
            <!--                text="Create"-->
            <!--                buttonStyle="db-btn"-->
            <!--            />-->
        </div>
        <section class="mt-5">
            <table class="min-w-full">
                <thead>
                <tr>
                    <th>Banner</th>
                    <th>Title</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in events" :key="item.id">
                    <td>
                        <a :href="route('event.show',item.id)">
                            <img :src="item.banner.thumb" alt="event" height="150" width="150">
                        </a>
                    </td>
                    <td>
                        <p> {{ item.title }}</p>
                    </td>
                    <td>
                        <div class="flex justify-end gap-x-3">
                            <!--                            <AppButton-->
                            <!--                                :link="['db.news.edit',item.id]"-->
                            <!--                                text="Edit"-->
                            <!--                                buttonStyle="db-btn"-->
                            <!--                            />-->
                            <!--                            <AppButton-->
                            <!--                                @click="deleteItem(item.id)"-->
                            <!--                                text="Delete"-->
                            <!--                                class="bg-button-db-red hover:bg-button-db-red-active"-->
                            <!--                                buttonStyle="db-btn"-->
                            <!--                            />-->
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

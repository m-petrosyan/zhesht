<script setup>
import {router} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import NavLink from "@/Components/NavLink.vue";
import {ref} from "vue";
import draggable from "vuedraggable";
import {formatDateTime} from "@/Helpers/dateFormatHelper.js";

const props = defineProps({
    tours: {required: true}
})

const items = ref(props.tours);

const deleteItem = (id) => {
    router.delete(route('db.event.destroy', id))
}

const updateSorting = () => {
    const sortedIds = items.value.map((item, index) => ({
        id: item.id,
        slider_order: index + 1,
    }));
    router.post(route("db.tour.reorder"), {sortedIds}, {preserveScroll: false});
};
</script>

<template>
    <AuthenticatedLayout title="Dashboard">
        <template #header>
            <div class="flex justify-end">
                <NavLink :href="route('db.event.create')"
                         class="px-4 py-2 bg-blue-green text-white rounded">
                    Create
                </NavLink>
            </div>
        </template>
        <section>
            <table class="min-w-full border-separate border-spacing-y-4">
                <thead class="text-left">
                <tr class="leading-[2]">
                    <th>Banner</th>
                    <th>Poster</th>
                    <th>Title</th>
                    <th>Dates</th>
                    <th>Intro</th>
                </tr>
                </thead>
                <draggable tag="tbody" v-model="items" @end="updateSorting" c>
                    <template v-slot:item="{ element }">
                        <tr class="border-b border-gray-900 cursor-grab">
                            <td class="w-48">
                                <img :src="element.banner.thumb" alt="event" class="h-24">
                            </td>
                            <td class="flex gap-x-4">
                                <div v-for="event in element.events" :key="event.id">
                                    <img v-if="event.poster?.thumb" :src="event.poster?.thumb" alt="event"
                                         class="h-24">
                                </div>
                            </td>
                            <td>
                                <p> {{ element.title }}</p>
                            </td>
                            <td>
                                <p v-for="event in element.events" :key="event.id">
                                    {{ formatDateTime(event.date_time, 'D MMMM YYYY HH:mm') }}
                                </p>
                            </td>
                            <td class="w-96">
                                <p class="line-clamp-6" v-html="element.intro"></p>
                            </td>
                            <td>
                                <div class="flex justify-end align-center gap-x-3 h-20">
                                    <NavLink class="px-4 mt-10 py-2 bg-green text-white rounded"
                                             :href="route('db.event.edit',element.id)">
                                        Edit
                                    </NavLink>
                                    <button class="px-4 mt-10 bg-dark-orange text-white rounded"
                                            @click="deleteItem(element.id)">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                </draggable>
            </table>
        </section>
    </AuthenticatedLayout>
</template>

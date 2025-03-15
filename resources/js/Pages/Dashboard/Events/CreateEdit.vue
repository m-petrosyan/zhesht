<script setup>
import QuillUploadEditor from "@/Components/Ui/QuillUploadEditor.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import UiInput from "@/Components/Ui/UiInput.vue";
import InputImage from "@/Components/Ui/InputImage.vue";
import useFormHelper from "@/Helpers/formHelper.js";
import {computed, ref} from "vue";
import DeleteIcon from "@/Components/Icons/DeleteIcon.vue";
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import {formatDateTime, formatUtcDateTime} from "@/Helpers/dateFormatHelper.js";
import {router} from "@inertiajs/vue3";


const props = defineProps({
    tour: {type: Object},
})

const currentEvent = ref(0)
const date_time = computed(() => formatDateTime(form.events[currentEvent.value]?.date_time, 'D MMMM YYYY HH:mm'))

const form = useFormHelper(
    props.tour?.id
        ? {...props.tour}
        : {
            banner_file: null,
            banner: null,
            title: null,
            intro: null,
            content: null,
            events: [
                {
                    date_time: null,
                    location: null,
                    tickets: [],
                    poster_file: null,
                    poster: null,
                }
            ]
        })


const addTicket = () => {
    form.events[currentEvent.value].tickets.push({title: '', url: ''})
}

const submit = () => {
    form.post(route(props.tour?.id ? 'db.event.update' : 'db.event.store', form), {
        preserveScroll: false,
        onSuccess: () => {
            form.reset()
        }
    })
}

const removeTicket = (index) => {
    form.events[currentEvent.value].tickets.splice(index, 1)
}

const addEvent = () => {
    form.events.push({
        date_time: null,
        location: null,
        tickets: []
    })
    currentEvent.value = form.events.length - 1
}

const removeEvent = (index) => {
    const id = form.events[index]?.id

    if (id) {
        router.delete(route('db.event.delete', id));
    }
    form.events.splice(index, 1)
    currentEvent.value = currentEvent.value - 1
}

const setCurrentEvent = (index) => {
    currentEvent.value = index
}

const format = (date) => {
    form.events[currentEvent.value].date_time = formatUtcDateTime(date, 'Y-MM-DD HH:mm');
    return date;
}

const dateFormat = (value) => {
    return String(value).padStart(2, '0')
}

const def = {
    flow: ['calendar', 'time'],
}

</script>

<template>
    <AuthenticatedLayout title="Dashboard">
        <form @submit.prevent="submit" enctype="multipart/form-data">
            <div class="flex gap-x-2 font-black">
                <div class="flex gap-x-2">
                    <button @click="setCurrentEvent(index)"
                            v-for="(event,index) in form.events" type="button"
                            class="px-4 py-2 bg-yellow  text-white rounded "
                            :class="currentEvent === index ? 'opacity-100': 'opacity-50'"
                    >
                        {{ event.location?.slice(0, 10) ?? 'New Event' }}
                    </button>
                </div>
                <div>
                    <button type="button" @click="addEvent"
                            class="px-4 py-2 bg-orange text-white rounded">
                        +
                    </button>
                </div>
            </div>
            <div class="flex justify-between gap-x-5 mt-10">
                <div class="w-1/2 flex gap-x-5">
                    <div class="w-2/3 flex flex-col gap-y-2">
                        <UiInput
                            v-model="form.title"
                            placeholder="Title"
                            :errors="form.errors.title"/>
                        <UiInput
                            v-model="form.events[currentEvent].location"
                            placeholder="Location"
                            :errors="form.events[currentEvent]?.errors?.location"/>
                        <VueDatePicker v-model="date_time"
                                       :format
                                       :flow="def.flow"
                                       minutes-grid-increment="30"
                                       expanded
                                       dark/>
                        <textarea v-model="form.intro" placeholder="Intro" rows="5"/>
                    </div>
                    <div class="w-1/3">
                        <InputImage
                            :preview="form.events[currentEvent].poster"
                            v-model:file="form.events[currentEvent].poster_file"
                            placeholder="Poster"
                        />
                    </div>
                </div>
                <div class="w-1/2">
                    <InputImage
                        :preview="form.banner"
                        v-model:file="form.banner_file"
                        placeholder="Banner (1680x945)"
                    />
                </div>
            </div>

            <div class="mt-10">
                <QuillUploadEditor
                    v-model:content="form.content"
                    class="h-64"
                    collection="event-image"
                    :error="form.errors.content"
                />
            </div>

            <div class="flex flex-col gap-y-2">
                <div class="flex justify-end">
                    <button
                        type="button"
                        @click="addTicket"
                        class="px-4 mt-5 py-2 bg-blue-green text-white rounded"
                    >
                        Add Ticket
                    </button>
                </div>
                <div class="flex flex-col gap-y-2 mt-10">
                    <label v-if="form.events[currentEvent]?.tickets.length" class="block text-sm font-medium">
                        Tickets
                    </label>
                    <div v-for="(ticket, index) in form.events[currentEvent]?.tickets" :key="index"
                         class="flex gap-x-2">
                        <UiInput
                            v-model="ticket.title"
                            placeholder="Title"
                            :errors="form.events[currentEvent]?.errors?.tickets ? form.events[currentEvent]?.errors?.tickets[index].title : null"/>
                        <UiInput
                            v-model="ticket.url"
                            placeholder="URL"
                            :errors="form.events[currentEvent]?.errors?.tickets ? form.events[currentEvent]?.errors?.tickets[index].url : null"/>
                        <button type="button" @click="removeTicket(index)"
                                class="px-4 py-2 bg-red text-white rounded"> delete
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex justify-between space-x-4">
                <div>
                    <button
                        v-if="currentEvent !== 0"
                        type="button"
                        class="px-4 mt-10 py-2 bg-red-500 text-white rounded"
                        @click="removeEvent(currentEvent)">
                        <DeleteIcon/>
                    </button>
                </div>
                <button
                    type="submit"
                    class="px-4 mt-10 py-2 bg-dark-orange text-white rounded"
                    :disabled="form.processing"
                >
                    Publish Event
                </button>
            </div>
        </form>
    </AuthenticatedLayout>
</template>

<script setup>
import QuillUploadEditor from "@/Components/Ui/QuillUploadEditor.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import UiInput from "@/Components/Ui/UiInput.vue";
import InputImage from "@/Components/Ui/InputImage.vue";
import {computed, ref} from "vue";
import DeleteIcon from "@/Components/Icons/DeleteIcon.vue";
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import {formatDateTime, formatUtcDateTime} from "@/Helpers/dateFormatHelper.js";
import {router, useForm} from "@inertiajs/vue3";
import SelectImages from "@/Components/Ui/SelectImages.vue";


const props = defineProps({
    tour: {type: Object},
})

const currentEventIndex = ref(0)
const currentEvent = computed(() => form.events[currentEventIndex.value])
const date_time = computed(() => formatDateTime(form.events[currentEventIndex.value]?.date_time, 'D MMMM YYYY HH:mm'))
const addGallery = ref(false)

const form = useForm(
    props.tour?.id
        ? {...props.tour, banner_file: null, _method: 'PUT'}
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
        });

const gallery = useForm({
    title: '',
    images: [],
    preview: [],
});

const addTicket = () => {
    form.events[currentEventIndex.value].tickets.push({title: '', url: ''})
}


const removeTicket = (index) => {
    form.events[currentEventIndex.value].tickets.splice(index, 1)
}

const addEvent = () => {
    form.events.push({
        date_time: null,
        location: null,
        tickets: []
    })
    currentEventIndex.value = form.events.length - 1
}

const removeEvent = (index) => {
    const id = form.events[index]?.id

    if (id) {
        router.delete(route('db.event.delete', id));
    }
    form.events.splice(index, 1)
    currentEventIndex.value = currentEventIndex.value - 1
}

const setCurrentEvent = (index) => {
    currentEventIndex.value = index
}

const format = (date) => {
    form.events[currentEventIndex.value].date_time = formatUtcDateTime(date, 'Y-MM-DD HH:mm');
    return date;
}

const dateFormat = (value) => {
    return String(value).padStart(2, '0')
}

const def = {
    flow: ['calendar', 'time'],
}

const submit = () => {
    form.post(route(props.tour?.id ? 'db.event.update' : 'db.event.store', form), {
        preserveScroll: false,
        onSuccess: () => {
            form.reset()
        }
    })
}

const submitGallery = () => {
    gallery.post(route('db.gallery.store', currentEvent?.value.id), {
        preserveState: false,
        preserveScroll: true,
    })
}

const removeImageQuery = (id) => {
    form.delete(route('db.media.destroy', id), {
        preserveState: false,
        preserveScroll: true,
    });
}

const removeGallery = (id) => {
    form.delete(route('db.gallery.destroy', id), {
        preserveState: false,
        preserveScroll: true,
        onSuccess: () => {
            router.reload();
        },
    });
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
                            :class="currentEventIndex === index ? 'opacity-100': 'opacity-50'"
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
                            v-model="form.events[currentEventIndex].location"
                            placeholder="Location"
                            :errors="form.events[currentEventIndex]?.errors?.location"/>
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
                            :preview="form.events[currentEventIndex].poster"
                            v-model:file="form.events[currentEventIndex].poster_file"
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
                        class="px-4 mt-5 py-2 bg-blue-green text-white rounded flex gap-x-2"
                    > Add Ticket
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                             fill="#e8eaed">
                            <path
                                d="M480-280q17 0 28.5-11.5T520-320q0-17-11.5-28.5T480-360q-17 0-28.5 11.5T440-320q0 17 11.5 28.5T480-280Zm0-160q17 0 28.5-11.5T520-480q0-17-11.5-28.5T480-520q-17 0-28.5 11.5T440-480q0 17 11.5 28.5T480-440Zm0-160q17 0 28.5-11.5T520-640q0-17-11.5-28.5T480-680q-17 0-28.5 11.5T440-640q0 17 11.5 28.5T480-600Zm320 440H160q-33 0-56.5-23.5T80-240v-160q33 0 56.5-23.5T160-480q0-33-23.5-56.5T80-560v-160q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v160q-33 0-56.5 23.5T800-480q0 33 23.5 56.5T880-400v160q0 33-23.5 56.5T800-160Zm0-80v-102q-37-22-58.5-58.5T720-480q0-43 21.5-79.5T800-618v-102H160v102q37 22 58.5 58.5T240-480q0 43-21.5 79.5T160-342v102h640ZM480-480Z"/>
                        </svg>
                    </button>
                </div>
                <div class="flex flex-col gap-y-2 mt-10">
                    <label v-if="currentEvent?.tickets.length" class="block text-sm font-medium">
                        Tickets
                    </label>
                    <div v-for="(ticket, index) in currentEvent?.tickets" :key="index"
                         class="flex gap-x-2">
                        <UiInput
                            v-model="ticket.title"
                            placeholder="Title"
                            :errors="currentEvent?.errors?.tickets ? currentEvent?.errors?.tickets[index].title : null"/>
                        <UiInput
                            v-model="ticket.url"
                            placeholder="URL"
                            :errors="currentEvent?.errors?.tickets ? currentEvent?.errors?.tickets[index].url : null"/>
                        <button type="button" @click="removeTicket(index)"
                                class="px-4 py-2 bg-red text-white rounded"> delete
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex justify-between space-x-4">
                <div>
                    <button
                        v-if="currentEventIndex !== 0"
                        type="button"
                        class="px-4 mt-10 py-2 bg-red-500 text-white rounded flex gap-x-2 bg-red"
                        @click="removeEvent(currentEventIndex)">
                        Delete Event
                        <DeleteIcon/>
                    </button>
                </div>
                <button
                    type="submit"
                    class="px-4 mt-10 py-2 bg-dark-orange text-white rounded"
                    :disabled="form.processing"
                >
                    {{ currentEvent?.id ? 'Update' : 'Create' }}
                </button>
            </div>
        </form>
        <div v-if="currentEvent?.id">
            <button @click="addGallery = !addGallery" class="px-4 mt-10 py-2 bg-green text-white rounded flex gap-x-2">
                Add gellery
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                     fill="#e8eaed">
                    <path
                        d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm40-80h480L570-480 450-320l-90-120-120 160Zm-40 80v-560 560Z"/>
                </svg>
            </button>

            <div v-if="currentEvent.galleries?.length">
                <div v-for="(gallery, index) in currentEvent.galleries" :key="index">
                    <h2 class="text-center">{{ gallery.title }}</h2>
                    <div class="flex flex-wrap gap-2 mt-5 ">
                        <div v-for="image in gallery.images" :key="image.id" class="w-24">
                            <img v-if="image.thumb && image.thumb.trim()"
                                 :src="image.thumb"
                                 class="object-cover"
                                 alt="Image"
                                 @error="$event.target.src = image.original"/>
                            <img v-else-if="image.original"
                                 :src="image.original"
                                 class="object-cover"
                                 alt="Image"/>
                            <button type="button" @click="removeImageQuery(image.id)">Remove</button>
                        </div>
                    </div>
                    <button
                        type="button"
                        class="px-4 mt-10 py-2 bg-red-500 text-white rounded flex gap-x-2 bg-red"
                        @click="removeGallery(gallery.id)">
                        Remove Gallery
                        <DeleteIcon/>
                    </button>
                </div>
            </div>

            <div v-if="addGallery" class="my-20">
                <UiInput
                    classes="w-96 mx-auto"
                    v-model="gallery.title"
                    placeholder="Title"
                    :errors="form.errors.title"/>
                <SelectImages
                    classes="mt-10"
                    v-model:previews="gallery.preview"
                    v-model:files="gallery.images"/>
                <button v-if="gallery.images.length" @click="submitGallery"
                        class="px-4 mt-10 py-2 bg-dark-orange mx-auto text-white rounded flex gap-x-2">
                    Create gellery
                </button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

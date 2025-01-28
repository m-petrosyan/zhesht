<script setup>
import QuillUploadEditor from "@/Components/Ui/QuillUploadEditor.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import UiInput from "@/Components/Ui/UiInput.vue";
import InputImage from "@/Components/Ui/InputImage.vue";
import InputDate from "@/Components/Ui/InputDate.vue";
import ErrorMessages from "@/Components/Ui/ErrorMessages.vue";
import useFormHelper from "@/Helpers/formHelper.js";

const props = defineProps({
    event: {type: Object},
})

const form = useFormHelper(
    props.event?.id
        ? {...props.event}
        : {
            title: null,
            content: null,
            date_time: null,
            location: null,
            poster: null,
            banner: null,
            tickets: []
        })


const addTicket = () => {
    form.tickets.push({title: '', url: ''})
}

const submit = () => {
    form.post(route(form.id ? 'db.event.update' : 'db.event.store', form), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset()
        }
    })
}

const removeTicket = (index) => {
    form.tickets.splice(index, 1)
}
</script>

<template>
    <AuthenticatedLayout title="Dashboard">
        <div class="">
            <ErrorMessages :messages="$page.props.errors"/>
            <form @submit.prevent="submit" enctype="multipart/form-data">
                <div class="flex justify-between gap-x-10">
                    <div class="w-1/2 flex flex-col gap-y-2">
                        <UiInput
                            v-model="form.title"
                            label="Title"
                            :errors="form.errors.title"/>
                        <UiInput
                            v-model="form.location"
                            label="Location"
                            :errors="form.errors.location"/>
                        <InputDate
                            v-model="form.date_time"
                            label="Event Date & Time"
                            :errors="form.errors.date_time"/>
                    </div>
                    <div class="w-1/2">
                        <InputImage
                            :preview="form.banner"
                            v-model:file="form.poster"
                            placeholder="Click to upload (1680x945)"
                        />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium ">
                        Description
                    </label>
                    <QuillUploadEditor
                        v-model:content="form.content"
                        class="h-64"
                        collection="event-image"
                        :error="form.errors.content"
                    />
                </div>

                <div class="flex flex-col gap-y-2">
                    <div class="flex justify-between">
                        <label class="block text-sm font-medium ">
                            Tickets
                        </label>
                        <button
                            type="button"
                            @click="addTicket"
                            class="px-4 mt-5 py-2 bg-green-500 text-white rounded hover:bg-blue-600"
                        >
                            Add Ticket
                        </button>
                    </div>
                    <div class="flex flex-col gap-y-2">
                        <div v-for="(ticket, index) in form.tickets" :key="index" class="flex gap-x-2">
                            <UiInput
                                v-model="ticket.title"
                                placeholder="Title"
                                :errors="form.errors.tickets ? form.errors.tickets[index].title : null"/>
                            <UiInput
                                v-model="ticket.url"
                                placeholder="URL"
                                :errors="form.errors.tickets ? form.errors.tickets[index].url : null"/>
                            <button type="button" @click="removeTicket(index)"
                                    class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600"> delete
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <button
                        type="submit"
                        class="px-4 mt-10 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
                        :disabled="form.processing"
                    >
                        Publish Event
                    </button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

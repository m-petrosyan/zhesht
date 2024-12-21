<script setup>
import {useForm} from '@inertiajs/vue3'
import QuillUploadEditor from "@/Components/Ui/QuillUploadEditor.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {reactive} from "vue";
import UiInput from "@/Components/Ui/UiInput.vue";
import InputImage from "@/Components/Ui/InputImage.vue";
import InputDate from "@/Components/Ui/InputDate.vue";

const form = useForm({
    title: null,
    content: null,
    date_time: null,
    location: null,
    banner: null,
    newBanner: null,
})


const data = reactive({
    banner: null,
})

const saveDraft = () => {
    form.status = 'draft'
    submit()
}

const submit = () => {
    form.post(route('events.store'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset()
        }
    })
}
</script>

<template>
    <AuthenticatedLayout title="Dashboard">
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 text-white">
            <form @submit.prevent="submit">
                <div class="flex justify-between gap-x-10">
                    <div class="w-1/2">
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
                            :image="form.banner"
                            v-model:preview="form.newBanner"
                            v-model:file="data.banner"
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
                        :error="form.errors.content"
                    />
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end space-x-4">
                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
                        :disabled="form.processing"
                    >
                        Publish Event
                    </button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

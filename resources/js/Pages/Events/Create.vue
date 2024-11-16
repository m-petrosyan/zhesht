<template>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <form @submit.prevent="submit" class="space-y-6">
            <!-- Title Input -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Event Title
                </label>
                <input
                    v-model="form.title"
                    type="text"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                    :class="{ 'border-red-500': form.errors.title }"
                >
                <div v-if="form.errors.title" class="text-red-500 text-sm mt-1">
                    {{ form.errors.title }}
                </div>
            </div>

            <!-- Date and Time -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Start Date & Time
                    </label>
                    <input
                        v-model="form.start_date"
                        type="datetime-local"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                    >
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        End Date & Time
                    </label>
                    <input
                        v-model="form.end_date"
                        type="datetime-local"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                    >
                </div>
            </div>

            <!-- Location and Venue -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Location
                    </label>
                    <input
                        v-model="form.location"
                        type="text"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                    >
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Venue
                    </label>
                    <input
                        v-model="form.venue"
                        type="text"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                    >
                </div>
            </div>

            <!-- Max Participants -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Maximum Participants
                </label>
                <input
                    v-model.number="form.max_participants"
                    type="number"
                    min="1"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                >
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Event Banner
                </label>
                <input
                    type="file"
                    @input="form.banner = $event.target.files[0]"
                    accept="image/*"
                    class="mt-1 block w-full"
                >
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Event Description
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
                    type="button"
                    @click="saveDraft"
                    class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600"
                    :disabled="form.processing"
                >
                    Save Draft
                </button>
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
</template>

<script setup>
import {useForm} from '@inertiajs/vue3'
import QuillUploadEditor from "@/Components/Ui/QuillUploadEditor.vue";

const form = useForm({
    title: '',
    content: '',
    start_date: '',
    end_date: '',
    location: '',
    venue: '',
    max_participants: null,
    banner: null,
    images: [],
    status: 'draft'
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

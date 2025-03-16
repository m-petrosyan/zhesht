<script setup>
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    previews: {type: Array, required: true},
    files: {type: Object, required: true},
    classes: {type: String, default: ''}
})

const emit = defineEmits(['update:previews', 'update:files'])

const form = useForm({});

const removeImage = (index) => {
    const newPreviews = [...props.previews];
    newPreviews.splice(index, 1);
    emit('update:previews', newPreviews);

    const dataTransfer = new DataTransfer();
    const filesArray = Array.from(props.files);

    filesArray.forEach((file, i) => {
        if (i !== index) {
            dataTransfer.items.add(file);
        }
    });

    emit('update:files', dataTransfer.files);
};

const uploadImages = (event) => {
    const files = event.target.files;

    emit('update:files', files);

    const previewArray = [];

    for (const file of files) {
        const reader = new FileReader();

        reader.onload = (e) => {
            previewArray.push({file, url: e.target.result});

            if (previewArray.length === files.length) {
                emit('update:previews', previewArray);
            }
        };
        reader.readAsDataURL(file);
    }
};
</script>

<template>
    <div class="relative" :class="classes">
        <input type="file" hidden id="files" accept="image/*" @change="uploadImages" multiple/>
        <label
            class="cursor-pointer flex border border-dashed border-2 w-fit p-2 mx-auto"
            for="files">Select images

            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                <path
                    d="M440-320v-326L336-542l-56-58 200-200 200 200-56 58-104-104v326h-80ZM240-160q-33 0-56.5-23.5T160-240v-120h80v120h480v-120h80v120q0 33-23.5 56.5T720-160H240Z"/>
            </svg>
        </label>
    </div>
    <div class="flex flex-wrap gap-2 mt-5">
        <div v-if="previews.length" v-for="(preview, index) in previews" :key="index"
             class="w-1/12">
            <img :src="preview.url" class="images object-cover" alt="Image"/>
            <button type="button" @click="removeImage(index)">Remove</button>
        </div>
    </div>
</template>

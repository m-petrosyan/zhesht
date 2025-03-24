<script setup>
import {computed, ref} from "vue";
import {v4 as uuidv4} from 'uuid';

const props = defineProps({
    file: {type: Object, required: true},
    preview: {type: Object, required: true},
    placeholder: {type: String}
})

const previewFile = ref(null)

const emit = defineEmits(['update:preview', 'update:file'])

const changePreview = (file) => {
    previewFile.value = URL.createObjectURL(file.target.files[0])
    emit('update:file', file.target.files[0]);
};

const previewStyle = computed(() => {
    const imageUrl = previewFile.value ?? props.preview?.thumb ?? null;

    return imageUrl
        ? {backgroundImage: `url(${imageUrl})`}
        : {backgroundColor: 'rgb(31, 41, 55)'};
});

const uniqueId = uuidv4();
</script>

<template>
    <div class="h-full">
        <input type="file" hidden accept="image/*" :id="uniqueId"
               @change="changePreview">
        <label
            :class="['flex h-full min-h-60 w-inherit items-center justify-center border-dashed border-2 border-black-600-30 cursor-pointer rounded-md bg-no-repeat bg-center bg-cover rounded-10 mx-auto']"
            :for="uniqueId"
            :style="previewStyle">
            <span v-if="!preview">{{ placeholder }}</span>
        </label>
    </div>
</template>

<style scoped>

</style>

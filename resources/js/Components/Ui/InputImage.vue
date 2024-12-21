<script setup>
import {computed, ref} from "vue";

const props = defineProps({
    image: {type: Object, required: true},
    preview: {type: Object, required: true},
    bgSize: {type: String, default: 'bg-cover'},
    placeholder: {type: String}
})

const previewFile = ref(null)

const emit = defineEmits(['update:preview', 'update:file'])

const changePreview = (file) => {
    previewFile.value = URL.createObjectURL(file.target.files[0])
    emit('update:preview', file.target.files[0]);
};

const previewStyle = computed(() => {
    const imageUrl = previewFile.value ?? props.image?.thumb ?? null;

    return imageUrl
        ? {backgroundImage: `url(${imageUrl})`}
        : {backgroundColor: 'rgb(31, 41, 55)'};
});
</script>

<template>
    <div>
        <input type="file" hidden accept="image/*" id="preview"
               @change="changePreview">
        <label
            :class="['flex h-inherit min-h-60 w-inherit items-center justify-center border-dashed border-2 border-black-600-30 cursor-pointer rounded-md bg-no-repeat bg-center rounded-10 mx-auto',bgSize]"
            for="preview"
            :style="previewStyle">
            <span v-if="!preview">{{ placeholder }}</span>
        </label>
    </div>
</template>

<style scoped>

</style>

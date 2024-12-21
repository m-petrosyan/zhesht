<script setup>
import FormErrors from "@/Components/Ui/FormErrors.vue";

const props = defineProps({
    modelValue: {
        type: String,
        default: ''
    },
    label: {
        type: String,
        default: ''
    },
    placeholder: {
        type: String,
        default: ''
    },
    errors: {
        type: Array,
        default: []
    }
});


const emit = defineEmits(['update:modelValue']);

const updateValue = (event) => {
    emit('update:modelValue', event.target.value);
};
</script>

<template>
    <div class="flex flex-col w-full">
        <label v-if="label">{{ label }}</label>
        <input
            class="w-full h-full rounded-md"
            :placeholder="placeholder"
            :value="modelValue"
            @input="updateValue"
        />
    </div>
    <FormErrors :errors="errors"/>
</template>

<style scoped lang="scss">
</style>

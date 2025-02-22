<script setup>import FormErrors from "@/Components/Ui/FormErrors.vue";

const props = defineProps({
    label: {
        type: String,
        default: ''
    },
    errors: {
        type: Array,
        default: []
    }
});

const date_time = defineModel({
    type: String,
    default: ''
});


</script>

<template>
    <div>
        <label class="block  text-sm font-medium ">
            {{ label }}
        </label>
        <input
            @change="event => date_time = event.target.value"
            :value="date_time"
            type="datetime-local"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
        >
    </div>
    <FormErrors :errors="errors"/>
</template>

<style scoped lang="scss">

</style>

<script setup>
import {computed} from 'vue';
import {Link} from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'inline-flex items-center px-1 border-b-2 border-indigo-600 text-sm font-medium leading-5 text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
        : 'inline-flex items-center px-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 text-gray-400 focus:outline-none focus:text-gray-300 focus:border-gray-700 transition duration-150 ease-in-out',
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot/>
    </Link>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>

<template>
    <AuthenticatedLayout title="Dashboard">
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-100">
                        You're logged in!
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

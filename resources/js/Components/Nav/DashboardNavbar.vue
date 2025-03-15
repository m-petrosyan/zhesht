<script setup>

import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import {Link} from "@inertiajs/vue3";
</script>

<template>
    <nav
        class="bg-white dark:border-gray-700 dark:bg-gray-800"
    >
        <!-- Primary Navigation Menu -->
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 justify-between">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex shrink-0 items-center">
                        <Link :href="route('db.event.index')">
                            <img src="/images/logo.png" width="100" alt="logo"/>
                        </Link>
                    </div>

                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <!--                        <NavLink-->
                        <!--                            :href="route('db.dashboard')"-->
                        <!--                            :active="route().current('db.dashboard')">-->
                        <!--                            Dashboard-->
                        <!--                        </NavLink>-->
                        <NavLink
                            :href="route('db.event.index')"
                            :active="route().current('db.event.index')">
                            Event
                        </NavLink>
                        <NavLink
                            :href="route('db.subscribers.index')"
                            :active="route().current('db.subscribers.index')">
                            Subscribers
                        </NavLink>
                        <NavLink
                            :href="route('db.settings.create')"
                            :active="route().current('db.settings.create')">
                            Settings
                        </NavLink>
                    </div>
                </div>

                <div class="hidden sm:ms-6 sm:flex sm:items-center">
                    <div class="relative ms-3">
                        <DropdownLink
                            :href="route('db.logout')"
                            method="post"
                            as="button"
                        >
                            Log Out
                        </DropdownLink>
                    </div>
                </div>

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button
                        @click="
                                    showingNavigationDropdown =
                                        !showingNavigationDropdown
                                "
                        class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none dark:text-gray-500 dark:hover:bg-gray-900 dark:hover:text-gray-400 dark:focus:bg-gray-900 dark:focus:text-gray-400"
                    >
                        <svg
                            class="h-6 w-6"
                            stroke="currentColor"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <path
                                :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex':
                                                !showingNavigationDropdown,
                                        }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path
                                :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex':
                                                showingNavigationDropdown,
                                        }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div
            :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
            class="sm:hidden"
        >
            <div class="space-y-1 pb-3 pt-2">
                <ResponsiveNavLink
                    :href="route('db.dashboard')"
                    :active="route().current('db.dashboard')"
                >
                    Dashboard
                </ResponsiveNavLink>
            </div>

            <!-- Responsive Settings Options -->
            <div
                class="border-t border-gray-200 pb-1 pt-4 dark:border-gray-600"
            >
                <div class="px-4">
                    <div
                        class="text-base font-medium text-gray-800 dark:text-gray-200"
                    >
                        {{ $page.props.auth.user.name }}
                    </div>
                    <div class="text-sm font-medium text-gray-500">
                        {{ $page.props.auth.user.email }}
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <ResponsiveNavLink
                        :href="route('db.logout')"
                        method="post"
                        as="button"
                    >
                        Log Out
                    </ResponsiveNavLink>
                </div>
            </div>
        </div>
    </nav>
</template>

<style scoped lang="scss">

</style>

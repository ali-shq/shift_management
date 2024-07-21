<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import NavigationDrawer from "@/Components/NavigationDrawer.vue";

import { Head, Link } from "@inertiajs/vue3";
import { ref } from "vue";
import HeroSection from "./Guest-Pages/HeroSection.vue";
defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
let drawerOpen = ref(false);
function toggleDrawer() {
    drawerOpen.value = !drawerOpen.value;
}
</script>

<template>
    <Head title="ShiftFacile - Easy Scheduling, Happy Team" />

    <div class="bg-gray-100">
        <div>
            <nav class="fixed w-full border-b border-gray-100 bg-white">
                <!-- Primary Navigation Menu -->
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 items-center justify-between">
                        <!-- Logo -->
                        <div class="flex-shrink-0">
                            <Link>
                                <ApplicationLogo class="block h-9 w-auto" />
                            </Link>
                        </div>
                        <!-- Navigation Links -->
                        <div
                            class="ml-auto hidden md:flex md:items-center md:space-x-4"
                        >
                            <a
                                href="#"
                                class="text-gray-700 hover:text-gray-900"
                                >Home</a
                            >
                            <a
                                href="#about"
                                class="text-gray-700 hover:text-gray-900"
                                >About</a
                            >
                            <a
                                href="#services"
                                class="text-gray-700 hover:text-gray-900"
                                >Services</a
                            >
                            <a
                                href="#contact"
                                class="text-gray-700 hover:text-gray-900"
                                >Contact</a
                            >
                        </div>

                        <!-- Navigation Links -->
                        <div class="flex items-center space-x-4">
                            <div
                                v-if="canLogin"
                                class="hidden p-6 text-right md:block"
                            >
                                <Link
                                    v-if="$page.props.auth.user"
                                    :href="route('dashboard')"
                                    class="font-semibold text-gray-600 hover:text-gray-900 focus:rounded-sm focus:outline focus:outline-2 focus:outline-green-500 dark:text-green-400 dark:hover:text-black"
                                    >Dashboard</Link
                                >

                                <template v-else>
                                    <Link
                                        :href="route('login')"
                                        class="hidden rounded p-2 font-semibold text-gray-600 outline hover:text-gray-900 focus:rounded-sm focus:outline focus:outline-2 focus:outline-fontColorPrimary md:inline-block dark:text-fontColorPrimary dark:hover:text-fontColorSecondary"
                                        >Log in</Link
                                    >
                                </template>
                            </div>
                        </div>

                        <NavigationDrawer
                            :isOpen="drawerOpen"
                            @toggle-drawer="toggleDrawer"
                        />
                    </div>
                </div>
            </nav>
        </div>
        <!-- hero section -->

        <div><HeroSection /></div>
    </div>
</template>

<style scoped></style>

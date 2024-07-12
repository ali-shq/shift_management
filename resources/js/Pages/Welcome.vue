<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import NavigationDrawer from '@/Components/NavigationDrawer.vue';

import { Head, Link } from "@inertiajs/vue3";
import { ref} from 'vue'
import HeroSection from "./Guest-Pages/HeroSection.vue";
defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
let drawerOpen = ref(false);
function toggleDrawer(){
    drawerOpen.value = !drawerOpen.value;
}
</script>

<template>
    <Head title="ShiftFacile - Easy Scheduling, Happy Team" />

    <div class="bg-gray-100">
        <div >
            <nav class="fixed w-full border-b border-gray-100 bg-white">
                <!-- Primary Navigation Menu -->
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 justify-between">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex shrink-0 items-center">
                                <Link>
                                    <ApplicationLogo class="block h-9 w-auto" />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div
                                v-if="canLogin"
                                class="z-10 p-6 text-right sm:fixed sm:right-0 sm:top-0"
                            >
                                <Link
                                    v-if="$page.props.auth.user"
                                    :href="route('dashboard')"
                                    class="font-semibold text-gray-600 hover:text-gray-900 focus:rounded-sm focus:outline focus:outline-2 focus:outline-green-500 dark:text-green-400 dark:hover:text-black"
                                    >Dashboard</Link
                                >

                                <template v-else>
                                    <!-- <button
                                        class="group mb-2 me-2 items-center justify-center overflow-hidden rounded-lg bg-gradient-to-br from-green-400 to-blue-600 p-0.5 text-sm font-medium text-gray-900 hover:text-white focus:outline-none focus:ring-4 focus:ring-green-200 group-hover:from-green-400 group-hover:to-blue-600 dark:text-white dark:focus:ring-green-800"
                                    >
                                        <span
                                            class="relative rounded-md bg-white px-5 py-2.5 transition-all duration-75 ease-in group-hover:bg-opacity-0 dark:bg-gray-900"
                                        >
                                            Let's Talk
                                        </span>
                                    </button> -->
                                    <Link
                                        :href="route('login')"
                                        class="rounded p-2 font-semibold text-gray-600 outline hover:text-gray-900 focus:rounded-sm focus:outline focus:outline-2 focus:outline-fontColorPrimary dark:text-fontColorPrimary dark:hover:text-fontColorSecondary"
                                        >Log in</Link
                                    >

                                    <!-- <Link
                                        v-if="canRegister"
                                        :href="route('register')"
                                        class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:rounded-sm focus:outline focus:outline-2 focus:outline-red-500 dark:text-green-400 dark:hover:text-black"
                                        >Register</Link
                                    > -->
                                </template>
                            </div>

                            <div>
    <NavigationDrawer :isOpen="drawerOpen" @toggle-drawer="toggleDrawer" />
    <button @click="toggleDrawer" class="p-4 bg-blue-500 text-white">Toggle Drawer</button>
  </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- hero section -->

        <div > <HeroSection /></div>
    </div>

    <!-- <div
        class="relative min-h-screen bg-center selection:bg-green-500 selection:text-white sm:flex sm:items-center sm:justify-center"
    >
        <div
            v-if="canLogin"
            class="z-10 p-6 text-right sm:fixed sm:right-0 sm:top-0"
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
                    class="font-semibold text-gray-600 hover:text-gray-900 focus:rounded-sm focus:outline focus:outline-2 focus:outline-green-500 dark:text-green-400 dark:hover:text-black"
                    >Log in</Link
                >

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:rounded-sm focus:outline focus:outline-2 focus:outline-red-500 dark:text-green-400 dark:hover:text-black"
                    >Register</Link
                >
            </template>
        </div>

        <div class="mx-auto max-w-7xl p-6 lg:p-8">
            <ApplicationLogo />
        </div>
    </div> -->
</template>

<style></style>

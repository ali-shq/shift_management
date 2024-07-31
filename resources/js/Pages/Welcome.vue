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
const links = ref([
    { name: "Home", href: "#", active: true },
    { name: "About", href: "#about", active: false },
    { name: "Services", href: "#services", active: false },
    { name: "Contact", href: "#contact", active: false },
]);
let drawerOpen = ref(false);

function setActiveLink(selectedLink) {
      links.value.forEach(link => {
        link.active = (link === selectedLink);
      });
    }
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
                                v-for="link in links"
                                :key="link.name"
                                :href="link.href"
                                :class="[
                                    'nav-link',
                                    link.active
                                        ? 'text-fontColorPrimary focus:outline-none focus:border-fontColorPrimary transition duration-150 ease-in-out'
                                        : 'text-gray-700'
                                    
                                ]"
                                @click="setActiveLink(link)"
                            >
                                {{ link.name }}
                            </a>
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
                                        class="hidden animate-shake-slow-repeat mb-3 md:inline-flex items-center justify-center rounded-lg bg-fontColorPrimary bg-gradient-to-r from-fontColorPrimary to-fontColorSecondary px-5 py-3 text-center text-base font-medium text-white hover:bg-fontColorSecondary focus:ring-4 focus:ring-primary-300 sm:mb-0 sm:mr-3 dark:focus:ring-fontColorPrimary"
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

<style scoped>
.nav-link {
    transition: color 0.3s;
}
</style>

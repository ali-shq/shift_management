<script setup>
import { Head, Link } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="ShiftFacile" />

    <div
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
    </div>
</template>

<style>
.bg-dots-darker {
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
    }
}
</style>

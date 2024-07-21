<script setup>
import HeroSectionIcon from "@/Components/icon-components/HeroSectionIcon.vue";
import { Link } from "@inertiajs/vue3";
</script>
<template>
    <!-- hero section goes here -->
    <section class="bg-custom-image bg-cover bg-center  h-screen">
        <div
            class="mx-auto grid h-full max-w-screen-xl px-4 py-8 lg:grid-cols-12 lg:gap-8 lg:py-16 xl:gap-0"
        >
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1
                    class="animate-fade-in-right mb-4 max-w-2xl py-4 text-4xl font-extrabold leading-none tracking-tight sm:text-5xl xl:text-6xl dark:text-fontColorPrimary"
                >
                    Employee scheduling tool for your business
                </h1>
                <p
                    class="animate-fade-in-left mb-6 max-w-2xl font-light text-fontColorThird md:text-lg lg:mb-8 lg:text-xl dark:text-fontColorThird"
                >
                    From scheduling to complex adjustments and employee fair
                    assign, ShiftFacile comes to help you.
                </p>
                <div class="flex flex-col sm:flex-row">
                    <Link
                        :href="route('login')"
                        class="animate-shake-slow-repeat mb-3 inline-flex items-center justify-center rounded-lg bg-fontColorPrimary bg-gradient-to-r from-fontColorPrimary to-fontColorSecondary px-5 py-3 text-center text-base font-medium text-white hover:bg-fontColorSecondary focus:ring-4 focus:ring-primary-300 sm:mb-0 sm:mr-3 dark:focus:ring-fontColorPrimary "
                    >
                        Get started
                        <svg
                            class="-mr-1 ml-2 h-5 w-5"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a 1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a 1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </Link>
                </div>
            </div>
            <div class="hidden pt-8 lg:col-span-5 lg:mt-0 lg:flex">
                <HeroSectionIcon />
            </div>
        </div>
    </section>
</template>

<style scoped></style>

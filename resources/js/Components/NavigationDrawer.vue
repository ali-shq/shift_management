<script>
import { Link } from "@inertiajs/vue3";
export default {
    props: {
        isOpen: {
            type: Boolean,
            required: true,
        },
    },
    methods: {
        toggleDrawer() {
            this.$emit("toggle-drawer");
        },
    },
};
</script>
<template>
     <button @click="toggleDrawer" class="p-2" >
      <!-- Icon for the menu (you can replace it with any icon you prefer) -->
      <svg v-if="!isDrawerOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
      </svg>
      <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
    <!-- <div
        :class="{ block: isOpen, hidden: !isOpen }"
        class="fixed inset-0 z-50 flex"
    >
    
        <div
            class="fixed inset-0 bg-gray-600 opacity-75"
            @click="toggleDrawer"
        ></div>
        
        <div class="relative w-64 bg-white">
            <div class="absolute right-0 top-0 -mr-12 pt-2">
                <button
                    class="ml-1 flex h-10 w-10 items-center justify-center rounded-full focus:bg-gray-600 focus:outline-none"
                    @click="toggleDrawer"
                >
                    <svg
                        class="h-6 w-6 text-white"
                        stroke="currentColor"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>
            <nav class="mt-5">
                <Link
                    :href="route('login')"
                    class="mt-2 block rounded-lg bg-gray-200 px-4 py-2 text-sm font-semibold hover:bg-gray-300"
                    >Log in
                </Link>
            </nav>
        </div>
    </div> -->
</template>

<style scoped></style>

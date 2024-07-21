<!-- src/components/NavigationDrawer.vue -->
<template>
    <div>
        <!-- Mobile Menu Icon -->
        <div class="block p-4 md:hidden">
            <svg
                @click="toggleDrawer"
                class="h-6 w-6 cursor-pointer"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"
                ></path>
            </svg>
        </div>

        <!-- Navigation Drawer -->
        <div
            v-show="isOpen"
            class="fixed inset-0 z-50 transform bg-gray-800 bg-opacity-75 transition-transform duration-300 ease-in-out"
            @click.self="toggleDrawer"
        >
            <div class="relative h-full w-64 bg-white p-4">
                <button @click="toggleDrawer" class="absolute right-4 top-4">
                    <svg
                        class="h-6 w-6 text-gray-700"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        ></path>
                    </svg>
                </button>
                <h2 class="mb-4 text-xl font-bold">Navigation</h2>
                <ul>
                    <li class="mb-2">
                        <a href="#" class="text-gray-700">Home</a>
                    </li>
                    <li class="mb-2">
                        <a href="#about" class="text-gray-700">About</a>
                    </li>
                    <li class="mb-2">
                        <a href="#services" class="text-gray-700">Services</a>
                    </li>
                    <li class="mb-2">
                        <a href="#contact" class="text-gray-700">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isOpen: false,
        };
    },
    methods: {
        toggleDrawer() {
            this.isOpen = !this.isOpen;
            if (this.isOpen) {
                document.addEventListener("click", this.handleClickOutside);
            } else {
                document.removeEventListener("click", this.handleClickOutside);
            }
        },
        handleClickOutside(event) {
            const drawer = this.$refs.drawer;
            if (drawer && !drawer.contains(event.target)) {
                this.isOpen = false;
                document.removeEventListener("click", this.handleClickOutside);
            }
        },
    },
    mounted() {
        document.addEventListener("click", (event) => {
            if (!this.$el.contains(event.target)) {
                this.isOpen = false;
            }
        });
    },
    beforeUnmount() {
        document.removeEventListener("click", this.handleClickOutside);
    },
};
</script>

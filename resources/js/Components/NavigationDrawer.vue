<template>
    <div :class="{ 'block': isOpen, 'hidden': !isOpen }" class="fixed inset-0 z-50 flex">
      <div class="fixed inset-0 bg-gray-600 opacity-75" @click="toggleDrawer"></div>
      <div class="relative bg-white w-64">
        <div class="absolute top-0 right-0 -mr-12 pt-2">
          <button class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:bg-gray-600" @click="toggleDrawer">
            <svg class="h-6 w-6 text-white" stroke="currentColor" fill="none" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>
        <nav class="mt-5">
          <a href="#" class="block px-4 py-2 mt-2 text-sm font-semibold bg-gray-200 rounded-lg hover:bg-gray-300">Home</a>
          <a href="#" class="block px-4 py-2 mt-2 text-sm font-semibold bg-gray-200 rounded-lg hover:bg-gray-300">About</a>
          <a href="#" class="block px-4 py-2 mt-2 text-sm font-semibold bg-gray-200 rounded-lg hover:bg-gray-300">Services</a>
          <a href="#" class="block px-4 py-2 mt-2 text-sm font-semibold bg-gray-200 rounded-lg hover:bg-gray-300">Contact</a>
        </nav>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      isOpen: {
        type: Boolean,
        required: true,
      },
    },
    methods: {
      toggleDrawer() {
        this.$emit('toggle-drawer');
      },
    },
  };
  </script>
  
  <style scoped>
  </style>
  
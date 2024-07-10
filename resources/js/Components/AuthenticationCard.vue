<template>
    <div
        class="flex min-h-screen flex-col items-center p-2  bg-gray-100 pt-6 sm:justify-center sm:pt-0"
    >
        <div class="p-6">
            <slot name="logo" />
        </div>

        <div
            class=" mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>

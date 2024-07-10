<script setup>
defineProps({
    type: {
        type: String,
        default: "submit",
    },
});
</script>

<template>
    <button
        :type="type"
        class="my-8 block w-full items-center rounded-md border border-transparent bg-fontColorPrimary px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-fontColorSecondary focus:bg-fontColorSecondary focus:outline-none focus:ring-2 focus:ring-fontColorSecondary focus:ring-offset-2 active:bg-fontColorSecondary"
    >
        <slot />
    </button>
</template>

<script setup>
import { onMounted, ref } from "vue";

const model = defineModel();

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        ref="input"
        class="rounded-md border-gray-300 shadow-sm focus:border-fontColorPrimary focus:ring-fontColorSecondary"
        v-model="model"
    />
</template>

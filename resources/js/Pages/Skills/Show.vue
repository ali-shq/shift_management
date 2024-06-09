<template>
    <Head>
        <link rel="canonical" :href="skill.routes.show" />
    </Head>
    <AppLayout :title="skill.name">
        <Container>
            <PageHeading class="mt-2">{{ skill.name }}</PageHeading>
            <span class="mt-1 block text-sm text-gray-600">{{ skill.description }}</span>
            <span class="mt-1 block text-sm text-gray-600">{{ skill.created_at }}</span>
            
            <Link
                        :href="route('skills.edit', skill.id)"
                        class="group block px-2 py-4"
                    >
                    <button class="font-mono text-xs hover:font-semibold">
                        Edit
                    </button>
                </Link>
                <form
                    @submit.prevent="deleteSkill"
                >
                    <button
                        class="font-mono text-xs text-red-700 hover:font-semibold"
                    >
                        Delete
                    </button>
                </form>
        </Container>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Container from "@/Components/Container.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import PageHeading from "@/Components/PageHeading.vue";

const form = useForm({
});


const props = defineProps(["skill"]);
const deleteSkill = () => form.delete(route("skills.destroy", props.skill.id));
// const emit = defineEmits(["edit", "delete"]);

</script>

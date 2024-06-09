<template>
    <AppLayout title="Edit Skill">
        <Container>
            <PageHeading>Edit Skill {{ props.skill.name }}</PageHeading>

            <form @submit.prevent="updateSkill" class="mt-6">
                <div>
                    <InputLabel for="name" class="sr-only">Name</InputLabel>
                    <TextInput
                        id="name"
                        class="w-full"
                        v-model="form.name"
                        placeholder="Give it a great name…"
                    />
                    <InputError :message="form.errors.name" class="mt-1" />
                </div>

                <!-- <div class="mt-3">
                    <InputLabel for="topic_id">Select a Topic</InputLabel>
                    <select v-model="form.topic_id" id="topic_id" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option v-for="topic in topics" :key="topic.id" :value="topic.id">
                            {{ topic.name }}
                        </option>
                    </select>
                    <InputError :message="form.errors.topic_id" class="mt-1" />
                </div> -->

                <div class="mt-3">
                    <InputLabel for="description" class="sr-only">Description</InputLabel>
                    <TextInput
                        id="description"
                        class="w-full"
                        v-model="form.description"
                        placeholder="Add some more detail…"
                    />
                    <InputError :message="form.errors.description" class="mt-1" />
                </div>

                <div class="mt-3">
                    <PrimaryButton type="submit">Edit Skill</PrimaryButton>
                </div>
            </form>
        </Container>
    </AppLayout>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import TextArea from "@/Components/TextArea.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Container from "@/Components/Container.vue";
import MarkdownEditor from "@/Components/MarkdownEditor.vue";
import { isInProduction } from "@/Utilities/environment.js";
import PageHeading from "@/Components/PageHeading.vue";

const props = defineProps(['skill']);

const form = useForm({
    name: props.skill.name,
    // topic_id: props.topics[0].id,
    description: props.skill.description,
});

const updateSkill = () => form.put(route("skills.update", props.skill.id));

</script>

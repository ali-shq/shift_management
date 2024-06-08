<template>
    <AppLayout>
        <Container>
            <div>
                <PageHeading
                    v-text="'All Skills'"
                />
                <menu class="flex space-x-1 mt-3 overflow-x-auto pb-2 pt-1">
                </menu>

                <form @submit.prevent="search" class="mt-4">
                    <div>
                        <InputLabel for="query">Search</InputLabel>
                        <div class="flex space-x-2 mt-1">
                            <TextInput v-model="searchForm.query" class="w-full" id="query"/>
                            <SecondaryButton type="submit">Search</SecondaryButton>
                            <DangerButton v-if="searchForm.query" @click="clearSearch">Clear</DangerButton>
                        </div>
                    </div>
                </form>
            </div>
            <ul class="mt-4 divide-y">
                <li
                    v-for="skill in skills.data"
                    :key="skill.id"
                    class="flex flex-col items-baseline justify-between md:flex-row"
                >
                    <Link
                        :href="skill.routes.show"
                        class="group block px-2 py-4"
                    >
                        <span
                            class="text-lg font-bold group-hover:text-indigo-500"
                        >{{ skill.name }}</span
                        >
                        <span
                            class="block pt-1 text-sm text-gray-600 first-letter:uppercase"
                        >{{ formattedDate(skill) }}
                        </span>
                    </Link>
                </li>
            </ul>

            <Pagination :meta="skills.meta" :only="['skills']" class="mt-2"/>
        </Container>
    </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Container from "@/Components/Container.vue";
import Pagination from "@/Components/Pagination.vue";
import {Link, useForm, usePage} from "@inertiajs/vue3";
import {relativeDate} from "@/Utilities/date.js";
import PageHeading from "@/Components/PageHeading.vue";
import Pill from "@/Components/Pill.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";


const formattedDate = (skill) => relativeDate(skill.created_at);

const searchForm = useForm({
    query: props.query,
    page: 1,
});

const page = usePage();
const search = () => searchForm.get(page.url);
const clearSearch = () => {
    searchForm.query = '';
    search();
};
</script>

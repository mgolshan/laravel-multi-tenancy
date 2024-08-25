<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Dropdown from '@/Components/Dropdown.vue';
import {Head, useForm} from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps<{
    task?: object;
    projects: object;
}>();

const form = useForm({
    name: props.task?.name || '',
    project_id: props.task?.project_id || 0,
});

function getProjectName(id) {
    return props.projects.find((project) => project.id === id)?.name || 'Unknown Project';
}

const Heading = props.task ? `Update the task ID #${props.task.id}` : "Create new task";
</script>

<template>
    <Head :title="Heading" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ Heading }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <form @submit.prevent="task ? form.put(route('tasks.update', task.id)) : form.post(route('tasks.store'))" class="mt-6 space-y-6">
                            <div>
                                <InputLabel for="name" value="Name"/>

                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    required
                                    autofocus
                                    autocomplete="name"
                                />

                                <InputError class="mt-2" :message="form.errors.name"/>
                            </div>

                            <div>
                                <InputLabel for="project_id" value="Project"/>

                                <Dropdown
                                    id="project_id"
                                    class="mt-1 block w-full"
                                    v-model="form.project_id"
                                    required
                                    align="left" width="100"
                                >
                                    <template #trigger>
                                        <div class="relative">
                                            <button type="button"
                                                    class="inline-flex justify-between w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                    id="options-menu" aria-haspopup="true" aria-expanded="true">
                                                <span v-if="!form.project_id">Select Project</span>
                                                <span v-else>{{ getProjectName(form.project_id) }}</span>
                                                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                     fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                          d="M5 8a1 1 0 011.707 0L10 11.293l3.293-3.294a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4A1 1 0 015 8z"
                                                          clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>
                                    </template>
                                    <template #content>
                                        <div class="py-1" role="none">

                                            <button v-for="project in projects" :key="project.id" type="button"
                                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                                    role="menuitem" @click="form.project_id = project.id">
                                                {{ project.name }}
                                            </button>
                                        </div>
                                    </template>
                                </Dropdown>

                                <InputError class="mt-2" :message="form.errors.project_id"/>
                            </div>

                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                                <Transition
                                    enter-active-class="transition ease-in-out"
                                    enter-from-class="opacity-0"
                                    leave-active-class="transition ease-in-out"
                                    leave-to-class="opacity-0"
                                >
                                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                                </Transition>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

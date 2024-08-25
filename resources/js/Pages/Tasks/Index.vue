<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import Button from '@/Components/Button.vue';
import LinkButton from '@/Components/LinkButton.vue';

const form = useForm({
});

defineProps<{
    tasks: object;
}>();

const Heading = "Tasks";
</script>

<template>
    <Head :title="Heading" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ Heading }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <LinkButton :href="route('tasks.create')" added-class="mb-4 float-right">Add new task</LinkButton>
                        <p class="bg-white border-b px-6 py-4 font-medium text-gray-900 whitespace-nowrap" v-if="tasks.length < 1">
                            No tasks found!
                        </p>

                        <table v-else class="w-full text-sm text-left text-gray-500">
                            <thead class="text-sm text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left">
                                    Task name
                                </th>
                                <th scope="col" class="px-6 py-3 text-left">
                                    Project name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Actions
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="bg-white border-b" v-for="task of tasks" :key="task.id">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ task.name }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ task.project.name }}
                                </td>
                                <td class="px-6 py-4">
                                    <LinkButton :href="route('tasks.edit', task)">Edit</LinkButton>
                                    <form @submit.prevent="form.delete(route('tasks.destroy', task.id))" class="inline-block">
                                        <Button class="bg-red-600 ml-2" onclick="return confirm('Are you sure?')">Delete</Button>
                                    </form>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

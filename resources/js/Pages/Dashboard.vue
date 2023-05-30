<script setup>
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

// Layouts
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ModalProject from './Dashboard/ModalProject.vue';

// Components
import Card from '@/Components/Card.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    projects: { type: Object },
    workflowTemplates: { type: Object }
});

const projectModal = ref(false);

const toggleProjectModal = () => {
    projectModal.value = !projectModal.value;
}

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <ModalProject 
            :open-modal="projectModal" 
            :close-modal="toggleProjectModal"
            :templates="props.workflowTemplates"/>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col gap-5">
                    <div class="flex w-full gap-6">
                        <Card class="grow">
                            This part is supposed to show the user's task that has the nearest due date
                        </Card>
                        <PrimaryButton v-on:click="toggleProjectModal">
                            New Project
                        </PrimaryButton>
                    </div>
                    
                    <Card 
                        v-if="props.projects.length"
                        class="uppercase text-center text-green-innoscripta font-extrabold text-xl">
                        Your Active Projects
                    </Card>
                    <Card 
                        v-else 
                        class="bg-green-innoscripta text-center text-white font-extrabold text-xl opacity-50">
                        Oops . . . You do not have any active projects yet
                    </Card>

                    <div class="grid grid-cols-2 gap-3">
                        <Card v-for="project in projects" class="shadow">
                            <div class="flex flex-col gap-2">
                                <p class="font-extrabold">
                                    {{ project.name }}
                                </p>
                                <div class="flex flex-col gap-2">
                                    <p class="text-sm text-gray-400">Description</p>
                                    {{ project.description }}
                                </div>
                                <div class="flex gap-1 text-sm text-gray-400">
                                    Created at
                                    <div>
                                        {{ new Date(project.created_at)
                                            .toLocaleDateString(
                                                'en-DE',
                                                {
                                                    day: '2-digit',
                                                    month: 'long',
                                                    year: 'numeric'
                                                }
                                            ) 
                                        }}
                                    </div>
                                </div>
                            </div>
                        </Card>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

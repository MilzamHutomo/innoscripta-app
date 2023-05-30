<script setup>
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

// Layouts
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ModalWorkflowTemplate from './Home/ModalWorkflowTemplate.vue';

// Components
import Card from '@/Components/Card.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    workflowTemplates: { type: Object }
});

const workflowTemplateModal = ref(false);

const openWorkflowTemplateCreator = () => {
    workflowTemplateModal.value = !workflowTemplateModal.value
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <ModalWorkflowTemplate 
            :open-modal="workflowTemplateModal"
            :close-modal="openWorkflowTemplateCreator"/>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col gap-5">
                    <div class="flex flex-col sm:flex-row gap-3 w-full font-bold text-green-innoscripta cursor-default">
                        <Card class="flex flex-col gap-4 items-center grow">
                            <p>Number of Manager</p>
                            <p class="text-2xl">{{ $page.props.countManager }}</p>
                        </Card>
                        <Card class="flex flex-col gap-4 items-center grow">
                            <p>Number of Representative</p>
                            <p class="text-2xl">{{ $page.props.countRepresentative }}</p>
                        </Card>
                    </div>

                    <Card class="flex justify-between text-green-innoscripta text-center font-extrabold text-2xl">
                        <p>WORKFLOW TEMPLATES</p>
                        <PrimaryButton v-on:click="openWorkflowTemplateCreator">
                            Create
                        </PrimaryButton>
                    </Card>

                    <div class="flex flex-col gap-3">
                        <Card v-if="props.workflowTemplates.length === 0" 
                            class="bg-red-200 text-red-800 text-center font-extrabold text-lg">
                            YOU DO NOT HAVE ANY WORKFLOW TEMPLATE
                        </Card>

                        <Card 
                            v-else 
                            v-for="template in props.workflowTemplates"
                            class="flex justify-between items-center">
                            <div class="flex flex-col items-start gap-1">
                                <p class="font-bold">
                                    {{ template.name }}
                                </p>
                                <div 
                                    v-if="template.is_active" 
                                    class="bg-green-500 px-2 py-1 rounded font-bold text-sm text-white">
                                    ACTIVE
                                </div>
                                <div
                                    v-else
                                    class="bg-red-500 px-2 py-1 rounded font-bold text-sm text-white">
                                    INACTIVE
                                </div>
                            </div>
                            <div class="flex flex-col items-end gap-1">
                                <p>Created at</p>
                                <p>
                                    {{ new Date(template.created_at).toLocaleDateString('en-DE', {
                                        day: '2-digit',
                                        month: 'long',
                                        year: 'numeric'
                                    }) }}
                                </p>
                            </div>
                        </Card>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

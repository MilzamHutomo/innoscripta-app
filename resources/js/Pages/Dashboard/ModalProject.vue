<script setup>
import { router } from '@inertiajs/core';
import { ref } from 'vue';

// Components
import Card from '@/Components/Card.vue';
import DangerButton from '@/Components/DangerButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import NewModal from '@/Components/NewModal.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    openModal: { type: Boolean },
    closeModal: { type: Function },
    templates: { type: Object }
});

const name = ref('');
const description = ref('');
const template = ref(props.templates[0].id);
const boards = ref(props.templates[0].boards);

const projectTemplateChange = (event) => {
    template.value = event.target.value

    props.templates.forEach(element => {
        if (element.id == template.value) {
            boards.value = element.boards;
        }
    });
}

const clearValue = () => {
    name.value = '';
    description.value = '';
    template.value = 0;
    boards.value = props.templates[0].boards;

    props.closeModal();
}

const createProject = (event) => {
    router.post(route('project.store'), {
        name: name.value,
        description: description.value,
        workflow_template_id: template.value
    }, {
        onBefore: () => event.target.disabled = true,
        onFinish: () => clearValue()
    });
}

</script>

<template>
    <NewModal :show="props.openModal" :close="props.closeModal">
        <div class="flex flex-col gap-3">
            <div class="flex flex-col gap-2">
                <InputLabel value="Project's Name" />
                <TextInput
                    v-model="name" 
                    type="text" 
                    placeholder="Good project begins with a good name . . ." />
            </div>
            <div class="flex flex-col gap-2"> 
                <InputLabel value="Description" />
                <textarea 
                    v-model="description"
                    placeholder="Small notes just in case you confused what project is this . . ."
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm resize-y"/>
            </div>
            <div class="flex flex-col gap-2"> 
                <InputLabel value="Workflow Template" />
                <select
                    v-on:change="projectTemplateChange($event)"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm resize-y">
                    <option v-for="template in props.templates" :value="template.id">
                        {{ template.name }}
                    </option>
                </select>
            </div>
            <Card :backgroundColor="`bg-gray-200`">
                Board you will use in this template:
                <div class="flex flex-col gap-1">
                    <div v-for="board, key in boards" class="rounded bg-gray-300 w-fit px-2 py-1">
                        {{ key+1 + ') ' + board.name }}
                    </div>
                </div>
            </Card>
            <div class="flex gap-4 justify-center">
                <DangerButton v-on:click="clearValue">
                    Cancel
                </DangerButton>
                <PrimaryButton v-on:click="createProject($event)"
                    class="disabled:opacity-50 disabled:pointer-events-none"
                    :disabled="!name || !template">
                    Create
                </PrimaryButton>
            </div>
        </div>
    </NewModal>
</template>
<script setup>
import { router } from '@inertiajs/core';
import { ref } from 'vue';
import draggable from 'vuedraggable';

// Components
import InputLabel from '@/Components/InputLabel.vue';
import NewModal from '@/Components/NewModal.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

// Icons
import Trash from '@/Icons/Trash.vue';

const props = defineProps({
    openModal: { type: Boolean },
    closeModal: { type: Function }
});

const isDragging = ref(false);

const name = ref('');
const board = ref('');

const workflowBoards = ref([]);

const addBoard = () => {
    workflowBoards.value.push(board.value);

    board.value = '';
}

const deleteBoard = (name) => {
    const index = workflowBoards.value.indexOf(name);

    workflowBoards.value.splice(index, 1);
}

const watchEnterKey = (event) => {
    if (event.key === 'Enter') {
        addBoard();
    }
}

const clearValue = () => {
    name.value = '';
    board.value = '';

    workflowBoards.value = [];

    props.closeModal();
}

const createTemplate = () => {
    router.post(route('workflow-template.store'), {
        name: name.value,
        boards: workflowBoards.value
    }, {
        onFinish: () => {
            clearValue();
        }
    });
}
</script>

<template>
    <NewModal :show="props.openModal" :close="props.closeModal">
        <div class="flex flex-col gap-3">
            <h4 class="font-bold text-center">New Workflow Template</h4>

            <div class="flex flex-col gap-2">
                <InputLabel value="Template Name" />
                <TextInput 
                    v-model="name"
                    type="text" 
                    placeholder="Give your template a name . . ."/>
            </div>
            <div class="flex flex-col gap-2">
                <InputLabel value="Workflow Board" />
                <div class="flex gap-3">
                    <TextInput 
                        v-model="board"
                        v-on:keypress="watchEnterKey($event)"
                        class="grow"
                        type="text" 
                        placeholder="Type your workflow process . . ."/>
                    <PrimaryButton 
                        v-on:click="addBoard"
                        class="disabled:opacity-50 disabled:pointer-events-none"
                        :disabled="!board">
                        Add
                    </PrimaryButton>
                </div>
            </div>
            <draggable
                :component-data="{
                    tag: 'ul',
                    type: 'transition-group',
                    name: !isDragging ? 'flip-list' : null
                }"
                v-model="workflowBoards"
                @start="isDragging = true"
                @end="isDragging = false">
                <template #item="{ element }">
                    <div 
                        class="bg-slate-200 rounded p-1 text-center mb-3 font-bold text-lg
                            flex items-center gap-3" 
                        :class="isDragging ? 'cursor-grabbing' : 'cursor-grab'">
                        <div class="grow">
                            {{ element }}
                        </div>
                        <div
                            v-on:click="deleteBoard(element)"
                            class="cursor-pointer hover:text-red-500">
                            <Trash class="h-5"/>
                        </div>
                    </div>
                </template>
            </draggable>
            <div class="flex gap-4 justify-center w-full">
                <PrimaryButton 
                    v-on:click="clearValue"
                    class="bg-red-500">
                    Cancel
                </PrimaryButton>
                <PrimaryButton 
                    v-on:click="createTemplate"
                    class="bg-green-innoscripta disabled:opacity-50 disabled:pointer-events-none"
                    :disabled="!name || !workflowBoards.length">
                    Create
                </PrimaryButton>
            </div>
        </div>
    </NewModal>
</template>
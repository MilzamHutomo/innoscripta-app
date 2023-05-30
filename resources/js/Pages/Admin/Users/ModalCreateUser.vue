<script setup>
import { router } from '@inertiajs/core';
import { ref } from 'vue';

// Components
import InputLabel from '@/Components/InputLabel.vue';
import NewModal from '@/Components/NewModal.vue';
import TextInput from '@/Components/TextInput.vue';
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    openModal: { type: Boolean },
    closeModal: { type: Function },
    roles: { type: Array }
});

const name = ref('');
const email = ref('');
const role = ref(props.roles[1]);

const roleChange = (event) => {
    role.value = event.target.value;
}

const clearValue = () => {
    name.value = '';
    email.value = '';

    role.value = props.roles[1];

    props.closeModal();
}

const createUser = (event) => {
    router.post(route('admin.user.store'), {
        name: name.value,
        email: email.value,
        role: role.value
    }, {
        onBefore: () => event.target.disabled = true,
        onFinish: () => {
            event.target.disabled = false;
            clearValue();
        }
    });
}
</script>

<template>
    <NewModal :show="props.openModal" :close="clearValue">
        <div class="flex flex-col gap-5">
            <div class="flex flex-col gap-1">
                <InputLabel value="Name" />
                <TextInput v-model="name" type="text" placeholder="Give the user a name . . ." />
            </div>
            <div class="flex flex-col gap-1">
                <InputLabel value="Email" />
                <TextInput v-model="email" type="email" placeholder="What is the email of your user? . . ." />
            </div>
            <div class="flex flex-col gap-1">
                <InputLabel value="User's Role" />
                <select
                    v-on:change="roleChange($event)"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option 
                        v-for="role in props.roles" 
                        :value="role" >
                        {{ role }}
                    </option>
                </select>
            </div>
            <div class="flex justify-center gap-5">
                <DangerButton v-on:click="clearValue">
                    Cancel
                </DangerButton>
                <PrimaryButton 
                    v-on:click="createUser($event)"
                    class="disabled:opacity-50 disabled:pointer-events-none"
                    :disabled="!name || !email">
                    Create
                </PrimaryButton>
            </div>
        </div>
    </NewModal>
</template>
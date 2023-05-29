<script setup>
import { Head, useForm } from '@inertiajs/vue3';

// Layouts
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Card from '@/Components/Card.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    roles: { type: Array },
    user: { type: Object }
});

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    role: props.user.role
});

const userRoleChange = (event) => {
    form.role = event.target.value;
}
</script>

<template>
    <Head :title="user.name" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ props.user.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form 
                    @submit.prevent="form.put(route('admin.user.update', {user: props.user.id}))" 
                    class="flex flex-col gap-3 items-center">
                    <Card class="flex flex-col gap-3 w-full md:w-3/4 lg:w-1/2">
                        <div class="w-full">
                            <InputLabel value="Account Name" />
                            <TextInput 
                                v-model="form.name"
                                class="w-full"
                                type="text" />
                        </div>
                        <div class="w-full">
                            <InputLabel value="Registered Email" />
                            <TextInput 
                                v-model="form.email"
                                class="w-full"
                                type="text" />
                        </div>
                        <div class="w-full">
                            <InputLabel value="Account Role" />
                            <select 
                                v-on:change="userRoleChange($event)"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full text-center">
                                <option disabled selected>Select Account Role</option>
                                <option 
                                    v-for="role in props.roles" 
                                    :selected="props.user.role === role"
                                    :value="role">
                                    {{ role }}
                                </option>
                            </select>
                        </div>
                    </Card>
                    <PrimaryButton type="submit" :disabled="form.processing">
                        Update
                    </PrimaryButton>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
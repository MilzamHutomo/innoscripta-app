<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

// Layouts
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

// Components
import Card from '@/Components/Card.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ModalCreateUser from './Users/ModalCreateUser.vue';

const userModal = ref(false);

const toggleUserModal = () => {
    userModal.value = !userModal.value;
}

</script>

<template>
    <Head title="User List" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                User List
            </h2>
        </template>

        <ModalCreateUser 
            :open-modal="userModal" 
            :close-modal="toggleUserModal"
            :roles="$page.props.roles" />

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col gap-3 items-center mx-auto w-full md:w-3/4 lg:w-1/2">
                    <PrimaryButton v-on:click="toggleUserModal" class="w-full">
                        <div class="flex w-full justify-center">
                            Add User
                        </div>
                    </PrimaryButton>
                    <Link 
                        v-for="user in $page.props.users"
                        class="cursor-pointer w-full"
                        :href="route('admin.user.show', {user: user.id})">
                        <Card
                            class="flex gap-3 justify-between hover:bg-gray-200">
                            <p>{{ user.name }}</p>
                            <p>{{ user.email }}</p>
                        </Card>
                    </Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
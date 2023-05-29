<script setup>
import { Head } from '@inertiajs/vue3';

// Layouts
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

// Components
import Card from '@/Components/Card.vue';

</script>

<template>
    <Head title="User List" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                User List
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col gap-3">
                    <Card 
                        v-for="user in $page.props.users"
                        class="flex gap-3 justify-between">
                        <p>{{ user.name }}</p>
                        <p>{{ user.email }}</p>
                    </Card>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
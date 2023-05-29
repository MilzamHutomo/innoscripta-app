<script setup>
import { Head } from '@inertiajs/vue3';

// Layouts
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

// Components
import Card from '@/Components/Card.vue';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col sm:flex-row gap-3">
                    
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

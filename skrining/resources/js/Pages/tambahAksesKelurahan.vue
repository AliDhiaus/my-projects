<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #kelurahan>
            <div class="bg-white shadow p-5">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">kelurahan</h2>
            </div>
        </template>

        <div class="py-12">
            
        </div>
    </AuthenticatedLayout>
</template>

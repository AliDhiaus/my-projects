<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="shadow p-5 mt-5">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
                <img src="https://www.muf.co.id/wp-content/uploads/2024/06/Web-Banner-Sampaikan-pertanyaanmu-dengan-mudah-dan-cepat-02.jpg" class="mt-5">
            </div>
        </template>
    </AuthenticatedLayout>
</template>

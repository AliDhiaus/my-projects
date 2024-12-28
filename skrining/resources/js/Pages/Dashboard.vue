<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #dashboard>
            <div class="bg-white shadow">
                        <div class="bg-gradient-to-r from-green-500 to-blue-500 gap-5 flex flex-col justify-center items-center h-64">
                            <img src="image/logoKesehatan.png" class="w-40" alt="" srcset="">
                            <div class="text-center text-white font-bold">
                                <h1>PUSKESMAS SERANG KOTA</h1>
                                <h3>Selamat Datang Di Aplikasi SINAPZA</h3>
                            </div>
                        </div>
                        <div class="flex flex-col p-5">
                            <div class="flex">
                                <h3 class="w-24">Kode UPK</h3>
                                <h3 class="w-2">:</h3>
                                <h3>{{ $page.props.auth.user.upk }}</h3>
                            </div>
                            <div class="flex">
                                <h3 class="w-24">Nama UPK</h3>
                                <h3 class="w-2">:</h3>
                                <h3>PUSKESMAS SERANG KOTA</h3>
                            </div>
                            <div class="flex">
                                <h3 class="w-24">Kabupaten</h3>
                                <h3 class="w-2">:</h3>
                                <h3>KOTA SERANG</h3>
                            </div>
                            <div class="flex">
                                <h3 class="w-24">Provinsi</h3>
                                <h3 class="w-2">:</h3>
                                <h3>BANTEN</h3>
                            </div>
                        </div>
                    </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

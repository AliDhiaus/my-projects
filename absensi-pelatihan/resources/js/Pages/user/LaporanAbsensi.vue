<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head} from '@inertiajs/vue3';
import { defineProps} from 'vue';

const data = defineProps({
  data: Array,
})
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #dashboard>
            <div class="">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto text-sm md:text-md">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                <h1 class="text-2xl font-bold mb-4">Laporan Absensi</h1>
                                <div class="overflow-x-auto">
                                    <table class="w-full text-center mt-5">
                                        <thead>
                                            <tr class="border bg-slate-200">
                                                <th class="border p-2">No</th>
                                                <th class="border p-2">Nama Lengkap</th>
                                                <th class="border p-2">Tanggal</th>
                                                <th class="border p-2">Kejuruan</th>
                                                <th class="border p-2">Kelas</th>
                                                <th class="border p-2">Jam Masuk</th>
                                                <th class="border p-2">Jam Keluar</th>
                                                <th class="border p-2">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item, i) in data.data" :key="i">
                                                <td class="border p-2">{{ ++i }}</td>
                                                <td class="border p-2">{{ item.name }}</td>
                                                <td class="border p-2">{{ item.tanggal }}</td>
                                                <td class="border p-2">{{ item.kejuruan }}</td>
                                                <td class="border p-2">{{ item.kelas }}</td>
                                                <td class="border p-2 bg-red-700 text-white" v-if="item.jam_masuk === null">None</td>
                                                <td class="border p-2" v-if="item.jam_masuk !== null">{{ item.jam_masuk }}</td>
                                                <td class="border p-2 bg-red-700 text-white" v-if="item.jam_keluar === null">None</td>
                                                <td class="border p-2" v-if="item.jam_keluar !== null">{{ item.jam_keluar }}</td>
                                                <td class="border p-2">{{ item.keterangan }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>

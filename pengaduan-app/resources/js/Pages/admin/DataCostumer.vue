<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import TableComponent from "@/Components/TableComponent.vue";
import Swal from "sweetalert2";
import { ref } from "vue";

const props = defineProps({
    laporan: Array,
})
const data = props.laporan.filter(item => item.tanggapan === null)

const form = useForm({
    status: "",
});

const handleStatus = (id) => {
    form.get(route('tanggapan.admin', id), {
        onFinish: () => console.log('Berhasil'),
    });
};
</script>

<template>

    <Head title="Laporan Konsumsi" />

    <AuthenticatedLayout :total="data.length">
        <template #header>
            <div class="shadow p-5 mt-5 mx-5">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Data Costumer Service
                </h2>
                <div class="mt-5">
                    <div class="max-w-7xl mx-auto">
                        <div class="bg-white overflow-hidden shadow-sm">
                            <TableComponent heading="">
                                <template #body>
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                Nama Lengkap
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Jenis Kelamin
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Alamat
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                No HP
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                No Kontrak
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Keluhan
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                status
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Tanggapan
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody v-for="(item, index) in data" :key="index">
                                        <tr 
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                            v-if="item.tanggapan === null"
                                            >
                                            <td scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ item.name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ item.jenis_kelamin }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ item.alamat }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ item.no_hp }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ item.no_kontrak }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ item.keluhan }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ item.status }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <button class="bg-blue-900 p-2 text-white rounded-lg font-bold"
                                                    type="submit" @click="
                                                        handleStatus(item.id)">
                                                    Tanggapi
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </template>
                            </TableComponent>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>

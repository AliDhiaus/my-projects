<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import TableComponent from "@/Components/TableComponent.vue";
import Swal from "sweetalert2";
import { ref } from "vue";

const props = defineProps({
    data: Array,
    laporan: Array
});
console.log(props.data)

const data = props.laporan.filter(item => item.tanggapan === null)

</script>

<template>
    <Head title="Laporan Konsumsi" />

    <AuthenticatedLayout :total="data.length">
        <template #header>
            <div class="shadow p-5 m-5">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Data Sektor
                </h2>
                <div class="mt-5">
                    <div class="max-w-7xl mx-auto shadow overflow-hidden">
                        <div class="text-gray-900">
                            <TableComponent heading="">
                                <template #body>
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                                    >
                                        <tr>
                                            <th
                                                scope="col"
                                                class="px-6 py-3"
                                            >
                                                Nama Lengkap
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3"
                                            >
                                                Jenis Kelamin
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3"
                                            >
                                                Alamat
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3"
                                            >
                                                No HP
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3"
                                            >
                                                No Kontrak
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3"
                                            >
                                                Keluhan
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3"
                                            >
                                                Tanggapan
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody v-for="(item, index) in props.data" :key="index">
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                            v-if="item.tanggapan !== null"
                                        >
                                            <td
                                                scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                            >
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
                                                {{ item.tanggapan }}
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

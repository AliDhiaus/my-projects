<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import TableComponent from "@/Components/TableComponent.vue";
import Swal from "sweetalert2";
import { ref } from "vue";

const props = defineProps({
    laporan: Array,
    notif:Array,
});

const data = ref(props.laporan?.filter((item) => item.status === "disetujui" ));
const total = ref(props.notif.filter(item => item.status === null).length)

const form = useForm({
    status: "",
});

const handleStatus = (id) => {
    Swal.fire({
        title: "Apakah pengaduan ini ingin disetujui?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Setuju!",
        denyButtonText: `Tolak!`,
    }).then((result) => {
        if (result.isConfirmed) {
            form.status = "disetujui";
            form.put(route("laporan.update", id), {
                onSuccess: () => {
                    Swal.fire("Saved!", "success");
                    window.location.reload();
                },
            });
        } else if (result.isDenied) {
            form.status = "ditolak";
            form.put(route("laporan.update", id), {
                onSuccess: () => {
                    Swal.fire("Saved!", "success");
                    window.location.reload();
                },
            });
        }
    });
};
</script>

<template>
    <Head title="Laporan Konsumsi" />

    <AuthenticatedLayout :total="total">
        <template #header>
            <div class="shadow p-5 mt-5">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Data Keluhan
                </h2>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div
                            class="bg-white overflow- shadow-sm sm:rounded-lg"
                        >
                         
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
                                                    status
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3"

                                                >
                                                    tanggapan
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="(item, index) in data"
                                                :key="index"
                                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
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
                                                    <div
                                                    class="px-4 py-1 rounded-full shadow-md bg-green-500 text-white uppercase text-center" v-if="!item.tanggapan">
                                                    {{
                                                            item.status
                                                            ? item.status
                                                                : "Verifikasi Pengaduan"
                                                            }}
                                                    </div>
                                                    <div
                                                    class="px-4 py-1 rounded-full shadow-md bg-gray-700 text-slate-100 uppercase text-center" v-else>
                                                    Sudah Ditanggapi
                                                </div>
                                            </td>
                                            <td class="px-6 py-4" >
                                                {{ item.tanggapan?item.tanggapan:'belum ada tanggapan' }}
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

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';

const { props } = usePage();
const peserta = props.data;
console.log(peserta)

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
                                <div class="p-2 bg-blue-900 text-white font-bold mb-4">
                                    <h1 class="text-3xl mt-2 mb-2">Aplikasi Absensi Peserta Pelatihan PBK Non-Boarding</h1>
                                    <p class="text-lg">Aplikasi Absensi Online Berbasis Website Balai Besar Pelatihan Vokasi Dan Produktivitas</p>
                                </div>
                                <div>
                                    <h1 class="text-2xl font-bold mb-4">STRUKTUR ORGANISASI</h1>
                                    <h3>Struktur Organisasi BBPVP Serang  (per SEPTEMBER 2023)</h3>
                                    <img src="https://blkserang.kemnaker.go.id/wp-content/uploads/2024/07/Struktur-Organisasi-Per-Oktober-2023-724x1024.png" alt="" srcset="">
                                </div>
                                <div class="bg-white ">
                                    <h1 class="text-2xl font-bold mb-4">TUGAS DAN FUNGSI</h1>
                                    <div class="p-6 text-gray-900 w-full flex gap-5">
                                        <div class="shadow p-2">
                                            <h1 class="text-2xl font-bold mb-4">TUGAS</h1>
                                            <h3>Berdasarkan Permenaker Nomor 1 Tahun 2022, BBPVP Serang memiliki tugas melaksanakan pelatihan vokasi dan peningkatan produktivitas, sertifikasi kompetensi, serta konsultansi dan peningkatan jejaring di bidang pelatihan vokasi dan produktivitas.</h3>
                                        </div>
                                        <div class="shadow p-2">
                                            <h1 class="text-2xl font-bold mb-4">FUNGSI</h1>
                                            <ol class="list-decimal list-inside space-y-2">
                                                <li>Penyusunan rencana, program dan anggaran.</li>
                                                <li>Pelaksanaan pelatihan vokasi dan peningkatan produktivitas.</li>
                                                <li>Pelaksanaan fasilitasi pemagangan.</li>
                                                <li>Pelaksanaan sertifikasi kompetensi.</li>
                                                <li>Pelaksanaan konsultansi pelatihan vokasi dan produktivitas.</li>
                                                <li>Pelaksanaan peningkatan jejaring pelatihan vokasi dan produktivitas</li>
                                                <li>Pelaksanaan promosi dan pengukuran peningkatan produktivitas</li>
                                                <li>Pelaksanaan pemantauan pelatihan vokasi dan produktivitas</li>
                                                <li>Pelaksanaan urusan organisasi dan sumber daya manusia aparatur, tata laksana, keuangan, rumah tangga, persuratan, kearsipan, perlengkapan, dan pengelolaan barang milik negara</li>
                                                <li>Penyusunan evaluasi dan pelaporan</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>

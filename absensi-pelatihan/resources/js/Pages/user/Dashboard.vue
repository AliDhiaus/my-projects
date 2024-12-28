<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #dashboard>
            <div class="">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg md:hidden">
                            <div class="p-2 bg-blue-900 text-white font-bold mb-4">
                                <h1 class="text-3xl mt-2 mb-2">Aplikasi Absensi Peserta Pelatihan PBK Non-Boarding</h1>
                                <p class="text-lg">Aplikasi Absensi Online Berbasis Website Balai Besar Pelatihan Vokasi Dan Produktivitas</p>
                            </div>
                            <div class="p-6 text-gray-900">
                                <h1 class="text-2xl font-bold mb-4">Balai Besar Pelatihan Vokasi dan Produktivitas (BBPVP) Serang </h1>
                                <img src="https://blkserang.kemnaker.go.id/wp-content/uploads/2023/04/visi-dan-misi.png" alt="" srcset="">
                                <div class="mt-5">
                                    <h1 class="text-2xl font-bold mb-4">Visi</h1>
                                    <h3>Menjadi Pusat Pelatihan Tenaga Kerja Yang Profesional dan Berkualitas Bidang Industri</h3>
                                </div>
                                <div class="mt-5">
                                    <h1 class="text-2xl font-bold mb-4">Misi</h1>
                                    <ol class="list-decimal list-inside space-y-2">
                                        <li>Mengembangkan sistem dan metode pelatihan sesuai dengan kebutuhan dunia industri.</li>
                                        <li>Mengimplementasikan sistem dan metode pelatihan kerja di bidang industri.</li>
                                        <li>Meningkatkan kualitas SDM, sarana, dan prasarana pelatihan sesuai perkembangan IPTEK.</li>
                                        <li>Meningkatkan pemberdayaan lembaga pelatihan dan pengabdian masyarakat.</li>
                                        <li>Mengembangkan jejaring kerja sama dan komunikasi antar lembaga.</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 hidden md:block">
                            <div class="p-2 bg-blue-900 text-white font-bold mb-4">
                                <h1 class="text-3xl mt-2 mb-2">Aplikasi Absensi Peserta Pelatihan PBK Non-Boarding</h1>
                                <p class="text-lg">Aplikasi Absensi Online Berbasis Website Balai Besar Pelatihan Vokasi Dan Produktivitas</p>
                            </div>
                            <h1 class="text-2xl font-bold mb-4">Balai Besar Pelatihan Vokasi dan Produktivitas (BBPVP) Serang </h1>
                            <div class="text-gray-900 w-full gap-5 mt-5 shadow">
                                <img src="/image/las.png" class="w-full">
                                <div class="p-5">
                                    <h1>Pelatihan las adalah program pendidikan dan pelatihan yang dirancang untuk mengajarkan keterampilan dan pengetahuan yang diperlukan untuk menjadi seorang tukang las. Pelatihan ini meliputi berbagai teknik pengelasan, keamanan kerja, penggunaan alat dan mesin las, serta pemahaman tentang bahan yang dilas, seperti baja, aluminium, dan logam lainnya.</h1>
                                </div>
                            </div>
                            <div class="text-gray-900 w-full gap-5 mt-5 shadow">
                                <img src="/image/listrik.png" class="w-full">
                                <div class="p-5">
                                    <h1>Pelatihan listrik adalah program pendidikan dan pelatihan yang bertujuan untuk mengajarkan keterampilan dan pengetahuan yang diperlukan untuk bekerja di bidang kelistrikan. Program ini sangat penting bagi mereka yang ingin menjadi teknisi listrik, insinyur listrik, atau bekerja dalam perawatan dan instalasi sistem listrik di berbagai sektor, termasuk industri, bangunan komersial, dan perumahan.</h1>
                                </div>
                            </div>
                            <div class="text-gray-900 w-full gap-5 mt-5 shadow">
                                <img src="/image/mesin.png" class="w-full">
                                <div class="p-5">
                                    <h1>Pelatihan manufaktur adalah program pendidikan dan pelatihan yang dirancang untuk membekali individu dengan keterampilan dan pengetahuan yang diperlukan untuk bekerja dalam industri manufaktur. Manufaktur mencakup berbagai proses produksi yang melibatkan pengubahan bahan mentah menjadi produk jadi melalui metode mekanis, kimia, atau fisik. Pelatihan ini penting bagi mereka yang ingin bekerja sebagai operator mesin, teknisi, insinyur, atau supervisor dalam berbagai sektor manufaktur seperti otomotif, elektronik, tekstil, dan lainnya.</h1>
                                </div>
                            </div>
                            <div class="text-gray-900 w-full gap-5 mt-5 shadow">
                                <img src="/image/tik.png" class="w-full">
                                <div class="p-5">
                                    <h1>Pelatihan Teknologi Informasi dan Komunikasi (TIK) adalah program pendidikan dan pelatihan yang dirancang untuk memberikan keterampilan dan pengetahuan dalam bidang teknologi informasi dan komunikasi. Program ini sangat penting di era digital saat ini, di mana teknologi memainkan peran kunci dalam berbagai aspek kehidupan, termasuk pendidikan, bisnis, pemerintahan, dan komunikasi sehari-hari.</h1>
                                </div>
                            </div>
                            <div class="text-gray-900 w-full gap-5 mt-5 shadow">
                                <img src="/image/garment.png" class="w-full">
                                <div class="p-5">
                                    <h1>Pelatihan garment adalah program pendidikan dan pelatihan yang dirancang untuk memberikan keterampilan dan pengetahuan dalam industri pakaian, mulai dari desain, produksi, hingga manajemen rantai pasokan. Industri garment mencakup berbagai aspek seperti pembuatan pakaian, tekstil, dan aksesoris, dan pelatihan ini penting bagi mereka yang ingin bekerja sebagai desainer pakaian, teknisi produksi, manajer kualitas, atau profesional lainnya dalam sektor ini.</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>

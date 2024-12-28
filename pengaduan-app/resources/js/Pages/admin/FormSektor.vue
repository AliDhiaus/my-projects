<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

// Define props
const props = defineProps({
    laporan: Object
});

const form = useForm({
    tanggapan: "",
});

const SimpanData = (id) => {
    form.put(route('dataTanggapan.admin', id), {
        onSuccess: () => {
            let timerInterval;
            Swal.fire({
                title: "Sedang di prosess!",
                html: "<b></b>",
                timer: 1000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                },
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    Swal.fire({
                        title: "Success!",
                        text: "Tanggapan Telah Terkirim Ke Customer",
                        icon: "success",
                    });
                    router.get(route('dashboard.admin'));
                }
            });
        },
        onError: (errors) => {
            console.log(errors);
            alert('Terjadi kesalahan, silakan periksa kembali inputan Anda.');
        },
    });
};

</script>


<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="shadow p-5 mt-5">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Form Costumer Service</h2>
                <div class="shadow mt-5 p-5" v-for="(item, i) in props.laporan" :key="i">
                    <h1 class="font-semibold text-lg text-gray-800 leading-tight">Data Keluhan Konsumen</h1>
                    <div class="p-5">
                        <div class="flex items-center gap-4">
                            <label for="" class="w-36">Nama Lengkap</label><span>:</span>
                            <h1 class="w-full">{{ item.name }}</h1>
                        </div>
                        <div class="flex items-center gap-4 mt-5">
                            <label for="" class="w-36">Jenis Kelamin</label><span>:</span>
                            <h1 class="w-full">{{ item.jenis_kelamin }}</h1>
                        </div>
                        <div class="flex items-center gap-4 mt-5">
                            <label for="" class="w-36">Alamat</label><span>:</span>
                            <h1 class="w-full">{{ item.alamat }}</h1>
                        </div>
                        <div class="flex items-center gap-4 mt-5">
                            <label for="" class="w-36">No HP</label><span>:</span>
                            <h1 class="w-full">{{ item.no_hp }}</h1>
                        </div>
                        <div class="flex items-center gap-4 mt-5">
                            <label for="" class="w-36">No Kontrak</label><span>:</span>
                            <h1 class="w-full">{{ item.no_kontrak }}</h1>
                        </div>
                        <div class="flex items-center gap-4 mt-5">
                            <label for="" class="w-36">Keluhan</label><span>:</span>
                            <h1 class="w-full">{{ item.keluhan }}</h1>
                        </div>
                    </div>
                    <div class="shadow p-5 mt-5">
                        <h1 class="font-semibold text-lg text-center text-gray-800 leading-tight">Berikan Tanggapan</h1>
                        <form @submit.prevent="SimpanData(item.id)">
                            <div class="flex items-center gap-4 mt-10">
                                <textarea v-model="form.tanggapan" class="w-full" required />
                            </div>
                            <div class="mt-5 flex justify-end">
                                <button type="submit" class="bg-blue-600 py-2 px-6 rounded text-white">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>

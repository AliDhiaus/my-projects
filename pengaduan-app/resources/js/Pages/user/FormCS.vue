<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import Swal from "sweetalert2";

// Definisikan props
const props = defineProps({
    auth: Object,
});

// Membuat form menggunakan useForm
const form = useForm({
    name: props.auth.user.name,
    jenis_kelamin: props.auth.user.jenis_kelamin,
    alamat: props.auth.user.alamat,
    no_hp: props.auth.user.no_hp,
    no_kontrak: props.auth.user.no_kontrak,
    keluhan: "",
    user_id: parseInt(props.auth.user.id),
});

const SimpanData = () => {
    form.post(route("postCS.user"), {
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
                        text: "Data telah dikirim ke customer service",
                        icon: "success",
                    });
                    form.keluhan =''
                }
            });
        },
    });
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="shadow p-5 mt-5">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Form Costumer Service
                </h2>
                <div class="shadow mt-5 p-5">
                    <div class="flex items-center gap-4">
                        <label for="" class="w-36">Nama Lengkap</label
                        ><span>:</span>
                        <h1 class="w-full">{{ form.name }}</h1>
                    </div>
                    <div class="flex items-center gap-4 mt-5">
                        <label for="" class="w-36">Jenis Kelamin</label
                        ><span>:</span>
                        <h1 class="w-full">{{ form.jenis_kelamin }}</h1>
                    </div>
                    <div class="flex items-center gap-4 mt-5">
                        <label for="" class="w-36">Alamat</label><span>:</span>
                        <h1 class="w-full">{{ form.alamat }}</h1>
                    </div>
                    <div class="flex items-center gap-4 mt-5">
                        <label for="" class="w-36">No HP</label><span>:</span>
                        <h1 class="w-full">{{ form.no_hp }}</h1>
                    </div>
                    <div class="flex items-center gap-4 mt-5">
                        <label for="" class="w-36">No Kontrak</label
                        ><span>:</span>
                        <h1 class="w-full">{{ form.no_kontrak }}</h1>
                    </div>
                    <div class="flex items-center gap-4 mt-5">
                        <label for="" class="w-36">Kelurahan</label
                        ><span>:</span>
                        <textarea
                            v-model="form.keluhan"
                            class="w-full"
                            required
                        />
                    </div>
                    <div class="mt-5 flex justify-end">
                        <button
                            type="submit"
                            class="bg-blue-600 py-2 px-6 rounded text-white text-start"
                            @click="SimpanData"
                        >
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>

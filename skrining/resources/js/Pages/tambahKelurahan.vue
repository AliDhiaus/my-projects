<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { faChevronLeft } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { dataKel } from '@/lib/dataKel';
import { ref } from 'vue';

const kecamatan = ref(null);
const kelurahan = ref(null);

const form = useForm({
    provinsi: 'Banten',
    kota: 'Serang',
    upk: '',
    kecamatan: '',
    kelurahan: ''
});

const handleSubmit = () => {
    form.kecamatan = kecamatan.value ? kecamatan.value.kecamatan : '';
    form.kelurahan = kelurahan.value ? kelurahan.value : '';

    form.post(route('kelurahan.post'), {
        onSuccess: () => {
            console.log("Form submitted successfully");
        },
        onError: (errors) => {
            console.error("There was an error submitting the form:", errors);
        }
    });
};
</script>


<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #kelurahan>
            <div class="bg-white shadow p-5">
                <Link :href="route('kelurahan')" class="py-2 px-4 rounded-lg bg-slate-600 text-white text-sm"><FontAwesomeIcon :icon="faChevronLeft" /> Kembali</Link>
                <form @submit.prevent="handleSubmit" class="my-5 flex flex-col gap-5">
                    <div class="flex flex-col">
                        <label for="provinsi">Provinsi</label>
                        <input type="text" placeholder="Masukan Nama Provinsi" class="bg-slate-100" disabled v-model="form.provinsi">
                    </div>
                    <div class="flex flex-col">
                        <label for="kota">Kota</label>
                        <input type="text" placeholder="Masukan Nama Kota/Kabupaten" class="bg-slate-100" disabled v-model="form.kota">
                    </div>
                    <div class="flex flex-col">
                        <label for="upk">UPK</label>
                        <input type="text" placeholder="Masukan Nama UPK" v-model="form.upk">
                    </div>
                    <div class="flex flex-col">
                        <label for="kecamatan">Kecamatan</label>
                        <select v-model="kecamatan" placeholder="Pilih Kecamatan">
                            <option v-if="!dataKel" selected>Tidak ada</option>
                            <option v-for="(item, i) in dataKel" :value="item" :key="i">{{ item.kecamatan }}</option>
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label for="kelurahan">Kelurahan</label>
                        <select v-model="kelurahan" :disabled="!kecamatan">
                            <option v-if="!kecamatan" selected>Tidak ada</option>
                            <option v-for="(item, i) in kecamatan?.kelurahan" :value="item" :key="i">{{ item }}</option>
                        </select>
                    </div>
                    <button type="submit" class="py-2 px-4 w-20 rounded-lg shadow bg-blue-500 text-slate-100">Submit</button>
                </form>
            </div>
        </template>
    </AuthenticatedLayout>
</template>

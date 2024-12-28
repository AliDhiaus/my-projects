<script setup>
import { defineProps, ref, watch } from 'vue';
import { router, useForm, usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'; // Pastikan ini benar

const props = defineProps({
  akun: Object,
});

const user = ref({ ...props.akun });

const form = useForm({
    name: user.name,
    jenis_kelamin: user.jenis_kelamin,
    tanggal_lahir: user.tanggal_lahir,
    alamat: user.alamat,
    email: user.email,
});

watch(() => props.akun, (newValue) => {
  form.name = newValue.name;
  form.jenis_kelamin = newValue.jenis_kelamin;
  form.tanggal_lahir = newValue.tanggal_lahir;
  form.alamat = newValue.alamat;
  form.email = newValue.email;
}, { immediate: true });

const submit = (id) => {
  router.put(route('updatePeserta', id), form, {
    onSuccess: () => {
      alert('Data berhasil diperbarui');
    },
    onError: () => {
      alert('Terjadi kesalahan, data tidak bisa diperbarui');
    }
  });
};
</script>

<template>
  <AuthenticatedLayout>
    <template #dashboard>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">        
                    <h1 class="text-2xl font-bold mb-4">Edit Peserta</h1>
                    <form @submit.prevent="submit(user.id)" class="shadow p-5 mt-5">
                        <div class="flex gap-5">
                            <label for="name" class="w-36">Nama Lengkap</label><span>:</span>
                            <input v-model="form.name" id="name" type="text" class="w-full" />
                        </div>
                        <div class="flex gap-5 mt-5">
                            <label for="email" class="w-36">Email</label><span>:</span>
                            <input v-model="form.email" id="email" type="email" class="w-full" />
                          </div>
                          <div class="flex gap-5 mt-5">
                              <label for="email" class="w-36">Tanggal Lahir</label><span>:</span>
                              <input v-model="form.tanggal_lahir" id="tanggal_lahir" type="date" class="w-full" />
                          </div>
                          <div class="flex gap-5 mt-5">
                              <label for="email" class="w-36">Jenis Kelamin</label><span>:</span>
                              <select v-model="form.jenis_kelamin" id="jenis_kelamin" class="w-full">
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                              </select>
                          </div>
                        <div class="flex gap-5 mt-5">
                            <label for="email" class="w-36">Alamat</label><span>:</span>
                            <input v-model="form.alamat" id="alamat" type="text" class="w-full" />
                        </div>
                        <div class="flex justify-end mt-5">
                            <button type="submit" class="px-4 py-2 bg-blue-500 rounded-lg text-white font-bold">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </template>
  </AuthenticatedLayout>
</template>

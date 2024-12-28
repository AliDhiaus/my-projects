<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faUserSecret, faTrashCan, faPlus, faEdit } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
library.add(faUserSecret, faTrashCan, faPlus, faEdit);


const props = defineProps({
  data: Array,
});


const hapusData = (id) => {
    if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        router.delete(route('deletePeserta', id), {
          onSuccess: () => {
            alert('Data berhasil dihapus');
          },
          onError: () => {
            alert('Terjadi kesalahan, data tidak bisa dihapus');
          }
        });
    }
}
const editData = (id) => {
    router.get(route('geEditPeserta', id)), {
        onSuccess: () => {
            alert('Data berhasil di edit');
          }
    }
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #dashboard>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto text-sm md:text-md sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                <div>
                                    <h1 class="text-2xl font-bold mb-4">Manajemen Peserta</h1>
                                    <Link :href="route('tambahPeserta')"><font-awesome-icon :icon="['fas', 'plus']" /> Tambah Peserta</Link>                                
                                </div>
                                <div class="overflow-x-auto">
                                    <table class="w-full border mt-2">
                                        <thead>
                                            <tr class="border bg-blue-400 font-bold text-center">
                                                <th class="border p-2">No</th>
                                                <th class="border p-2">Nama Lengkap</th>
                                                <th class="border p-2">Tanggal Lahir</th>
                                                <th class="border p-2">Jenis Kelamin</th>
                                                <th class="border p-2">Alamat</th>
                                                <th class="border p-2">Email</th>
                                                <th class="border p-2">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="border" v-for="(item, i) in data" :key="i">
                                                <td class="border text-center p-2">{{ ++i }}</td>
                                                <td class="border p-2">{{ item.name }}</td>
                                                <td class="border p-2">{{ item.tanggal_lahir }}</td>
                                                <td class="border p-2">{{ item.jenis_kelamin }}</td>
                                                <td class="border p-2">{{ item.alamat }}</td>
                                                <td class="border p-2">{{ item.email }}</td>
                                                <td class="border p-2 text-center flex justify-around cursor-pointer">
                                                    <button type="submit"   class="shadow px-4 py-2 bg-blue-500 font-bold text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300" 
                                                    @click="editData(item.id)"><font-awesome-icon :icon="['fas', 'edit']" /> Edit</button>
                                                    <button type="submit" class="shadow px-3 py-1 bg-red-500 font-bold text-white rounded-lg  hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-blue-300" @click="hapusData(item.id)"><font-awesome-icon :icon="['fas', 'trash-can']" /> Hapus</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </template>
    </AuthenticatedLayout>
</template>

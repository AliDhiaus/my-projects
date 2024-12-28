<script setup>
import { computed } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, usePage } from '@inertiajs/vue3';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faUserSecret, faTrashCan, faPlus, faX } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

library.add(faUserSecret, faTrashCan, faPlus, faX);

const { props } = usePage();

// Grouping data by kejuruan and kelas
const groupedData = computed(() => {
    const grouped = {};
    props.data.forEach(item => {
        const key = `${item.kejuruan}-${item.kelas}`;
        if (!grouped[key]) {
            grouped[key] = {
                kejuruan: item.kejuruan,
                kelas: item.kelas,
                items: [],
            };
        }
        grouped[key].items.push(item);
    });

    return Object.values(grouped);
});

const hapusAbsen = (kejuruan) => {
    if (confirm("Apakah Anda yakin ingin menghapus semua data untuk kejuruan ini?")) {
        router.delete(route('deleteAbsensi'), {
            data: { kejuruan },
            onSuccess: () => {
                alert('Data berhasil dihapus');
                window.location.reload();
            },
            onError: () => {
                alert('Terjadi kesalahan, data tidak bisa dihapus');
            }
        });
    }
};

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #dashboard>
            <div class="py-12">
                <div class="max-w-7xl mx-auto text-sm md:text-md lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h1 class="text-2xl font-bold mb-4">Kelola Absensi</h1>
                            <div v-for="(group, index) in groupedData" :key="index" class="shadow p-4 overlow-y mb-4 rounded-lg">
                                <div class="mb-4">
                                    <div class="flex gap-2">
                                        <h1 class="w-24 font-semibold">Kejuruan</h1><span>:</span>
                                        <h1 class="w-full">{{ group.kejuruan }}</h1>
                                        <button @click="hapusAbsen(group.kejuruan)">
                                            <font-awesome-icon :icon="['fas', 'x']" />
                                        </button>
                                    </div>
                                    <div class="flex gap-2">
                                        <h1 class="w-24 font-semibold">Kelas</h1><span>:</span>
                                        <h1 class="w-full">{{ group.kelas }}</h1>
                                    </div>
                                </div>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full text-center border-collapse">
                                        <thead>
                                            <tr class="border-b bg-slate-200">
                                                <th class="border p-2">No</th>
                                                <th class="border p-2">Nama</th>
                                                <th class="border p-2">Tanggal</th>
                                                <th class="border p-2">Jam Masuk</th>
                                                <th class="border p-2">Jam Keluar</th>
                                                <th class="border p-2">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item, i) in group.items" :key="i">
                                                <td class="border p-2">{{ i + 1 }}</td>
                                                <td class="border p-2">{{ item.name }}</td>
                                                <td class="border p-2">{{ item.tanggal }}</td>
                                                <td class="border p-2" :class="{'bg-red-700 text-white': !item.jam_masuk}">
                                                    {{ item.jam_masuk || 'None' }}
                                                </td>
                                                <td class="border p-2" :class="{'bg-red-700 text-white': !item.jam_keluar}">
                                                    {{ item.jam_keluar || 'None' }}
                                                </td>
                                                <td class="border p-2">{{ item.keterangan }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { faPlus, faTrash } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { Head, router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const { props } = usePage();
const data = ref(props.data);
const message = ref(props.message)

const handleDelete = (id) =>{
    router.delete(route('kelurahan.destroy', id),{
        onSuccess: () => {
            data.value = data.value.filter(item => item.id !== id);
            window.location.reload();
        },
        onError: (errors) => {
            console.error("There was an error submitting the form:", errors);
        }
    })
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #kelurahan>
            <div class="bg-white shadow mx-1 py-5 px-2 md:p-5 overflow-x-scroll">
                <a :href="route('kelurahan.add')" class="py-2 px-4 rounded-lg bg-blue-600 text-white text-sm"><FontAwesomeIcon :icon="faPlus" /> Tambah</a>
                <table class="border my-5 w-full" v-if="message === ''">
                    <tr class="border bg-slate-800 text-white">
                        <th class="border px-1 text-xs md:text-base py-1 w-4 md:p-1">PROVINSI</th>
                        <th class="border px-1 text-xs md:text-base">KOTA</th>
                        <th class="border px-1 text-xs md:text-base">UPK</th>
                        <th class="border px-1 text-xs md:text-base">KECAMATAN</th>
                        <th class="border px-1 text-xs md:text-base">KELURAHAN</th>
                        <th class="border px-1 text-xs md:text-base">ACTION</th>
                    </tr>
                    <tr v-for="(item, i) in data" :key="i" class="text-center">
                        <td class="border px-1 text-xs md:text-base md:p-1">{{ item.provinsi }}</td>
                        <td class="border px-1 text-xs md:text-base">{{ item.kota }}</td>
                        <td class="border px-1 text-xs md:text-base">{{ item.upk }}</td>
                        <td class="border px-1 text-xs md:text-base">{{ item.kecamatan }}</td>
                        <td class="border px-1 text-xs md:text-base">{{ item.kelurahan }}</td>
                        <td class="border px-1 text-xs md:text-base">
                            <button @click="handleDelete(item.id)">
                                <FontAwesomeIcon :icon="faTrash" class="text-red-500" />
                            </button>
                        </td>
                    </tr>
                </table>
                <h1 v-else class="mt-5 text-center">{{ message }}</h1>
            </div>
        </template>

        <div class="py-12">
            
        </div>
    </AuthenticatedLayout>
</template>

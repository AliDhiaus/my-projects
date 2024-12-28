<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {
    faEllipsisVertical,
    faMagnifyingGlass,
    faTrash,
    faX,
} from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { Head, usePage, router } from "@inertiajs/vue3";
import { ref } from "vue";

const { props } = usePage();
const data = ref(props.data);

const isDropdownVisible = ref();

const toggleDropdown = (nik) => {
    isDropdownVisible.value = isDropdownVisible.value === nik ? null : nik;
};

const detail = (nik) => {
    router.get(route('demografi.detail', nik));
};

const hapus = (nik) => {
    router.delete(route("demografi.destroy", nik), {
        onSuccess: () => {
            data.value = data.value.filter((item) => item.nik !== nik);
            window.location.reload();
        },
        onError: (errors) => {
            console.error("There was an error deleting the item:", errors);
        },
    });
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #demografi>
            <div class="bg-white shadow h-full p-5">
                <h1>Data Demografi Individu</h1>
                <div class="flex" v-for="(item, i) in data" :key="i">
                    <div class="flex w-full border bg-slate-100 shadow mt-5 p-5">
                        <div class="w-40 mt-5 h-full hidden md:block">
                            <img src="image/pp.png" class="items-center"/>
                        </div>
                        <div class="flex flex-col p-5 w-full">
                            <div class="flex justify-center md:hidden">
                                <img src="image/pp.png" class="items-center bg-blue-100 p-2 rounded-full w-28 h-28" />
                            </div>
                            <div class="flex mt-5">
                                <h3 class="w-36">NIK</h3>
                                <h3 class="w-2">:</h3>
                                <h3>{{ item.nik }}</h3>
                            </div>
                            <div class="flex">
                                <h3 class="w-36">Nama Lengkap</h3>
                                <h3 class="w-2">:</h3>
                                <h3>{{ item.name }}</h3>
                            </div>
                            <div class="flex">
                                <h3 class="w-36">Tanggal Screening</h3>
                                <h3 class="w-2">:</h3>
                                <h3>{{ item.date }}</h3>
                            </div>
                            <div class="flex">
                                <h3 class="w-36">Jenis Kelamin</h3>
                                <h3 class="w-2">:</h3>
                                <h3>{{ item.gender }}</h3>
                            </div>
                        </div>
                        <button @click="toggleDropdown(item.nik)" class="h-1">
                            <FontAwesomeIcon :icon="faEllipsisVertical" />
                        </button>
                        <div
                            v-if="isDropdownVisible === item.nik"
                            class="absolute right-5 mt-7 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5"
                        >
                            <div>
                                <button
                                    @click.prevent="hapus(item.nik)"
                                    class="block text-sm text-gray-700 p-2 hover:bg-gray-100"
                                    role="menuitem"
                                >
                                    <FontAwesomeIcon :icon="faTrash" /> Hapus
                                </button>
                                <button
                                    @click="detail(item.nik)"
                                    class="block text-sm text-gray-700 p-2 hover:bg-gray-100"
                                    role="menuitem"
                                >
                                    <FontAwesomeIcon
                                        :icon="faMagnifyingGlass"
                                    />
                                    Detail
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>

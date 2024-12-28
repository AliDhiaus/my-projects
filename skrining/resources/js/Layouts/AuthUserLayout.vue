<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { icon } from '@fortawesome/fontawesome-svg-core';
import { faFile, faUser } from '@fortawesome/free-regular-svg-icons';
import { faHome } from '@fortawesome/free-solid-svg-icons';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="p-5 flex h-full justify-center items-center ">
        <div class="bg-white w-2/3 h-full">
            <h1 class="text-center font-bold">Selamat datang di Aplikasi SINAPZA</h1>
            <h3 class="text-center">Silahkan Isi Biodata Diri Kamu Disini</h3>
            <form class="mt-5" v-if="$slots.home">
                <slot name="home" />
            </form>
            <form  v-if="$slots.quiz">
                <slot name="quiz" />
            </form>
        </div>
    </div>
</template>



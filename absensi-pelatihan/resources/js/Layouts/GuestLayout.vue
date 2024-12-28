<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>
<style>
.tampilan {
    background-image: url('/image/bg.jpeg');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
}

</style>
<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 tampilan" id="bodyLogin" :style="{ opacity: opacity }">
        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>


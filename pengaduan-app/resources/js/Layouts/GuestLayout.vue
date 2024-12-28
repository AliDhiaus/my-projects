<script setup>
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">

        <div
            class="w-full flex flex-col  sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
        >
        <div class="mb-2 text-xl text-center uppercase font-bold">
            <p>Layanan PENGADUAN Konsumen</p>
        </div>
        <img src="/image/logo.png" alt="logo" width="200px" class="mx-auto my-5" />
            <slot />
        </div>
    </div>
</template>

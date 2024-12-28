<script setup>
const props = defineProps({
    heading: String
});
</script>

<template>
    <div class="relative overflow-x-auto border border-slate-200">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                {{ heading }}
            </caption>
            <slot name="body"/>
        </table>
    </div>
</template>

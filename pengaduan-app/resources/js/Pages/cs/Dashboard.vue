<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { Bar } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js';

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale);

const props = defineProps({
    laporan: Array,
});

// Data for the chart
const dataTanggap = ref(props.laporan.filter(item => item.tanggapan === null));

const approvedCount = computed(() => props.laporan.filter(item => item.tanggapan !== null).length);
const pendingCount = computed(() => dataTanggap.value.length);

const chartData = ref({
    labels: ['Sudah Ditanggapi', 'Belum Ditanggapi'],
    datasets: [
        {
            label: 'Jumlah Laporan',
            backgroundColor: ['#4CAF50', '#FF6384'],
            data: [approvedCount.value, pendingCount.value],
        },
    ],
});

const chartOptions = ref({
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: {
            position: 'top',
        },
        title: {
            display: true,
            text: 'Status Tanggapan Laporan',
        },
    },
});

</script>

<template>
    <Head title="Admin" />

    <AuthenticatedLayout :total="dataTanggap.length">
        <template #header>
            <div class="shadow p-5 mt-5 bg-gray-100">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard Costumer Service</h2>
                <div class="p-6 bg-white shadow-md rounded-lg mt-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
                        <!-- Statistics Cards -->
                        <div class="bg-blue-100 p-4 rounded-lg shadow-md text-center">
                            <h3 class="text-lg font-semibold text-blue-600">Total Laporan Ditanggapi</h3>
                            <p class="text-2xl font-bold">{{ approvedCount }}</p>
                        </div>
                        <div class="bg-yellow-100 p-4 rounded-lg shadow-md text-center">
                            <h3 class="text-lg font-semibold text-yellow-600">Total Laporan Belum Ditanggapi</h3>
                            <p class="text-2xl font-bold">{{ pendingCount }}</p>
                        </div>
                        <div class="bg-green-100 p-4 rounded-lg shadow-md text-center">
                            <h3 class="text-lg font-semibold text-green-600">Total Laporan</h3>
                            <p class="text-2xl font-bold">{{ props.laporan.length }}</p>
                        </div>
                    </div>
        
                    <!-- Chart -->
                    <div class="mb-8">
                        <Bar :data="chartData" :options="chartOptions" />
                    </div>
        
                    <div class="overflow-x-auto bg-white shadow-md rounded-lg"></div>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggapan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="item in props.laporan" :key="item.id">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ item.id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ item.name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ item.alamat }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ item.no_hp }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ item.tanggapan ? 'Ditanggapi' : 'Belum Ditanggapi' }}</td>
                                </tr>
                            </tbody>
                        </table>
                </div>
            </div>
        </template>

    </AuthenticatedLayout>
</template>


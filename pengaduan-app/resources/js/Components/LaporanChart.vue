<!-- LaporanChart.vue -->
<template>
  <div>
    <Bar :chart-data="chartData" :options="chartOptions" />
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Bar } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js';

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale);

const props = defineProps({
  approved: Number,
  pending: Number,
});

const chartData = computed(() => ({
  labels: ['Sudah Ditanggapi', 'Belum Ditanggapi'],
  datasets: [
    {
      label: 'Jumlah Laporan',
      backgroundColor: ['#4CAF50', '#FF6384'],
      data: [props.approved, props.pending],
    },
  ],
}));

const chartOptions = {
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
};
</script>

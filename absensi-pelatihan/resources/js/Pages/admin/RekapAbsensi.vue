<script setup>
import { computed, ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import jsPDF from 'jspdf';
import 'jspdf-autotable';
import * as XLSX from 'xlsx';

const { props } = usePage();
const searchQuery = ref(''); // Ref to store the search query

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

  return Object.values(grouped).filter(group => {
    const query = searchQuery.value.toLowerCase();
    return (
      group.kejuruan.toLowerCase().includes(query) ||
      group.kelas.toLowerCase().includes(query) ||
      group.items.some(item =>
        item.name.toLowerCase().includes(query) ||
        item.tanggal.toLowerCase().includes(query)
      )
    );
  });
});

const generatePDF = () => {
  const doc = new jsPDF();

  groupedData.value.forEach((group, index) => {
    if (index > 0) doc.addPage();
    
    doc.setFontSize(18);
    doc.text(`Rekap Absensi - ${group.kejuruan} ${group.kelas}`, 14, 20);

    const tableData = group.items.map((item, i) => [
      i + 1,
      item.name,
      item.tanggal,
      item.jam_masuk || 'None',
      item.jam_keluar || 'None',
      item.keterangan,
    ]);

    doc.autoTable({
      startY: 30,
      head: [['No', 'Nama', 'Tanggal', 'Jam Masuk', 'Jam Keluar', 'Keterangan']],
      body: tableData,
      theme: 'grid',
    });
  });

  doc.save('rekap-absensi.pdf');
};

const exportToExcel = () => {
  const exportData = [];

  groupedData.value.forEach(group => {
    group.items.forEach(item => {
      exportData.push({
        Kejuruan: group.kejuruan,
        Kelas: group.kelas,
        Nama: item.name,
        Tanggal: item.tanggal,
        'Jam Masuk': item.jam_masuk || 'None',
        'Jam Keluar': item.jam_keluar || 'None',
        Keterangan: item.keterangan,
      });
    });
  });

  const worksheet = XLSX.utils.json_to_sheet(exportData);
  const workbook = XLSX.utils.book_new();
  XLSX.utils.book_append_sheet(workbook, worksheet, 'Rekap Absensi');
  XLSX.writeFile(workbook, 'rekap_absensi.xlsx');
};
</script>
<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
      <template #dashboard>
          <div>
              <div class="py-12">
                  <div class="max-w-7xl mx-auto text-sm md:text-md lg:px-8">
                      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                          <div class="p-6 text-gray-900">
                              <h1 class="text-2xl font-bold mb-4">Rekap Absensi</h1>
                              
                              <!-- Search Bar -->
                              <div class="mb-4">
                                  <input 
                                      v-model="searchQuery" 
                                      type="text" 
                                      placeholder="Search by kejuruan, kelas, nama, or tanggal..." 
                                      class="p-2 border border-gray-300 rounded-md w-full"
                                  />
                              </div>

                              <div class="flex mt-5 items-center gap-5">
                                  <button @click="generatePDF" class="md:mb-6 md:px-6 md:py-2 p-2 bg-blue-500 text-white shadow hover:bg-blue-700 transition duration-300 ease-in-out transform hover:scale-105">
                                      Export to PDF
                                  </button>
                                  <button 
                                      @click="exportToExcel" 
                                      class="md:mb-6 md:px-6 md:py-2 p-2 bg-green-500 text-white shadow hover:bg-green-600 transition duration-300 ease-in-out transform hover:scale-105">
                                      Export to Excel
                                  </button>
                              </div>

                              <!-- Grouped Data Display -->
                              <div v-for="(group, index) in groupedData" :key="index" class="shadow p-2 mt-5">
                                  <div class="flex gap-2 w-full">
                                      <h1 class="w-24">Kejuruan</h1><span>:</span>
                                      <h1>{{ group.kejuruan }}</h1>
                                  </div>
                                  <div class="flex gap-2 w-full">
                                      <h1 class="w-24">Kelas</h1><span>:</span>
                                      <h1>{{ group.kelas }}</h1>
                                  </div>
                                  <div class="overflow-x-auto">
                                    <table class="w-full text-center mt-2">
                                        <thead>
                                            <tr class="border bg-slate-200">
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
          </div>
      </template>
  </AuthenticatedLayout>
</template>

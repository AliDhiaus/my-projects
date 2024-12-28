<template>
    <div class="container">
        <div class="box">
            <button @click="printPDF" class="btn"><font-awesome-icon :icon="['far', 'file-pdf']" /> Cetak PDF</button>
            <div class="form-group">
                <label for="selectDate">Pilih Tanggal:</label>
                <select id="selectDate" class="form-control" v-model="selectedDate">
                    <option value="">Semua Tanggal</option>
                    <option v-for="(date, index) in uniqueDates" :key="index" :value="date">{{ date }}</option>
                </select>
            </div>
        </div>
        <div id="printArea">
            <div class="cardInput" v-for="(value, i) in filteredDas" :key="i">
                <div class="boxText">
                    <h3>Judul Siaran</h3><span>:</span>
                    <h4>{{ value.judul }}</h4>
                </div>
                <div class="boxText">
                    <h3>Hari Dan Tanggal</h3><span>:</span>
                    <h4>{{ value.tanggal }}</h4>        
                </div>
                <div class="boxText">
                    <h3>Petugas</h3><span>:</span>
                    <h4>{{ value.petugas }}</h4>
                </div>
                <table v-if="value.isiDas.length !== 0" class="tbLaporan">
                    <tr>
                        <th class="thLP">Waktu</th>
                        <th class="thLP">Program</th>
                        <th class="thLP">Frame</th>
                        <th class="thLP">Durasi</th>
                        <th class="thKet">Keterangan</th>
                    </tr>
                    <tr v-for="(item, j) in value.isiDas" :key="j">
                        <td>{{ item.waktu }}</td>
                        <td>{{ item.program }}</td>
                        <td>{{ item.frame }}</td>
                        <td>{{ item.durasi }}</td>
                        <td>{{ item.keterangan }}</td>
                    </tr>
                </table>
                <p v-else class="text-center">--- Isi Daftar Acara Siaran Not Found ---</p>
            </div>
            
            <div v-if="das.length === 0">
                <p>No data available.</p>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import jsPDF from 'jspdf';
import html2canvas from 'html2canvas';

export default {
    data() {
        return {
            das: [],
            searchQuery: '',
            selectedDate: '',
        };
    },
    computed: {
        uniqueDates() {
            return [...new Set(this.das.map(item => item.tanggal))];
        },
        filteredDas() {
            return this.das.filter(item => {
                const matchesQuery = item.judul.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    item.tanggal.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    item.petugas.toLowerCase().includes(this.searchQuery.toLowerCase());

                const matchesDate = this.selectedDate ? item.tanggal === this.selectedDate : true;
                
                return matchesQuery && matchesDate;
            });
        },
    },
    mounted() {
        const token = localStorage.getItem('accessToken');
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        this.fetchDas();
    },
    methods: {
        fetchDas() {
            axios.get('api/das')
                .then(response => {
                    const dasData = response.data.das;
                    const promises = dasData.map(dasItem => {
                        return axios.get(`api/isi/das/${dasItem.id}`)
                            .then(response => {
                                dasItem.isiDas = response.data;
                                return dasItem;
                            });
                    });
                    return Promise.all(promises);
                })
                .then(updatedDas => {
                    this.das = updatedDas;
                    console.log('Data berhasil diambil:', this.das);
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        },
        printPDF() {
            const printArea = document.getElementById('printArea');
            html2canvas(printArea, { scale: 2 }).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const pdf = new jsPDF('p', 'mm', 'a4');
                const imgWidth = 210; // Full width of the PDF page
                const pageHeight = 295;
                const imgHeight = (canvas.height * imgWidth) / canvas.width;
                let heightLeft = imgHeight;
                let position = 0;

                pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;

                while (heightLeft >= 0) {
                    position = heightLeft - imgHeight;
                    pdf.addPage();
                    pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }
                pdf.save('Daftar-Acara-Siaran.pdf');
            });
        }

    }
};
</script>

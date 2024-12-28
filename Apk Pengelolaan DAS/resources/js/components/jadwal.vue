<template>
    <div class="container">
        <div class="box">
            <div class="boxSearch">
                <input type="text" v-model="searchQuery" placeholder="Search...">
                <label class="btnSearch"><font-awesome-icon :icon="['fas', 'magnifying-glass']" /></label>
            </div>
        </div>
        <table class="tableJadwal">
            <tr>
                <th>Nama Penyiar</th>
                <th>Waktu</th>
                <th class="thTanggal">Hari dan Tanggal</th>
                <th>Shift</th>
                <th>Tempat</th>
            </tr>
            <tr v-for="(item, i) in manageJadwal" :key="i">
                <td>{{ item.nama }}</td>
                <td>{{ item.waktu }}</td>
                <td>{{ item.hariTanggal }}</td>
                <td>{{ item.shift }}</td>
                <td>{{ item.tempat }}</td>
            </tr>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            jadwal: [],
            searchQuery: ''
        }
    },
    computed: {
        manageJadwal() {
            return this.jadwal.filter(item => {
                return item.nama.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                       item.hariTanggal.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                       item.shift.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                       item.tempat.toLowerCase().includes(this.searchQuery.toLowerCase());
            });
        }
    },
     mounted() {
        this.fetchJadwal(); 
    },
    methods: {
        fetchJadwal() {
            axios.get('api/manage-jadwal').then(response => {
                this.jadwal = response.data;
            }).catch(error => {
                console.error("There was an error fetching the jadwal data:", error);
            });
        },
        deleteIsi(id) {
            axios.delete(`api/delete-jadwal/${id}`).then(() => {
                this.jadwal = this.jadwal.filter(item => item.id !== id);
            }).catch(error => {
                console.error("There was an error deleting the jadwal data:", error);
            });
        },
    }
}
</script>

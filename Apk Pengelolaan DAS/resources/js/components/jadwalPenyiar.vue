<template>
    <div class="container">
        <div class="box">
            <RouterLink to="/tambahjadwal" class="btn">+ Jadwal</RouterLink>
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
                <th></th>
                <th></th>
            </tr>
            <tr v-for="(item, i) in manageJadwal" :key="i">
                <td>{{ item.nama }}</td>
                <td>{{ item.waktu }}</td>
                <td>{{ item.hariTanggal }}</td>
                <td>{{ item.shift }}</td>
                <td>{{ item.tempat }}</td>
                <td><button @click.prevent="editIsi(item.id)"><font-awesome-icon :icon="['fas', 'pen-to-square']" /></button></td>
                <td><button @click.prevent="deleteIsi(item.id)"><font-awesome-icon :icon="['fas', 'trash-can']" /></button></td>
            </tr>
        </table>

        <p v-if="jadwal.length === 0">No data available</p>

        <div v-if="showUpdateModal" class="modal">
            <div class="modal-content">
                <div class="boxOption">
                    <h2>Update Data</h2>
                    <router-link to="" @click="showUpdateModal = false"><font-awesome-icon :icon="['fas', 'x']" /></router-link>
                </div>
                <form @submit.prevent="updateIsi" class="boxInputData">
                    <div class="input-group">
                        <label for="editNama" class="labelJadwal">Nama</label><span>:</span>
                        <input type="text" v-model="editItem.nama" id="editNama" required>
                    </div>
                    <div class="input-group">
                        <label for="editWaktu" class="labelJadwal">Waktu</label><span>:</span>
                        <input type="text" v-model="editItem.waktu" id="editWaktu" required>
                    </div>
                    <div class="input-group">
                        <label for="editHariTanggal" class="labelJadwal">Hari & Tanggal</label><span>:</span>
                        <input type="text" v-model="editItem.hariTanggal" id="editHariTanggal" required>
                    </div>
                    <div class="input-group">
                        <label for="editShift" class="labelJadwal">Shift</label><span>:</span>
                        <input type="text" v-model="editItem.shift" id="editShift" required>
                    </div>
                    <div class="input-group">
                        <label for="editShift" class="labelJadwal">Tempat</label><span>:</span>
                        <input type="text" v-model="editItem.tempat" id="editShift" required>
                    </div>
                    <button type="submit" class="btnUpdate">Update</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            showUpdateModal: false,
            jadwal: [],
            editItem: {
                id: null,
                nama: '',
                waktu: '',
                hariTanggal: '',
                shift: '',
                tempat: ''
            },
            searchQuery: ''
        }
    },
    computed:{
        manageJadwal(){
            return this.jadwal.filter(item =>{
                return item.nama.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                item.hariTanggal.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                item.shift.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                item.tempat.toLowerCase().includes(this.searchQuery.toLowerCase());
            })
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
            if(confirm('Apakah anda yakin ingin menghapus data jadwal ?')) {
                axios.delete(`api/delete-jadwal/${id}`).then(() => {
                    this.jadwal = this.jadwal.filter(item => item.id !== id);
                }).catch(error => {
                    console.error("There was an error deleting the jadwal data:", error);
                });
            } else {
                alert('Penghapusan dibatalkan');
            }
        },
        editIsi(id) {
            const item = this.jadwal.find(item => item.id === id);
            if (item) {
                this.editItem = { ...item };
                this.showUpdateModal = true;
            }
        },
        updateIsi() {
            axios.put(`api/update-jadwal/${this.editItem.id}`, this.editItem).then(response => {
                console.log("Update Response: ", response.data);
                const updatedItem = response.data.data;
                const index = this.jadwal.findIndex(item => item.id === this.editItem.id);
                if (index !== -1) {
                    this.jadwal.splice(index, 1, updatedItem);
                }
                this.showUpdateModal = false;
                this.$forceUpdate();
            }).catch(error => {
                console.error("There was an error updating the jadwal data:", error);
            });
        }
    }
}
</script>

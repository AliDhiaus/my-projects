<template>
    <div class="container">
        <div class="box">
            <div class="boxSearch">
                <input type="text" v-model="searchQuery" placeholder="Search...">
                <button class="btnSearch" @click="filterDas"><font-awesome-icon :icon="['fas', 'magnifying-glass']" /></button>
            </div>
            <router-link to="/tambah-das" class='btn'>
                <font-awesome-icon :icon="['fas', 'plus']" /> DAS
            </router-link>
        </div>

        <div class="cardInput" v-for="(value, i) in filteredDas" :key="i">
            <div class="boxOption">
                <router-link to="" @click.prevent="tambahDas(value.id)"><font-awesome-icon :icon="['fas', 'plus']" /> Isi DAS</router-link>
                <router-link to="" @click.prevent="hapusDas(value.id)"><font-awesome-icon :icon="['fas', 'x']" /></router-link>
            </div>
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
            <table v-if="value.isiDas.length !== 0">
                <tr>
                    <th>Waktu</th>
                    <th>Program</th>
                    <th>Frame</th>
                    <th>Durasi</th>
                    <th class="thKet">Keterangan</th>
                    <th></th>
                    <th></th>
                </tr>
                <tr v-for="(item, j) in value.isiDas" :key="j">
                    <td>{{ item.waktu }}</td>
                    <td>{{ item.program }}</td>
                    <td>{{ item.frame }}</td>
                    <td>{{ item.durasi }}</td>
                    <td>{{ item.keterangan }}</td>
                    <td><button @click.prevent="editIsi(value.id, item)"><font-awesome-icon :icon="['fas', 'pen-to-square']" /></button></td>
                    <td><button @click.prevent="deleteIsi(value.id, item.id)"><font-awesome-icon :icon="['fas', 'trash-can']" /></button></td>
                </tr>
            </table>
            <p v-else >--- Isi Daftar Acara Siaran Not Found ---</p>
        </div>

        <div v-if="filteredDas.length === 0">
            <p>No data available.</p>
        </div>

        <div v-if="showUpdateModal" class="modal">
            <div class="modal-content">
                <div class="boxOption">
                    <h2>Update Data</h2>
                    <router-link to="" @click="showUpdateModal = false"><font-awesome-icon :icon="['fas', 'x']" /></router-link>
                </div>
                <form @submit.prevent="updateIsi" class="boxInputData">
                    <div class="input-group">
                        <label for="waktu">Waktu</label><span>:</span>
                        <input type="text" v-model="editItem.waktu" id="waktu" required>
                    </div>
                    <div class="input-group">
                        <label for="program">Program</label><span>:</span>
                        <input type="text" v-model="editItem.program" id="program" required>
                    </div>
                    <div class="input-group">
                        <label for="frame">Frame</label><span>:</span>
                        <input type="text" v-model="editItem.frame" id="frame" required>
                    </div>
                    <div class="input-group">
                        <label for="frame">Durasi</label><span>:</span>
                        <input type="text" v-model="editItem.durasi" id="frame" required>
                    </div>
                    <div class="input-group">
                        <label for="keterangan">Keterangan</label><span>:</span>
                        <textarea type="text" v-model="editItem.keterangan" id="keterangan" required></textarea>
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
            das: [],
            showUpdateModal: false,
            editItem: {
                id: null,
                waktu: '',
                program: '',
                frame: '',
                keterangan: ''
            },
            editDasId: null,
            searchQuery: ''
        };
    },
    computed: {
        filteredDas() {
            return this.das.filter(item => {
                return item.judul.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                       item.tanggal.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                       item.petugas.toLowerCase().includes(this.searchQuery.toLowerCase());
            });
        }
    },
    mounted() {
        const token = localStorage.getItem('accessToken');
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        this.fetchDas();
    },
    methods: {
        fetchDas() {
            axios.get('api/manage/das')
                .then(response => {
                    const dasData = response.data;
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
        tambahDas(id) {
            this.$router.push({ 
                name: 'TambahIsiDAS', 
                params: { id } 
            });    
        },
        hapusDas(id){
            if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                axios.delete(`api/delete-das/${id}`)
                    .then(response => {
                        console.log(response.data);
                        this.das = this.das.filter(item => item.id !== id);
                        alert('Item berhasil dihapus');
                    })
                    .catch(error => {
                        console.error(error);
                        alert('Gagal menghapus item');
                    });
            } else {
                alert('Penghapusan dibatalkan');
            }
        },
        deleteIsi(dasId, isiId) {
            axios.delete(`api/delete-isi-das/${isiId}`).then(response => {
                console.log(response.data);
                const dasItem = this.das.find(item => item.id === dasId);
                if (dasItem) {
                    dasItem.isiDas = dasItem.isiDas.filter(item => item.id !== isiId);
                }
            }).catch(error => {
                console.error(error);
            });
        },
        editIsi(dasId, item) {
            this.editItem = { ...item };
            this.editDasId = dasId;
            this.showUpdateModal = true;
        },
        updateIsi() {
            axios.put(`api/update-isi-das/${this.editItem.id}`, this.editItem)
                .then(response => {
                    console.log(response.data);
                    const dasItem = this.das.find(item => item.id === this.editDasId);
                    if (dasItem) {
                        const isiIndex = dasItem.isiDas.findIndex(item => item.id === this.editItem.id);
                        if (isiIndex !== -1) {
                            dasItem.isiDas[isiIndex] = { ...this.editItem };
                        }
                    }
                    this.showUpdateModal = false;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        filterDas() {
            console.log('Search query:', this.searchQuery);
        }
    }
};
</script>

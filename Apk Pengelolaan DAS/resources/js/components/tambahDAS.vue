
<template>
    <div class="boxForm">
        <h1><router-link to="/das" class="linkBar"><FontAwesomeIcon :icon="['far', 'circle-left']" /></router-link> Tambah Daftar Acara Siaran</h1>
        <form action="inputData" class="boxInputData">
            <div class="form-group">
                <label for="kodeNRP">Judul</label><span>:</span>
                <input type="text" class="form-control" id="kodeNRP" v-model='judul' placeholder="Masukkan Judul Siaran">
            </div>
            <div class="form-group">
                <label for="kodeNRP">Hari dan Tanggal</label><span>:</span>
                <input type="date" class="form-control" id="kodeNRP" v-model='tanggal' placeholder="Masukkan Hari dan Tanggal">
            </div>
            <div class="form-group">
                <label for="tugas">Petugas</label><span>:</span>
                <input type="text" class="form-control" id="tugas" v-model='petugas' placeholder="Masukkan Petugas">
            </div>
            <div class="boxBtn">
                <button type="submit" @click="simpanDas" class="btn">Submit</button>
            </div>
        </form>
    </div>
</template>
<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import axios from 'axios';

export default {
    data() {
        return {
            judul: '',
            tanggal: '',
            petugas: ''
        };
    },
    components: {
        FontAwesomeIcon
    },
    mounted() {
        const token = localStorage.getItem('accessToken');
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    },
    methods: {
        simpanDas(event){
            event.preventDefault();
            const data = {
                judul: this.judul,
                tanggal: this.tanggal,
                petugas: this.petugas
            };
            axios.post('api/manage/das', data)
            .then(response => {
                console.log('data berhasil di simpan :' + response.data);
                this.$router.push('das')
            })
            .catch(error => {
                console.log('data error' + error.data)
                if(!this.data) {
                    alert('isi dulu dan jangan ada yang tidak terisi')
                } else if (error.response){
                    console('Data tidak berhasil di simpan');
                } else {
                    console('axios tidak berjalan dengan baik');
                }
            })
        }
    }
}
</script>
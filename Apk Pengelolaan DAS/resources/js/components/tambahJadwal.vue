<template>
    <div class="boxForm">        
        <h1><router-link to="/manage-jadwal" class="linkBar"><FontAwesomeIcon :icon="['far', 'circle-left']" /></router-link> Tambah Jadwal Penyiar</h1>
        <form action="inputData" class="boxInputData">
            <div class="form-group">
                <label>Nama Penyiar</label><span>:</span>
                <input type="text" class="form-control" v-model="nama" placeholder="Masukkan Nama Penyiar">
            </div>
            <div class="form-group">
                <label>Waktu</label><span>:</span>
                <select class="form-control" id="Shift" v-model="waktu">
                    <option value="" disabled selected>Pilih Shift</option>
                    <option value="04:00 - 10:00">04:00 - 10:00</option>
                    <option value="10:01 - 16:00">10:01 - 16:00</option>
                    <option value="16:01 - 22:00">16:01 - 22:00</option>
                </select>            
            </div>
            <div class="form-group">
                <label>Hari & Tanggal</label><span>:</span>
                <input type="date" class="form-control" v-model="tanggal" placeholder="Masukkan Hari Dan Tanggal">
            </div>
            <div class="form-group">
                <label>Shift</label><span>:</span>
                <input type="text" class="form-control" v-model="shift" placeholder="Masukkan Shift">
            </div>
            <div class="form-group">
                <label>Tempat</label><span>:</span>
                <input type="text" class="form-control" v-model="tempat" placeholder="Masukkan Tempat">
            </div>
            <div class="boxBtn">
                <button type="submit" class="btn" @click.prevent="tambahJadwal">Submit</button>
            </div>
        </form>
    </div>
</template>

<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import axios from 'axios';

export default {
    components: {
        FontAwesomeIcon
    },
    data() {
        return {
            nama: '',
            waktu: '',
            tanggal: '',
            shift: '',
            tempat: ''
        }
    },
    methods: {
        getHari(dateString) {
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const date = new Date(dateString);
            return days[date.getUTCDay()];
        },
        tambahJadwal() {
            const hari = this.getHari(this.tanggal);

            const output = {
                nama: this.nama,
                waktu: this.waktu,
                hariTanggal: `${hari}, ${this.tanggal}`,
                shift: this.shift,
                tempat: this.tempat
            }

            axios.post('api/manage-jadwal', output).then(response => {
                alert('Jadwal berhasil ditambahkan')
            }).catch(error => {
                console.error('Terjadi kesalahan: ', error);
            });
        }
    }
}
</script>

<template>
    <div class="boxForm">
        <h1>
            <router-link to="/das" class="linkBar">
                <font-awesome-icon :icon="['far', 'circle-left']" />
            </router-link>
            Tambah Isi Daftar Acara Siaran
        </h1>
        <form  class="boxInputData">
            <h4>{{ id }}</h4>
            <div class="form-group">
                <label>Shift</label><span>:</span>
                <select class="form-control" id="Shift" v-model="selectedShift" @change="handleShiftChange">
                    <option value="" disabled selected>Pilih Shift</option>
                    <option value="shift1">04:00 - 10:00</option>
                    <option value="shift2">10:01 - 16:00</option>
                    <option value="shift3">16:01 - 22:00</option>
                </select>
            </div>
            <div class="form-group" v-if="pagi">
                <label for="waktu">Waktu</label><span>:</span>
                <input type="time" class="form-control" id="waktu" v-model="waktu"  @change="validateTime('10:00')" />
            </div>
            <div class="form-group" v-if="siang">
                <label for="waktu">Waktu</label><span>:</span>
                <input type="time" class="form-control" id="waktu" v-model="waktu" @change="validateTime('16:00')" />
            </div>
            <div class="form-group" v-if="malam">
                <label for="waktu">Waktu</label><span>:</span>
                <input type="time" class="form-control" id="waktu" v-model="waktu" @change="validateTime('20:00')" />
            </div>
            <div class="form-group">
                <label for="program">Program</label><span>:</span>
                <input type="text" class="form-control" id="program" v-model="program" placeholder="Masukkan Program" />
            </div>
            <div class="form-group">
                <label for="frame">Frame</label><span>:</span>
                <input type="text" class="form-control" id="frame" v-model="frame" placeholder="Masukkan Frame" />
            </div>
            <div class="form-group">
                <label for="durasi">Durasi</label><span>:</span>
                <input type="text" class="form-control" id="durasi" v-model="durasi" placeholder="Masukkan Durasi" />
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label><span>:</span>
                <input type="text" class="form-control" id="keterangan" v-model="keterangan" placeholder="Masukkan Keterangan" />
            </div>
            <p v-if="error" class="error">{{ error }}</p>
            <div class="boxBtn">
                <button type="submit" @click.prevent="simpanDas()" class="btn">Submit</button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            id: this.$route.params.id,
            selectedShift: '',
            pagi: false,
            siang: false,
            malam: false,
            waktu: '',
            isValid: true,
            maxTime: '',
            program: '',
            frame: '',
            durasi: '',
            keterangan: '',
            error: '',
            success: ''
        }
    },
    mounted() {
        const token = localStorage.getItem('accessToken');
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        axios.defaults.headers.common['Accept'] = 'application/json';
        axios.defaults.headers.common['Content-Type'] = 'application/json';

    },
    methods: {
        handleShiftChange() {
            if (this.selectedShift === 'shift1') {
                this.pagi = true;
                this.siang = false
                this.malam = false;
            } else if (this.selectedShift === 'shift2') {
                this.pagi = false
                this.siang = true;
                this.malam = false;
            } else if (this.selectedShift === 'shift3') {
                this.pagi = false
                this.siang = false
                this.malam = true;
            }
        },
        validateTime(maxTime) {
            if (this.waktu > maxTime) {
                alert(`Waktu yang dipilih melebihi batas maksimum ${maxTime}`)
                this.waktu = ''
            } 
        },
        simpanDas() {
            const data = {
                waktu: this.waktu,
                program: this.program,
                frame: this.frame,
                durasi: this.durasi,
                keterangan: this.keterangan,
            };
            axios.post(`/api/isi-das/${this.id}`, data)
                .then(response => {
                    alert('Data berhasil di tambahkan ke dalam tabel');
                    console.log(response.data);
                })
                .catch(error => {
                    this.error = 'Gagal menyimpan data ke dalam tabel';
                    this.success = '';
                    console.log(error);
                });
        }
    }
}
</script>


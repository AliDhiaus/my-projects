<template>
    <div class="container">
        <div class="boxCard">
            <div action="inputData" class="card" v-for="(item, i) in user" :key="i">
                <img :src="getImageUrl(item)" class="imgCard">
                <div class="boxCardBio">
                    <div class="cardBio">
                        <h3>NRP</h3><span>:</span>
                        <h4>{{ item.nrp }}</h4>
                    </div>
                    <div class="cardBio">
                        <h3>Nama</h3><span>:</span>
                        <h4>{{ item.name }}</h4>
                    </div>
                    <div class="cardBio">
                        <h3>Jabatan</h3><span>:</span>
                        <h4>{{ item.jabatan }}</h4>
                    </div>
                    <div class="cardBio">
                        <h3>Jenis Kelamin</h3><span>:</span>
                        <h4>{{ item.jenis_kelamin }}</h4>
                    </div>
                    <div class="cardBio">
                        <h3>Alamat</h3><span>:</span>
                        <h4>{{ item.alamat }}</h4>
                    </div>
                </div>
            </div>
        </div>      
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            user: []
        };
    },
    mounted() {
        this.fetchPenyiar();
    },
    methods: {
        fetchPenyiar() {
            axios.get('/api/manage-penyiar')
                .then(response => {
                    console.log('Data penyiar berhasil di ambil:', response.data);
                    this.user = response.data.filter(user => user.level === 'user');
                })
                .catch(error => {
                    console.error('Error fetching penyiar data:', error);
                });
        },
        getImageUrl(item) {
            return `data:image/jpeg;base64,${item.image}`;
        }
    }
};
</script>

<template>
        <h1 class="txProfile"><router-link to="" @click.prevent="faBackspace()" class="linkBar"><FontAwesomeIcon :icon="['far', 'circle-left']" /></router-link> Profile</h1>
        <div class="boxPP">
            <img :src="getImageUrl(account)" alt="image">
            <div class="boxBio">
                <h4>{{ account.nrp }}</h4>
                <h4>{{ account.name }}</h4>
                <h4>{{ account.jabatan }}</h4>
            </div>
        </div>
        <form action="inputData" class="boxInputData">
            <div class="form-group">
                <h3 for="kodeNRP">Kode NRP</h3><span>:</span>
                <h4>{{ account.nrp }}</h4>
            </div>
            <div class="form-group">
                <h3 for="namaLengkap">Nama Lengkap</h3><span>:</span>
                <h4>{{ account.name }}</h4>
            </div>
            <div class="form-group">
                <h3 for="jabatan">Jabatan</h3><span>:</span>
                <h4>{{ account.jabatan }}</h4>
            </div>      
            <div class="form-group">
                <h3 for="jabatan">Tanggal Lahir</h3><span>:</span>
                <h4>{{ account.tgl_lahir }}</h4>
            </div>      
            <div class="form-group">
                <h3 for="jabatan">Jenis Kelamin</h3><span>:</span>
                <h4>{{ account.jenis_kelamin }}</h4>
            </div>      
            <div class="form-group">
                <h3 for="jabatan">Alamat</h3><span>:</span>
                <h4>{{ account.alamat }}</h4>
            </div>      
            <div class="form-group">
                <h3 for="jabatan">No Handphone</h3><span>:</span>
                <h4>{{ account.no_hp }}</h4>
            </div>      
            <div class="form-group">
                <h3 for="jabatan">Email</h3><span>:</span>
                <h4>{{ account.email }}</h4>
            </div>      
        </form>
</template>

<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

export default {
    data() {
        return {
            account: {},
        };
    },
    components: {
        FontAwesomeIcon
    },
    mounted() {
        const token = localStorage.getItem('accessToken');
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        this.fetchProfile();
    },
    methods: {
        fetchProfile() {
            axios.get('/api/account/manage')
            .then(response => {
                    this.account = response.data;
                })
                .catch(error => {
                    console.error('Error fetching profile:', error);
                });
        },
        getImageUrl(account) {
            return `data:image/jpeg;base64,${account.image}`;
        },
        faBackspace(){
            const level = localStorage.getItem('userLevel');
            if(level === 'admin'){
                this.$router.push('/home-admin')
            } else {
                this.$router.push('/home')
            }
        }
    }
};
</script>

<template>
  <form class="boxLogin" @submit.prevent="resetPassword">
      <div class="cardlogin">
          <h1 class="judulReset">Reset Password</h1>
          <div>
              <h2>-- {{ account.name }} --</h2>
              <h2>{{ account.email }}</h2>
          </div>
          <input type="password" v-model="password" class="inputan" placeholder="New Password...">
          <input type="password" v-model="password_confirmation" class="inputan" placeholder="Confirm Password...">
          <button type="submit" class="btnLogin">Reset Password</button>
      </div>
  </form>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            account: {},
            password: '',
            password_confirmation: ''
        };
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
        resetPassword() {
            const payload = {
                password: this.password,
                password_confirmation: this.password_confirmation
            };

            axios.post('/api/account/manage', payload)
            .then(response => {
                this.successMessage = response.data.message;
                this.$router.push('/login')
            })
            .catch(error => {
                if(this.password === '' || this.password_confirmation === ''){
                    alert('Silahkan isi terlebih dahulu')
                } else if (this.password !== this.password_confirmation){
                    alert('Confirmasi passwor kamu berbeda')
                } else if (error.response) {
                    alert('Isi password minimal 8 karakter');
                } else {
                    console.error('Error resetting password:', error);
                }
            });
        }
    }
};
</script>

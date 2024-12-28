<template>
  <form class="boxLogin">
      <div class="cardlogin">
          <h1>Login</h1>
          <input type="email" v-model="email" class="inputan" placeholder="Username....">
          <input type="password" v-model="password" class="inputan" placeholder="Password...">
          <router-link to="" @click.prevent="forgotPassword" class="lupaPW">Forgot Password?</router-link>
          <button type="submit" @click.prevent="handleLogin" class="btnLogin">Login</button>
      </div>
  </form>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            email: '',
            password: ''
        };
    },
    methods: {
        handleLogin() {
            const dataLog = {
                email: this.email,
                password: this.password
            }
            axios.post('/api/login', dataLog)
            .then(response => {
                localStorage.setItem('accessToken', response.data.token);
                localStorage.setItem('userLevel', response.data.level);  
                if(response.data.level === 'admin'){
                    this.$router.push('/home-admin'); 
                } else {
                    this.$router.push('/home');    
                }         
            })
            .catch(error => {
                if(this.email === '' || this.password === ''){
                    alert('Silahkan masukan email dan password')
                } else if (error.response) {
                    alert('Email atau Password Kamu salah');
                } else {
                    alert('Terjadi kesalahan di bagian backend');
                }
            })
        },
        forgotPassword(){
            const getUser= { email: this.email }
            axios.post('/api/forgot-password', getUser)
            .then(response => {
                localStorage.setItem('accessToken', response.data.token);
                this.$router.push('/forgot');
                this.rEmail = response.data.email.email;
            })
            .catch(error => {
                if(this.email === ''){
                    alert('input email data yang mau di reset');
                } else if(!this.rEmail) {
                    alert('email tidak terdaftar');
                } else { 
                    console.log(error);
                }
            })
        }
    }
};
</script>

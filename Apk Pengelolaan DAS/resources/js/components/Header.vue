<template>
  <header class="head">
    <h1 class="txHeader">Hello {{account.name }}, Selamat Bertugas</h1>
    <h1 class="txHeaderMobile">Hello {{account.name }}, <br> Selamat Bertugas</h1>
    <div class="dropdown">
        <button @click="toggleDropdown" class="btnAkun">Account</button>
        <div v-if="showDropdown" class="dropdown-content">
            <router-link to="/" @click="goToProfile" class="isiDropdown">Profile</router-link>
            <router-link to="/" @click="logout" class="isiDropdown">Logout</router-link>
        </div>
    </div>
  </header>
</template>
<script>
export default {
  data() {
    return {
      showDropdown: false,
      showDropdownMenu: false,
      account: {}
    };
  },
  mounted() {
        const token = localStorage.getItem('accessToken');
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        this.fetchProfile();
  },
  methods: {
    toggleDropdown() {
      this.showDropdown = !this.showDropdown;
    },
    toggleDropdownMenu() {
      this.showDropdownMenu = !this.showDropdownMenu;
    },
    goToProfile() {
      const level = localStorage.getItem('userLevel');
      if(level == 'admin'){
        this.$router.push('/profile-admin');
      } else {
        this.$router.push('/profile');
      }
    },
    logout() {
      localStorage.removeItem('accessToken');
      localStorage.removeItem('userLevel');
      this.$router.push('/login');
    },
    fetchProfile() {
      axios.get('/api/account/manage')
      .then(response => {
        this.account = response.data;
      })
      .catch(error => {
        console.error('Error fetching profile:', error);
      });
    }
  }
}
</script>

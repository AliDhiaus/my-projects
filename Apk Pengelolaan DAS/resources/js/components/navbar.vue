<template>
    <nav>
        <rotert-link to="home" class="navbar"><img src="/image/logorricoid.png" class="logo" srcset="logo RRI"></rotert-link>
        <router-link to="home-admin" class="linkBar">Home</router-link>
        <router-link to="laporan-das" class="linkBar">Laporan Daftar Acara Siaran</router-link>
        <router-link to="manage-jadwal" class="linkBar">Manage Jadwal Penyiar</router-link>
        <router-link to="petugas" class="linkBar">Petugas Siaran</router-link>
    </nav>
    <div class="dropdownMenu">
        <button @click="toggleDropdownMenu" class="btnMenu">Menu</button>
        <div v-if="showDropdownMenu" class="dropdown-menu">
            <router-link to="home-admin" class="isiDropdown" @click="hideDropdownMenu">Home</router-link>
            <router-link to="laporan-das" class="isiDropdown" @click="hideDropdownMenu">Laporan Daftar Acara Siaran</router-link>
            <router-link to="manage-jadwal" class="isiDropdown" @click="hideDropdownMenu">Manage Jadwal Penyiar</router-link>
            <router-link to="petugas" class="isiDropdown" @click="hideDropdownMenu">Petugas Siaran</router-link>
            <router-link to="/" @click="goToProfile" class="isiDropdown">Profile</router-link>
            <router-link to="/" @click="logout" class="isiDropdown">Logout</router-link>
        </div>
    </div>
</template>
<script>
export default {
  data() {
    return {
      showDropdownMenu: false,
    };
  },
  mounted() {
        const token = localStorage.getItem('accessToken');
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        this.fetchProfile();
  },
  methods: {
    toggleDropdownMenu() {
      this.showDropdownMenu = !this.showDropdownMenu;
    },
    hideDropdownMenu() {
      this.showDropdownMenu = false;
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
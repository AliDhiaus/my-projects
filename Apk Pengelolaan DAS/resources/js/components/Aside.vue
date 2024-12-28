<template>
  <nav>
    <div class="navbar">
      <img src="/image/logorricoid.png" class="logo" alt="logo RRI">
    </div>
    <router-link to="home" class="linkBar">Home</router-link>
    <router-link to="das" class="linkBar">Daftar Acara Siaran</router-link>
    <router-link to="jadwal" class="linkBar">Jadwal Penyiar</router-link>
    <router-link to="penyiar" class="linkBar">Petugas Siaran</router-link>
  </nav>
  <div class="dropdownMenu">
    <button @click="toggleDropdownMenu" class="btnMenu">Menu</button>
    <div v-if="showDropdownMenu" class="dropdown-menu">
      <router-link to="home" id="home" class="isiDropdown" @click="hideDropdownMenu">Home</router-link>
      <router-link to="das" class="isiDropdown" @click="hideDropdownMenu">Daftar Acara Siaran</router-link>
      <router-link to="jadwal" class="isiDropdown" @click="hideDropdownMenu">Jadwal Penyiar</router-link>
      <router-link to="penyiar" class="isiDropdown" @click="hideDropdownMenu">Petugas Siaran</router-link>
      <router-link to="/" @click="goToProfile" class="isiDropdown">Profile</router-link>
      <router-link to="/" @click="logout" class="isiDropdown">Logout</router-link>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      showDropdown: false,
      showDropdownMenu: false,
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
    hideDropdownMenu() {
      this.showDropdownMenu = false;
    },
    goToProfile() {
      this.hideDropdownMenu();
      const level = localStorage.getItem('userLevel');
      if(level == 'admin'){
        this.$router.push('/profile-admin');
      } else {
        this.$router.push('/profile');
      }
    },
    logout() {
      this.hideDropdownMenu();
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

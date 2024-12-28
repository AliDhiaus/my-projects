import './bootstrap';

import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { fab } from '@fortawesome/free-brands-svg-icons';
import { far } from '@fortawesome/free-regular-svg-icons';
library.add(fas, far, fab);

import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';

import Login from './components/login.vue'; 
import Home from './components/Home.vue'; 
import HomeAdmin from './components/homeAdmin.vue'; 
import Header from './components/Header.vue'; 
import Aside from './components/Aside.vue'; 
import Penyiar from './components/penyiar.vue'; 
import DAS from './components/DAS.vue'; 
import laporanDas from './components/laporanDas.vue'; 
import TambahDAS from './components/tambahDAS.vue'; 
import TambahIsiDAS from './components/tambahIsiDas.vue'; 
import IsiHome from './components/isiHome.vue'; 
import JadwalPenyiar from './components/jadwalPenyiar.vue'; 
import Jadwal from './components/jadwal.vue'; 
import TambahJadwal from './components/tambahJadwal.vue'; 
import Footer from './components/Footer.vue'; 
import Forgot from './components/forgot.vue'; 
import Profile from './components/profile.vue'; 
import NotFound from './components/NotFound.vue'; 

const app = createApp({});

app.component('font-awesome-icon', FontAwesomeIcon);

app.component('login-component', Login);
app.component('header-component', Header);
app.component('aside-component', Aside);
app.component('notfound-component', NotFound);

const routes = [
    { path: '/login', component: Login },
    { path: '/forgot', component: Forgot },
    {
        path: '/home-admin',
        component: HomeAdmin,
        meta: { requiresAuth: true },
        children: [
            { path: '', component: IsiHome },
            { path: '/header', component: Header },
            { path: '/aside', component: Aside },
            { path: '/laporan-das', component: laporanDas },
            { path: '/manage-jadwal', component: JadwalPenyiar },
            { path: '/tambahjadwal', component: TambahJadwal, meta: { noHeader: true } },
            { path: '/petugas', component: Penyiar },
            { path: '/profile-admin', component: Profile, meta: { noHeader: true } },
        ],
    },
    {
        path: '/home',
        component: Home,
        meta: { requiresAuth: true },
        children: [
            { path: '', component: IsiHome },
            { path: '/header', component: Header },
            { path: '/aside', component: Aside },
            { path: '/das', component: DAS },
            { path: '/tambah-das', component: TambahDAS, meta: { noHeader: true } },
            { path: '/tambah-isi-das/:id?',name: 'TambahIsiDAS', component: TambahIsiDAS, meta: { noHeader: true } },
            { path: '/jadwal', component: Jadwal },
            { path: '/penyiar', component: Penyiar },
            { path: '/profile', component: Profile, meta: { noHeader: true } },
        ],
    },
    { path: '/footer', component: Footer },
    { path: '/:pathMatch(.*)*', name: 'NotFound', component: NotFound }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

app.use(router);
app.component('font-awesome-icon', FontAwesomeIcon);
app.mount('#app');

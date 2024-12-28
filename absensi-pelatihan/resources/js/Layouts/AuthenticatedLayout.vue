<script setup>
import { onMounted, ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import { sideAdmin } from '@/lib/data'; 
import { sideUser } from '@/lib/data'; 
import { library } from '@fortawesome/fontawesome-svg-core';
import { faUserSecret, faTrashCan, faPlus, faHouse, faPhoneVolume } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faInstagram, faFacebook } from '@fortawesome/free-brands-svg-icons';
library.add(faUserSecret, faTrashCan, faPlus, faHouse, faPhoneVolume, faInstagram, faFacebook);

const showingNavigationDropdown = ref(false);
</script>
            
<template>
    <div>
        <div class="min-h-screen">
            <nav class="bg-gray-100 border-b border-gray-100 fixed w-full p-2 z-30">
                <!-- Primary Navigation Menu -->
                <div>
                    <div class="flex justify-between p-2 h-16">
                        <div class="flex">
                            <div class="shrink-0 flex flex-col items-center">  
                                <h1 class="px-52 text-2xl font-bold">Balai Besar Pelatihan Vokasi dan Produktivitas (BBPVP) Serang</h1>
                                <p>We Care About Your Bright Future – Office & workshop at – Jln Raya Pandeglang km.3 Serang</p>                      
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                            >
                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                            >
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="text-sm sm:hidden"
                >
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800">
                            {{ $page.props.auth.user.name }}
                        </div>
                        <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="p-2 border-t border-gray-200" v-if="$page.props.auth.user.role === 'admin'">
                        <div class="max-w-7xl mx-auto" v-for="(item, i) in sideAdmin" :key="i">
                            <ResponsiveNavLink :href="route(item.url)">{{item.name}}</ResponsiveNavLink>
                        </div>
                        <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                            Log Out
                        </ResponsiveNavLink>
                    </div>

                    <div class="pt-4 pb-1 border-t border-gray-200" v-if="$page.props.auth.user.role === 'user'">
                        <div class="max-w-7xl mx-auto" v-for="(item, i) in sideUser" :key="i">
                            <ResponsiveNavLink :href="route(item.url)">{{item.name}}</ResponsiveNavLink>
                        </div>
                        <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                            Log Out
                        </ResponsiveNavLink>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <aside class="bg-blue-900 fixed h-full  shadow w-52 text-white font-bold hidden z-40 md:block z-5" v-if="$page.props.auth.user.role === 'admin'">
                <div>
                    <img src="/image/logo.png" alt="image" class="w-full">
                   <div class="max-w-7xl mx-auto py-4 px-2 w-full" v-for="(item, i) in sideAdmin" :key="i">
                      <Link :href="route(item.url)" class="p-2 hover:text-yellow-200"><font-awesome-icon :icon="item.icon" /> {{item.name}}</Link>
                   </div>
               </div>
               <div class="bg-slate-100 absolute bottom-0 w-full flex flex-col justify-center items-center text-black">
                     <div class="py-4 px-4" >
                         <h1><font-awesome-icon :icon="['fas', 'phone-volume']" /> 0254-200160</h1>
                         <a href="https://www.facebook.com/pemberdayaan.bblkiserang"><font-awesome-icon :icon="['fab', 'instagram']" /> BBPLK Serang </a>
                         <a href="https://www.instagram.com/bbpvp_serang?igsh=MWdmanNtaHVhZmh0dQ=="><font-awesome-icon :icon="['fab', 'facebook']" /> bbpvp_serang</a>
                     </div>
                </div>
            </aside>

            <aside class="bg-blue-900 shadow w-52  h-full text-white font-bold fixed hidden z-40 md:block" v-if="$page.props.auth.user.role === 'user'">
                <div>
                   <div class="flex justify-center">
                       <img src="/image/logo.png" alt="image" class="w-full">
                   </div>
                   <div class="max-w-7xl mx-auto py-4 px-4" v-for="(item, i) in sideUser" :key="i">
                      <Link :href="route(item.url)" class="p-2 hover:text-yellow-200"><font-awesome-icon :icon="item.icon" /> {{item.name}}</Link>
                   </div>
                </div>
                <div class="bg-slate-100 absolute bottom-0 w-full flex flex-col justify-center items-center text-black">
                     <div class="flex flex-col py-4" >
                         <h1><font-awesome-icon :icon="['fas', 'phone-volume']" /> 0254-200160</h1>
                         <a href="https://www.facebook.com/pemberdayaan.bblkiserang"><font-awesome-icon :icon="['fab', 'instagram']" /> BBPLK Serang </a>
                         <a href="https://www.instagram.com/bbpvp_serang?igsh=MWdmanNtaHVhZmh0dQ=="><font-awesome-icon :icon="['fab', 'facebook']" /> bbpvp_serang</a>
                     </div>
                </div>
            </aside>
             <div class="w-full h-dvh">

                 <!-- Page Content -->
                 <main class="w-full p-2 absolute top-5 md:top-14 md:right-2 md:w-2/3 lg:w-5/6">
                     <slot name="dashboard"/>
                 </main>
             </div>
        </div>
    </div>
</template>

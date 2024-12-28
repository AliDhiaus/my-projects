<script setup>
import { ref } from 'vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { linkAdmin } from '@/lib/data';
import { linkCS } from '@/lib/data';
import { linkKonsumen } from '@/lib/data';
const data = defineProps({
    total : Number,
})


const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="">
        <div class="min-h-screen">
            <nav class="bg-gray-100 border-b border-gray-100 fixed w-full z-40">
                <!-- Primary Navigation Menu -->
                <div>
                    <div class="flex justify-between px-6 p-2 h-16">
                        <div class="flex">
                            <div class="shrink-0 flex gap-5 items-center">                        
                                    <img src="/image/logo.png" class="w-36">
                                    <h1 class="text-lg">PT. Mandiri Utama Finance Serang</h1>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown -->
                            <div>
                                <h1>Hallo {{ $page.props.auth.user.role }}, {{ $page.props.auth.user.name }}</h1>
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
                    // <div class="p-2 border-t border-gray-200" v-if="$page.props.auth.user.role === 'admin'">
                    //     <div class="max-w-7xl mx-auto" v-for="(item, i) in sideAdmin" :key="i">
                    //         <ResponsiveNavLink :href="route(item.url)">{{item.name}}</ResponsiveNavLink>
                    //     </div>
                    //     <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>
                    //     <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                    //         Log Out
                    //     </ResponsiveNavLink>
                    // </div>

                    // <div class="pt-4 pb-1 border-t border-gray-200" v-if="$page.props.auth.user.role === 'user'">
                    //     <div class="max-w-7xl mx-auto" v-for="(item, i) in sideUser" :key="i">
                    //         <ResponsiveNavLink :href="route(item.url)">{{item.name}}</ResponsiveNavLink>
                    //     </div>
                    //     <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>
                    //     <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                    //         Log Out
                    //     </ResponsiveNavLink>
                    // </div>
                </div>
            </nav>

            <!-- Page Heading -->
             <div class="flex w-full h-dvh">
                 <aside class="bg-blue-900 fixed h-full top-16 shadow w-60 hidden md:block" v-if="$page.props.auth.user.role === 'Admin'">
                    <div class="mt-2">
                        <div class="max-w-7xl mx-auto py-2" v-for="(item, i) in linkAdmin" :key="i">
                            <ResponsiveNavLink :href="route(item.link)" class="text-white font-bold hover:text-slate-900 relative">
                                <div class="py-0 text-sm px-3 rounded-full bg-red-500 text-white absolute right-2 top-2" v-if="item.name==='Data Costumer Service' && total > 0">
                                {{ total }}
                            </div>
                            {{ item.name }}
                        </ResponsiveNavLink>
                        </div>
                        <ResponsiveNavLink :href="route('logout')" method="post" as="button" class="p-2 text-white font-bold hover:text-slate-900">Log Out</ResponsiveNavLink>
                    </div>
                 </aside>

                 <aside class="shadow w-52 top-16 h-full bg-blue-900  fixed hidden md:block" v-if="$page.props.auth.user.role === 'Customer Service'">
                    <div class="mt-2">
                        <div class="max-w-7xl mx-auto py-2" v-for="(item, i) in linkCS" :key="i">
                           <ResponsiveNavLink :href="route(item.link)" class="relative text-white font-bold hover:text-slate-900">
                            <div class="py-0 text-sm px-3 rounded-full bg-red-500 text-white absolute right-2 top-3" v-if="item.name==='Laporan Konsumen' && total > 0">
                                {{ total }}
                            </div>
                            {{ item.name }}
                        </ResponsiveNavLink>
                        </div>
                        <ResponsiveNavLink :href="route('logout')" method="post" as="button" class="p-2 text-white font-bold hover:text-slate-900">Log Out</ResponsiveNavLink>
                    </div>
                 </aside>

                 <aside class="bg-blue-900 shadow w-52 top-16 h-full bg-blue-900  fixed hidden md:block" v-if="$page.props.auth.user.role === 'User'">
                    <div class="mt-2">
                        <div class="max-w-7xl mx-auto py-2" v-for="(item, i) in linkKonsumen" :key="i">
                           <ResponsiveNavLink :href="route(item.link)" class="text-white font-bold hover:text-slate-900">{{ item.name }}</ResponsiveNavLink>
                        </div>
                        <ResponsiveNavLink :href="route('logout')" method="post" as="button" class="p-2 text-white font-bold hover:text-slate-900">Log Out</ResponsiveNavLink>
                    </div>
                 </aside>

                 <!-- Page Content -->
                 <main class="w-full p-2 absolute top-5 md:top-14 md:right-2 md:w-2/3 lg:w-5/6">
                    
                    <slot name="header"/>
                    <slot name="dashboard"/>
                 </main>
             </div>
        </div>
    </div>
</template>

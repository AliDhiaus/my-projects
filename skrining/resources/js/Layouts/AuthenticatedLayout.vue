<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faFile, faUser } from '@fortawesome/free-regular-svg-icons';
import { faHome } from '@fortawesome/free-solid-svg-icons';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <nav class="fixed w-full bg-gradient-to-r from-green-500 to-blue-500 border-b border-gray-100">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex gap-2 justify-center items-center text-white font-bold">
                            <img src="/image/logoKesehatan.png" class="w-10" alt="" srcset="">
                            <h1>SINAPZA Skrining Napza</h1>
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
                                            class="bg-transparent font-bold  text-white inline-flex items-center px-3 py-2 text-sm leading-4 font-medium  transition ease-in-out duration-150"
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

                                <template  #content>
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
                class="sm:hidden"
            >
                <div class="pt-2 pb-3 space-y-1">
                    <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                        Dashboard
                    </ResponsiveNavLink>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t bg-slate-100 border-gray-200">
                    <div class="px-4 bg-slate-100">
                        <div class="font-medium text-base bg-slate-100 text-gray-800">
                            {{ $page.props.auth.user.name }}
                        </div>
                        <div class="font-medium text-sm bg-slate-100 text-gray-500">{{ $page.props.auth.user.email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <ResponsiveNavLink :href="route('dashboard')"> Dashboard </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('demografi')"> Demografi </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('kelurahan')"> Keurahan Faskes </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('logout')" method="post" as="button">Log Out</ResponsiveNavLink>
                    </div>
                </div>
            </div>
        </nav>
        <div class="w-full h-full">
            <aside class="fixed h-full w-1/5 pt-3 bg-white shadow flex flex-col gap-2 z-40 hidden md:block md:flex lg:w-52" style="top: 4rem;">
                <Link :href="route('dashboard')" class="p-3 hover:bg-[#173B45] hover:text-white"><FontAwesomeIcon :icon="faHome" /> Dashboard</Link>
                <Link :href="route('demografi')" class="p-3 hover:bg-[#173B45] hover:text-white"><FontAwesomeIcon :icon="faUser" /> Demografi</Link>
                <Link :href="route('kelurahan')" class="p-3  hover:bg-[#173B45] hover:text-white"><FontAwesomeIcon :icon="faFile" /> Kelurahan Faskes</Link>
            </aside>
            <main class="w-full h-full pt-16 md:w-3/4 md:ml-44 lg:w-3/4 lg:ml-64"> 
                <div class="p-3" v-if="$slots.dashboard">
                    <slot name="dashboard" />
                </div>
                <div class="p-3" v-if="$slots.demografi">
                    <slot name="demografi" />
                </div>
                <div class="p-3" v-if="$slots.detail">
                    <slot name="detail" />
                </div>
                <div class="p-3" v-if="$slots.kelurahan">
                    <slot name="kelurahan" />
                </div>
                <div class="p-3" v-if="$slots.Profile">
                    <slot name="Profile" />
                </div>
            </main>
        </div>
    </div>
</template>



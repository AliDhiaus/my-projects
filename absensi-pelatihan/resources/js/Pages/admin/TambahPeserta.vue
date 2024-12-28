<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    name: '',
    tanggal_lahir: '',
    jenis_kelamin: '',
    alamat: '',
    username: '',
    email: '',
    password: '',
    password_confirmation: '',
    role: 'user',
    terms: false,
});

const submit = () => {
    form.post(route('postPeserta'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #dashboard>
            <div class="py-12">
                <div class="max-w-7xl mx-auto text-sm md:text-md lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <form @submit.prevent="submit">
                                <div>
                                    <InputLabel for="name" value="Full Name" />
                    
                                    <TextInput
                                        id="name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.name"
                                        required
                                        autofocus
                                        autocomplete="name"
                                    />
                    
                                    <InputError class="mt-2" :message="form.errors.name" />
                                </div>           
                                <div class="mt-4">
                                    <InputLabel for="tanggal_lahir" value="Tanggal Lahir" />
                    
                                    <TextInput
                                        id="tanggal_lahir"
                                        type="date"
                                        class="mt-1 block w-full"
                                        v-model="form.tanggal_lahir"
                                        required
                                        autofocus
                                        autocomplete="tanggal_lahir"
                                    />
                    
                                    <InputError class="mt-2" :message="form.errors.tanggal_lahir" />
                                </div>           
                                <div class="mt-4">
                                    <InputLabel for="jenis_kelamin" value="Jenis Kelamin" />
                    
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="w-full" v-model="form.jenis_kelamin"  required autofocus autocomplete="jenis_kelamin">
                                        <option value="">Laki-Laki</option>
                                        <option value="perempuan">Perempuan</option>
                                    </select>
                    
                                    <InputError class="mt-2" :message="form.errors.jenis_kelamin" />
                                </div>           
                                <div class="mt-4">
                                    <InputLabel for="alamat" value="Alamat" />
                    
                                    <TextInput
                                        id="alamat"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.alamat"
                                        required
                                        autofocus
                                        autocomplete="alamat"
                                    />
                    
                                    <InputError class="mt-2" :message="form.errors.alamat" />
                                </div>           
                                <div class="mt-4">
                                    <InputLabel for="name" value="Username" />
                    
                                    <TextInput
                                        id="username"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.username"
                                        required
                                        autofocus
                                        autocomplete="username"
                                    />
                    
                                    <InputError class="mt-2" :message="form.errors.username" />
                                </div>
                                <div class="mt-4">
                                    <InputLabel for="email" value="Email" />
                    
                                    <TextInput
                                        id="email"
                                        type="email"
                                        class="mt-1 block w-full"
                                        v-model="form.email"
                                        required
                                        autocomplete="email"
                                    />
                    
                                    <InputError class="mt-2" :message="form.errors.email" />
                                </div>
                                <div class="mt-4">
                                    <InputLabel for="password" value="Password" />
                    
                                    <TextInput
                                        id="password"
                                        type="password"
                                        class="mt-1 block w-full"
                                        v-model="form.password"
                                        required
                                        autocomplete="new-password"
                                    />
                    
                                    <InputError class="mt-2" :message="form.errors.password" />
                                </div>
                                <div class="mt-4">
                                    <InputLabel for="password_confirmation" value="Confirm Password" />
                    
                                    <TextInput
                                        id="password_confirmation"
                                        type="password"
                                        class="mt-1 block w-full"
                                        v-model="form.password_confirmation"
                                        required
                                        autocomplete="new-password"
                                    />
                    
                                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                                </div>
                                <div class="mt-4" hidden>
                                    <InputLabel for="role" value="Role" />
                    
                                    <TextInput 
                                        id="role"
                                        type="text"
                                        class="mt-1 block w-full bg-slate-100"
                                        v-model="form.role"
                                        autofocus
                                        autocomplete="role"
                                        :disabled="true"
                                    />
                    
                                    <InputError class="mt-2" :message="form.errors.role" />
                                </div>
                                <div class="flex items-center justify-end mt-4">
                                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                        Register
                                    </PrimaryButton>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>

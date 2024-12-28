<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    upk: '',
    password: '',
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <!-- <GuestLayout> -->
        <Head title="Log in" />
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-5 z-50">
            <form @submit.prevent="submit" class="bg-white shadow rounded-md w-96">
                <div class="gap-5 py-5 flex flex-col justify-center items-center shadow bg-gradient-to-r from-green-500 to-blue-500">
                    <img src="image/logoKesehatan.png" class="w-24" alt="" srcset="">
                    <div class="text-center text-white font-bold">
                        <h1>PUSKESMAS SERANG KOTA</h1>
                        <h1>SILAHKAN LOGIN TERLEBIH DAHULU</h1>
                    </div>
                </div>
                <div class="p-5">
                    <div class="mt-5">
                        <InputLabel for="UPK" value="kode UPK" />
        
                        <TextInput
                            id="UPK"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.upk"
                            required
                            autofocus
                            autocomplete="username"
                        />
        
                        <InputError class="mt-2" :message="form.errors.upk" />
                    </div>
        
                    <div class="mt-4">
                        <InputLabel for="password"  value="Password" />
        
                        <TextInput
                            id="password"
                            type="password"
                            class="mt-1 block w-full"
                            v-model="form.password"
                            required
                            autocomplete="current-password"
                        />
        
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>
        
                    <div class="flex justify-center mt-4 text-center ">
                        <PrimaryButton  :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Log in
                        </PrimaryButton>
                    </div>
                </div>
            </form>
        </div>
    <!-- </GuestLayout> -->
</template>

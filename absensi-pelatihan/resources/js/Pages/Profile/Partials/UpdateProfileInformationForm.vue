<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { watch } from 'vue';

const props = defineProps({
    mustVerifyEmail: Boolean,
    status: String,
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    jenis_kelamin: user.jenis_kelamin,
    tanggal_lahir: user.tanggal_lahir,
    alamat: user.alamat,
    email: user.email,
});
watch(() => form.jenis_kelamin, (newValue) => {
    console.log('Jenis Kelamin changed to:', newValue);
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Profile Information</h2>

            <p class="mt-1 text-sm text-gray-600">
                Update your account's profile information and email address.
            </p>
        </header>

        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" value="Nama Lengkap" />

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
            <div>
                <InputLabel for="name" value="Jenis Kelamin" />

                <select
                    id="jenis_kelamin"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.jenis_kelamin"
                    required
                    autofocus
                    autocomplete="jenis_kelamin"
                >
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>


                <InputError class="mt-2" :message="form.errors.jenis_kelamin" />
            </div>
            <div>
                <InputLabel for="name" value="Tanggal Lahir" />

                <TextInput
                    id="tanggal"
                    type="date"
                    class="mt-1 block w-full"
                    v-model="form.tanggal_lahir"
                    required
                    autofocus
                    autocomplete="tanggal"
                />

                <InputError class="mt-2" :message="form.errors.tanggal_lahir" />
            </div>
            <div>
                <InputLabel for="name" value="Alamat" />

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

            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>

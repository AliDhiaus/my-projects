<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps(['data','nikUser']);
const rujukIPWL = ref('tidak');

const form = useForm({
    ipwl:props.data.id,
    nikUser : props.nikUser,
})

const ipwlSubmit = () => {
    form.post(route('home.ipwl'),{
        onSuccess : ()=> {
            console.log('success')
        },
        onError : ()=>{
            console.error('error');
        }
    })
}
</script>

<template>
    <div class=" items-center p-4">
        <h1 class="mb-4 font-bold text-slate-600">Rujuk IPWL</h1>
        <form @submit.prevent="ipwlSubmit" class="w-full">
            <div class="my-5">
                <label for="selectIPWL" class="text-sm">Rujuk IPWL :</label>
                <select class="w-full rounded-lg border-slate-300 my-2" id="rujukIPWL" v-model="rujukIPWL">
                    <option value="tidak">Tidak</option>
                    <option value="iya">Iya</option>
                </select>
            </div>
            <div class="my-5" v-if="rujukIPWL === 'iya'">
                <label for="selectIPWL" class="text-sm">Pilih Unit Pelayanan Kesehatan :</label>
                <select class="w-full rounded-lg border-slate-300 my-2" id="selectIPWL" :value="form.ipwl" v-model="form.ipwl">
                    <option v-for="(data,i) in props.data" :value="data.id" :key="i">
                        {{ data.upk }}
                    </option>
                </select>
            </div>
            <button type="submit" class="text-white text-sm bg-blue-500 rounded-lg shadow py-2 px-4 block">
                Submit IPWL
            </button>
        </form>
    </div>
</template>
<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import CardQuiz from '@/Components/CardQuiz.vue'
import CardIpwl from '@/Components/CardIpwl.vue'

const {props} = usePage();
const dataKelurahan = props.kelurahanAkses

const selected = ref('biodata');
const userFilled = ref(false);

const btnSelect = (select) =>{
    if(userFilled.value){
        selected.value = select;
    }
};
const nikUser = ref();
const form = useForm({
    nik: '',    
    name: '',
    date: '',
    gender: 'Laki laki',
    academy: '',
    religion: '',
    status: 'Belum Menikah',
    job: '',
    old: '',
    dateOfBirth:'',
});

const calculateAge = (dateOfBirth) => {
    if (!dateOfBirth) return '';

    const today = new Date();
    const birthDate = new Date(dateOfBirth);
    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
};

watch(() => form.dateOfBirth, (newDate) => {
    form.old = calculateAge(newDate);
});
watch(() => form.nik, (newNIK) => {
    nikUser.value = newNIK;
});

const handleSubmitBiodata = () => {
    form.post(route('home.insert'),{
        onSuccess: () =>{
            userFilled.value = true;
            btnSelect('quiz')
        },
        onError : (e) =>{
            console.error(e);
        }
    })
}

function handleQuizSubmitted(payload) {
  if (payload === 'ipwl') {
    selected.value = 'ipwl'; 
  }
}

</script>

<template>
    <div class="p-5 flex h-full justify-center items-center ">
        <div class="bg-white w-full h-full md:w-2/3">
            <h1 class="text-center font-bold">Selamat datang di Aplikasi SINAPZA</h1>
            <h3 class="text-center">Silahkan Isi Biodata Diri Kamu Disini</h3>
            <nav class="flex bg-[#173B45]  mt-5">
                <div :class="selected === 'biodata' ? 'text-slate-800 bg-white' : 'text-white'" class="p-2 border cursor-default " @click="btnSelect('biodata')"><FontAwesomeIcon :icon="faHome" /> Biodata</div>
                <div :class="selected === 'quiz' ? 'text-slate-800 bg-white': 'text-white' " @click="btnSelect('quiz')" class="p-2 border cursor-default "><FontAwesomeIcon :icon="faUser" /> Quiz</div>            
                <div :class="selected === 'ipwl' ? 'text-slate-800 bg-white': 'text-white' " @click="btnSelect('ipwl')" class="p-2 border cursor-default "><FontAwesomeIcon :icon="faUser" /> IPWL</div>            
            </nav>
            <form v-if="selected === 'biodata'" @submit.prevent="handleSubmitBiodata" class="flex flex-col gap-2 w-full shadow p-5">
                <div class="flex">
                    <label for="tanggal" class="w-48">Tanggal Screening</label><span class="w-5">:</span>
                    <div class="flex flex-col w-full">
                        <input type="date" v-model="form.date" class="w-full border-b-2  border-t-0 border-l-0 border-r-0" placeholder="Masukan Tanggal Screening" required>
                        <span v-if="form.errors.date" class="text-red-500">{{ form.errors.date }}</span>
                    </div>
                </div>
                <div class="flex">
                    <label for="nik" class="w-48">NIK</label><span class="w-5">:</span>
                    <div class="flex flex-col w-full">
                        <input type="text" class="w-full border-b-2  border-t-0 border-l-0 border-r-0" placeholder="Masukan NIK" v-model="form.nik" required>
                        <span v-if="form.errors.nik" class="text-red-500">{{ form.errors.nik }}</span>
                    </div>
                </div>
                <div class="flex">
                    <label for="nama" class="w-48">Nama Lengkap</label><span class="w-5">:</span>
                    <div class="flex flex-col w-full">
                        <input type="text" class="w-full border-b-2  border-t-0 border-l-0 border-r-0" placeholder="Masukan Nama Lengkap" v-model="form.name" required>
                        <span v-if="form.errors.name" class="text-red-500">{{ form.errors.name }}</span>
                    </div>
                </div>
                <div class="flex">
                    <label for="agama" class="w-48">Agama</label><span class="w-5">:</span>
                    <div class="flex flex-col w-full">
                        <input type="text" class="w-full border-b-2  border-t-0 border-l-0 border-r-0" placeholder="Masukan Agama" v-model="form.religion" required>
                        <span v-if="form.errors.religion" class="text-red-500">{{ form.errors.religion }}</span>
                    </div>
                </div>
                <div class="flex">
                    <label for="pendidikan" class="w-48">Pendidikan</label><span class="w-5">:</span>
                    <div class="flex flex-col w-full">
                        <input type="text" class="w-full border-b-2  border-t-0 border-l-0 border-r-0" placeholder="Masukan Pendidikan" v-model="form.academy" required>
                        <span v-if="form.errors.academy" class="text-red-500">{{ form.errors.academy }}</span>
                    </div>
                </div>
                <div class="flex">
                    <label for="tanggal" class="w-48">Tanggal Lahir</label><span class="w-5">:</span>
                    <div class="flex flex-col w-full">
                        <input type="date" class="w-full border-b-2  border-t-0 border-l-0 border-r-0" placeholder="Masukan Tanggal Lahir" v-model="form.dateOfBirth" required>
                        <span v-if="form.errors.dateOfBirth" class="text-red-500">{{ form.errors.dateOfBirth }}</span>
                    </div>
                </div>
                <div class="flex">
                    <label for="usia" class="w-48">Usia</label><span class="w-5">:</span>
                    <div class="flex flex-col w-full">
                        <input type="text" class="w-full border-b-2 bg-slate-200 focus:outline-none border-t-0 border-l-0 border-r-0" placeholder="Masukan Usia" v-model="form.old" required readonly>
                        <span v-if="form.errors.old" class="text-red-500">{{ form.errors.old }}</span>
                    </div>
                </div>
                <div class="flex">
                    <label for="pekerjaan" class="w-48">Pekerjaan</label><span class="w-5">:</span>
                    <div class="flex flex-col w-full">
                        <input type="text" class="w-full border-b-2  border-t-0 border-l-0 border-r-0" placeholder="Masukan Pekerjaan" v-model="form.job" required>
                        <span v-if="form.errors.job" class="text-red-500">{{ form.errors.job }}</span>
                    </div>
                </div>
                <div class="flex">
                    <label for="jns_kelamin" class="w-48">Jenis Kelamin</label><span class="w-5">:</span>
                    <div class="flex flex-col w-full">
                        <select class="w-full border-b-2  border-t-0 border-l-0 border-r-0" v-model="form.gender">
                            <option value="Laki laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <span v-if="form.errors.gender" class="text-red-500">{{ form.errors.gender }}</span>
                    </div>
                </div>
                <div class="flex">
                    <label for="status" class="w-48">Status Pernikahan</label><span class="w-5">:</span>
                    <div class="flex flex-col w-full">
                        <select class="w-full border-b-2  border-t-0 border-l-0 border-r-0" v-model="form.status">
                            <option value="Menikah">Menikah</option>
                            <option value="Belum Menikah">Belum Menikah</option>
                        </select>
                        <span v-if="form.errors.status" class="text-red-500">{{ form.errors.status }}</span>
                    </div>
                </div>
                <div class="flex justify-center mt-5">
                    <button type="submit" class="bg-blue-500 p-2 text-white w-1/5 rounded">Submit</button>
                </div>
            </form>
            <div v-else-if="selected === 'quiz'">
                    <CardQuiz :nikUser="nikUser"  @submitted="handleQuizSubmitted"/>
            </div>
            <div v-else>
                   <CardIpwl :data="dataKelurahan" :nikUser="nikUser" />
            </div>
        </div>
    </div>
    
</template>

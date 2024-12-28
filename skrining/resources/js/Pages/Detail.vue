<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { faArrowLeft } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { Head, router, usePage } from "@inertiajs/vue3";
import { ref } from "vue";

const { props } = usePage();
const data = ref(props.data);
const dataQuiz = ref(props.dataQuiz);
const dataipwl = ref(props.kelurahan);
const answers = ref([]);

const idIpwl = data.value.map(i => JSON.parse(i.ipwl)).filter(ipwl => ipwl !== null && ipwl !== undefined);
console.log(idIpwl)

if (dataQuiz.value) {
    answers.value = dataQuiz.value.map((item) => {
        try {
            return JSON.parse(item.answer);
        } catch (error) {
            console.error("Failed to parse JSON:", error);
            return {};
        }
    });
    console.log(answers.value);
}
</script>

<template>
    <Head title="Detail" />
    <AuthenticatedLayout>
        <template #detail>
            <form class="flex flex-col gap-2  lg:p-5">
                <div class="mb-5 flex justify-between font-bold">
                    <a href="/demografi">
                        <FontAwesomeIcon :icon="faArrowLeft" />
                        Kembali
                    </a>
                    <h1>Detail Individu</h1>
                </div>
                <div class="lg:flex lg:gap-3">
                    <div class="flex flex-col w-full lg:w-2/3">
                        <div class="shadow rounded p-2" v-for="(item, i) in data" :key="i">
                            <div class="w-full flex justify-center items-center">
                                <img src="/image/pp.png" class="w-32 mb-5 p-5 rounded-full bg-slate-200"/>
                            </div>
                            <h1 class="font-bold mb-5 text-center">
                                Biodata
                            </h1>
                            <div class="flex">
                                <h3 class="w-44">NIK</h3>
                                <h3 class="w-2">:</h3>
                                <h3>{{ item.nik }}</h3>
                            </div>
                            <div class="flex">
                                <h3 class="w-44">Nama Lengkap</h3>
                                <h3 class="w-2">:</h3>
                                <h3>{{ item.name }}</h3>
                            </div>
                            <div class="flex">
                                <h3 class="w-44">Tanggal Screening</h3>
                                <h3 class="w-2">:</h3>
                                <h3>{{ item.date }}</h3>
                            </div>
                            <div class="flex">
                                <h3 class="w-44">Jenis Kelamin</h3>
                                <h3 class="w-2">:</h3>
                                <h3>{{ item.gender }}</h3>
                            </div>
                            <div class="flex">
                                <h3 class="w-44">Agama</h3>
                                <h3 class="w-2">:</h3>
                                <h3>{{ item.religion }}</h3>
                            </div>
                            <div class="flex">
                                <h3 class="w-44">Tanggal Lahir</h3>
                                <h3 class="w-2">:</h3>
                                <h3>{{ item.date_of_birth }}</h3>
                            </div>
                            <div class="flex">
                                <h3 class="w-44">Usia</h3>
                                <h3 class="w-2">:</h3>
                                <h3>{{ item.old }}</h3>
                            </div>
                            <div class="flex">
                                <h3 class="w-44">Penidikan</h3>
                                <h3 class="w-2">:</h3>
                                <h3>{{ item.academy }}</h3>
                            </div>
                            <div class="flex">
                                <h3 class="w-44">Pekerjaan</h3>
                                <h3 class="w-2">:</h3>
                                <h3>{{ item.job }}</h3>
                            </div>
                            <div class="flex">
                                <h3 class="w-44">Status Pernikahan</h3>
                                <h3 class="w-2">:</h3>
                                <h3>{{ item.status }}</h3>
                            </div>
                            <h1>{{ item.ipwl }}</h1>
                        </div>
                        <div class="shadow mt-5 rounded p-2">
                            <h1 class="mb-5 text-center font-bold">Rujuk IPWL</h1>
                            <div v-if="idIpwl.length !== 0">
                                <div class="flex" >
                                    <h3 class="w-24">Rujuk UPK</h3>
                                    <h3 class="w-2">:</h3>
                                    <h3>Iya</h3>
                                </div>
                                <h1 class="text-center font-bold bg-slate-100 mt-5 mb-3">Unit Pelayanan Kesehatan</h1>
                                <div class="flex">
                                    <h3 class="w-24">Provinsi</h3>
                                    <h3 class="w-2">:</h3>
                                    <h3>{{ dataipwl?.provinsi }}</h3>
                                </div>
                                <div class="flex">
                                    <h3 class="w-24">Kota</h3>
                                    <h3 class="w-2">:</h3>
                                    <h3>{{ dataipwl?.kota }}</h3>
                                </div>
                                <div class="flex">
                                    <h3 class="w-24">UPK</h3>
                                    <h3 class="w-2">:</h3>
                                    <h3>{{ dataipwl?.upk }}</h3>
                                </div>
                                <div class="flex">
                                    <h3 class="w-24">Kecamatan</h3>
                                    <h3 class="w-2">:</h3>
                                    <h3>{{ dataipwl?.kecamatan }}</h3>
                                </div>
                                <div class="flex">
                                    <h3 class="w-24">Kelurahan</h3>
                                    <h3 class="w-2">:</h3>
                                    <h3>{{ dataipwl?.kelurahan }}</h3>
                                </div>
                            </div>
                            <div v-else>
                                <div class="flex" >
                                    <h3 class="w-24">Rujuk IPWL</h3>
                                    <h3 class="w-2">:</h3>
                                    <h3>Tidak</h3>
                                </div>
                            </div>                                  
                        </div>
                    </div>
                    <div class="shadow rounded w-full p-4 mt-5 lg:mt-0">
                        <h1 class="font-bold mb-5 text-center">
                            Data Quiz
                        </h1>
                        <div
                            v-for="(answersObj, questionId) in answers"
                            :key="questionId"
                        >
                            <div
                                v-for="(answer, key) in answersObj"
                                :key="key"
                            >
                                <p class="my-4">
                                    <strong>Quiz {{ key }}:</strong>
                                </p>
                                <p class="my-4">
                                    <span class v-if="key === '1'">
                                        Dalam kehidupan anda, zat apa
                                        saja dibawah ini yang pernah
                                        digunakan? (Hanya penggunaan non
                                        medis) <br />
                                        a. Tembakau (rokok, cerutu,
                                        kretek, dll.):
                                    </span>
                                    <span class="my-4" v-if="key === '2'">
                                        Selama 3 bulan terakhir,
                                        seberapa sering anda pernah
                                        menggunakan zat yang seperti
                                        anda katakan?(zat pertama, zat
                                        kedua, dll.) <br />
                                        a. Tembakau (rokok, cerutu,
                                        kretek, dll.): 
                                    </span>
                                    <span class="my-4" v-if="key === '3'">
                                        Selama 3 bulan terakhir,
                                        seberapa sering anda mempunyai
                                        keinginan yang kuat untuk
                                        menggunakan(zat pertama, zat
                                        kedua, dll.) <br />
                                        a. Tembakau (rokok, cerutu,
                                        kretek, dll.): 
                                    </span>
                                    <span class="my-4" v-if="key === '4'">
                                        Selama 3 bulan terakhir,
                                        seberapa sering napza yang anda
                                        gunakan dari(zat pertama, zat
                                        kedua, dll.)yang menyebabkan
                                        timbulnya masalah kesehatan,
                                        sosial, hukum dan masalah
                                        keuangan? <br />
                                        a. Tembakau (rokok, cerutu,
                                        kretek, dll.): 
                                    </span>
                                    <span class="my-4" v-if="key === '5'">
                                        Selama 3 bulan terakhir,
                                        seberapa sering anda gagal
                                        melakukan hal-hal yang biasa
                                        anda lakukan disebabkan karena
                                        penggunaan dari(zat pertama, zat
                                        kedua, dll.) <br />
                                        a. Tembakau (rokok, cerutu,
                                        kretek, dll.): 
                                    </span>
                                    <span class="my-4" v-if="key === '6'">
                                        Selama 3 bulan terakhir,
                                        seberapa sering anda pernah
                                        menggunakan zat yang seperti
                                        anda katakan?(zat pertama, zat
                                        kedua, dll.) <br />
                                        a. Tembakau (rokok, cerutu,
                                        kretek, dll.): 
                                    </span>
                                    <span class="my-4" v-if="key === '7'">
                                        Pernahkah anda mencoba untuk mengurangi atau menghentikan penggunaan (zat pertama, zat kedua, dll.) <br />
                                        a. Tembakau (rokok, cerutu,
                                        kretek, dll.): 
                                    </span>
                                    <span class="my-4" v-if="key === '8'">
                                        Pernahkah anda menggunakan napza dengan cara menyuntik? (hanya penggunaan non medis) <br />
                                        Jawaban : {{ answer[undefined]}}
                                    </span>
                                    {{ answer.a }}
                                </p>
                                <p class="my-4">
                                    <span v-if="key !== '8'">
                                        b. Minuman beralkohol (bir, anggur,
                                        spirtus, tuak, dll, sesuaikan nama
                                        lokal.):
                                    </span>
                                    {{ answer.b }}
                                </p>
                                <p class="my-4">
                                    <span v-if="key !== '8'">
                                        c. Kanabis (marijuana, ganja, gelek,
                                        cimeng, dll.):
                                    </span>
                                    {{ answer.c }}
                                </p>
                                <p class="my-4">
                                    <span v-if="key !== '8'"> d. Kokain: </span>
                                    {{ answer.d }}
                                </p>
                                <p class="my-4">
                                    <span v-if="key !== '8'">
                                        e. Stimulan jenis amfetamin
                                        (ekstasi, shabu, dll):
                                    </span>

                                    {{ answer.e }}
                                </p>
                                <p class="my-4">
                                    <span v-if="key !== '8'">
                                        f. Inhalansia (lem, bensin,
                                        tiner, dll):
                                    </span>

                                    {{ answer.f }}
                                </p>
                                <p class="my-4">
                                    <span v-if="key !== '8'">
                                        g. Sedatif atau obat tidur (Pil
                                        koplo, valium, dumolid, lexotan,
                                        rohypnol, mogadon, dll.):
                                    </span>
                                    {{ answer.g }}
                                </p>
                                <p class="my-4">
                                    <span v-if="key !== '8'">
                                        h. Halusinogens (LSD, mushroom,
                                        PCP, dll.):
                                    </span>

                                    {{ answer.h }}
                                </p>
                                <p class="my-4">
                                    <span v-if="key !== '8'">
                                        i. Opioid (Heroin, putaw,
                                        morfin, metadon, kodein, dll.):
                                    </span>

                                    {{ answer.i }}
                                </p>
                                <p class="my-4">
                                    <span v-if="key !== '8'"> j. Zat-lain: </span>
                                    {{ answer.j }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </template>
    </AuthenticatedLayout>
</template>

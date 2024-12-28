<script setup>
import { defineProps, ref, watch, onMounted } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Swal from "sweetalert2";

// Mendapatkan props dari usePage
const { props } = usePage();
const user = props.auth.user.name;
const userId = props.auth.user.id;

// Mendapatkan tanggal saat ini
const dateNow = ref(new Date().toISOString().split("T")[0]);

// Mendapatkan data yang sesuai dengan tanggal saat ini
const data = ref(props.data.find((item) => item.tanggal === dateNow.value));

// Format untuk tampilan tanggal
const option = {
  weekday: "long",
  day: "numeric",
  month: "long",
  year: "numeric",
};
const dateNowDisplay = ref(
  new Intl.DateTimeFormat("id-ID", option).format(new Date())
);

// Batas waktu untuk jam keluar
const batasWaktu = new Date().setHours(15, 30, 0, 0);

// Inisialisasi form dengan useForm
const form = useForm({
  user_id: userId,
  name: user,
  kejuruan: '',
  kelas: '',
  tanggal: dateNow.value,
  jam_masuk: undefined,
  jam_keluar: undefined,
  keterangan: '',
});

// Menyimpan nilai yang dipilih
const selected = ref("");

// Status untuk mengontrol disabled state tombol
const isJamMasukDisabled = ref(false);
const isJamKeluarDisabled = ref(true); // Default disabled state for Jam Keluar button

// Menyimpan data dari props ke dalam form saat komponen di-mount
onMounted(() => {
  if (data.value) {
    form.keterangan = data.value.keterangan;
    form.jam_masuk = data.value.jam_masuk;
    form.jam_keluar = data.value.jam_keluar;
    isJamMasukDisabled.value = !!form.jam_masuk; // Disable if jam_masuk already exists
    isJamKeluarDisabled.value = !!form.jam_keluar; // Disable if jam_keluar already exists
  }
});

// Menangani perubahan pada keterangan dan kejuruan
watch(
  () => form.keterangan,
  (newValue) => {
    selected.value = newValue;
    if (!data.value) {
      form.post(route("postAbsensi"), {
        onSuccess() {
          Swal.fire({
            title: "Data berhasil disimpan!",
            icon: "success",
          });
          window.location.reload();
        },
        onError() {
          Swal.fire({
            title: "Gagal menyimpan data!",
            icon: "error",
          });
        },
      });
    }
  }
);

watch(
  () => form.kejuruan,
  (newValue) => {
    selected.value = newValue;
  }
);

// Fungsi untuk mengupdate jam masuk
const jamMasuk = () => {
  const now = new Date();
  form.jam_masuk = now.toLocaleTimeString([], {
    hour: "2-digit",
    minute: "2-digit",
  });

  form.put(route("updateAbsensi", data.value.id), {
    onSuccess() {
      Swal.fire({
        title: "Data berhasil disimpan!",
        icon: "success",
      });
      isJamMasukDisabled.value = true; // Disable tombol setelah sukses
      isJamKeluarDisabled.value = false; // Enable tombol Jam Keluar jika diperlukan
    },
    onError() {
      Swal.fire({
        title: "Gagal menyimpan data!",
        icon: "error",
      });
    },
  });
};

// Fungsi untuk mengupdate jam keluar
const JamKeluar = () => {
  form.jam_keluar = new Date().toLocaleTimeString([], {
    hour: "2-digit",
    minute: "2-digit",
  });

  form.put(route("updateAbsensi", data.value.id), {
    onSuccess() {
      Swal.fire({
        title: "Data berhasil disimpan!",
        icon: "success",
      });
      isJamKeluarDisabled.value = true; // Disable tombol setelah sukses
    },
    onError() {
      Swal.fire({
        title: "Gagal menyimpan data!",
        icon: "error",
      });
    },
  });
};
</script>

<template>
  <AuthenticatedLayout>
    <template #dashboard>
      <div class="py-12">
        <div class="max-w-7xl mx-auto text-sm md:text-md">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
              <h1 class="text-2xl font-bold mb-4">Absensi</h1>
              <form @submit.prevent="submit" class="shadow p-5 mt-5">
                <div class="flex gap-5 items-center">
                  <h1 for="name" class="w-44">Nama Lengkap</h1>
                  <span>:</span>
                  <h1 class="w-full">{{ user }}</h1>
                </div>
                <div class="flex gap-5 mt-5 items-center">
                  <h1 class="w-44">Hari Dan Tanggal</h1>
                  <span>:</span>
                  <h1 class="w-full">{{ dateNowDisplay }}</h1>
                </div>
                <div class="flex gap-5 mt-5">
                  <input type="text" v-model="form.user_id" hidden>
                  <label for="kejuruan" class="w-44">Kejuruan</label>
                  <span>:</span>
                  <select v-model="form.kejuruan" id="kejuruan" class="w-full" :disabled="form.jam_masuk">
                    <option value="" disabled>Pilih Keterangan</option>
                    <option value="Las">Las</option>
                    <option value="Listrik">Listrik</option>
                    <option value="Garment Apparel">Garment Apparel</option>
                    <option value="TIK">TIK</option>
                    <option value="Manufaktur">Manufaktur</option>
                  </select>
                </div>
                <div class="flex gap-5 mt-5" v-if="selected === 'Las' || selected === 'Listrik' || selected === 'Garment Apparel'">
                  <label for="kelas" class="w-44">Kelas</label>
                  <span>:</span>
                  <select v-model="form.kelas" id="kelas" class="w-full" :disabled="form.jam_masuk">
                    <option value="" disabled>Pilih Kelas</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                  </select>
                </div>
                <div class="flex gap-5 mt-5" v-if="selected === 'TIK' || selected === 'Manufaktur'">
                  <label for="kelas" class="w-44">Kelas</label>
                  <span>:</span>
                  <select v-model="form.kelas" id="kelas" class="w-full" :disabled="form.jam_masuk">
                    <option value="" disabled>Pilih Kelas</option>
                    <option value="A">A</option>
                  </select>
                </div>
                <div class="flex gap-5 mt-5">
                  <label for="keterangan" class="w-44">Keterangan</label>
                  <span>:</span>
                  <select v-model="form.keterangan" id="keterangan" class="w-full" :disabled="form.jam_masuk">
                    <option value="" disabled>Pilih Keterangan</option>
                    <option value="hadir">Hadir</option>
                    <option value="sakit">Sakit</option>
                    <option value="izin">Izin</option>
                    <option value="tidak hadir">Tidak Hadir</option>
                  </select>
                </div>

                <div class="flex justify-center gap-20 mt-5" v-if="selected === 'hadir'">
                  <div class="flex gap-5 items-center mt-5">
                    <button type="button" class="bg-blue-700 p-2 rounded text-white font-bold disabled:bg-gray-500" @click="jamMasuk()" :disabled="isJamMasukDisabled">
                      Jam Masuk
                    </button>
                    <h1>{{ form.jam_masuk }}</h1>
                  </div>
                  <div class="flex gap-5 items-center mt-5">
                    <button type="button" class="bg-blue-700 p-2 rounded text-white font-bold disabled:bg-gray-500" @click="JamKeluar()" :disabled="new Date() <= batasWaktu || isJamKeluarDisabled">
                      Jam Keluar
                    </button>
                    <h1>{{ form.jam_keluar }}</h1>
                  </div>
                </div>

                <!-- Tidak ada tombol submit, karena data disubmit otomatis -->
              </form>
            </div>
          </div>
        </div>
      </div>
    </template>
  </AuthenticatedLayout>
</template>

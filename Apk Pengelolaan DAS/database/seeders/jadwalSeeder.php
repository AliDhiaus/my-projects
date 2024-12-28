<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\jadwal;

class jadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataPenyiar = [
            [
                'nama' => 'Citra Astarie',
                'waktu' => '04.00 - 10.00',
                'hariTanggal' => 'Rabu, 2024-7-10',
                'shift' => 'Pagi',
                'tempat' => 'RRI Pro 1'
            ],
            [
                'nama' => 'Argan Prayoga',
                'waktu' => '04.00 - 10.00',
                'hariTanggal' => 'Rabu, 2024-7-10',
                'shift' => 'Pagi',
                'tempat' => 'RRI Pro 2'
            ],
            [
                'nama' => 'Fitri Rianti',
                'waktu' => '10.00 - 16.00',
                'hariTanggal' => 'Rabu, 2024-7-10',
                'shift' => 'Siang',
                'tempat' => 'RRI Pro 1'
            ],
            [
                'nama' => 'Hasniar Rahmawati',
                'waktu' => '10.00 - 16.00',
                'hariTanggal' => 'Rabu, 2024-7-10',
                'shift' => 'Siang',
                'tempat' => 'RRI Pro 2'
            ],
            [
                'nama' => 'Digi Pribadi',
                'waktu' => '16.00 - 22.00',
                'hariTanggal' => 'Rabu, 2024-7-10',
                'shift' => 'malam',
                'tempat' => 'RRI Pro 1'
            ],
            [
                'nama' => 'Ilma Afiah',
                'waktu' => '16.00 - 22.00',
                'hariTanggal' => 'Rabu, 2024-7-10',
                'shift' => 'malam',
                'tempat' => 'RRI Pro 2'
            ],
            [
                'nama' => 'Dede Firdaus',
                'waktu' => '04.00 - 10.00',
                'hariTanggal' => 'Kamis, 2024-7-11',
                'shift' => 'Pagi',
                'tempat' => 'RRI Pro 1'
            ],
            [
                'nama' => 'Sarah Ganefi',
                'waktu' => '04.00 - 10.00',
                'hariTanggal' => 'Kamis, 2024-7-11',
                'shift' => 'Pagi',
                'tempat' => 'RRI Pro 2'
            ],
            [
                'nama' => 'Citra Astarie',
                'waktu' => '10.00 - 16.00',
                'hariTanggal' => 'Kamis, 2024-7-11',
                'shift' => 'Siang',
                'tempat' => 'RRI Pro 1'
            ],
            [
                'nama' => 'Rifki Baedowi',
                'waktu' => '10.00 - 16.00',
                'hariTanggal' => 'Kamis, 2024-7-11',
                'shift' => 'Siang',
                'tempat' => 'RRI Pro 2'
            ],
            [
                'nama' => 'Gita Puspita',
                'waktu' => '16.00 - 22.00',
                'hariTanggal' => 'Kamis, 2024-7-11',
                'shift' => 'malam',
                'tempat' => 'RRI Pro 1'
            ],
            [
                'nama' => 'Argan Prayoga',
                'waktu' => '16.00 - 22.00',
                'hariTanggal' => 'Kamis, 2024-7-11',
                'shift' => 'malam',
                'tempat' => 'RRI Pro 2'
            ],
            [
                'nama' => 'Fitri Rianti',
                'waktu' => '04.00 - 10.00',
                'hariTanggal' => 'Jumat, 2024-7-12',
                'shift' => 'Pagi',
                'tempat' => 'RRI Pro 1'
            ],
            [
                'nama' => 'Hasniar Rahmawati',
                'waktu' => '04.00 - 10.00',
                'hariTanggal' => 'Jumat, 2024-7-12',
                'shift' => 'Pagi',
                'tempat' => 'RRI Pro 2'
            ],
            [
                'nama' => 'Dede Firdaus',
                'waktu' => '10.00 - 16.00',
                'hariTanggal' => 'Jumat, 2024-7-12',
                'shift' => 'Siang',
                'tempat' => 'RRI Pro 1'
            ],
            [
                'nama' => 'Ilma Afiah',
                'waktu' => '10.00 - 16.00',
                'hariTanggal' => 'Jumat, 2024-7-11',
                'shift' => 'Siang',
                'tempat' => 'RRI Pro 2'
            ],
            [
                'nama' => 'Digi Pribadi',
                'waktu' => '16.00 - 22.00',
                'hariTanggal' => 'Jumat, 2024-7-12',
                'shift' => 'malam',
                'tempat' => 'RRI Pro 1'
            ],
            [
                'nama' => 'Rifki Baedwi',
                'waktu' => '16.00 - 22.00',
                'hariTanggal' => 'Jumat, 2024-7-12',
                'shift' => 'malam',
                'tempat' => 'RRI Pro 2'
            ]
        ];

        foreach ($dataPenyiar as $i) {
            jadwal::create($i);
        }
    }
}

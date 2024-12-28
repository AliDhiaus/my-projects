<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\isiDas;

class isiDasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [

                'das_id' => 2,
                'waktu' => '04.45',
                'program' => 'Tune',
                'frame' => 'Computer',
                'durasi' => '15 Menit',
                'keterangan' => 'Kicauan burung cendrawasih',
            ],
            [   
                'das_id' => 3,
                'waktu' => '10.00',
                'program' => 'Broadcast',
                'frame' => 'Computer',
                'durasi' => '60 Menit',
                'keterangan' => 'iklan, musik, live',
            ],
        ];

        foreach ($data as $item) {
            isiDas::create($item);
        }
    }
}

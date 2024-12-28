<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class kelurahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kelurahan_akses')->insert([
            'provinsi' => 'banten',
            'kota' => 'serang',
            'upk' => 'Puskesmas Serang Kota',
            'kecamatan' => 'serang',
            'kelurahan' => 'cipare'
        ]);
    }
}

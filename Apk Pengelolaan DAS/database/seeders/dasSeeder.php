<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\das;

class dasSeeder extends Seeder
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
                'account_id'=> 1,
                'judul' => 'Judul Acara 1',
                'tanggal' => '2015-02-22',
                'petugas' => 'Petugas 1',
            ],
            [   
                'account_id'=> 2,
                'judul' => 'Judul Acara 2',
                'tanggal' => '2012-02-22',
                'petugas' => 'Petugas 2',
            ],
        ];

        foreach ($data as $item) {
            das::create($item);
        }
    }
}

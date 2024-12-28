<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            'level' => 'admin',
            'name' => 'admin',
            'email' => 'rri@gmail.com',
            'password' => Hash::make('admin123'),
            'jabatan' => 'Admin',
            'alamat' => 'RRI Banten',
            'tgl_lahir' => '1980-01-01',
            'jenis_kelamin' => '-',
            'no_hp' => '081234567890',
            'nrp' => 'NRP001',
            'image' => base64_encode(file_get_contents(public_path('image/pp.jpg')))
        ];
        DB::table('account')->insert($admin);

        $users = [
            [
                'name' => 'Argan Prayoga',
                'email' => 'argan@gmail.com',
                'password' => 'argan123',
                'jabatan' => 'Penyiar',
                'alamat' => 'Serang Banten',
                'tgl_lahir' => '1990-01-01',
                'jenis_kelamin' => 'Pria',
                'no_hp' => '081234567891',
                'nrp' => 'NRP002',
                'image' => base64_encode(file_get_contents(public_path('image/argan.jpg')))
            ],
            [
                'name' => 'Hasniar Rahmawati',
                'email' => 'niar@gmail.com',
                'password' => 'niar',
                'jabatan' => 'Penyiar',
                'alamat' => 'Serang Banten',
                'tgl_lahir' => '1991-01-01',
                'jenis_kelamin' => 'Perempuan',
                'no_hp' => '081234567892',
                'nrp' => 'NRP003',
                'image' => base64_encode(file_get_contents(public_path('image/niar.jpg')))
            ],
            [
                'name' => 'Digi Pribadi',
                'email' => 'digi@gmail.com',
                'password' => 'digi123',
                'jabatan' => 'Penyiar',
                'alamat' => 'Serang Banten',
                'tgl_lahir' => '1992-01-01',
                'jenis_kelamin' => 'Pria',
                'no_hp' => '081234567893',
                'nrp' => 'NRP004',
                'image' => base64_encode(file_get_contents(public_path('image/digi.jpg')))
            ],
            [
                'name' => 'Dede Firdaus',
                'email' => 'dede@gmail.com',
                'password' => 'dede123',
                'jabatan' => 'Penyiar',
                'alamat' => 'Serang Banten',
                'tgl_lahir' => '1993-01-01',
                'jenis_kelamin' => 'Pria',
                'no_hp' => '081234567894',
                'nrp' => 'NRP005',
                'image' => base64_encode(file_get_contents(public_path('image/dede.jpg')))
            ],
            [
                'name' => 'Ilma Afiah',
                'email' => 'ilma@gmail.com',
                'password' => 'ilma123',
                'jabatan' => 'Penyiar',
                'alamat' => 'Serang Banten',
                'tgl_lahir' => '1994-01-01',
                'jenis_kelamin' => 'Perempuan',
                'no_hp' => '081234567895',
                'nrp' => 'NRP006',
                'image' => base64_encode(file_get_contents(public_path('image/ilma.jpg')))
            ],
            [
                'name' => 'Gita Puspita',
                'email' => 'gita@gmail.com',
                'password' => 'gita123',
                'jabatan' => 'Penyiar',
                'alamat' => 'Serang Banten',
                'tgl_lahir' => '1995-01-01',
                'jenis_kelamin' => 'Perempuan',
                'no_hp' => '081234567896',
                'nrp' => 'NRP007',
                'image' => base64_encode(file_get_contents(public_path('image/gita.jpg')))
            ],
            [
                'name' => 'Citra Astarie',
                'email' => 'citra@gmail.com',
                'password' => 'citra123',
                'jabatan' => 'Penyiar',
                'alamat' => 'Serang Banten',
                'tgl_lahir' => '1996-01-01',
                'jenis_kelamin' => 'Perempuan',
                'no_hp' => '081234567897',
                'nrp' => 'NRP008',
                'image' => base64_encode(file_get_contents(public_path('image/citra.jpg')))
            ],
            [
                'name' => 'Fitri Rianti',
                'email' => 'fitri@gmail.com',
                'password' => 'fitri123',
                'jabatan' => 'Penyiar',
                'alamat' => 'Cilegon Banten',
                'tgl_lahir' => '1997-01-01',
                'jenis_kelamin' => 'Perempuan',
                'no_hp' => '081234567898',
                'nrp' => 'NRP009',
                'image' => base64_encode(file_get_contents(public_path('image/fitri.jpg')))
            ],
            [
                'name' => 'Sarah Ganefi',
                'email' => 'sarah@gmail.com',
                'password' => 'sarah123',
                'jabatan' => 'Penyiar',
                'alamat' => 'Serang Banten',
                'tgl_lahir' => '1997-11-21',
                'jenis_kelamin' => 'Perempuan',
                'no_hp' => '081234567898',
                'nrp' => 'NRP010',
                'image' => base64_encode(file_get_contents(public_path('image/sarah.jpg')))
            ],
            [
                'name' => 'Rifki Baedowi',
                'email' => 'rifki@gmail.com',
                'password' => 'rifki123',
                'jabatan' => 'Penyiar',
                'alamat' => 'Cilegon Banten',
                'tgl_lahir' => '1997-05-11',
                'jenis_kelamin' => 'Pria',
                'no_hp' => '081234567898',
                'nrp' => 'NRP011',
                'image' => base64_encode(file_get_contents(public_path('image/rifki.jpg')))
            ]
        ];

        foreach ($users as $index => $user) {
            $user['password'] = Hash::make($user['password']);
            $user['level'] = 'user';
            DB::table('account')->insert($user);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Amara',
                'tanggal_lahir' => '2002-03-23',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Serang',
                'username' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
            ],
            [
                'name' => 'Somad Diningrat',
                'tanggal_lahir' => '2003-10-20',
                'jenis_kelamin' => 'Laki-Laki',
                'alamat' => 'Serang',
                'username' => 'Somad',
                'email' => 'somad@gmail.com',
                'password' => Hash::make('qwerty'),
                'role' => 'user',
            ],
            [
                'name' => 'Solikin',
                'tanggal_lahir' => '2003-08-20',
                'jenis_kelamin' => 'Laki-Laki',
                'alamat' => 'Serang',
                'username' => 'Solikin',
                'email' => 'Solikin@gmail.com',
                'password' => Hash::make('Solikin123'),
                'role' => 'user',
            ],
            [
                'name' => 'Dadang',
                'tanggal_lahir' => '2003-08-20',
                'jenis_kelamin' => 'Laki-Laki',
                'alamat' => 'Serang',
                'username' => 'Dadang',
                'email' => 'Dadang@gmail.com',
                'password' => Hash::make('Dadang123'),
                'role' => 'user',
            ],
            [
                'name' => 'Dayat',
                'tanggal_lahir' => '2003-08-20',
                'jenis_kelamin' => 'Laki-Laki',
                'alamat' => 'Serang',
                'username' => 'Dayat',
                'email' => 'Dayat@gmail.com',
                'password' => Hash::make('Dayat123'),
                'role' => 'user',
            ],
            [
                'name' => 'Rusdi',
                'tanggal_lahir' => '2003-08-20',
                'jenis_kelamin' => 'Laki-Laki',
                'alamat' => 'Serang',
                'username' => 'Rusdi',
                'email' => 'Rusdi@gmail.com',
                'password' => Hash::make('Rusdi123'),
                'role' => 'user',
            ],
            [
                'name' => 'Madrobi',
                'tanggal_lahir' => '2003-08-20',
                'jenis_kelamin' => 'Laki-Laki',
                'alamat' => 'Serang',
                'username' => 'Madrobi',
                'email' => 'Madrobi@gmail.com',
                'password' => Hash::make('Madrobi123'),
                'role' => 'user',
            ],
            [
                'name' => 'Muthia',
                'tanggal_lahir' => '2002-05-02',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Serang',
                'username' => 'Muthia',
                'email' => 'Muthia@gmail.com',
                'password' => Hash::make('Muthia123'),
                'role' => 'user',
            ],
            [
                'name' => 'Surtini',
                'tanggal_lahir' => '2002-07-22',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Serang',
                'username' => 'Surtini',
                'email' => 'Surtini@gmail.com',
                'password' => Hash::make('Surtini123'),
                'role' => 'user',
            ],
            [
                'name' => 'Suryati',
                'tanggal_lahir' => '2001-02-02',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Serang',
                'username' => 'Suryati',
                'email' => 'Suryati@gmail.com',
                'password' => Hash::make('Suryati123'),
                'role' => 'user',
            ],
            [
                'name' => 'Putri',
                'tanggal_lahir' => '2004-05-18',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Serang',
                'username' => 'Putri',
                'email' => 'Putri@gmail.com',
                'password' => Hash::make('Putri123'),
                'role' => 'user',
            ],
            [
                'name' => 'Ratna',
                'tanggal_lahir' => '2002-05-02',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Serang',
                'username' => 'Ratna',
                'email' => 'Ratna@gmail.com',
                'password' => Hash::make('Ratna123'),
                'role' => 'user',
            ],
        ]);
    }
}

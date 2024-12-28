<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data Admin
        DB::table('users')->insert([
            'name' => 'Sandi Bagaskara',
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Admin Street, Admin City',
            'no_hp' => '081234567890',
            'no_kontrak' => '0862392381',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'), 
            'role' => 'Admin',
        ]);

        // Data Customer Service
        DB::table('users')->insert([
            'name' => 'Putri Maharani',
            'jenis_kelamin' => 'Perempuan',
            'alamat' => 'CS Street, CS City',
            'no_hp' => '081234567891',
            'no_kontrak' => '8907652765',
            'username' => 'Putri',
            'email' => 'putri@example.com',
            'password' => Hash::make('12345678'), 
            'role' => 'Customer Service',
        ]);

        // Data User
        DB::table('users')->insert([
            'name' => 'Komarudin',
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'User Street, User City',
            'no_hp' => '081234567892',
            'no_kontrak' => '12345678',
            'username' => 'Komarudin',
            'email' => 'komarudin@example.com',
            'password' => Hash::make('12345678'), 
            'role' => 'User',
        ]);
        DB::table('users')->insert([
            'name' => 'Ali Kontol',
            'jenis_kelamin' => 'Perempuan',
            'alamat' => 'User Street, User City',
            'no_hp' => '0899772113222',
            'no_kontrak' => '0892654738',
            'username' => 'ali',
            'email' => 'ali@example.com',
            'password' => Hash::make('0892654738'), 
            'role' => 'User',
        ]);
    }
}

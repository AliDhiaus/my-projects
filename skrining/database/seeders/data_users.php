<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class data_users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('data_users')->insert([
            'nik' => '082121',
            'name' => 'sutiyem',
            'date' => '2003-05-05',
            'gender' => 'laki-laki',
            'academy' => 'SMK',
            'religion' => 'budha',
            'status' => 'bujang',
            'job' => 'barista',
            'quiz' => 'ya' 
        ]);
    }
}

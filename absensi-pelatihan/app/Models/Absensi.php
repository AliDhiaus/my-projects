<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $fillable = [
        'user_id',
        'name',
        'tanggal',
        'kejuruan',
        'kelas',
        'jam_masuk',
        'jam_keluar',
        'keterangan',
    ];
}

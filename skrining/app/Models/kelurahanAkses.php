<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelurahanAkses extends Model
{
    use HasFactory;
    protected $table='kelurahan_akses';

    protected $fillable = [
        'id',
        'provinsi',
        'kota',
        'upk',
        'kecamatan',
        'kelurahan',
    ];
}

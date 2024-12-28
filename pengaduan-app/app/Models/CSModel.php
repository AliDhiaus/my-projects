<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CSModel extends Model
{
    use HasFactory;

    protected $table = 'costumer_service';


    protected $fillable = [
        'name',
        'jenis_kelamin',
        'alamat',
        'no_hp',
        'no_kontrak',
        'keluhan',
        'status',
        'tanggapan',
        'user_id',
    ];



}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IsiDas extends Model
{
    use HasFactory;

    protected $table = 'isi_das';

    protected $fillable = [
        'das_id',
        'waktu',
        'program',
        'frame',
        'durasi',
        'keterangan',
    ];

    public function das()
    {
        return $this->belongsTo(Das::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Das extends Model
{
    use HasFactory;

    protected $table = 'das';

    protected $fillable = [
        'account_id',
        'judul',
        'tanggal',
        'petugas'
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'account_id', 'account_id');
    // }

    public function isiDas()
    {
        return $this->hasMany(IsiDas::class);
    }
    

}

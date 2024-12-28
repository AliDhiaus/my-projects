<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'account';

    protected $fillable = [
        'id',
        'level',
        'name',
        'email',
        'password',
        'nrp',
        'jabatan',
        'tgl_lahir',
        'jenis_kelamin',
        'no_hp',
        'image'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function das()
    {
        return $this->hasMany(Das::class, 'account_id', 'account_id');
    }
}

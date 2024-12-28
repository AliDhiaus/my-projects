<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dataUsers extends Model
{
    use HasFactory;

    protected $table = 'data_users';

    protected $fillable = [
        'nik',
        'name',
        'date',
        'gender',
        'academy',
        'religion',
        'status',
        'job',
        'date_of_birth',
        'old'
    ];

    protected $primaryKey = 'nik';
    public $incrementing = false;
    protected $keyType = 'string';

    public function answers()
    {
        return $this->hasMany(AnswerQuest::class, 'nik', 'nik');
    }
}

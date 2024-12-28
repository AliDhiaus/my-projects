<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerQuest extends Model
{
    use HasFactory;

    protected $table = 'answer_user';

    protected $fillable = [
        'answer',
        'nik'
    ];

    protected $casts = [
        'answers' => 'array', 
    ];

    public function user()
    {
        return $this->belongsTo(DataUser::class, 'nik', 'nik');
    }
}


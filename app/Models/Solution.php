<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    use HasFactory;

    protected $table = 'solutions';

    protected $fillable = [
        'student_id',
        'solution_file',
        'submission_time',
        'homework_id',
        'score',
    ];

    public function student() 
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }
}

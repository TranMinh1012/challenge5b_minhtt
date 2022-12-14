<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Essay extends Model
{
    use HasFactory;

    protected $table = 'essays';

    protected $fillable = [
        'teacher_id',
        'essay',
        'tip',
        'assignment_time',
    ];
}

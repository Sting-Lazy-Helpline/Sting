<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Answers extends Model
{
    use HasFactory;
    protected $fillable = [
        'survey_id',
        'question_id',
        'answer',
    ];
}

  
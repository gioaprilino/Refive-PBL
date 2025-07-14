<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobVacancy extends Model
{
    protected $fillable = [
        'title',
        'thumbnail',
        'author',
        'description',
        'deadline',
    ];
}

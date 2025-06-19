<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'heading',
        'description_1',
        'description_2',
        'image_1',
        'image_2',
    ];
}

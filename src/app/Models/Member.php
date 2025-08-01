<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'designation',
        'x_url',
        'fb_url',
        'ig_url',
        'in_url',
        'image',
        'status',
    ];
}

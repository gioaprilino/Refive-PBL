<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'photo',
        'short_desc',
        'description',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'service_id',
        'project_status',
        'thumbnail',
        'images',
        'status',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_client_id',
        'thumbnail',
        'message',
    ];

    public function client()
    {
        return $this->belongsTo(ProjectClient::class, 'project_client_id');
    }
}

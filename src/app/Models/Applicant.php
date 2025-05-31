<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Applicant extends Model {
    use HasFactory;

    protected $fillable = [
        'recruitment_id', 'name', 'email', 'phone', 'resume', 'status'
    ];

    public function recruitment() {
        return $this->belongsTo(Recruitment::class);
    }
}

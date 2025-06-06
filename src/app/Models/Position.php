<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Position extends Model {
    use HasFactory;

    protected $fillable = ['name', 'department_id'];

    public function department() {
        return $this->belongsTo(Department::class);
    }
}

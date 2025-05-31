<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model {
    use HasFactory;

    protected $fillable = ['name', 'code'];

    public function positions() {
        return $this->hasMany(Position::class);
    }
}

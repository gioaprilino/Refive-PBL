<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asset extends Model {
    use HasFactory;

    protected $fillable = [
        'name', 'serial_number', 'assigned_to', 'status', 'notes'
    ];

    public function employee() {
        return $this->belongsTo(Employee::class, 'assigned_to');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model {
    use HasFactory;

    protected $fillable = [
        'employee_id', 'date', 'status', 'clock_in', 'clock_out',
        'latitude', 'longitude', 'radius'
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}
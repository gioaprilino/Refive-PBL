<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Leave extends Model {
    use HasFactory;

    protected $fillable = [
        'employee_id', 'type', 'start_date', 'end_date', 'reason', 'status'
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}

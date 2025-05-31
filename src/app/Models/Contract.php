<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contract extends Model {
    use HasFactory;

    protected $fillable = [
        'employee_id', 'contract_type', 'start_date', 'end_date', 'notes'
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}

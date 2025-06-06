<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeProjectTask extends Model {
    use HasFactory;

    protected $fillable = [
        'employee_id', 'project_id', 'task', 'deadline', 'status'
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }
}

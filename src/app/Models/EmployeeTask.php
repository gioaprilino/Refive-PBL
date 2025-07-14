<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_project_id',
        'employee_id',
        'name',
        'description',
        'due_date',
        'status',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(EmployeeProject::class, 'employee_project_id');
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}

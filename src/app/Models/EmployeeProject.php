<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EmployeeProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'name',
        'description',
        'start_date',
        'end_date',
        'status',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(EmployeeTask::class, 'employee_project_id', 'id');
    }
}

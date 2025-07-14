<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'leave_type',
        'start_date',
        'end_date',
        'total_days',
        'reason',
        'notes',
        'status',
        'approved_by',
        'approved_at',
        'rejection_reason',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'approved_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'approved' => 'bg-green-100 text-green-800',
            'rejected' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getStatusTextAttribute()
    {
        return match ($this->status) {
            'pending' => 'Menunggu Persetujuan',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            default => 'Tidak Diketahui',
        };
    }

    public function getLeaveTypeTextAttribute()
    {
        return match ($this->leave_type) {
            'annual' => 'Cuti Tahunan',
            'sick' => 'Cuti Sakit',
            'personal' => 'Cuti Pribadi',
            'maternity' => 'Cuti Melahirkan',
            'paternity' => 'Cuti Ayah',
            'emergency' => 'Cuti Darurat',
            default => ucfirst($this->leave_type),
        };
    }

    public function calculateTotalDays()
    {
        $startDate = Carbon::parse($this->start_date);
        $endDate = Carbon::parse($this->end_date);

        $totalDays = 0;
        $currentDate = $startDate->copy();

        while ($currentDate->lte($endDate)) {
            // Skip weekends (Saturday = 6, Sunday = 0)
            if (! in_array($currentDate->dayOfWeek, [0, 6])) {
                $totalDays++;
            }
            $currentDate->addDay();
        }

        return $totalDays;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($leaveRequest) {
            $leaveRequest->total_days = $leaveRequest->calculateTotalDays();
        });

        static::updating(function ($leaveRequest) {
            if ($leaveRequest->isDirty(['start_date', 'end_date'])) {
                $leaveRequest->total_days = $leaveRequest->calculateTotalDays();
            }
        });
    }
}

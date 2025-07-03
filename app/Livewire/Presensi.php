<?php

namespace App\Livewire;

use App\Models\Attendance;
use App\Models\LeaveRequest;
use App\Models\Schedule;
use Auth;
use Carbon\Carbon;
use Livewire\Component;

class Presensi extends Component
{
    public $latitude;

    public $longitude;

    public $status;

    public $attendance;

    // Leave request properties
    public $showLeaveModal = false;

    public $leave_type = '';

    public $start_date = '';

    public $end_date = '';

    public $reason = '';

    public $notes = '';

    public function mount()
    {
        $user = Auth::user();
        $this->attendance = Attendance::where('user_id', $user->id)
            ->whereDate('created_at', today())
            ->first();
    }

    public function submitPresensi()
    {
        $user = Auth::user();
        $now = Carbon::now();

        $schedule = Schedule::with(['shift', 'office'])->where('user_id', $user->id)->firstOrFail();
        $shift = $schedule->shift;
        $office = $schedule->office;

        if (! $this->latitude || ! $this->longitude || $this->status !== 'dalam') {
            session()->flash('error', 'Lokasi tidak valid atau di luar jangkauan kantor.');

            return;
        }

        if (! $this->attendance) {
            // CHECK IN
            Attendance::create([
                'user_id' => $user->id,
                'shift_id' => $shift->id,
                'office_id' => $office->id,
                'schedule_latitude' => $office->latitude,
                'schedule_longitude' => $office->longitude,
                'schedule_start_time' => $shift->start_time,
                'schedule_end_time' => $shift->end_time,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'start_time' => $now->format('H:i:s'),
            ]);

            session()->flash('success', 'Berhasil Check-In');
        } elseif (! $this->attendance->end_time) {
            // CHECK OUT
            $this->attendance->update([
                'end_time' => $now->format('H:i:s'),
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
            ]);

            session()->flash('success', 'Berhasil Check-Out');
        } else {
            session()->flash('success', 'Presensi hari ini sudah lengkap.');
        }

        // Refresh attendance state
        $this->attendance = Attendance::where('user_id', $user->id)
            ->whereDate('created_at', today())
            ->first();
    }

    public function openLeaveModal()
    {
        $this->showLeaveModal = true;
        $this->resetLeaveForm();
    }

    public function closeLeaveModal()
    {
        $this->showLeaveModal = false;
        $this->resetLeaveForm();
    }

    public function resetLeaveForm()
    {
        $this->leave_type = '';
        $this->start_date = '';
        $this->end_date = '';
        $this->reason = '';
        $this->notes = '';
    }

    public function submitLeaveRequest()
    {
        $this->validate([
            'leave_type' => 'required|in:annual,sick,personal,maternity,paternity,emergency',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:500',
            'notes' => 'nullable|string|max:500',
        ], [
            'leave_type.required' => 'Jenis cuti harus dipilih',
            'leave_type.in' => 'Jenis cuti tidak valid',
            'start_date.required' => 'Tanggal mulai harus diisi',
            'start_date.after_or_equal' => 'Tanggal mulai tidak boleh kurang dari hari ini',
            'end_date.required' => 'Tanggal selesai harus diisi',
            'end_date.after_or_equal' => 'Tanggal selesai tidak boleh kurang dari tanggal mulai',
            'reason.required' => 'Alasan cuti harus diisi',
            'reason.max' => 'Alasan cuti maksimal 500 karakter',
            'notes.max' => 'Catatan maksimal 500 karakter',
        ]);

        // Check for overlapping leave requests
        $existingLeave = LeaveRequest::where('user_id', Auth::id())
            ->where('status', '!=', 'rejected')
            ->where(function ($query) {
                $query->whereBetween('start_date', [$this->start_date, $this->end_date])
                    ->orWhereBetween('end_date', [$this->start_date, $this->end_date])
                    ->orWhere(function ($q) {
                        $q->where('start_date', '<=', $this->start_date)
                            ->where('end_date', '>=', $this->end_date);
                    });
            })
            ->first();

        if ($existingLeave) {
            session()->flash('error', 'Anda sudah memiliki pengajuan cuti pada periode tersebut.');

            return;
        }

        LeaveRequest::create([
            'user_id' => Auth::id(),
            'leave_type' => $this->leave_type,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'reason' => $this->reason,
            'notes' => $this->notes,
            'status' => 'pending',
        ]);

        session()->flash('success', 'Pengajuan cuti berhasil dikirim dan menunggu persetujuan.');
        $this->closeLeaveModal();
    }

    public function render()
    {
        $schedule = Schedule::with(['shift', 'office'])->where('user_id', auth()->user()->id)->first();

        // Get user's leave requests
        $leaveRequests = LeaveRequest::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('livewire.presensi', [
            'schedule' => $schedule,
            'attendance' => $this->attendance,
            'leaveRequests' => $leaveRequests,
        ])
            ->layout('components.layouts.app2');
    }
}

<?php

namespace App\Livewire;

use App\Models\Attendance;
use App\Models\Schedule;
use Carbon\Carbon;
use Livewire\Component;
use Auth;

class Presensi extends Component
{
    public $latitude, $longitude, $status;
    public $attendance;

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

        if (!$this->latitude || !$this->longitude || $this->status !== 'dalam') {
            session()->flash('error', 'Lokasi tidak valid atau di luar jangkauan kantor.');
            return;
        }

        if (!$this->attendance) {
            // CHECK IN
            Attendance::create([
                'user_id' => $user->id,
                'schedule_latitude' => $office->latitude,
                'schedule_longitude' => $office->longitude,
                'schedule_start_time' => $shift->start_time,
                'schedule_end_time' => $shift->end_time,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'start_time' => $now->format('H:i:s'),
            ]);

            session()->flash('success', 'Berhasil Check-In');
        } elseif (!$this->attendance->end_time) {
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

    public function render()
    {
        $schedule = Schedule::with(['shift', 'office'])->where('user_id', auth()->user()->id)->first();

        return view('livewire.presensi', [
            'schedule' => $schedule,
            'attendance' => $this->attendance,
        ])
        ->layout('components.layouts.app2');
    }
}
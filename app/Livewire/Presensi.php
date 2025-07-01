<?php

namespace App\Livewire;

use App\Models\Schedule;
use Livewire\Component;

class Presensi extends Component
{
    public function render()
    {
        $schedule = Schedule::where('user_id', auth()->user()->id)->first();

        return view('livewire.presensi', [
            'schedule' => $schedule,
        ])
            ->layout('components.layouts.app2');
    }
}

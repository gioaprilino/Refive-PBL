<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Schedule;
use Auth;

class Presensi extends Component
{

    public function render()
    {
        $schedule = Schedule::where('user_id', auth()->user()->id)->first();
        
        return view('livewire.presensi', [
            'schedule' => $schedule
        ])
        ->layout('components.layouts.app2');
    }
}

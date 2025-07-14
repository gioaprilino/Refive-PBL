<?php

namespace App\Livewire;

use App\Models\JobVacancy;
use Livewire\Component;

class JobPage extends Component
{
    public function render()
    {
        return view('livewire.job-page', [
            'jobs' => JobVacancy::latest()->paginate(6),
        ]);
    }
}

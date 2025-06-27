<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\JobVacancy;

class JobPage extends Component
{
    public function render()
    {
        return view('livewire.job-page', [
            'jobs' => JobVacancy::latest()->paginate(6),
        ]);
    }
}

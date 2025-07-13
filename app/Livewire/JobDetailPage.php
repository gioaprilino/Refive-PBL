<?php

namespace App\Livewire;

use App\Models\JobVacancy;
use Livewire\Component;

class JobDetailPage extends Component
{
    public JobVacancy $job;

    public function mount(JobVacancy $job)
    {
        $this->job = $job;
    }

    public function render()
    {
        return view('livewire.job-detail-page');
    }
}

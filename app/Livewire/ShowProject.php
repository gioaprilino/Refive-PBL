<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Project;
use App\Models\Service;

class ShowProject extends Component
{
    public $projects;
    public $services;

    public function mount()
    {
        $this->projects = Project::with('service')->get();
        $this->services = Service::all();
    }
    public function render()
    {
        return view('livewire.show-project');
    }
}

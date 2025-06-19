<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Project;
use App\Models\Contact;

class ProjectDetail extends Component
{
    public $project;

    public function mount($id)
    {
        $this->project = Project::with('service')->findOrFail($id);
    }
    public function render()
    {
        return view('livewire.project-detail')
            ->layout('components.layouts.app', [
                'title' => $this->project->title,
                'contact' => Contact::first(), // penting agar footer tidak error
            ]);
    }
}

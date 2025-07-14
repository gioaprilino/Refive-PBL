<?php

namespace App\Livewire;

use App\Models\JobVacancy;
use Livewire\Component;
use Livewire\WithFileUploads;

class JobApplyPage extends Component
{
    use WithFileUploads;

    public $job;

    public $name;

    public $email;

    public $phone;

    public $cv;

    public function mount($job)
    {
        $this->job = JobVacancy::findOrFail($job);
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $cvPath = $this->cv->store('lamaran', 'public');

        // Pastikan $data didefinisikan sebelum digunakan
        $data = [
            'job_title' => $this->job->title,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ];

        \Mail::to('gioaprilino91@gmail.com')->send(new \App\Mail\JobApplicationMail($data, $cvPath));

        session()->flash('success', 'Lamaran berhasil dikirim ke HRD!');
        $this->reset(['name', 'email', 'phone', 'cv']);
    }

    public function render()
    {
        return view('livewire.job-apply-page');
    }
}

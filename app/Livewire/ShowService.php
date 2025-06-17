<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Service;

class ShowService extends Component
{
    public $service;

    public function mount($id)
    {
        $this->service = Service::findOrFail($id);
    }
    
    public function render()
    {
        return view('livewire.show-service', [
            'service' => $this->service,
            'services' => Service::all(),
        ]);
    }
}

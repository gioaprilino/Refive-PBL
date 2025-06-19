<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\About;

class ShowAbout extends Component
{
    public function render()
    {
        $about = About::latest()->first();

        return view('livewire.show-about', [
            'about' => $about,
        ]);
    }
}

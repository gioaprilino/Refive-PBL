<?php

namespace App\Livewire;

use App\Models\About;
use Livewire\Component;

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

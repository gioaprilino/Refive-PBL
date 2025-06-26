<?php

namespace App\Livewire;

use App\Models\Hero;
use Livewire\Component;

class ShowHero extends Component
{
    public function render()
    {
        $hero = Hero::latest()->first();

        return view('livewire.show-hero', compact('hero'));
    }
}

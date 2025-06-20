<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Hero;

class ShowHero extends Component
{
    public function render()
    {
        $hero = Hero::latest()->first();
        return view('livewire.show-hero', compact('hero'));
    }
}

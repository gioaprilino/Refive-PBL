<?php

namespace App\Livewire\Position;

use Livewire\Component;
use App\Models\Position;

class Create extends Component
{
    public $name;

    public function store()
    {
        $this->validate(['name' => 'required']);
        Position::create(['name' => $this->name]);
        session()->flash('message', 'Jabatan berhasil ditambahkan.');
        return redirect()->route('position.index');
    }

    public function render()
    {
        return view('livewire.position.create');
    }
}

<?php

namespace App\Livewire\Position;

use Livewire\Component;
use App\Models\Position;

class Edit extends Component
{
    public $positionId;
    public $name;

    public function mount($id)
    {
        $position = Position::findOrFail($id);
        $this->positionId = $position->id;
        $this->name = $position->name;
    }

    public function update()
    {
        $this->validate(['name' => 'required']);
        Position::findOrFail($this->positionId)->update(['name' => $this->name]);
        session()->flash('message', 'Jabatan berhasil diperbarui.');
        return redirect()->route('position.index');
    }

    public function render()
    {
        return view('livewire.position.edit')->layout('components.layouts.app');
    }
}

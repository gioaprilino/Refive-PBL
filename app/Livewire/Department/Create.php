<?php

namespace App\Livewire\Department;

use Livewire\Component;
use App\Models\Department;
class Create extends Component
{
    public $code, $name;

    public function save() {
        $this->validate([
            'code' => 'required|unique:departments',
            'name' => 'required',
        ]);

        Department::create([
            'code' => $this->code,
            'name' => $this->name,
        ]);

        session()->flash('message', 'Departemen berhasil ditambahkan.');
        return redirect()->route('department.index');
    }

    public function render() {
        return view('livewire.department.create');
    }
}
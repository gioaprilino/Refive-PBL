<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Department;

class Create extends Component
{
    public $name, $email, $position_id, $department_code;
    public $positions, $departments;

    public function mount()
    {
        $this->positions = Position::all();
        $this->departments = Department::all();
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees',
            'position_id' => 'required',
            'department_code' => 'required',
        ]);

        Employee::create([
            'name' => $this->name,
            'email' => $this->email,
            'position_id' => $this->position_id,
            'department_code' => $this->department_code,
        ]);

        session()->flash('message', 'Karyawan berhasil ditambahkan.');
        return redirect()->route('employee.index');
    }

    public function render()
    {
        return view('livewire.employee.create');
    }
}

<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Department;

class Edit extends Component
{
    public $employeeId, $name, $email, $position_id, $department_code;
    public $positions, $departments;

    public function mount($id)
    {
        $employee = Employee::findOrFail($id);
        $this->employeeId = $employee->id;
        $this->name = $employee->name;
        $this->email = $employee->email;
        $this->position_id = $employee->position_id;
        $this->department_code = $employee->department_code;

        $this->positions = Position::all();
        $this->departments = Department::all();
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees,email,' . $this->employeeId,
            'position_id' => 'required',
            'department_code' => 'required',
        ]);

        Employee::findOrFail($this->employeeId)->update([
            'name' => $this->name,
            'email' => $this->email,
            'position_id' => $this->position_id,
            'department_code' => $this->department_code,
        ]);

        session()->flash('message', 'Karyawan berhasil diperbarui.');
        return redirect()->route('employee.index');
    }

    public function render()
    {
        return view('livewire.employee.edit');
    }
}

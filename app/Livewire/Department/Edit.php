<?php
namespace App\Livewire\Department;

use Livewire\Component;
use App\Models\Department;

class Edit extends Component
{
    public $departmentId;
    public $code;
    public $name;

    public function mount($id)
    {
        $department = Department::findOrFail($id);
        $this->departmentId = $department->id;
        $this->code = $department->code;
        $this->name = $department->name;
    }

    public function update()
    {
        $this->validate([
            'code' => 'required|unique:departments,code,' . $this->departmentId,
            'name' => 'required',
        ]);

        $department = Department::findOrFail($this->departmentId);
        $department->update([
            'code' => $this->code,
            'name' => $this->name,
        ]);

        session()->flash('message', 'Departemen berhasil diperbarui.');
        return redirect()->route('department.index');
    }

    public function render()
    {
        return view('livewire.department.edit');
    }

    protected $layout = 'components.layouts.app';
}
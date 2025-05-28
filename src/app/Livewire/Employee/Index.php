<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Employee;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortField === $field
            ? ($this->sortDirection === 'asc' ? 'desc' : 'asc')
            : 'asc';

        $this->sortField = $field;
    }

    public function delete($id)
    {
        Employee::findOrFail($id)->delete();
        session()->flash('message', 'Karyawan berhasil dihapus.');
    }

    public function render()
    {
        $employees = Employee::with('position', 'department')
            ->where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.employee.index', [
            'employees' => $employees,
        ]);
    }
}
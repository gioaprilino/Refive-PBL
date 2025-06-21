<?php

namespace App\Livewire\Position;

use Livewire\Component;
use Livewire\WithPagination; // Tambahkan trait untuk pagination
use App\Models\Position;

class Index extends Component
{
    use WithPagination;

    public $positions;
    public $search = ''; // Tambahkan properti $search
    public $sortField = 'name'; // Tambahkan properti untuk sorting
    public $sortDirection = 'asc'; // Tambahkan properti untuk arah sorting

    public function mount()
    {
        $this->positions = Position::all();
    }

    public function updatingSearch()
    {
        $this->resetPage(); // Reset pagination saat pencarian berubah
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
        Position::findOrFail($id)->delete();
        session()->flash('message', 'Jabatan berhasil dihapus.');
    }

    public function render()
    {
        $positions = Position::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('code', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.position.index', [
            'positions' => $positions,
        ]);
    }
}


<div class="p-6">
    {{-- Tambahkan form create di sini --}}
    <livewire:department.create />

    <div class="flex justify-between mb-4">
        <input wire:model="search" type="text" placeholder="Cari departemen..." class="border rounded p-2">
        <a href="{{ route('department.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah</a>
    </div>

    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2 cursor-pointer" wire:click="sortBy('code')">Kode</th>
                <th class="px-4 py-2 cursor-pointer" wire:click="sortBy('name')">Nama</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($departments as $department)
            <tr>
                <td class="border px-4 py-2">{{ $department->code }}</td>
                <td class="border px-4 py-2">{{ $department->name }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('department.edit', $department->id) }}" class="text-blue-500">Edit</a>
                    <button wire:click="delete({{ $department->id }})" class="text-red-500 ml-2">Hapus</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $departments->links() }}
    </div>
</div>

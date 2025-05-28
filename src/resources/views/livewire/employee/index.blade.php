<div class="p-6">
    <div class="flex justify-between mb-4">
        <input wire:model="search" type="text" placeholder="Cari karyawan..." class="border rounded p-2">
        <a href="{{ route('employee.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah</a>
    </div>

    <table class="table-auto w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 cursor-pointer" wire:click="sortBy('name')">Nama</th>
                <th class="px-4 py-2">Posisi</th>
                <th class="px-4 py-2">Kode Departemen</th>
                <th class="px-4 py-2">Tanggal Masuk</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($employees as $employee)
                <tr class="hover:bg-gray-50">
                    <td class="border px-4 py-2">{{ $employee->name }}</td>
                    <td class="border px-4 py-2">{{ $employee->position->name ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $employee->department->code ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $employee->hire_date }}</td>
                    <td class="border px-4 py-2 capitalize">{{ $employee->status }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('employee.edit', $employee->id) }}" class="text-blue-500">Edit</a>
                        <button wire:click="delete({{ $employee->id }})" class="text-red-500 ml-2">Hapus</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">Tidak ada data karyawan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $employees->links() }}
    </div>
</div>

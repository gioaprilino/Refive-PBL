<div class="p-6">
    <div class="flex flex-col sm:flex-row justify-between items-center mb-4 gap-2">
        <input wire:model="search" type="text" placeholder="Cari posisi..." class="border border-gray-300 rounded p-2 w-full sm:w-1/3">
        <a href="{{ route('position.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">Tambah</a>
    </div>

    <div class="overflow-x-auto">
        <table class="table-auto w-full border border-gray-200 text-sm text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Departemen</th>                
                    <th class="px-4 py-2 border cursor-pointer" wire:click="sortBy('name')">Nama</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($positions as $position)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2">{{ $position->department->code ?? '-' }}</td>
                        <td class="border px-4 py-2">{{ $position->name }}</td>
                        <td class="border px-4 py-2 space-x-2">
                            <a href="{{ route('position.edit', $position->id) }}" class="text-blue-600 hover:underline">Edit</a>
                            <button wire:click="delete({{ $position->id }})" class="text-red-600 hover:underline">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4">Tidak ada data posisi ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $positions->links() }}
    </div>
</div>
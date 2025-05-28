<div>
    <h2 class="text-xl font-bold mb-4">Edit Departemen</h2>

    <form wire:submit.prevent="update">
        <div class="mb-4">
            <label>Kode</label>
            <input type="text" wire:model="code" class="border p-2 w-full">
            @error('code') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label>Nama</label>
            <input type="text" wire:model="name" class="border p-2 w-full">
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-yellow-500 text-white px-4 py-2">Update</button>
        <a href="{{ route('department.index') }}" class="ml-2 text-blue-500">Kembali</a>
    </form>
</div>
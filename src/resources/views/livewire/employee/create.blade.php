<div>
    <h2 class="text-xl font-bold mb-4">Tambah Karyawan</h2>

    <form wire:submit.prevent="save">
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

        <button type="submit" class="bg-green-500 text-white px-4 py-2">Simpan</button>
    </form>
</div>

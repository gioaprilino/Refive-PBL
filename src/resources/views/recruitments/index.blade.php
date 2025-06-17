{{-- filepath: d:\project\Refive-PBL\src\resources\views\recruitments\edit.blade.php --}}
@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Lowongan Kerja</h1>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('recruitments.update', $recruitment->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block font-medium">Judul</label>
            <input type="text" name="title" value="{{ old('title', $recruitment->title) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block font-medium">Departemen</label>
            <select name="department_id" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Pilih Departemen --</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ old('department_id', $recruitment->department_id) == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block font-medium">Posisi</label>
            <select name="position_id" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Pilih Posisi --</option>
                @foreach($positions as $position)
                    <option value="{{ $position->id }}" {{ old('position_id', $recruitment->position_id) == $position->id ? 'selected' : '' }}>
                        {{ $position->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block font-medium">Deskripsi</label>
            <textarea name="description" class="w-full border rounded px-3 py-2" rows="4" required>{{ old('description', $recruitment->description) }}</textarea>
        </div>
        <div>
            <label class="block font-medium">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2" required>
                <option value="open" {{ old('status', $recruitment->status) == 'open' ? 'selected' : '' }}>Open</option>
                <option value="closed" {{ old('status', $recruitment->status) == 'closed' ? 'selected' : '' }}>Closed</option>
            </select>
        </div>
        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
            <a href="{{ route('recruitments.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
        </div>
    </form>
@endsection{{-- filepath: d:\project\Refive-PBL\src\resources\views\recruitments\index.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Lowongan Kerja</h1>
        <a href="{{ route('recruitments.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah Lowongan</a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-blue-100 rounded">
            <thead>
                <tr class="bg-blue-50">
                    <th class="py-2 px-4 border-b">Judul</th>
                    <th class="py-2 px-4 border-b">Departemen</th>
                    <th class="py-2 px-4 border-b">Posisi</th>
                    <th class="py-2 px-4 border-b">Status</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recruitments as $recruitment)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $recruitment->title }}</td>
                        <td class="py-2 px-4 border-b">{{ $recruitment->department->name ?? '-' }}</td>
                        <td class="py-2 px-4 border-b">{{ $recruitment->position->name ?? '-' }}</td>
                        <td class="py-2 px-4 border-b">
                            <span class="px-2 py-1 rounded {{ $recruitment->status == 'open' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($recruitment->status) }}
                            </span>
                        </td>
                        <td class="py-2 px-4 border-b flex gap-2">
                            <a href="{{ route('applicants.index', $recruitment->id) }}" class="text-blue-600 hover:underline">Pelamar</a>
                            <a href="{{ route('recruitments.edit', $recruitment->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                            <form action="{{ route('recruitments.destroy', $recruitment->id) }}" method="POST" onsubmit="return confirm('Yakin hapus lowongan?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 text-center text-gray-500">Belum ada lowongan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
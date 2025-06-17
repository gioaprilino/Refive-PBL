{{-- filepath: d:\project\Refive-PBL\src\resources\views\recruitments\create.blade.php --}}
@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Tambah Lowongan Kerja</h1>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('recruitments.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block font-medium">Judul</label>
            <input type="text" name="title" value="{{ old('title') }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block font-medium">Departemen</label>
            <select name="department_id" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Pilih Departemen --</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
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
                    <option value="{{ $position->id }}" {{ old('position_id') == $position->id ? 'selected' : '' }}>
                        {{ $position->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block font-medium">Deskripsi</label>
            <textarea name="description" class="w-full border rounded px-3 py-2" rows="4" required>{{ old('description') }}</textarea>
        </div>
        <div>
            <label class="block font-medium">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2" required>
                <option value="open" {{ old('status') == 'open' ? 'selected' : '' }}>Open</option>
                <option value="closed" {{ old('status') == 'closed' ? 'selected' : '' }}>Closed</option>
            </select>
        </div>
        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
            <a href="{{ route('recruitments.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
        </div>
    </form>
@endsection
@extends('layouts.app')
@section('content')
    <div class="max-w-xl mx-auto mt-8 bg-white rounded-lg shadow p-6 border border-blue-100">
        <h2 class="text-xl font-bold text-blue-700 mb-6">Edit Jabatan</h2>
        <form method="POST" action="{{ route('positions.update', $position) }}">
            @csrf @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-medium text-blue-700 mb-1">Nama</label>
                <input type="text" name="name" value="{{ $position->name }}" class="w-full border border-blue-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-blue-700 mb-1">Departemen</label>
                <select name="department_id" class="w-full border border-blue-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500" required>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" @selected($department->id == $position->department_id)>{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow transition">Update</button>
        </form>
    </div>
@endsection
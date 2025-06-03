@extends('layouts.app')
@section('content')
    <div class="max-w-xl mx-auto mt-8 bg-white rounded-lg shadow p-6 border border-blue-100">
        <h2 class="text-xl font-bold text-blue-700 mb-6">Tambah Departemen</h2>
        <form method="POST" action="{{ route('departments.store') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-blue-700 mb-1">Nama</label>
                <input type="text" name="name" class="w-full border border-blue-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-blue-700 mb-1">Kode</label>
                <input type="text" name="code" class="w-full border border-blue-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow transition">Simpan</button>
        </form>
    </div>
@endsection
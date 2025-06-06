@extends('layouts.app')
@section('content')
    <div class="max-w-xl mx-auto mt-8 bg-white rounded-lg shadow p-6 border border-blue-100">
        <h2 class="text-xl font-bold text-blue-700 mb-6">Edit Profil Perusahaan</h2>
        <form method="POST" action="{{ route('companies.update', $company) }}">
            @csrf @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-medium text-blue-700 mb-1">Nama</label>
                <input type="text" name="name" value="{{ $company->name }}" class="w-full border border-blue-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-blue-700 mb-1">Deskripsi</label>
                <textarea name="description" class="w-full border border-blue-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500" required>{{ $company->description }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-blue-700 mb-1">Alamat</label>
                <textarea name="address" class="w-full border border-blue-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500" required>{{ $company->address }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-blue-700 mb-1">Telepon</label>
                <input type="text" name="phone" value="{{ $company->phone }}" class="w-full border border-blue-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-blue-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ $company->email }}" class="w-full border border-blue-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-blue-700 mb-1">Website</label>
                <input type="text" name="website" value="{{ $company->website }}" class="w-full border border-blue-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow transition">Update</button>
        </form>
    </div>
@endsection
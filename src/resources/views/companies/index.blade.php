@extends('layouts.app')
@section('content')
    <div class="mt-4">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-blue-700">Profil Perusahaan</h2>
            <a href="{{ route('companies.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow transition">Tambah Profil</a>
        </div>
        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800 border border-green-200">{{ session('success') }}</div>
        @endif
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full divide-y divide-blue-200 bg-white">
                <thead class="bg-blue-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">Telepon</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-blue-100">
                    @foreach($companies as $company)
                    <tr>
                        <td class="px-6 py-4 text-gray-700">{{ $company->name }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $company->email }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $company->phone }}</td>
                        <td class="px-6 py-4 flex gap-2">
                            <a href="{{ route('companies.edit', $company) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded shadow text-xs font-semibold">Edit</a>
                            <form action="{{ route('companies.destroy', $company) }}" method="POST" class="inline" onsubmit="return confirm('Yakin?')">
                                @csrf @method('DELETE')
                                <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded shadow text-xs font-semibold">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
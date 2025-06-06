@extends('layouts.app')
@section('content')
    <div class="mt-4">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-blue-700">Manajemen Karyawan</h2>
            <a href="{{ route('employees.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow transition">Tambah
                Karyawan</a>
        </div>
        @if (session('success'))
            <div
                class="mb-4 p-3 rounded bg-green-100 text-green-800 border border-green-200">{{ session('success') }}</div>
        @endif

        <form method="GET" class="flex items-center gap-2 mb-4">
            <select name="status"
                class="border border-blue-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
                onchange="this.form.submit()">
                <option value="all" {{ $status == 'all' ? 'selected' : '' }}>Semua</option>
                <option value="active" {{ $status == 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="resigned" {{ $status == 'resigned' ? 'selected' : '' }}>Resign</option>
                <option value="retired" {{ $status == 'retired' ? 'selected' : '' }}>Pensiun</option>
            </select>
            <a href="{{ route('employees.export') }}"
                class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded shadow transition">Export
                Excel</a>
        </form>

        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full divide-y divide-blue-200 bg-white">
                <thead class="bg-blue-100">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">
                            Nama</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">
                            Email</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">
                            Jabatan</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">
                            Departemen</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-blue-100">
                    @foreach ($employees as $employee)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $employee->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $employee->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $employee->position->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $employee->department->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm flex gap-2">
                                <a href="{{ route('employees.edit', $employee) }}"
                                    class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded shadow text-xs font-semibold">
                                    Edit</a>
                                <form action="{{ route('employees.destroy', $employee) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus?')" class="inline">
                                    @csrf @method('DELETE')
                                    <button
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded shadow text-xs font-semibold">
                                        Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

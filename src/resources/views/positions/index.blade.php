@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Jabatan</h2>
    <a href="{{ route('positions.create') }}" class="btn btn-primary mb-3">Tambah Jabatan</a>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th><th>Departemen</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($positions as $position)
            <tr>
                <td>{{ $position->name }}</td>
                <td>{{ $position->department->name }}</td>
                <td>
                    <a href="{{ route('positions.edit', $position) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('positions.destroy', $position) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
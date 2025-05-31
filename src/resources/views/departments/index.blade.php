@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Departemen</h2>
    <a href="{{ route('departments.create') }}" class="btn btn-primary mb-3">Tambah Departemen</a>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th><th>Kode</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($departments as $department)
            <tr>
                <td>{{ $department->name }}</td>
                <td>{{ $department->code }}</td>
                <td>
                    <a href="{{ route('departments.edit', $department) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('departments.destroy', $department) }}" method="POST" class="d-inline">
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
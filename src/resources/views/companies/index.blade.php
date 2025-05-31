@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Profil Perusahaan</h2>
    <a href="{{ route('companies.create') }}" class="btn btn-primary mb-3">Tambah Profil</a>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th><th>Email</th><th>Telepon</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($companies as $company)
            <tr>
                <td>{{ $company->name }}</td>
                <td>{{ $company->email }}</td>
                <td>{{ $company->phone }}</td>
                <td>
                    <a href="{{ route('companies.edit', $company) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('companies.destroy', $company) }}" method="POST" class="d-inline">
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
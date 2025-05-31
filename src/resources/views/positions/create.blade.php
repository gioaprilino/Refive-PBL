@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Tambah Jabatan</h2>
    <form method="POST" action="{{ route('positions.store') }}">
        @csrf
        <div class="mb-3"><label class="form-label">Nama</label><input type="text" name="name" class="form-control" required></div>
        <div class="mb-3">
            <label class="form-label">Departemen</label>
            <select name="department_id" class="form-control" required>
                <option value="">-- Pilih Departemen --</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
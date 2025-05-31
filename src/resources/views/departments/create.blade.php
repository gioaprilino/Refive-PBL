@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Tambah Departemen</h2>
    <form method="POST" action="{{ route('departments.store') }}">
        @csrf
        <div class="mb-3"><label class="form-label">Nama</label><input type="text" name="name" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Kode</label><input type="text" name="code" class="form-control" required></div>
        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
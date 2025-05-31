@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Tambah Profil Perusahaan</h2>
    <form method="POST" action="{{ route('companies.store') }}">
        @csrf
        <div class="mb-3"><label class="form-label">Nama</label><input type="text" name="name" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Deskripsi</label><textarea name="description" class="form-control" required></textarea></div>
        <div class="mb-3"><label class="form-label">Alamat</label><textarea name="address" class="form-control" required></textarea></div>
        <div class="mb-3"><label class="form-label">Telepon</label><input type="text" name="phone" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Website</label><input type="text" name="website" class="form-control"></div>
        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
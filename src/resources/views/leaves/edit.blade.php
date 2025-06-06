@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Edit Profil Perusahaan</h2>
    <form method="POST" action="{{ route('companies.update', $company) }}">
        @csrf @method('PUT')
        <div class="mb-3"><label class="form-label">Nama</label><input type="text" name="name" value="{{ $company->name }}" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Deskripsi</label><textarea name="description" class="form-control" required>{{ $company->description }}</textarea></div>
        <div class="mb-3"><label class="form-label">Alamat</label><textarea name="address" class="form-control" required>{{ $company->address }}</textarea></div>
        <div class="mb-3"><label class="form-label">Telepon</label><input type="text" name="phone" value="{{ $company->phone }}" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Email</label><input type="email" name="email" value="{{ $company->email }}" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Website</label><input type="text" name="website" value="{{ $company->website }}" class="form-control"></div>
        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
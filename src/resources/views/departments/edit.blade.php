@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Edit Departemen</h2>
    <form method="POST" action="{{ route('departments.update', $department) }}">
        @csrf @method('PUT')
        <div class="mb-3"><label class="form-label">Nama</label><input type="text" name="name" value="{{ $department->name }}" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Kode</label><input type="text" name="code" value="{{ $department->code }}" class="form-control" required></div>
        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
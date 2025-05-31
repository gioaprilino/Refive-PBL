@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Edit Jabatan</h2>
    <form method="POST" action="{{ route('positions.update', $position) }}">
        @csrf @method('PUT')
        <div class="mb-3"><label class="form-label">Nama</label><input type="text" name="name" value="{{ $position->name }}" class="form-control" required></div>
        <div class="mb-3">
            <label class="form-label">Departemen</label>
            <select name="department_id" class="form-control" required>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" @selected($department->id == $position->department_id)>{{ $department->name }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Edit Karyawan</h2>
    <form method="POST" action="{{ route('employees.update', $employee) }}" onsubmit="return validateEmployeeEditForm()">
        @csrf
        @method('PUT')
        <div class="mb-3"><label>Nama</label>
            <input name="name" class="form-control" value="{{ $employee->name }}" required pattern="[A-Za-z\s]+" title="Hanya huruf dan spasi">
        </div>
        <div class="mb-3"><label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $employee->email }}" required>
        </div>
        <div class="mb-3"><label>Telepon</label>
            <input name="phone" class="form-control" value="{{ $employee->phone }}" required pattern="[0-9]{10,15}" title="Masukkan nomor yang valid (10-15 digit)">
        </div>
        <div class="mb-3"><label>Jenis Kelamin</label>
            <select name="gender" class="form-control" required>
                <option value="male" @selected($employee->gender == 'male')>Laki-laki</option>
                <option value="female" @selected($employee->gender == 'female')>Perempuan</option>
            </select>
        </div>
        <div class="mb-3"><label>Alamat</label>
            <textarea name="address" class="form-control">{{ $employee->address }}</textarea>
        </div>
        <div class="mb-3"><label>Departemen</label>
            <select name="department_id" class="form-control">
                @foreach($departments as $d)
                    <option value="{{ $d->id }}" @selected($d->id == $employee->department_id)>{{ $d->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3"><label>Jabatan</label>
            <select name="position_id" class="form-control">
                @foreach($positions as $p)
                    <option value="{{ $p->id }}" @selected($p->id == $employee->position_id)>{{ $p->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3"><label>Tanggal Masuk</label>
            <input type="date" name="hire_date" class="form-control" value="{{ $employee->hire_date }}" id="hire_date">
        </div>
        <div class="mb-3"><label>Status</label>
            <select name="status" class="form-control">
                <option value="active" @selected($employee->status == 'active')>Aktif</option>
                <option value="resigned" @selected($employee->status == 'resigned')>Resign</option>
                <option value="retired" @selected($employee->status == 'retired')>Pensiun</option>
            </select>
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
</div>
<script>
function validateEmployeeEditForm() {
    const phone = document.querySelector('[name=phone]').value;
    const hireDate = document.getElementById('hire_date').value;
    const today = new Date().toISOString().split('T')[0];

    if (!/^\d{10,15}$/.test(phone)) {
        alert("Nomor telepon harus 10-15 digit angka.");
        return false;
    }

    if (hireDate > today) {
        alert("Tanggal masuk tidak boleh di masa depan.");
        return false;
    }

    return true;
}
</script>
@endsection
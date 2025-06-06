@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Absensi</h2>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <form method="POST" action="{{ route('absensi.store') }}" onsubmit="return validateAbsensi()">
    @csrf
    <div class="mb-3">
        <label>Status Kehadiran</label>
        <select name="status" class="form-control" required>
            <option value="">-- Pilih --</option>
            <option value="present">Hadir</option>
            <option value="leave">Izin</option>
            <option value="sick">Sakit</option>
        </select>
    </div>
    <input type="hidden" name="latitude" id="latitude">
    <input type="hidden" name="longitude" id="longitude">
    <input type="hidden" name="radius" value="100">
    <button class="btn btn-success">Catat Absensi</button>
</form>
<script>
function validateAbsensi() {
    const lat = document.getElementById('latitude').value;
    const lng = document.getElementById('longitude').value;
    if (!lat || !lng) {
        alert("Lokasi tidak terdeteksi. Aktifkan GPS Anda.");
        return false;
    }
    return true;
}
</script>
@endsection
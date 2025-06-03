@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Approval Cuti</h2>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <table class="table">
        <thead><tr><th>Nama</th><th>Jenis</th><th>Tanggal</th><th>Alasan</th><th>Aksi</th></tr></thead>
        <tbody>
        @foreach($leaves as $leave)
        <tr>
            <td>{{ $leave->employee->name }}</td>
            <td>{{ $leave->type }}</td>
            <td>{{ $leave->start_date }} - {{ $leave->end_date }}</td>
            <td>{{ $leave->reason }}</td>
            <td>
                <form action="{{ route('leaves.approve', $leave) }}" method="POST" class="d-inline">
                    @csrf @method('PATCH')
                    <button class="btn btn-success btn-sm">Setujui</button>
                </form>
                <form action="{{ route('leaves.reject', $leave) }}" method="POST" class="d-inline">
                    @csrf @method('PATCH')
                    <button class="btn btn-danger btn-sm">Tolak</button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
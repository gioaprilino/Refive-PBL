<?php
@extends('layouts.app')
@section('content')
<h2>Daftar Pelamar untuk: {{ $recruitment->title }}</h2>
<table>
    <tr>
        <th>Nama</th><th>Email</th><th>Status</th><th>Aksi</th>
    </tr>
    @foreach($applicants as $applicant)
    <tr>
        <td>{{ $applicant->name }}</td>
        <td>{{ $applicant->email }}</td>
        <td>{{ $applicant->status }}</td>
        <td>
            <form method="POST" action="{{ route('applicants.update', $applicant->id) }}">
                @csrf @method('PATCH')
                <select name="status">
                    <option value="pending" {{ $applicant->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="accepted" {{ $applicant->status == 'accepted' ? 'selected' : '' }}>Diterima</option>
                    <option value="rejected" {{ $applicant->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    <option value="interview" {{ $applicant->status == 'interview' ? 'selected' : '' }}>Wawancara</option>
                </select>
                <button type="submit">Update</button>
            </form>
            <form method="POST" action="{{ route('applicants.destroy', $applicant->id) }}">
                @csrf @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
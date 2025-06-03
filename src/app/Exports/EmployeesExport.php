<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Employee::with('department', 'position')
            ->where('status', 'active')
            ->get()
            ->map(function ($employee) {
                return [
                    'Nama' => $employee->name,
                    'Email' => $employee->email,
                    'Telepon' => $employee->phone,
                    'Jenis Kelamin' => $employee->gender,
                    'Departemen' => $employee->department->name ?? '',
                    'Jabatan' => $employee->position->name ?? '',
                    'Tanggal Masuk' => $employee->hire_date,
                    'Status' => $employee->status,
                ];
            });
    }

    public function headings(): array
    {
        return ['Nama', 'Email', 'Telepon', 'Jenis Kelamin', 'Departemen', 'Jabatan', 'Tanggal Masuk', 'Status'];
    }
}
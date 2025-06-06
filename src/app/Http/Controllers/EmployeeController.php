<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use App\Exports\EmployeesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
{
    $status = $request->get('status', 'all');

    $query = Employee::with(['department', 'position']);
    if ($status !== 'all') {
        $query->where('status', $status);
    }

    $employees = $query->get();
    return view('employees.index', compact('employees', 'status'));
}

    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();
        return view('employees.create', compact('departments', 'positions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string',
            'email'         => 'required|email|unique:employees',
            'phone'         => 'required|digits_between:10,15',
            'gender'        => 'required|in:male,female',
            'address'       => 'required|string',
            'department_id' => 'required|exists:departments,id',
            'position_id'   => 'required|exists:positions,id',
            'hire_date'     => 'required|date|before_or_equal:today',
            'status'        => 'required|in:active,resigned,retired',
        ]);

        Employee::create($request->all());

        return redirect()->route('employees.index')->with('success', 'Karyawan berhasil ditambahkan.');
    }

    public function edit(Employee $employee)
    {
        $departments = Department::all();
        $positions = Position::all();
        return view('employees.edit', compact('employee', 'departments', 'positions'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name'          => 'required|string',
            'email'         => 'required|email|unique:employees,email,' . $employee->id,
            'phone'         => 'required|digits_between:10,15',
            'gender'        => 'required|in:male,female',
            'address'       => 'required|string',
            'department_id' => 'required|exists:departments,id',
            'position_id'   => 'required|exists:positions,id',
            'hire_date'     => 'required|date|before_or_equal:today',
            'status'        => 'required|in:active,resigned,retired',
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return back()->with('success', 'Karyawan berhasil dihapus.');
    }


    public function export()
    {
        return Excel::download(new EmployeesExport, 'employees.xlsx');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index() {
        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }

    public function create() {
        return view('departments.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:departments'
        ]);

        Department::create($request->all());
        return redirect()->route('departments.index')->with('success', 'Departemen ditambahkan.');
    }

    public function edit(Department $department) {
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department) {
        $department->update($request->all());
        return redirect()->route('departments.index')->with('success', 'Departemen diperbarui.');
    }

    public function destroy(Department $department) {
        $department->delete();
        return back()->with('success', 'Departemen dihapus.');
    }
}

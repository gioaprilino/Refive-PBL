<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;
use App\Models\Department;

class PositionController extends Controller
{
    public function index() {
        $positions = Position::with('department')->get();
        return view('positions.index', compact('positions'));
    }

    public function create() {
        $departments = Department::all();
        return view('positions.create', compact('departments'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'department_id' => 'required|exists:departments,id'
        ]);

        Position::create($request->all());
        return redirect()->route('positions.index')->with('success', 'Jabatan ditambahkan.');
    }

    public function edit(Position $position) {
        $departments = Department::all();
        return view('positions.edit', compact('position', 'departments'));
    }

    public function update(Request $request, Position $position) {
        $position->update($request->all());
        return redirect()->route('positions.index')->with('success', 'Jabatan diperbarui.');
    }

    public function destroy(Position $position) {
        $position->delete();
        return back()->with('success', 'Jabatan dihapus.');
    }
}

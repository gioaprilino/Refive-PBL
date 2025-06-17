<?php

namespace App\Http\Controllers;

use App\Models\Recruitment;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;

class RecruitmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recruitments = Recruitment::with(['department', 'position'])->latest()->get();
        return view('recruitments.index', compact('recruitments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();
        return view('recruitments.create', compact('departments', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'position_id' => 'required|exists:positions,id',
            'description' => 'required|string',
            'status' => 'required|in:open,closed',
        ]);

        Recruitment::create($request->all());

        return redirect()->route('recruitments.index')->with('success', 'Lowongan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $recruitment = Recruitment::findOrFail($id);
        $departments = Department::all();
        $positions = Position::all();
        return view('recruitments.edit', compact('recruitment', 'departments', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'position_id' => 'required|exists:positions,id',
            'description' => 'required|string',
            'status' => 'required|in:open,closed',
        ]);

        $recruitment = Recruitment::findOrFail($id);
        $recruitment->update($request->all());

        return redirect()->route('recruitments.index')->with('success', 'Lowongan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $recruitment = Recruitment::findOrFail($id);
        $recruitment->delete();

        return redirect()->route('recruitments.index')->with('success', 'Lowongan berhasil dihapus.');
    }
}

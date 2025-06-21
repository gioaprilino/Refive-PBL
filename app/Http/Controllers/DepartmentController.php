<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'code' => 'required|unique:departments',
            'name' => 'required',
        ]);
        return Department::create($request->only(['code', 'name']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
        return $department;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        //
        $request->validate([
            'code' => 'required|unique:departments,code,' . $department->id,
            'name' => 'required',
        ]);
        $department->update($request->only(['code', 'name']));
        return $department;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        //
        $department->delete();
        return response()->noContent();
    }
}

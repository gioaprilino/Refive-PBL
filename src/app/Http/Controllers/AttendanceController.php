<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        $records = Attendance::where('employee_id', Auth::id())->get();
        return view('attendances.index', compact('records'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|in:present,leave,sick',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'radius' => 'nullable|numeric',
        ]);

        Attendance::create([
            'employee_id' => Auth::id(), // asumsikan id user == employee_id
            'date' => Carbon::now()->toDateString(),
            'status' => $request->status,
            'clock_in' => Carbon::now()->toTimeString(),
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'radius' => $request->radius,
        ]);

        return back()->with('success', 'Absensi dicatat.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index()
    {
        $leaves = Leave::with('employee')->where('status', 'pending')->get();
        return view('leaves.index', compact('leaves'));
    }

    public function approve(Leave $leave)
    {
        $leave->update(['status' => 'approved']);
        return back()->with('success', 'Cuti disetujui.');
    }

    public function reject(Leave $leave)
    {
        $leave->update(['status' => 'rejected']);
        return back()->with('success', 'Cuti ditolak.');
    }
}
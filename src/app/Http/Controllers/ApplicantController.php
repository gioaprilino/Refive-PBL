<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Recruitment;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($recruitmentId)
    {
        $recruitment = Recruitment::findOrFail($recruitmentId);
        $applicants = $recruitment->applicants()->get();
        return view('applicants.index', compact('recruitment', 'applicants'));
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
    public function store(Request $request, $recruitmentId)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'resume' => 'required|file',
        ]);

        $resumePath = $request->file('resume')->store('resumes', 'public');

        Applicant::create([
            'recruitment_id' => $recruitmentId,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'resume' => $resumePath,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Lamaran berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,accepted,rejected,interview',
        ]);

        $applicant = Applicant::findOrFail($id);
        $applicant->status = $request->status;
        $applicant->save();

        return redirect()->back()->with('success', 'Status pelamar diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $applicant = Applicant::findOrFail($id);
        $applicant->delete();

        return redirect()->back()->with('success', 'Data pelamar dihapus.');
    }
}

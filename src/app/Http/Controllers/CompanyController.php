<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index() {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    public function create() {
        return view('companies.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ]);

        Company::create($request->all());
        return redirect()->route('companies.index')->with('success', 'Profil perusahaan ditambahkan.');
    }

    public function edit(Company $company) {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company) {
        $company->update($request->all());
        return redirect()->route('companies.index')->with('success', 'Profil perusahaan diperbarui.');
    }

    public function destroy(Company $company) {
        $company->delete();
        return back()->with('success', 'Profil perusahaan dihapus.');
    }
}

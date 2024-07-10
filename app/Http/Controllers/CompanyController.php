<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('companies.index', [
            'companies' => auth()->user()->companies()->latest()->get()
        ]);
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:companies',
            'salary' => 'required|numeric',
            'full_time_in_hours' => 'required|numeric',
        ]);

        $validated['salary_per_hour'] = $validated['salary'] / $validated['full_time_in_hours'];
        auth()->user()->companies()->create($validated);

        return redirect()->route('companies.index');
    }

    public function show(Company $company)
    {
        //
    }

    public function edit(Company $company)
    {
        //
    }

    public function update(Request $request, Company $company)
    {
        //
    }

    public function destroy(Company $company)
    {
        //
    }

    public function showAll(){
        return response()->json([
            'data' =>  auth()->user()->companies()->get(['id', 'name'])
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmploymentStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = \App\Models\EmploymentStatus::all();
        return view('master.employment_statuses.index', compact('statuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        \App\Models\EmploymentStatus::create($request->all());
        return redirect()->route('master.employment-statuses.index')->with('success', 'Employment Status created successfully.');
    }

    public function update(Request $request, $id)
    {
        $status = \App\Models\EmploymentStatus::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $status->update($request->all());
        return redirect()->route('master.employment-statuses.index')->with('success', 'Employment Status updated successfully.');
    }

    public function destroy($id)
    {
        $status = \App\Models\EmploymentStatus::findOrFail($id);
        $status->delete();
        return redirect()->route('master.employment-statuses.index')->with('success', 'Employment Status deleted successfully.');
    }
}

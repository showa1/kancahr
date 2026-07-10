<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = \App\Models\Department::all();
        return view('master.departments.index', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:departments'
        ]);

        \App\Models\Department::create($request->all());
        return redirect()->route('master.departments.index')->with('success', 'Department created successfully.');
    }

    public function update(Request $request, $id)
    {
        $department = \App\Models\Department::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:departments,code,' . $department->id
        ]);

        $department->update($request->all());
        return redirect()->route('master.departments.index')->with('success', 'Department updated successfully.');
    }

    public function destroy($id)
    {
        $department = \App\Models\Department::findOrFail($id);
        $department->delete();
        return redirect()->route('master.departments.index')->with('success', 'Department deleted successfully.');
    }
}

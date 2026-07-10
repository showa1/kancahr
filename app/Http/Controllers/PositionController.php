<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = \App\Models\Position::with('department')->get();
        $departments = \App\Models\Department::all();
        return view('master.positions.index', compact('positions', 'departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'department_id' => 'nullable|exists:departments,id'
        ]);

        \App\Models\Position::create($request->all());
        return redirect()->route('master.positions.index')->with('success', 'Position created successfully.');
    }

    public function update(Request $request, $id)
    {
        $position = \App\Models\Position::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'department_id' => 'nullable|exists:departments,id'
        ]);

        $position->update($request->all());
        return redirect()->route('master.positions.index')->with('success', 'Position updated successfully.');
    }

    public function destroy($id)
    {
        $position = \App\Models\Position::findOrFail($id);
        $position->delete();
        return redirect()->route('master.positions.index')->with('success', 'Position deleted successfully.');
    }
}

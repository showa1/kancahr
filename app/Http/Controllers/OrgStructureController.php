<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrgStructure;
use App\Models\User;
use App\Models\Department;
use App\Models\Position;

class OrgStructureController extends Controller
{
    public function index()
    {
        $structures = OrgStructure::with(['user', 'department', 'position', 'reportsTo.user'])
            ->orderBy('sort_order')
            ->orderBy('department_id')
            ->get();

        $users       = User::where('role', 'employee')->orWhere('role', 'admin')->get();
        $departments = Department::all();
        $positions   = Position::all();

        return view('master.org_structures.index', compact('structures', 'users', 'departments', 'positions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sk_number'    => 'nullable|string|max:100',
            'user_id'      => 'nullable|exists:users,id',
            'department_id'=> 'nullable|exists:departments,id',
            'position_id'  => 'nullable|exists:positions,id',
            'reports_to_id'=> 'nullable|exists:org_structures,id',
            'acting_role'  => 'nullable|string|max:255',
            'formation'    => 'required|integer|min:1',
            'sort_order'   => 'required|integer|min:1',
            'period_start' => 'nullable|date',
            'period_end'   => 'nullable|date|after_or_equal:period_start',
            'status'       => 'required|in:aktif,nonaktif',
        ]);

        OrgStructure::create($request->all());
        return redirect()->route('master.org-structures.index')->with('success', 'Struktur organisasi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $structure = OrgStructure::findOrFail($id);

        $request->validate([
            'sk_number'    => 'nullable|string|max:100',
            'user_id'      => 'nullable|exists:users,id',
            'department_id'=> 'nullable|exists:departments,id',
            'position_id'  => 'nullable|exists:positions,id',
            'reports_to_id'=> 'nullable|exists:org_structures,id',
            'acting_role'  => 'nullable|string|max:255',
            'formation'    => 'required|integer|min:1',
            'sort_order'   => 'required|integer|min:1',
            'period_start' => 'nullable|date',
            'period_end'   => 'nullable|date|after_or_equal:period_start',
            'status'       => 'required|in:aktif,nonaktif',
        ]);

        $structure->update($request->all());
        return redirect()->route('master.org-structures.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $structure = OrgStructure::findOrFail($id);
        $structure->delete();
        return redirect()->route('master.org-structures.index')->with('success', 'Data berhasil dihapus.');
    }
}

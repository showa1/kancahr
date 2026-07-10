<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttendanceType;

class AttendanceTypeController extends Controller
{
    public function index()
    {
        $types   = AttendanceType::orderBy('code')->get();
        $devices = \App\Models\AttendanceDevice::orderBy('name')->get();
        return view('master.attendance.index', compact('types', 'devices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code'                   => 'required|string|max:20|unique:attendance_types,code',
            'name'                   => 'required|string|max:100',
            'machine_status_code'    => 'nullable|integer|min:0',
            'color'                  => 'required|in:emerald,yellow,red,blue,purple,gray,orange',
            'affects_payroll'        => 'nullable|boolean',
            'late_tolerance_minutes' => 'nullable|integer|min:0|max:120',
            'description'            => 'nullable|string|max:500',
            'is_active'              => 'nullable|boolean',
        ]);

        AttendanceType::create([
            'code'                   => strtoupper($request->code),
            'name'                   => $request->name,
            'machine_status_code'    => $request->machine_status_code,
            'color'                  => $request->color,
            'affects_payroll'        => $request->boolean('affects_payroll'),
            'late_tolerance_minutes' => $request->late_tolerance_minutes ?? 0,
            'description'            => $request->description,
            'is_active'              => $request->boolean('is_active', true),
        ]);

        return redirect()->route('master.attendance.index', ['tab' => 'types'])
            ->with('success', 'Jenis kehadiran berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $type = AttendanceType::findOrFail($id);

        $request->validate([
            'code'                   => 'required|string|max:20|unique:attendance_types,code,' . $type->id,
            'name'                   => 'required|string|max:100',
            'machine_status_code'    => 'nullable|integer|min:0',
            'color'                  => 'required|in:emerald,yellow,red,blue,purple,gray,orange',
            'affects_payroll'        => 'nullable|boolean',
            'late_tolerance_minutes' => 'nullable|integer|min:0|max:120',
            'description'            => 'nullable|string|max:500',
            'is_active'              => 'nullable|boolean',
        ]);

        $type->update([
            'code'                   => strtoupper($request->code),
            'name'                   => $request->name,
            'machine_status_code'    => $request->machine_status_code,
            'color'                  => $request->color,
            'affects_payroll'        => $request->boolean('affects_payroll'),
            'late_tolerance_minutes' => $request->late_tolerance_minutes ?? 0,
            'description'            => $request->description,
            'is_active'              => $request->boolean('is_active', true),
        ]);

        return redirect()->route('master.attendance.index', ['tab' => 'types'])
            ->with('success', 'Jenis kehadiran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        AttendanceType::findOrFail($id)->delete();
        return redirect()->route('master.attendance.index', ['tab' => 'types'])
            ->with('success', 'Jenis kehadiran berhasil dihapus.');
    }
}

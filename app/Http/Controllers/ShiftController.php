<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;

class ShiftController extends Controller
{
    public function index()
    {
        $shifts = Shift::orderBy('status')->orderBy('start_time')->get();
        return view('master.shifts.index', compact('shifts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:100',
            'code'           => 'required|string|max:50|unique:shifts',
            'alias'          => 'nullable|string|max:100',
            'start_time'     => 'required|date_format:H:i',
            'end_time'       => 'required|date_format:H:i',
            'cross_midnight' => 'nullable|boolean',
            'status'         => 'required|in:aktif,nonaktif',
        ]);

        Shift::create([
            'name'           => $request->name,
            'code'           => $request->code,
            'alias'          => $request->alias,
            'start_time'     => $request->start_time . ':00',
            'end_time'       => $request->end_time . ':00',
            'cross_midnight' => $request->boolean('cross_midnight'),
            'status'         => $request->status,
        ]);

        return redirect()->route('master.shifts.index')->with('success', 'Shift berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $shift = Shift::findOrFail($id);

        $request->validate([
            'name'           => 'required|string|max:100',
            'code'           => 'required|string|max:50|unique:shifts,code,' . $shift->id,
            'alias'          => 'nullable|string|max:100',
            'start_time'     => 'required|date_format:H:i',
            'end_time'       => 'required|date_format:H:i',
            'cross_midnight' => 'nullable|boolean',
            'status'         => 'required|in:aktif,nonaktif',
        ]);

        $shift->update([
            'name'           => $request->name,
            'code'           => $request->code,
            'alias'          => $request->alias,
            'start_time'     => $request->start_time . ':00',
            'end_time'       => $request->end_time . ':00',
            'cross_midnight' => $request->boolean('cross_midnight'),
            'status'         => $request->status,
        ]);

        return redirect()->route('master.shifts.index')->with('success', 'Data shift berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Shift::findOrFail($id)->delete();
        return redirect()->route('master.shifts.index')->with('success', 'Shift berhasil dihapus.');
    }
}

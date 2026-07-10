<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttendanceDevice;
use Illuminate\Support\Str;

class AttendanceDeviceController extends Controller
{
    public function index()
    {
        // Redirect ke halaman utama attendance dengan tab devices
        return redirect()->route('master.attendance.index', ['tab' => 'devices']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'                 => 'required|string|max:100',
            'serial_number'        => 'nullable|string|max:100|unique:attendance_devices,serial_number',
            'brand'                => 'nullable|string|max:50',
            'model_name'           => 'nullable|string|max:50',
            'ip_address'           => 'nullable|ip',
            'location'             => 'nullable|string|max:100',
            'integration_method'   => 'required|in:adms,sdk',
            'notes'                => 'nullable|string|max:500',
            'is_active'            => 'nullable|boolean',
        ]);

        $data = $request->only([
            'name', 'serial_number', 'brand', 'model_name',
            'ip_address', 'location', 'integration_method', 'notes',
        ]);
        $data['is_active']    = $request->boolean('is_active', true);

        // Generate ADMS token otomatis untuk metode ADMS
        if ($request->integration_method === 'adms') {
            $data['adms_token'] = Str::random(40);
        }

        AttendanceDevice::create($data);

        return redirect()->route('master.attendance.index', ['tab' => 'devices'])
            ->with('success', 'Mesin absensi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $device = AttendanceDevice::findOrFail($id);

        $request->validate([
            'name'               => 'required|string|max:100',
            'serial_number'      => 'nullable|string|max:100|unique:attendance_devices,serial_number,' . $device->id,
            'brand'              => 'nullable|string|max:50',
            'model_name'         => 'nullable|string|max:50',
            'ip_address'         => 'nullable|ip',
            'location'           => 'nullable|string|max:100',
            'integration_method' => 'required|in:adms,sdk',
            'notes'              => 'nullable|string|max:500',
            'is_active'          => 'nullable|boolean',
        ]);

        $data = $request->only([
            'name', 'serial_number', 'brand', 'model_name',
            'ip_address', 'location', 'integration_method', 'notes',
        ]);
        $data['is_active'] = $request->boolean('is_active', true);

        // Generate token baru jika metode berubah ke ADMS dan belum ada token
        if ($request->integration_method === 'adms' && empty($device->adms_token)) {
            $data['adms_token'] = Str::random(40);
        }

        $device->update($data);

        return redirect()->route('master.attendance.index', ['tab' => 'devices'])
            ->with('success', 'Data mesin absensi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        AttendanceDevice::findOrFail($id)->delete();
        return redirect()->route('master.attendance.index', ['tab' => 'devices'])
            ->with('success', 'Mesin absensi berhasil dihapus.');
    }
}

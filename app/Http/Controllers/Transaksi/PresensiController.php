<?php
namespace App\Http\Controllers\Transaksi;
use App\Http\Controllers\Controller;
use App\Models\AttendanceType;
use App\Models\AttendanceDevice;

class PresensiController extends Controller
{
    public function index()
    {
        $attendanceTypes  = AttendanceType::where('is_active', true)->orderBy('name')->get();
        $allTypes         = AttendanceType::orderBy('name')->get();
        $devices          = AttendanceDevice::where('is_active', true)->get();
        $totalDevices     = AttendanceDevice::count();

        return view('transaksi.presensi.index', compact(
            'attendanceTypes', 'allTypes', 'devices', 'totalDevices'
        ));
    }
}

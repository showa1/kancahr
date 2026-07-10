<?php
namespace App\Http\Controllers\Transaksi;
use App\Http\Controllers\Controller;
use App\Models\AttendanceDevice;
use App\Models\AttendanceType;

class RegistrasiPerangkatController extends Controller
{
    public function index()
    {
        $devices      = AttendanceDevice::orderBy('name')->get();
        $activeTypes  = AttendanceType::where('is_active', true)->count();
        $admsCount    = AttendanceDevice::where('integration_method', 'adms')->count();
        $sdkCount     = AttendanceDevice::where('integration_method', 'sdk')->count();

        return view('transaksi.registrasi-perangkat.index', compact(
            'devices', 'activeTypes', 'admsCount', 'sdkCount'
        ));
    }
}

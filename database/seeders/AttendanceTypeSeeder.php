<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AttendanceType;

class AttendanceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'code'                   => 'HADIR',
                'name'                   => 'Hadir',
                'machine_status_code'    => 0,
                'color'                  => 'emerald',
                'affects_payroll'        => false,
                'late_tolerance_minutes' => 0,
                'is_active'              => true,
                'description'            => 'Karyawan hadir tepat waktu. Kode mesin: 0 (verifikasi sukses).',
            ],
            [
                'code'                   => 'TERLAMBAT',
                'name'                   => 'Terlambat',
                'machine_status_code'    => 1,
                'color'                  => 'yellow',
                'affects_payroll'        => true,
                'late_tolerance_minutes' => 15,
                'is_active'              => true,
                'description'            => 'Karyawan hadir melebihi toleransi keterlambatan. Berpotensi memotong komponen gaji.',
            ],
            [
                'code'                   => 'ALPA',
                'name'                   => 'Alpa (Absen Tanpa Keterangan)',
                'machine_status_code'    => null,
                'color'                  => 'red',
                'affects_payroll'        => true,
                'late_tolerance_minutes' => 0,
                'is_active'              => true,
                'description'            => 'Tidak ada log dari mesin hingga akhir shift. Sistem otomatis menetapkan status ini.',
            ],
            [
                'code'                   => 'IZIN',
                'name'                   => 'Izin',
                'machine_status_code'    => null,
                'color'                  => 'blue',
                'affects_payroll'        => false,
                'late_tolerance_minutes' => 0,
                'is_active'              => true,
                'description'            => 'Karyawan tidak hadir dengan keterangan izin yang disetujui HR.',
            ],
            [
                'code'                   => 'SAKIT',
                'name'                   => 'Sakit',
                'machine_status_code'    => null,
                'color'                  => 'orange',
                'affects_payroll'        => false,
                'late_tolerance_minutes' => 0,
                'is_active'              => true,
                'description'            => 'Karyawan tidak hadir karena sakit dengan surat keterangan dokter.',
            ],
            [
                'code'                   => 'LEMBUR',
                'name'                   => 'Lembur',
                'machine_status_code'    => 4,
                'color'                  => 'purple',
                'affects_payroll'        => true,
                'late_tolerance_minutes' => 0,
                'is_active'              => true,
                'description'            => 'Log di luar jam shift yang telah disetujui sebagai jam lembur.',
            ],
        ];

        foreach ($types as $type) {
            AttendanceType::firstOrCreate(['code' => $type['code']], $type);
        }
    }
}

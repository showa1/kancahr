<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Onboarding Routes
    Route::get('/onboarding', [\App\Http\Controllers\OnboardingController::class, 'index'])->name('onboarding.index');
    Route::post('/onboarding/employee', [\App\Http\Controllers\OnboardingController::class, 'storeEmployee'])->name('onboarding.employee.store');
    Route::post('/onboarding/template', [\App\Http\Controllers\OnboardingController::class, 'storeTemplate'])->name('onboarding.template.store');
    Route::patch('/onboarding/{id}/status', [\App\Http\Controllers\OnboardingController::class, 'updateStatus'])->name('onboarding.status.update');
    // Master Data Routes
    Route::prefix('master')->name('master.')->group(function () {
        Route::resource('departments', \App\Http\Controllers\DepartmentController::class)->except(['create', 'show', 'edit']);
        Route::resource('positions', \App\Http\Controllers\PositionController::class)->except(['create', 'show', 'edit']);
        Route::resource('employment-statuses', \App\Http\Controllers\EmploymentStatusController::class)->except(['create', 'show', 'edit']);
        Route::resource('org-structures', \App\Http\Controllers\OrgStructureController::class)->except(['create', 'show', 'edit']);
        Route::resource('shifts', \App\Http\Controllers\ShiftController::class)->except(['create', 'show', 'edit']);

        // Master Presensi — index route (gabungan 2 tab)
        Route::get('attendance', [\App\Http\Controllers\AttendanceTypeController::class, 'index'])->name('attendance.index');
        // Jenis Kehadiran CRUD
        Route::resource('attendance-types', \App\Http\Controllers\AttendanceTypeController::class)->except(['index', 'create', 'show', 'edit']);
        // Integrasi Mesin CRUD
        Route::resource('attendance-devices', \App\Http\Controllers\AttendanceDeviceController::class)->except(['index', 'create', 'show', 'edit']);
    });

    // ===== TRANSAKSI ROUTES =====
    Route::prefix('transaksi')->name('transaksi.')->group(function () {
        // Karyawan
        Route::get('jadwal',    [\App\Http\Controllers\Transaksi\JadwalKerjaController::class,       'index'])->name('jadwal.index');
        Route::get('karyawan',         [\App\Http\Controllers\Transaksi\DataKaryawanController::class, 'index'])->name('karyawan.index');
        Route::get('karyawan/tambah',   [\App\Http\Controllers\Transaksi\DataKaryawanController::class, 'create'])->name('karyawan.create');
        Route::post('karyawan',         [\App\Http\Controllers\Transaksi\DataKaryawanController::class, 'store'])->name('karyawan.store');
        Route::get('riwayat',   [\App\Http\Controllers\Transaksi\RiwayatKaryawanController::class,   'index'])->name('riwayat.index');
        // Rekrutmen
        Route::get('rekrutmen',          [\App\Http\Controllers\Transaksi\RekrutmenController::class,         'index'])->name('rekrutmen.index');
        Route::get('rencana-rekrutmen',  [\App\Http\Controllers\Transaksi\RencanaRekrutmenController::class,  'index'])->name('rencana-rekrutmen.index');
        // Presensi (terintegrasi dengan Master Presensi)
        Route::get('registrasi-perangkat', [\App\Http\Controllers\Transaksi\RegistrasiPerangkatController::class, 'index'])->name('registrasi-perangkat.index');
        Route::get('presensi',             [\App\Http\Controllers\Transaksi\PresensiController::class,            'index'])->name('presensi.index');
        // Pelatihan
        Route::get('rencana-pelatihan',   [\App\Http\Controllers\Transaksi\RencanaPelatihanController::class,  'index'])->name('rencana-pelatihan.index');
        Route::get('realisasi-pelatihan', [\App\Http\Controllers\Transaksi\RealisasiPelatihanController::class,'index'])->name('realisasi-pelatihan.index');
        // Kinerja & Karier
        Route::get('penilaian', [\App\Http\Controllers\Transaksi\PenilaianKinerjaController::class, 'index'])->name('penilaian.index');
        Route::get('mutasi',    [\App\Http\Controllers\Transaksi\MutasiJabatanController::class,    'index'])->name('mutasi.index');
        Route::get('promosi',   [\App\Http\Controllers\Transaksi\PromosiKaryawanController::class,  'index'])->name('promosi.index');
    });
});

require __DIR__.'/auth.php';

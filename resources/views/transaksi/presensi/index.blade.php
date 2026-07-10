<x-app-layout>
    <div class="space-y-6">
        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">TRANSAKSI</p>
                <h1 class="text-2xl font-bold text-gray-800">Presensi Karyawan</h1>
                <p class="text-sm text-gray-500 mt-1">Log kehadiran harian terintegrasi dengan Master Presensi & mesin absensi.</p>
            </div>
            <div class="flex items-center gap-3">
                {{-- Filter tanggal --}}
                <div class="flex items-center gap-2 bg-white border border-gray-200 rounded-xl px-3 py-2 text-sm text-gray-600 shadow-sm">
                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span>{{ now()->format('d F Y') }}</span>
                </div>
                <button class="inline-flex items-center gap-2 text-sm font-semibold text-white px-4 py-2 rounded-xl shadow-sm transition" style="background: linear-gradient(135deg, #10b981, #059669);">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Export
                </button>
            </div>
        </div>

        {{-- Stats berdasarkan AttendanceType dari Master --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($attendanceTypes->take(4) as $type)
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">{{ $type->code }}</span>
                    <span class="w-3 h-3 rounded-full" style="background-color: {{ $type->getColorHex() }};"></span>
                </div>
                <p class="text-3xl font-bold text-gray-800">0</p>
                <p class="text-sm text-gray-500 mt-1">{{ $type->name }}</p>
            </div>
            @endforeach
        </div>

        {{-- Info Integrasi Master --}}
        <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-4 flex items-start gap-3">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0" style="background-color:#d1fae5">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-emerald-800">Terintegrasi dengan Master Presensi</p>
                <p class="text-xs text-emerald-600 mt-0.5">
                    {{ $allTypes->count() }} jenis kehadiran aktif &bull;
                    {{ $totalDevices }} mesin terdaftar &bull;
                    Status kehadiran mengikuti konfigurasi di
                    <a href="{{ route('master.attendance.index') }}" class="font-semibold underline hover:text-emerald-800">Master Presensi</a>
                </p>
            </div>
        </div>

        {{-- Legenda Jenis Kehadiran dari Master --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <h3 class="text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                Legenda Status (dari Master Presensi)
            </h3>
            <div class="flex flex-wrap gap-2">
                @foreach($allTypes as $type)
                <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-full border"
                      style="color:{{ $type->getColorHex() }}; border-color:{{ $type->getColorHex() }}20; background-color:{{ $type->getColorHex() }}12;">
                    <span class="w-2 h-2 rounded-full" style="background-color:{{ $type->getColorHex() }};"></span>
                    {{ $type->code }} — {{ $type->name }}
                </span>
                @endforeach
            </div>
        </div>

        {{-- Tabel Log Presensi --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="font-bold text-gray-800">Log Kehadiran Hari Ini</h3>
                <div class="flex items-center gap-2">
                    <div class="relative">
                        <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <input type="text" placeholder="Cari karyawan..." class="pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-300 focus:border-emerald-400">
                    </div>
                </div>
            </div>
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-3 text-left">Karyawan</th>
                        <th class="px-6 py-3 text-left">Departemen</th>
                        <th class="px-6 py-3 text-left">Jam Masuk</th>
                        <th class="px-6 py-3 text-left">Jam Keluar</th>
                        <th class="px-6 py-3 text-left">Mesin</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-16 h-16 rounded-2xl flex items-center justify-center" style="background-color:#f0fdf4;">
                                    <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-600">Belum ada data presensi hari ini</p>
                                    <p class="text-sm text-gray-400 mt-1">Data akan muncul otomatis dari mesin absensi yang terdaftar di
                                        <a href="{{ route('master.attendance.index') }}" class="text-emerald-600 font-medium underline">Master Presensi</a>
                                    </p>
                                </div>
                                @if($devices->isEmpty())
                                <a href="{{ route('master.attendance.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-white px-4 py-2 rounded-xl" style="background:linear-gradient(135deg,#10b981,#059669);">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    Daftarkan Mesin di Master Presensi
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Mesin Aktif --}}
        @if($devices->isNotEmpty())
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <h3 class="text-sm font-bold text-gray-700 mb-3">Mesin Absensi Aktif</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                @foreach($devices as $device)
                <div class="rounded-xl border p-3 flex items-center gap-3" style="border-color:#d1fae5; background-color:#f0fdf4;">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background-color:#d1fae5;">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-700">{{ $device->name }}</p>
                        <p class="text-xs text-gray-400">{{ strtoupper($device->integration_method) }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</x-app-layout>

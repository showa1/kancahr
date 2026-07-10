<x-app-layout>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">TRANSAKSI › PRESENSI</p>
                <h1 class="text-2xl font-bold text-gray-800">Registrasi Perangkat</h1>
                <p class="text-sm text-gray-500 mt-1">Pemetaan mesin absensi yang telah dikonfigurasi di Master Presensi.</p>
            </div>
            <a href="{{ route('master.attendance.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-white px-4 py-2 rounded-xl shadow-sm" style="background:linear-gradient(135deg,#8b5cf6,#7c3aed);">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Kelola di Master Presensi
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Total Mesin</p>
                <p class="text-3xl font-bold text-gray-800">{{ $devices->count() }}</p>
                <p class="text-sm text-gray-400 mt-1">terdaftar</p>
            </div>
            <div class="bg-emerald-50 rounded-2xl p-5 border border-emerald-100 shadow-sm">
                <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wider mb-2">Mesin Aktif</p>
                <p class="text-3xl font-bold text-emerald-600">{{ $devices->where('is_active', true)->count() }}</p>
                <p class="text-sm text-emerald-400 mt-1">online</p>
            </div>
            <div class="bg-violet-50 rounded-2xl p-5 border border-violet-100 shadow-sm">
                <p class="text-xs font-semibold text-violet-600 uppercase tracking-wider mb-2">Metode ADMS</p>
                <p class="text-3xl font-bold text-violet-600">{{ $admsCount }}</p>
                <p class="text-sm text-violet-400 mt-1">real-time push</p>
            </div>
            <div class="bg-blue-50 rounded-2xl p-5 border border-blue-100 shadow-sm">
                <p class="text-xs font-semibold text-blue-600 uppercase tracking-wider mb-2">Metode SDK</p>
                <p class="text-3xl font-bold text-blue-600">{{ $sdkCount }}</p>
                <p class="text-sm text-blue-400 mt-1">pull terjadwal</p>
            </div>
        </div>

        <div class="bg-violet-50 border border-violet-100 rounded-2xl p-4 flex items-start gap-3">
            <svg class="w-5 h-5 text-violet-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <p class="text-sm text-violet-700">
                Data perangkat dikelola di <a href="{{ route('master.attendance.index') }}" class="font-bold underline hover:text-violet-900">Master Presensi → Tab Integrasi Mesin</a>.
                Halaman ini menampilkan ringkasan perangkat yang sudah terdaftar.
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-800">Daftar Perangkat Terdaftar</h3>
            </div>
            @if($devices->isEmpty())
            <div class="py-16 text-center">
                <div class="w-16 h-16 rounded-2xl mx-auto mb-4 flex items-center justify-center" style="background:#f0fdf4;">
                    <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path></svg>
                </div>
                <p class="font-semibold text-gray-600">Belum ada mesin terdaftar</p>
                <p class="text-sm text-gray-400 mt-1">Tambahkan mesin melalui Master Presensi</p>
                <a href="{{ route('master.attendance.index') }}" class="inline-flex items-center gap-2 mt-4 text-sm font-semibold text-white px-4 py-2 rounded-xl" style="background:linear-gradient(135deg,#10b981,#059669);">
                    Tambah Mesin
                </a>
            </div>
            @else
            <table class="w-full">
                <thead class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left">Nama Mesin</th>
                        <th class="px-6 py-3 text-left">Serial Number</th>
                        <th class="px-6 py-3 text-left">Lokasi</th>
                        <th class="px-6 py-3 text-left">Metode</th>
                        <th class="px-6 py-3 text-left">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($devices as $device)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 font-semibold text-gray-800">{{ $device->name }}</td>
                        <td class="px-6 py-4 text-gray-500 text-sm font-mono">{{ $device->serial_number ?? '—' }}</td>
                        <td class="px-6 py-4 text-gray-500 text-sm">{{ $device->location ?? '—' }}</td>
                        <td class="px-6 py-4">
                            <span class="text-xs font-bold px-2.5 py-1 rounded-full {{ $device->integration_method === 'adms' ? 'bg-violet-100 text-violet-700' : 'bg-blue-100 text-blue-700' }}">
                                {{ strtoupper($device->integration_method) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1 text-xs font-semibold {{ $device->is_active ? 'text-emerald-700 bg-emerald-50' : 'text-gray-400 bg-gray-100' }} px-2.5 py-1 rounded-full">
                                <span class="w-1.5 h-1.5 rounded-full {{ $device->is_active ? 'bg-emerald-500 animate-pulse' : 'bg-gray-300' }}"></span>
                                {{ $device->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</x-app-layout>

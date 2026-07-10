<x-app-layout>
<div class="space-y-6" x-data="{
    activeTab: '{{ request('tab', 'types') }}',

    /* ===== JENIS KEHADIRAN ===== */
    showCreateTypeModal: false,
    showEditTypeModal: false,
    editType: { id:'', code:'', name:'', machine_status_code:'', color:'emerald', affects_payroll:false, late_tolerance_minutes:0, description:'', is_active:true },
    openEditType(row) {
        this.editType = {
            id: row.id,
            code: row.code,
            name: row.name,
            machine_status_code: row.machine_status_code ?? '',
            color: row.color,
            affects_payroll: row.affects_payroll,
            late_tolerance_minutes: row.late_tolerance_minutes,
            description: row.description ?? '',
            is_active: row.is_active
        };
        this.showEditTypeModal = true;
    },

    /* ===== MESIN ABSENSI ===== */
    showCreateDeviceModal: false,
    showEditDeviceModal: false,
    showTokenModal: false,
    tokenValue: '',
    editDevice: { id:'', name:'', serial_number:'', brand:'', model_name:'', ip_address:'', location:'', integration_method:'adms', notes:'', is_active:true },
    openEditDevice(row) {
        this.editDevice = {
            id: row.id,
            name: row.name,
            serial_number: row.serial_number ?? '',
            brand: row.brand ?? '',
            model_name: row.model_name ?? '',
            ip_address: row.ip_address ?? '',
            location: row.location ?? '',
            integration_method: row.integration_method,
            notes: row.notes ?? '',
            is_active: row.is_active
        };
        this.showEditDeviceModal = true;
    },
    showToken(token) {
        this.tokenValue = token;
        this.showTokenModal = true;
    },
    copyToken() {
        navigator.clipboard.writeText(this.tokenValue);
    },

    searchType: '',
    searchDevice: ''
}">

    {{-- ===== HEADER ===== --}}
    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
        <div>
            <p class="text-xs text-gray-400 font-medium uppercase tracking-widest">Data Master</p>
            <h2 class="text-2xl font-bold text-gray-800 mt-1">Master Presensi</h2>
            <p class="text-gray-500 text-sm mt-1">Konfigurasi jenis kehadiran dan integrasi mesin fingerprint / face ID.</p>
        </div>
        <div class="flex items-center gap-2 flex-wrap">
            {{-- Badge enterprise --}}
            <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-white px-3 py-1.5 rounded-full shadow-sm" style="background: linear-gradient(to right, #8b5cf6, #7c3aed);">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                Enterprise Ready
            </span>
            <button
                x-show="activeTab === 'types'"
                @click="showCreateTypeModal = true"
                class="bg-emerald-500 hover:bg-emerald-600 text-white font-medium py-2.5 px-5 rounded-xl shadow-sm transition-colors flex items-center gap-2 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Jenis
            </button>
            <button
                x-show="activeTab === 'devices'"
                @click="showCreateDeviceModal = true"
                class="bg-emerald-500 hover:bg-emerald-600 text-white font-medium py-2.5 px-5 rounded-xl shadow-sm transition-colors flex items-center gap-2 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Mesin
            </button>
        </div>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
    <div class="flex items-center gap-3 p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700 text-sm">
        <svg class="w-5 h-5 shrink-0 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- ===== TABS ===== --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_2px_15px_-4px_rgba(0,0,0,0.07)]">
        <div class="flex border-b border-gray-100 px-6 pt-4 gap-2">
            <button
                @click="activeTab = 'types'"
                :class="activeTab === 'types'
                    ? 'border-b-2 border-emerald-500 text-emerald-600 font-semibold'
                    : 'text-gray-400 hover:text-gray-600'"
                class="flex items-center gap-2 pb-3 px-2 text-sm transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                Jenis Kehadiran
                <span :class="activeTab === 'types' ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-500'" class="text-xs font-bold px-2 py-0.5 rounded-full">{{ $types->count() }}</span>
            </button>
            <button
                @click="activeTab = 'devices'"
                :class="activeTab === 'devices'
                    ? 'border-b-2 border-emerald-500 text-emerald-600 font-semibold'
                    : 'text-gray-400 hover:text-gray-600'"
                class="flex items-center gap-2 pb-3 px-2 text-sm transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                Integrasi Mesin
                <span :class="activeTab === 'devices' ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-500'" class="text-xs font-bold px-2 py-0.5 rounded-full">{{ $devices->count() }}</span>
            </button>
        </div>

        {{-- ==================== TAB 1: JENIS KEHADIRAN ==================== --}}
        <div x-show="activeTab === 'types'" x-transition class="p-6 space-y-5">

            {{-- Stats Cards --}}
            @php
                $totalTypes   = $types->count();
                $activeTypes  = $types->where('is_active', true)->count();
                $payrollTypes = $types->where('affects_payroll', true)->count();
                $tolTypes     = $types->where('late_tolerance_minutes', '>', 0)->count();
            @endphp
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                    <p class="text-xs text-gray-400 font-medium">Total Jenis</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">{{ $totalTypes }}</p>
                    <p class="text-xs text-gray-400 mt-1">terdaftar</p>
                </div>
                <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-100">
                    <p class="text-xs text-emerald-600 font-medium">Aktif</p>
                    <p class="text-2xl font-bold text-emerald-600 mt-1">{{ $activeTypes }}</p>
                    <p class="text-xs text-emerald-400 mt-1">digunakan</p>
                </div>
                <div class="bg-red-50 rounded-xl p-4 border border-red-100">
                    <p class="text-xs text-red-600 font-medium">Pengaruhi Gaji</p>
                    <p class="text-2xl font-bold text-red-600 mt-1">{{ $payrollTypes }}</p>
                    <p class="text-xs text-red-400 mt-1">jenis</p>
                </div>
                <div class="bg-yellow-50 rounded-xl p-4 border border-yellow-100">
                    <p class="text-xs text-yellow-600 font-medium">Ada Toleransi</p>
                    <p class="text-2xl font-bold text-yellow-600 mt-1">{{ $tolTypes }}</p>
                    <p class="text-xs text-yellow-400 mt-1">jenis</p>
                </div>
            </div>

            {{-- Search --}}
            <div class="relative max-w-xs">
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input x-model="searchType" type="text" placeholder="Cari kode atau nama..." class="pl-9 pr-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm text-gray-700 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all w-full">
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto rounded-xl border border-gray-100">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 text-xs font-semibold uppercase tracking-wider">
                            <th class="px-5 py-3 text-left">Kode</th>
                            <th class="px-5 py-3 text-left">Nama</th>
                            <th class="px-5 py-3 text-left">Kode Mesin</th>
                            <th class="px-5 py-3 text-left">Badge</th>
                            <th class="px-5 py-3 text-left">Toleransi</th>
                            <th class="px-5 py-3 text-left">Gaji</th>
                            <th class="px-5 py-3 text-left">Status</th>
                            <th class="px-5 py-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($types as $type)
                        <tr class="hover:bg-gray-50/50 transition-colors"
                            x-show="searchType === '' || '{{ strtolower($type->code . ' ' . $type->name) }}'.includes(searchType.toLowerCase())">
                            <td class="px-5 py-3.5">
                                <span class="font-mono text-xs bg-gray-100 text-gray-700 px-2.5 py-1 rounded-lg font-bold">{{ $type->code }}</span>
                            </td>
                            <td class="px-5 py-3.5">
                                <p class="font-semibold text-gray-800">{{ $type->name }}</p>
                                @if($type->description)
                                    <p class="text-xs text-gray-400 mt-0.5 truncate max-w-[200px]">{{ $type->description }}</p>
                                @endif
                            </td>
                            <td class="px-5 py-3.5">
                                @if($type->machine_status_code !== null)
                                    <span class="font-mono text-xs bg-indigo-50 text-indigo-700 px-2.5 py-1 rounded-lg font-bold">{{ $type->machine_status_code }}</span>
                                @else
                                    <span class="text-gray-300 text-xs">— sistem</span>
                                @endif
                            </td>
                            <td class="px-5 py-3.5">
                                @php $colors = $type->colorClasses; @endphp
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1 rounded-full {{ $colors['bg'] }} {{ $colors['text'] }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $colors['dot'] }}"></span>
                                    {{ ucfirst($type->color) }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5 text-gray-600">
                                @if($type->late_tolerance_minutes > 0)
                                    <span class="text-yellow-600 font-semibold">{{ $type->late_tolerance_minutes }} menit</span>
                                @else
                                    <span class="text-gray-300 text-xs">—</span>
                                @endif
                            </td>
                            <td class="px-5 py-3.5">
                                @if($type->affects_payroll)
                                    <span class="inline-flex items-center gap-1 text-xs font-semibold text-red-600 bg-red-50 px-2 py-1 rounded-full">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                        Memotong
                                    </span>
                                @else
                                    <span class="text-xs text-gray-400">Normal</span>
                                @endif
                            </td>
                            <td class="px-5 py-3.5">
                                @if($type->is_active)
                                    <span class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-xs font-semibold text-gray-400 bg-gray-100 px-2.5 py-1 rounded-full">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-1">
                                    <button
                                        @click="openEditType({
                                            id: {{ $type->id }},
                                            code: '{{ $type->code }}',
                                            name: '{{ addslashes($type->name) }}',
                                            machine_status_code: {{ $type->machine_status_code ?? 'null' }},
                                            color: '{{ $type->color }}',
                                            affects_payroll: {{ $type->affects_payroll ? 'true' : 'false' }},
                                            late_tolerance_minutes: {{ $type->late_tolerance_minutes }},
                                            description: '{{ addslashes($type->description ?? '') }}',
                                            is_active: {{ $type->is_active ? 'true' : 'false' }}
                                        })"
                                        class="p-1.5 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <form method="POST" action="{{ route('master.attendance-types.destroy', $type->id) }}" onsubmit="return confirm('Hapus jenis kehadiran {{ $type->name }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-5 py-12 text-center">
                                <div class="flex flex-col items-center gap-3 text-gray-400">
                                    <svg class="w-12 h-12 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                    <p class="text-sm font-medium">Belum ada jenis kehadiran</p>
                                    <p class="text-xs">Klik "Tambah Jenis" untuk mulai konfigurasi.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Info card mapping mesin --}}
            <div class="bg-gradient-to-br from-indigo-50 to-blue-50 border border-indigo-100 rounded-2xl p-5">
                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 rounded-xl bg-indigo-100 flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-indigo-800">Cara Kerja Mapping Kode Mesin</h4>
                        <p class="text-xs text-indigo-600 mt-1 leading-relaxed">
                            Mesin fingerprint/face ID mengirimkan kode status mentah (misal: <code class="bg-indigo-100 px-1 rounded">0</code> atau <code class="bg-indigo-100 px-1 rounded">1</code>).
                            KancaHR menerjemahkan kode ini ke jenis kehadiran yang Anda definisikan di sini secara otomatis.
                            Jika tidak ada log hingga akhir shift, sistem menetapkan status <strong>Alpa</strong>.
                        </p>
                        <div class="mt-3 flex flex-wrap gap-2 text-xs">
                            <span class="bg-white border border-indigo-200 text-indigo-700 px-2.5 py-1 rounded-lg font-medium">Kode 0 → Hadir</span>
                            <span class="bg-white border border-yellow-200 text-yellow-700 px-2.5 py-1 rounded-lg font-medium">Kode 1 → Terlambat (+ toleransi)</span>
                            <span class="bg-white border border-red-200 text-red-700 px-2.5 py-1 rounded-lg font-medium">Tidak ada log → Alpa</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ==================== TAB 2: INTEGRASI MESIN ==================== --}}
        <div x-show="activeTab === 'devices'" x-transition class="p-6 space-y-5">

            {{-- Stats Cards --}}
            @php
                $totalDevices = $devices->count();
                $activeDevices = $devices->where('is_active', true)->count();
                $admsDevices = $devices->where('integration_method', 'adms')->count();
                $sdkDevices = $devices->where('integration_method', 'sdk')->count();
            @endphp
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                    <p class="text-xs text-gray-400 font-medium">Total Mesin</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">{{ $totalDevices }}</p>
                    <p class="text-xs text-gray-400 mt-1">terdaftar</p>
                </div>
                <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-100">
                    <p class="text-xs text-emerald-600 font-medium">Mesin Aktif</p>
                    <p class="text-2xl font-bold text-emerald-600 mt-1">{{ $activeDevices }}</p>
                    <p class="text-xs text-emerald-400 mt-1">online</p>
                </div>
                <div class="bg-violet-50 rounded-xl p-4 border border-violet-100">
                    <p class="text-xs text-violet-600 font-medium">Metode ADMS</p>
                    <p class="text-2xl font-bold text-violet-600 mt-1">{{ $admsDevices }}</p>
                    <p class="text-xs text-violet-400 mt-1">real-time push</p>
                </div>
                <div class="bg-blue-50 rounded-xl p-4 border border-blue-100">
                    <p class="text-xs text-blue-600 font-medium">Metode SDK</p>
                    <p class="text-2xl font-bold text-blue-600 mt-1">{{ $sdkDevices }}</p>
                    <p class="text-xs text-blue-400 mt-1">pull terjadwal</p>
                </div>
            </div>

            {{-- Arsitektur Integrasi Info --}}
            <div class="grid md:grid-cols-2 gap-4">
                {{-- Metode A: ADMS --}}
                <div class="bg-gradient-to-br from-violet-50 to-purple-50 border border-violet-100 rounded-2xl p-5">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-violet-100 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center gap-2 flex-wrap">
                                <h4 class="text-sm font-bold text-violet-800">Metode A — ADMS (Auto Push)</h4>
                                <span class="text-[10px] font-bold text-white px-2 py-0.5 rounded-full shrink-0" style="background-color: #8b5cf6;">REKOMENDASI</span>
                            </div>
                            <p class="text-xs text-violet-600 mt-1 leading-relaxed">
                                Mesin absensi modern (ZKTeco, Solution) terhubung internet dan
                                <strong>menembak data langsung</strong> ke endpoint API KancaHR setiap kali karyawan absen.
                                Data terupdate secara <strong>real-time</strong> tanpa intervensi HR.
                            </p>
                            <div class="mt-3 flex flex-wrap gap-1.5 text-[11px]">
                                <span class="bg-violet-100 text-violet-700 px-2 py-0.5 rounded font-medium">⚡ Real-time</span>
                                <span class="bg-violet-100 text-violet-700 px-2 py-0.5 rounded font-medium">☁ Cloud-ready</span>
                                <span class="bg-violet-100 text-violet-700 px-2 py-0.5 rounded font-medium">🔑 Webhook Token</span>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Metode B: SDK --}}
                <div class="bg-gradient-to-br from-blue-50 to-cyan-50 border border-blue-100 rounded-2xl p-5">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-blue-800">Metode B — SDK (Pull Terjadwal)</h4>
                            <p class="text-xs text-blue-600 mt-1 leading-relaxed">
                                Untuk mesin di jaringan LAN tanpa internet. Middleware script
                                <strong>menarik data secara terjadwal</strong> dari IP mesin via protokol SDK
                                (zkemkeeper / port 4370), lalu bulk-insert ke KancaHR.
                            </p>
                            <div class="mt-3 flex flex-wrap gap-1.5 text-[11px]">
                                <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded font-medium">🏢 LAN/Intranet</span>
                                <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded font-medium">⏱ Cron Job</span>
                                <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded font-medium">📦 Bulk Insert</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Search + Tabel Mesin --}}
            <div class="relative max-w-xs">
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input x-model="searchDevice" type="text" placeholder="Cari nama atau lokasi..." class="pl-9 pr-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm text-gray-700 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all w-full">
            </div>

            <div class="overflow-x-auto rounded-xl border border-gray-100">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 text-xs font-semibold uppercase tracking-wider">
                            <th class="px-5 py-3 text-left">Mesin</th>
                            <th class="px-5 py-3 text-left">Brand / Model</th>
                            <th class="px-5 py-3 text-left">IP Address</th>
                            <th class="px-5 py-3 text-left">Lokasi</th>
                            <th class="px-5 py-3 text-left">Metode</th>
                            <th class="px-5 py-3 text-left">Last Sync</th>
                            <th class="px-5 py-3 text-left">Status</th>
                            <th class="px-5 py-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($devices as $device)
                        <tr class="hover:bg-gray-50/50 transition-colors"
                            x-show="searchDevice === '' || '{{ strtolower($device->name . ' ' . ($device->location ?? '')) }}'.includes(searchDevice.toLowerCase())">
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $device->name }}</p>
                                        @if($device->serial_number)
                                            <p class="text-xs text-gray-400 font-mono">S/N: {{ $device->serial_number }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-3.5 text-gray-600">
                                <p class="font-medium">{{ $device->brand ?? '—' }}</p>
                                <p class="text-xs text-gray-400">{{ $device->model_name ?? '' }}</p>
                            </td>
                            <td class="px-5 py-3.5">
                                @if($device->ip_address)
                                    <span class="font-mono text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded-lg">{{ $device->ip_address }}</span>
                                @else
                                    <span class="text-gray-300 text-xs">—</span>
                                @endif
                            </td>
                            <td class="px-5 py-3.5 text-gray-600 text-sm">
                                {{ $device->location ?? '—' }}
                            </td>
                            <td class="px-5 py-3.5">
                                @php $mc = $device->methodColor; @endphp
                                <div class="flex items-center gap-1.5">
                                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $mc['bg'] }} {{ $mc['text'] }}">
                                        {{ $device->integrationMethodLabel }}
                                    </span>
                                    @if($device->integration_method === 'adms' && $device->adms_token)
                                    <button @click="showToken('{{ $device->adms_token }}')"
                                        class="p-1 text-violet-400 hover:text-violet-600 hover:bg-violet-50 rounded-lg transition-colors" title="Lihat Token ADMS">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </button>
                                    @endif
                                </div>
                            </td>
                            <td class="px-5 py-3.5 text-gray-500 text-xs">
                                @if($device->last_sync_at)
                                    <span class="text-emerald-600 font-medium">{{ $device->last_sync_at->diffForHumans() }}</span>
                                @else
                                    <span class="text-gray-300">Belum sync</span>
                                @endif
                            </td>
                            <td class="px-5 py-3.5">
                                @if($device->is_active)
                                    <span class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-xs font-semibold text-gray-400 bg-gray-100 px-2.5 py-1 rounded-full">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-1">
                                    <button
                                        @click="openEditDevice({
                                            id: {{ $device->id }},
                                            name: '{{ addslashes($device->name) }}',
                                            serial_number: '{{ addslashes($device->serial_number ?? '') }}',
                                            brand: '{{ addslashes($device->brand ?? '') }}',
                                            model_name: '{{ addslashes($device->model_name ?? '') }}',
                                            ip_address: '{{ $device->ip_address ?? '' }}',
                                            location: '{{ addslashes($device->location ?? '') }}',
                                            integration_method: '{{ $device->integration_method }}',
                                            notes: '{{ addslashes($device->notes ?? '') }}',
                                            is_active: {{ $device->is_active ? 'true' : 'false' }}
                                        })"
                                        class="p-1.5 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <form method="POST" action="{{ route('master.attendance-devices.destroy', $device->id) }}" onsubmit="return confirm('Hapus mesin {{ $device->name }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-5 py-12 text-center">
                                <div class="flex flex-col items-center gap-3 text-gray-400">
                                    <svg class="w-12 h-12 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                    <p class="text-sm font-medium">Belum ada mesin terdaftar</p>
                                    <p class="text-xs">Klik "Tambah Mesin" untuk mendaftarkan perangkat absensi.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Endpoint API info untuk ADMS --}}
            <div class="bg-gray-900 rounded-2xl p-5">
                <div class="flex items-center gap-2 mb-3">
                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span class="text-sm font-bold text-white">Endpoint Webhook ADMS (Coming Soon)</span>
                </div>
                <div class="font-mono text-xs text-gray-400 space-y-1.5">
                    <div class="flex items-center gap-2">
                        <span class="text-emerald-400 font-bold bg-emerald-400/10 px-2 py-0.5 rounded">POST</span>
                        <span class="text-gray-300">{{ url('/api/attendance/adms/push') }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-blue-400 font-bold bg-blue-400/10 px-2 py-0.5 rounded">GET</span>
                        <span class="text-gray-300">{{ url('/api/attendance/adms/health') }}</span>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-3">Header: <code class="text-emerald-400">Authorization: Bearer {adms_token}</code></p>
            </div>
        </div>
    </div>

    {{-- ==================== MODAL TAMBAH JENIS KEHADIRAN ==================== --}}
    <div x-show="showCreateTypeModal" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm p-4">
        <div @click.away="showCreateTypeModal = false" class="bg-white rounded-2xl shadow-2xl w-full max-w-lg">
            <div class="flex items-center justify-between p-6 border-b border-gray-100">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Tambah Jenis Kehadiran</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Definisikan status kehadiran baru untuk sistem absensi.</p>
                </div>
                <button @click="showCreateTypeModal = false" class="p-2 text-gray-400 hover:bg-gray-100 rounded-xl transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form method="POST" action="{{ route('master.attendance-types.store') }}" class="p-6 space-y-4">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Kode <span class="text-red-500">*</span></label>
                        <input type="text" name="code" placeholder="HADIR" style="text-transform:uppercase" class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all font-mono" required>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Kode Mesin (opsional)</label>
                        <input type="number" name="machine_status_code" placeholder="0" min="0" class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Nama Tampilan <span class="text-red-500">*</span></label>
                    <input type="text" name="name" placeholder="Hadir" class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Warna Badge <span class="text-red-500">*</span></label>
                        <select name="color" class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all bg-white" required>
                            <option value="emerald">🟢 Emerald (Hadir)</option>
                            <option value="yellow">🟡 Yellow (Terlambat)</option>
                            <option value="red">🔴 Red (Alpa)</option>
                            <option value="blue">🔵 Blue (Izin)</option>
                            <option value="purple">🟣 Purple (Lembur)</option>
                            <option value="orange">🟠 Orange (Sakit)</option>
                            <option value="gray">⚫ Gray (Lainnya)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Toleransi Terlambat (menit)</label>
                        <input type="number" name="late_tolerance_minutes" value="0" min="0" max="120" class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Deskripsi</label>
                    <textarea name="description" rows="2" placeholder="Keterangan singkat tentang jenis kehadiran ini..." class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all resize-none"></textarea>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="affects_payroll" value="1" class="w-4 h-4 rounded text-red-500 border-gray-300 focus:ring-red-500">
                            <span class="text-sm text-gray-600">Mempengaruhi gaji</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 rounded text-emerald-500 border-gray-300 focus:ring-emerald-500">
                            <span class="text-sm text-gray-600">Aktif</span>
                        </label>
                    </div>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="button" @click="showCreateTypeModal = false" class="flex-1 py-2.5 border border-gray-200 text-gray-600 rounded-xl text-sm font-medium hover:bg-gray-50 transition-colors">Batal</button>
                    <button type="submit" class="flex-1 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl text-sm font-semibold transition-colors">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ==================== MODAL EDIT JENIS KEHADIRAN ==================== --}}
    <div x-show="showEditTypeModal" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm p-4">
        <div @click.away="showEditTypeModal = false" class="bg-white rounded-2xl shadow-2xl w-full max-w-lg">
            <div class="flex items-center justify-between p-6 border-b border-gray-100">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Edit Jenis Kehadiran</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Perbarui konfigurasi jenis kehadiran.</p>
                </div>
                <button @click="showEditTypeModal = false" class="p-2 text-gray-400 hover:bg-gray-100 rounded-xl transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form method="POST" :action="`{{ url('master/attendance-types') }}/${editType.id}`" class="p-6 space-y-4">
                @csrf @method('PUT')
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Kode <span class="text-red-500">*</span></label>
                        <input type="text" name="code" x-model="editType.code" style="text-transform:uppercase" class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all font-mono" required>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Kode Mesin (opsional)</label>
                        <input type="number" name="machine_status_code" x-model="editType.machine_status_code" min="0" class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Nama Tampilan <span class="text-red-500">*</span></label>
                    <input type="text" name="name" x-model="editType.name" class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Warna Badge <span class="text-red-500">*</span></label>
                        <select name="color" x-model="editType.color" class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all bg-white" required>
                            <option value="emerald">🟢 Emerald (Hadir)</option>
                            <option value="yellow">🟡 Yellow (Terlambat)</option>
                            <option value="red">🔴 Red (Alpa)</option>
                            <option value="blue">🔵 Blue (Izin)</option>
                            <option value="purple">🟣 Purple (Lembur)</option>
                            <option value="orange">🟠 Orange (Sakit)</option>
                            <option value="gray">⚫ Gray (Lainnya)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Toleransi Terlambat (menit)</label>
                        <input type="number" name="late_tolerance_minutes" x-model="editType.late_tolerance_minutes" min="0" max="120" class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Deskripsi</label>
                    <textarea name="description" x-model="editType.description" rows="2" class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all resize-none"></textarea>
                </div>
                <div class="flex items-center gap-4">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="affects_payroll" value="1" :checked="editType.affects_payroll" class="w-4 h-4 rounded text-red-500 border-gray-300 focus:ring-red-500">
                        <span class="text-sm text-gray-600">Mempengaruhi gaji</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" :checked="editType.is_active" class="w-4 h-4 rounded text-emerald-500 border-gray-300 focus:ring-emerald-500">
                        <span class="text-sm text-gray-600">Aktif</span>
                    </label>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="button" @click="showEditTypeModal = false" class="flex-1 py-2.5 border border-gray-200 text-gray-600 rounded-xl text-sm font-medium hover:bg-gray-50 transition-colors">Batal</button>
                    <button type="submit" class="flex-1 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl text-sm font-semibold transition-colors">Perbarui</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ==================== MODAL TAMBAH MESIN ==================== --}}
    <div x-show="showCreateDeviceModal" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm p-4">
        <div @click.away="showCreateDeviceModal = false" class="bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between p-6 border-b border-gray-100 sticky top-0 bg-white z-10">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Tambah Mesin Absensi</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Daftarkan mesin fingerprint atau face ID.</p>
                </div>
                <button @click="showCreateDeviceModal = false" class="p-2 text-gray-400 hover:bg-gray-100 rounded-xl transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form method="POST" action="{{ route('master.attendance-devices.store') }}" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Nama Mesin <span class="text-red-500">*</span></label>
                    <input type="text" name="name" placeholder="Mesin Lobby Utama" class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Brand</label>
                        <input type="text" name="brand" placeholder="ZKTeco" class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Model</label>
                        <input type="text" name="model_name" placeholder="ZK-F22" class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Nomor Seri</label>
                        <input type="text" name="serial_number" placeholder="ABC123456" class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 font-mono focus:border-emerald-500 transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">IP Address</label>
                        <input type="text" name="ip_address" placeholder="192.168.1.100" class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 font-mono focus:border-emerald-500 transition-all">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Lokasi Fisik</label>
                    <input type="text" name="location" placeholder="Lobby Utama / Lantai 2 / Parkir" class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-2">Metode Integrasi <span class="text-red-500">*</span></label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="flex items-start gap-3 p-3.5 border-2 rounded-xl cursor-pointer transition-colors has-[:checked]:border-violet-500 has-[:checked]:bg-violet-50 border-gray-200">
                            <input type="radio" name="integration_method" value="adms" checked class="mt-0.5 text-violet-600 focus:ring-violet-500">
                            <div>
                                <p class="text-sm font-semibold text-gray-800">ADMS</p>
                                <p class="text-xs text-gray-400 mt-0.5">Auto push real-time</p>
                            </div>
                        </label>
                        <label class="flex items-start gap-3 p-3.5 border-2 rounded-xl cursor-pointer transition-colors has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50 border-gray-200">
                            <input type="radio" name="integration_method" value="sdk" class="mt-0.5 text-blue-600 focus:ring-blue-500">
                            <div>
                                <p class="text-sm font-semibold text-gray-800">SDK</p>
                                <p class="text-xs text-gray-400 mt-0.5">Pull terjadwal via LAN</p>
                            </div>
                        </label>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Catatan</label>
                    <textarea name="notes" rows="2" placeholder="Catatan tambahan tentang mesin ini..." class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all resize-none"></textarea>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" value="1" checked id="device_active_create" class="w-4 h-4 rounded text-emerald-500 border-gray-300 focus:ring-emerald-500">
                    <label for="device_active_create" class="text-sm text-gray-600 cursor-pointer">Mesin aktif</label>
                </div>
                <p class="text-xs text-violet-600 bg-violet-50 px-3 py-2 rounded-lg">
                    💡 Token ADMS akan digenerate otomatis jika metode ADMS dipilih.
                </p>
                <div class="flex gap-3 pt-2">
                    <button type="button" @click="showCreateDeviceModal = false" class="flex-1 py-2.5 border border-gray-200 text-gray-600 rounded-xl text-sm font-medium hover:bg-gray-50 transition-colors">Batal</button>
                    <button type="submit" class="flex-1 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl text-sm font-semibold transition-colors">Daftarkan Mesin</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ==================== MODAL EDIT MESIN ==================== --}}
    <div x-show="showEditDeviceModal" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm p-4">
        <div @click.away="showEditDeviceModal = false" class="bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between p-6 border-b border-gray-100 sticky top-0 bg-white z-10">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Edit Mesin Absensi</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Perbarui informasi mesin yang terdaftar.</p>
                </div>
                <button @click="showEditDeviceModal = false" class="p-2 text-gray-400 hover:bg-gray-100 rounded-xl transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form method="POST" :action="`{{ url('master/attendance-devices') }}/${editDevice.id}`" class="p-6 space-y-4">
                @csrf @method('PUT')
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Nama Mesin <span class="text-red-500">*</span></label>
                    <input type="text" name="name" x-model="editDevice.name" class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Brand</label>
                        <input type="text" name="brand" x-model="editDevice.brand" class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Model</label>
                        <input type="text" name="model_name" x-model="editDevice.model_name" class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Nomor Seri</label>
                        <input type="text" name="serial_number" x-model="editDevice.serial_number" class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 font-mono focus:border-emerald-500 transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">IP Address</label>
                        <input type="text" name="ip_address" x-model="editDevice.ip_address" class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 font-mono focus:border-emerald-500 transition-all">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Lokasi Fisik</label>
                    <input type="text" name="location" x-model="editDevice.location" class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-2">Metode Integrasi <span class="text-red-500">*</span></label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="flex items-start gap-3 p-3.5 border-2 rounded-xl cursor-pointer transition-colors border-gray-200" :class="editDevice.integration_method === 'adms' ? 'border-violet-500 bg-violet-50' : ''">
                            <input type="radio" name="integration_method" value="adms" x-model="editDevice.integration_method" class="mt-0.5 text-violet-600 focus:ring-violet-500">
                            <div>
                                <p class="text-sm font-semibold text-gray-800">ADMS</p>
                                <p class="text-xs text-gray-400 mt-0.5">Auto push real-time</p>
                            </div>
                        </label>
                        <label class="flex items-start gap-3 p-3.5 border-2 rounded-xl cursor-pointer transition-colors border-gray-200" :class="editDevice.integration_method === 'sdk' ? 'border-blue-500 bg-blue-50' : ''">
                            <input type="radio" name="integration_method" value="sdk" x-model="editDevice.integration_method" class="mt-0.5 text-blue-600 focus:ring-blue-500">
                            <div>
                                <p class="text-sm font-semibold text-gray-800">SDK</p>
                                <p class="text-xs text-gray-400 mt-0.5">Pull terjadwal via LAN</p>
                            </div>
                        </label>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Catatan</label>
                    <textarea name="notes" x-model="editDevice.notes" rows="2" class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all resize-none"></textarea>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" value="1" :checked="editDevice.is_active" id="device_active_edit" class="w-4 h-4 rounded text-emerald-500 border-gray-300 focus:ring-emerald-500">
                    <label for="device_active_edit" class="text-sm text-gray-600 cursor-pointer">Mesin aktif</label>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="button" @click="showEditDeviceModal = false" class="flex-1 py-2.5 border border-gray-200 text-gray-600 rounded-xl text-sm font-medium hover:bg-gray-50 transition-colors">Batal</button>
                    <button type="submit" class="flex-1 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl text-sm font-semibold transition-colors">Perbarui</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ==================== MODAL TOKEN ADMS ==================== --}}
    <div x-show="showTokenModal" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm p-4">
        <div @click.away="showTokenModal = false" class="bg-gray-900 rounded-2xl shadow-2xl w-full max-w-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base font-bold text-white flex items-center gap-2">
                    <svg class="w-4 h-4 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                    Token ADMS
                </h3>
                <button @click="showTokenModal = false" class="p-1.5 text-gray-400 hover:bg-gray-800 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <p class="text-xs text-gray-400 mb-3">Gunakan token ini sebagai <code class="text-emerald-400">Authorization: Bearer</code> saat mengkonfigurasi ADMS URL di mesin.</p>
            <div class="bg-gray-800 rounded-xl p-4 mb-4">
                <code class="text-emerald-400 text-xs break-all font-mono" x-text="tokenValue"></code>
            </div>
            <button @click="copyToken()" class="w-full py-2.5 bg-violet-600 hover:bg-violet-700 text-white rounded-xl text-sm font-semibold transition-colors flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                Salin Token
            </button>
        </div>
    </div>

</div>
</x-app-layout>

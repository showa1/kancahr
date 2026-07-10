<x-app-layout>
<div class="space-y-6" x-data="{
    showCreateModal: false,
    showEditModal: false,
    edit: { id:'', name:'', code:'', alias:'', start_time:'', end_time:'', cross_midnight: false, status:'aktif' },
    search: ''
}">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
        <div>
            <p class="text-xs text-gray-400 font-medium uppercase tracking-widest">Data Master</p>
            <h2 class="text-2xl font-bold text-gray-800 mt-1">Master Shift</h2>
            <p class="text-gray-500 text-sm mt-1">Kelola daftar shift kerja beserta jam masuk dan jam pulang.</p>
        </div>
        <div class="flex items-center gap-3 flex-wrap">
            {{-- Search --}}
            <div class="relative">
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input x-model="search" type="text" placeholder="Cari nama atau kode shift..." class="pl-9 pr-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm text-gray-700 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all w-56">
            </div>
            <button @click="showCreateModal = true" class="bg-emerald-500 hover:bg-emerald-600 text-white font-medium py-2.5 px-5 rounded-xl shadow-sm transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Shift
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

    {{-- STATS CARDS --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @php
            $total   = $shifts->count();
            $aktif   = $shifts->where('status', 'aktif')->count();
            $nonaktif= $shifts->where('status', 'nonaktif')->count();
            $cross   = $shifts->where('cross_midnight', true)->count();
        @endphp
        <div class="bg-white border border-gray-100 rounded-2xl p-4 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.06)]">
            <p class="text-xs text-gray-400 font-medium">Total Shift</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $total }}</p>
            <p class="text-xs text-gray-400 mt-1">terdaftar</p>
        </div>
        <div class="bg-white border border-gray-100 rounded-2xl p-4 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.06)]">
            <p class="text-xs text-gray-400 font-medium">Shift Aktif</p>
            <p class="text-2xl font-bold text-emerald-600 mt-1">{{ $aktif }}</p>
            <p class="text-xs text-gray-400 mt-1">berjalan</p>
        </div>
        <div class="bg-white border border-gray-100 rounded-2xl p-4 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.06)]">
            <p class="text-xs text-gray-400 font-medium">Non-aktif</p>
            <p class="text-2xl font-bold text-gray-400 mt-1">{{ $nonaktif }}</p>
            <p class="text-xs text-gray-400 mt-1">dinonaktifkan</p>
        </div>
        <div class="bg-white border border-gray-100 rounded-2xl p-4 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.06)]">
            <p class="text-xs text-gray-400 font-medium">Lintas Hari</p>
            <p class="text-2xl font-bold text-purple-600 mt-1">{{ $cross }}</p>
            <p class="text-xs text-gray-400 mt-1">beda tanggal</p>
        </div>
    </div>

    {{-- TABLE CARD --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_2px_15px_-4px_rgba(0,0,0,0.07)] overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-emerald-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="font-bold text-gray-800">Tabel Pengaturan Shift</h3>
            </div>
            <span class="text-xs text-gray-400 bg-gray-100 px-3 py-1 rounded-full font-medium">{{ $shifts->count() }} Data</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3">No.</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3">Nama Shift</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3">Kode</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3">Nama Lain</th>
                        <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3">Jam Masuk</th>
                        <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3">Jam Pulang</th>
                        <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3">Durasi</th>
                        <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3">Beda Tanggal</th>
                        <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3">Status</th>
                        <th class="text-right text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($shifts as $shift)
                    <tr class="hover:bg-gray-50/60 transition-colors"
                        x-show="search === '' || '{{ strtolower($shift->name) }}'.includes(search.toLowerCase()) || '{{ strtolower($shift->code) }}'.includes(search.toLowerCase()) || '{{ strtolower($shift->alias) }}'.includes(search.toLowerCase())">

                        <td class="px-5 py-4 text-gray-400 text-xs">{{ $loop->iteration }}</td>

                        {{-- Nama Shift --}}
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                @php
                                    $shiftColors = [
                                        0 => 'from-amber-400 to-orange-400',
                                        1 => 'from-blue-400 to-indigo-500',
                                        2 => 'from-purple-400 to-violet-500',
                                        3 => 'from-rose-400 to-pink-500',
                                    ];
                                    $colorClass = $shiftColors[$loop->index % 4];
                                @endphp
                                <div class="w-9 h-9 rounded-xl bg-gradient-to-br {{ $colorClass }} flex items-center justify-center text-white font-bold text-xs shrink-0">
                                    {{ strtoupper(substr($shift->name, 0, 2)) }}
                                </div>
                                <span class="font-semibold text-gray-800">{{ $shift->name }}</span>
                            </div>
                        </td>

                        {{-- Kode --}}
                        <td class="px-5 py-4">
                            <span class="px-2.5 py-1 bg-gray-100 text-gray-700 text-xs font-bold rounded-lg font-mono">{{ $shift->code }}</span>
                        </td>

                        {{-- Alias --}}
                        <td class="px-5 py-4 text-gray-500 text-xs">{{ $shift->alias ?? '-' }}</td>

                        {{-- Jam Masuk --}}
                        <td class="px-5 py-4 text-center">
                            <div class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 text-emerald-700 rounded-xl text-xs font-bold">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $shift->start_time_formatted }}
                            </div>
                        </td>

                        {{-- Jam Pulang --}}
                        <td class="px-5 py-4 text-center">
                            <div class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-rose-50 text-rose-700 rounded-xl text-xs font-bold">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                {{ $shift->end_time_formatted }}
                            </div>
                        </td>

                        {{-- Durasi --}}
                        <td class="px-5 py-4 text-center">
                            <span class="text-xs font-medium text-gray-600 bg-gray-100 px-2.5 py-1 rounded-lg">{{ $shift->duration }}</span>
                        </td>

                        {{-- Beda Tanggal --}}
                        <td class="px-5 py-4 text-center">
                            @if($shift->cross_midnight)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-purple-50 text-purple-700 text-xs font-semibold rounded-full">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                                    Ya
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-gray-100 text-gray-400 text-xs font-semibold rounded-full">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                                    Tidak
                                </span>
                            @endif
                        </td>

                        {{-- Status --}}
                        <td class="px-5 py-4 text-center">
                            @if($shift->status === 'aktif')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-emerald-50 text-emerald-700 text-xs font-semibold rounded-full">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-gray-100 text-gray-400 text-xs font-semibold rounded-full">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span> Non-aktif
                                </span>
                            @endif
                        </td>

                        {{-- Aksi --}}
                        <td class="px-5 py-4 text-right">
                            <div class="flex items-center justify-end gap-1">
                                <button @click="edit = {
                                    id: {{ $shift->id }},
                                    name: '{{ $shift->name }}',
                                    code: '{{ $shift->code }}',
                                    alias: '{{ $shift->alias }}',
                                    start_time: '{{ $shift->start_time_formatted }}',
                                    end_time: '{{ $shift->end_time_formatted }}',
                                    cross_midnight: {{ $shift->cross_midnight ? 'true' : 'false' }},
                                    status: '{{ $shift->status }}'
                                }; showEditModal = true"
                                class="p-1.5 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                                <form action="{{ route('master.shifts.destroy', $shift->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus shift {{ $shift->name }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="px-6 py-20 text-center">
                            <div class="flex flex-col items-center gap-3 text-gray-400">
                                <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center mb-1">
                                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <p class="font-semibold text-gray-600">Belum ada data shift</p>
                                <p class="text-xs max-w-xs">Klik tombol "Tambah Shift" untuk mendaftarkan shift kerja pertama Anda.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ===== MODAL TAMBAH ===== --}}
    <div x-show="showCreateModal" class="fixed inset-0 z-50 overflow-y-auto" style="display:none;">
        <div class="flex items-center justify-center min-h-screen px-4 py-8">
            <div x-show="showCreateModal" x-transition.opacity class="fixed inset-0 bg-black/40 backdrop-blur-sm" @click="showCreateModal = false"></div>
            <div x-show="showCreateModal" x-transition.scale.origin.center class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg z-10">
                <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Tambah Shift Baru</h3>
                        <p class="text-sm text-gray-500 mt-0.5">Isi informasi jadwal shift kerja.</p>
                    </div>
                    <button @click="showCreateModal = false" class="text-gray-400 hover:text-gray-600 p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <form action="{{ route('master.shifts.store') }}" method="POST">
                    @csrf
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Shift <span class="text-red-400">*</span></label>
                                <input type="text" name="name" required placeholder="Contoh: Pagi 1" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Kode Shift <span class="text-red-400">*</span></label>
                                <input type="text" name="code" required placeholder="Contoh: S1" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5 uppercase">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lain / Alias</label>
                            <input type="text" name="alias" placeholder="Contoh: PAGI 1 (opsional)" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    <span class="inline-flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Jam Masuk <span class="text-red-400">*</span>
                                    </span>
                                </label>
                                <input type="time" name="start_time" required class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    <span class="inline-flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-rose-500"></span> Jam Pulang <span class="text-red-400">*</span>
                                    </span>
                                </label>
                                <input type="time" name="end_time" required class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                            </div>
                        </div>
                        <div class="bg-purple-50 border border-purple-100 rounded-xl p-3.5 flex items-center gap-3">
                            <input type="hidden" name="cross_midnight" value="0">
                            <input type="checkbox" name="cross_midnight" value="1" id="cross_midnight" class="w-4 h-4 rounded text-purple-600 focus:ring-purple-500 border-gray-300">
                            <label for="cross_midnight" class="cursor-pointer">
                                <p class="text-sm font-semibold text-purple-800">Beda Tanggal Masuk/Pulang</p>
                                <p class="text-xs text-purple-600 mt-0.5">Centang jika shift melewati tengah malam (misal: 22:00 – 06:00)</p>
                            </label>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <div class="flex gap-4">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="status" value="aktif" checked class="text-emerald-600 focus:ring-emerald-500">
                                    <span class="text-sm text-gray-700">Aktif</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="status" value="nonaktif" class="text-emerald-600 focus:ring-emerald-500">
                                    <span class="text-sm text-gray-700">Non-aktif</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-gray-50 rounded-b-2xl flex justify-end gap-3 border-t border-gray-100">
                        <button type="button" @click="showCreateModal = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">Batal</button>
                        <button type="submit" class="px-6 py-2 text-sm font-medium text-white bg-emerald-600 rounded-xl hover:bg-emerald-700 transition-colors shadow-sm">Simpan Shift</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ===== MODAL EDIT ===== --}}
    <div x-show="showEditModal" class="fixed inset-0 z-50 overflow-y-auto" style="display:none;">
        <div class="flex items-center justify-center min-h-screen px-4 py-8">
            <div x-show="showEditModal" x-transition.opacity class="fixed inset-0 bg-black/40 backdrop-blur-sm" @click="showEditModal = false"></div>
            <div x-show="showEditModal" x-transition.scale.origin.center class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg z-10">
                <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Edit Shift</h3>
                        <p class="text-sm text-gray-500 mt-0.5">Perbarui informasi shift kerja.</p>
                    </div>
                    <button @click="showEditModal = false" class="text-gray-400 hover:text-gray-600 p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <form :action="`/master/shifts/${edit.id}`" method="POST">
                    @csrf @method('PUT')
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Shift <span class="text-red-400">*</span></label>
                                <input type="text" name="name" x-model="edit.name" required class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Kode Shift <span class="text-red-400">*</span></label>
                                <input type="text" name="code" x-model="edit.code" required class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5 uppercase">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lain / Alias</label>
                            <input type="text" name="alias" x-model="edit.alias" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    <span class="inline-flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Jam Masuk
                                    </span>
                                </label>
                                <input type="time" name="start_time" x-model="edit.start_time" required class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    <span class="inline-flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-rose-500"></span> Jam Pulang
                                    </span>
                                </label>
                                <input type="time" name="end_time" x-model="edit.end_time" required class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                            </div>
                        </div>
                        <div class="bg-purple-50 border border-purple-100 rounded-xl p-3.5 flex items-center gap-3">
                            <input type="hidden" name="cross_midnight" value="0">
                            <input type="checkbox" name="cross_midnight" value="1" id="edit_cross_midnight"
                                :checked="edit.cross_midnight"
                                @change="edit.cross_midnight = $event.target.checked"
                                class="w-4 h-4 rounded text-purple-600 focus:ring-purple-500 border-gray-300">
                            <label for="edit_cross_midnight" class="cursor-pointer">
                                <p class="text-sm font-semibold text-purple-800">Beda Tanggal Masuk/Pulang</p>
                                <p class="text-xs text-purple-600 mt-0.5">Centang jika shift melewati tengah malam</p>
                            </label>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <div class="flex gap-4">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="status" value="aktif" :checked="edit.status === 'aktif'" class="text-emerald-600 focus:ring-emerald-500">
                                    <span class="text-sm text-gray-700">Aktif</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="status" value="nonaktif" :checked="edit.status === 'nonaktif'" class="text-emerald-600 focus:ring-emerald-500">
                                    <span class="text-sm text-gray-700">Non-aktif</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-gray-50 rounded-b-2xl flex justify-end gap-3 border-t border-gray-100">
                        <button type="button" @click="showEditModal = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">Batal</button>
                        <button type="submit" class="px-6 py-2 text-sm font-medium text-white bg-emerald-600 rounded-xl hover:bg-emerald-700 transition-colors shadow-sm">Perbarui Shift</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
</x-app-layout>

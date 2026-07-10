<x-app-layout>
    <div class="space-y-6">
        {{-- Header --}}
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">TRANSAKSI</p>
                <h1 class="text-2xl font-bold text-gray-800">Data Karyawan</h1>
                <p class="text-sm text-gray-500 mt-1">Pencatatan dan pengelolaan data karyawan aktif perusahaan.</p>
            </div>
            <a href="{{ route('transaksi.karyawan.create') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-white px-5 py-2.5 rounded-xl shadow-sm hover:shadow-md transition-all" style="background:linear-gradient(135deg,#10b981,#059669);">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Karyawan
            </a>
        </div>

        {{-- Flash Message --}}
        @if(session('success'))
        <div class="p-4 mb-4 rounded-xl bg-emerald-50 border border-emerald-100 flex items-start gap-3">
            <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
        </div>
        @endif

        {{-- Stats Cards --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Total Karyawan</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalActive + $totalInactive }}</p>
            </div>
            <div class="rounded-2xl p-5 border shadow-sm bg-emerald-50 border-emerald-100 text-emerald-600">
                <p class="text-xs font-semibold uppercase tracking-wider mb-2 opacity-80">Karyawan Aktif</p>
                <p class="text-3xl font-bold">{{ $totalActive }}</p>
            </div>
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Karyawan Non-Aktif</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalInactive }}</p>
            </div>
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Departemen</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalDepts }}</p>
            </div>
        </div>

        {{-- Data Table --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex flex-col md:flex-row items-center justify-between gap-4">
                <h3 class="font-bold text-gray-800">Daftar Karyawan</h3>
                
                <div class="flex items-center gap-2 w-full md:w-auto">
                    {{-- Search --}}
                    <div class="relative flex-1 md:w-64">
                        <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <input type="text" placeholder="Cari NIK, Nama..." class="w-full pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-300">
                    </div>
                    {{-- Filter Button --}}
                    <button class="px-3 py-2 border border-gray-200 rounded-xl hover:bg-gray-50 text-gray-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4">Karyawan</th>
                            <th class="px-6 py-4">Departemen & Jabatan</th>
                            <th class="px-6 py-4">Status & Tipe</th>
                            <th class="px-6 py-4">Bergabung</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($employees as $emp)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden shrink-0 border border-gray-200">
                                        <img src="{{ $emp->photo_url }}" alt="{{ $emp->full_name }}" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800">{{ $emp->display_name }}</p>
                                        <p class="text-xs text-gray-500 font-mono mt-0.5">{{ $emp->nik }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-800">{{ $emp->department->name ?? '-' }}</p>
                                <p class="text-xs text-gray-500 mt-0.5">{{ $emp->position->name ?? '-' }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2 py-1 text-[10px] font-bold rounded-full bg-blue-50 text-blue-600 uppercase tracking-wider">
                                    {{ $emp->employmentStatus->name ?? '-' }}
                                </span>
                                <p class="text-xs text-gray-500 mt-1 capitalize">{{ $emp->employee_type }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-gray-700">{{ $emp->join_date ? $emp->join_date->format('d M Y') : '-' }}</p>
                                @if($emp->join_date)
                                <p class="text-xs text-gray-400 mt-0.5">{{ $emp->join_date->diffForHumans() }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($emp->is_active)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-semibold text-emerald-700 bg-emerald-50 rounded-full border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-semibold text-rose-700 bg-rose-50 rounded-full border border-rose-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Non-Aktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button class="p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </button>
                                    <button class="p-2 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="w-16 h-16 rounded-2xl mx-auto mb-4 flex items-center justify-center bg-gray-50 border border-gray-100">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <p class="font-semibold text-gray-600">Belum ada data karyawan</p>
                                <p class="text-sm text-gray-400 mt-1">Silakan tambah data karyawan pertama Anda.</p>
                                <a href="{{ route('transaksi.karyawan.create') }}" class="inline-flex items-center gap-2 mt-4 text-sm font-semibold text-emerald-600 bg-emerald-50 border border-emerald-200 px-4 py-2 rounded-xl hover:bg-emerald-100 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    Tambah Karyawan
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination --}}
            @if($employees->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $employees->links() }}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>

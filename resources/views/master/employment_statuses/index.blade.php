<x-app-layout>
    <div class="space-y-6" x-data="{ showCreateModal: false, showEditModal: false, editStatus: { id: '', name: '' } }">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <p class="text-xs text-gray-400 font-medium uppercase tracking-widest">Data Master</p>
                <h2 class="text-2xl font-bold text-gray-800 mt-1">Status Karyawan</h2>
                <p class="text-gray-500 text-sm mt-1">Kelola jenis status kepegawaian (tetap, kontrak, magang, dll.).</p>
            </div>
            <button @click="showCreateModal = true" class="bg-emerald-500 hover:bg-emerald-600 text-white font-medium py-2.5 px-5 rounded-xl shadow-sm transition-colors flex items-center gap-2 self-start">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Status
            </button>
        </div>

        <!-- Alert -->
        @if(session('success'))
        <div class="flex items-center gap-3 p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700 text-sm">
            <svg class="w-5 h-5 shrink-0 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            {{ session('success') }}
        </div>
        @endif

        <!-- Info Badge -->
        <div class="flex items-start gap-3 p-4 bg-blue-50 border border-blue-100 rounded-xl text-blue-700 text-sm">
            <svg class="w-5 h-5 shrink-0 text-blue-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span>Data status karyawan digunakan saat mendaftarkan karyawan baru dan mempengaruhi kebijakan cuti, lembur, dan tunjangan.</span>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_2px_15px_-4px_rgba(0,0,0,0.07)] overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="font-bold text-gray-800">Daftar Status Karyawan</h3>
                <span class="text-xs text-gray-400 bg-gray-100 px-3 py-1 rounded-full font-medium">{{ $statuses->count() }} Total</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">#</th>
                            <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">Nama Status</th>
                            <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">Dibuat</th>
                            <th class="text-right text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @php
                            $badgeColors = [
                                0 => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'dot' => 'bg-emerald-500'],
                                1 => ['bg' => 'bg-blue-50', 'text' => 'text-blue-700', 'dot' => 'bg-blue-500'],
                                2 => ['bg' => 'bg-amber-50', 'text' => 'text-amber-700', 'dot' => 'bg-amber-500'],
                                3 => ['bg' => 'bg-purple-50', 'text' => 'text-purple-700', 'dot' => 'bg-purple-500'],
                            ];
                        @endphp
                        @forelse($statuses as $status)
                        @php $color = $badgeColors[$loop->index % 4]; @endphp
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-400">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-2 px-3 py-1.5 {{ $color['bg'] }} {{ $color['text'] }} text-sm font-semibold rounded-xl">
                                    <span class="w-2 h-2 rounded-full {{ $color['dot'] }}"></span>
                                    {{ $status->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-400">{{ $status->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button @click="editStatus = { id: {{ $status->id }}, name: '{{ $status->name }}' }; showEditModal = true" class="p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <form action="{{ route('master.employment-statuses.destroy', $status->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus status ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3 text-gray-400">
                                    <svg class="w-12 h-12 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                                    <p class="text-sm font-medium">Belum ada status karyawan</p>
                                    <p class="text-xs">Contoh: Pegawai Tetap, Kontrak, Magang, Percobaan.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Tambah -->
        <div x-show="showCreateModal" class="fixed inset-0 z-50 overflow-y-auto" style="display:none;">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div x-show="showCreateModal" x-transition.opacity class="fixed inset-0 bg-black/40 backdrop-blur-sm" @click="showCreateModal = false"></div>
                <div x-show="showCreateModal" x-transition.scale.origin.center class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md z-10">
                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900">Tambah Status Karyawan</h3>
                        <p class="text-sm text-gray-500 mt-1">Contoh: Pegawai Tetap, Kontrak, Magang.</p>
                    </div>
                    <form action="{{ route('master.employment-statuses.store') }}" method="POST">
                        @csrf
                        <div class="p-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Status</label>
                            <input type="text" name="name" required placeholder="Contoh: Pegawai Tetap" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                        </div>
                        <div class="px-6 py-4 bg-gray-50 rounded-b-2xl flex justify-end gap-3">
                            <button type="button" @click="showCreateModal = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">Batal</button>
                            <button type="submit" class="px-5 py-2 text-sm font-medium text-white bg-emerald-600 rounded-xl hover:bg-emerald-700 transition-colors shadow-sm">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div x-show="showEditModal" class="fixed inset-0 z-50 overflow-y-auto" style="display:none;">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div x-show="showEditModal" x-transition.opacity class="fixed inset-0 bg-black/40 backdrop-blur-sm" @click="showEditModal = false"></div>
                <div x-show="showEditModal" x-transition.scale.origin.center class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md z-10">
                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900">Edit Status Karyawan</h3>
                    </div>
                    <form :action="`/master/employment-statuses/${editStatus.id}`" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="p-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Status</label>
                            <input type="text" name="name" required x-model="editStatus.name" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                        </div>
                        <div class="px-6 py-4 bg-gray-50 rounded-b-2xl flex justify-end gap-3">
                            <button type="button" @click="showEditModal = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">Batal</button>
                            <button type="submit" class="px-5 py-2 text-sm font-medium text-white bg-emerald-600 rounded-xl hover:bg-emerald-700 transition-colors shadow-sm">Perbarui</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>

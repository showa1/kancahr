<x-app-layout>
    <div class="space-y-6" x-data="{ showCreateModal: false, showEditModal: false, editPos: { id: '', name: '', department_id: '' } }">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <p class="text-xs text-gray-400 font-medium uppercase tracking-widest">Data Master</p>
                <h2 class="text-2xl font-bold text-gray-800 mt-1">Jabatan</h2>
                <p class="text-gray-500 text-sm mt-1">Kelola data jabatan/posisi karyawan di perusahaan.</p>
            </div>
            <button @click="showCreateModal = true" class="bg-emerald-500 hover:bg-emerald-600 text-white font-medium py-2.5 px-5 rounded-xl shadow-sm transition-colors flex items-center gap-2 self-start">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Jabatan
            </button>
        </div>

        <!-- Alert -->
        @if(session('success'))
        <div class="flex items-center gap-3 p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700 text-sm">
            <svg class="w-5 h-5 shrink-0 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            {{ session('success') }}
        </div>
        @endif

        <!-- Table Card -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_2px_15px_-4px_rgba(0,0,0,0.07)] overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="font-bold text-gray-800">Daftar Jabatan</h3>
                <span class="text-xs text-gray-400 bg-gray-100 px-3 py-1 rounded-full font-medium">{{ $positions->count() }} Total</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">#</th>
                            <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">Nama Jabatan</th>
                            <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">Departemen</th>
                            <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">Dibuat</th>
                            <th class="text-right text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($positions as $position)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-400">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl flex items-center justify-center text-white font-bold text-sm" style="background: linear-gradient(135deg, #6366f1, #4f46e5);">{{ strtoupper(substr($position->name, 0, 1)) }}</div>
                                    <span class="font-semibold text-gray-800 text-sm">{{ $position->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($position->department)
                                    <span class="px-3 py-1 bg-blue-50 text-blue-600 text-xs font-bold rounded-lg uppercase tracking-wider">{{ $position->department->code }}</span>
                                    <span class="text-sm text-gray-500 ml-2">{{ $position->department->name }}</span>
                                @else
                                    <span class="text-gray-400 text-sm italic">Semua Departemen</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-400">{{ $position->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button @click="editPos = { id: {{ $position->id }}, name: '{{ $position->name }}', department_id: '{{ $position->department_id }}' }; showEditModal = true" class="p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <form action="{{ route('master.positions.destroy', $position->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jabatan ini?')">
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
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3 text-gray-400">
                                    <svg class="w-12 h-12 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    <p class="text-sm font-medium">Belum ada jabatan</p>
                                    <p class="text-xs">Klik "Tambah Jabatan" untuk menambahkan data pertama.</p>
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
                        <h3 class="text-lg font-bold text-gray-900">Tambah Jabatan Baru</h3>
                        <p class="text-sm text-gray-500 mt-1">Isi data jabatan baru di perusahaan Anda.</p>
                    </div>
                    <form action="{{ route('master.positions.store') }}" method="POST">
                        @csrf
                        <div class="p-6 space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Jabatan</label>
                                <input type="text" name="name" required placeholder="Contoh: Software Engineer" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Departemen <span class="text-gray-400 font-normal">(Opsional)</span></label>
                                <select name="department_id" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                                    <option value="">-- Semua Departemen --</option>
                                    @foreach($departments as $dept)
                                        <option value="{{ $dept->id }}">{{ $dept->name }} ({{ $dept->code }})</option>
                                    @endforeach
                                </select>
                            </div>
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
                        <h3 class="text-lg font-bold text-gray-900">Edit Jabatan</h3>
                    </div>
                    <form :action="`/master/positions/${editPos.id}`" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="p-6 space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Jabatan</label>
                                <input type="text" name="name" required x-model="editPos.name" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Departemen <span class="text-gray-400 font-normal">(Opsional)</span></label>
                                <select name="department_id" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                                    <option value="">-- Semua Departemen --</option>
                                    @foreach($departments as $dept)
                                        <option value="{{ $dept->id }}" :selected="editPos.department_id == '{{ $dept->id }}'">{{ $dept->name }} ({{ $dept->code }})</option>
                                    @endforeach
                                </select>
                            </div>
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

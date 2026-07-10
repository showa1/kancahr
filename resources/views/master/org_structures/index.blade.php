<x-app-layout>
<div class="space-y-6" x-data="{
    view: 'table',
    showCreateModal: false,
    showEditModal: false,
    edit: {}
}">

    {{-- ===== HEADER ===== --}}
    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
        <div>
            <p class="text-xs text-gray-400 font-medium uppercase tracking-widest">Data Master</p>
            <h2 class="text-2xl font-bold text-gray-800 mt-1">Struktur Organisasi</h2>
            <p class="text-gray-500 text-sm mt-1">Kelola hierarki jabatan dan unit kerja perusahaan.</p>
        </div>
        <div class="flex items-center gap-3 flex-wrap">
            {{-- View Toggle --}}
            <div class="flex bg-gray-100 rounded-xl p-1 gap-1">
                <button @click="view = 'table'" :class="view === 'table' ? 'bg-white shadow-sm text-emerald-600' : 'text-gray-500'" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-medium transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 6h18M3 14h18M3 18h18"></path></svg>
                    Tabel
                </button>
                <button @click="view = 'chart'" :class="view === 'chart' ? 'bg-white shadow-sm text-emerald-600' : 'text-gray-500'" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-medium transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    Bagan
                </button>
            </div>
            <button @click="showCreateModal = true" class="bg-emerald-500 hover:bg-emerald-600 text-white font-medium py-2.5 px-5 rounded-xl shadow-sm transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Entri
            </button>
        </div>
    </div>

    {{-- ===== ALERT ===== --}}
    @if(session('success'))
    <div class="flex items-center gap-3 p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700 text-sm">
        <svg class="w-5 h-5 shrink-0 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- ===== TABLE VIEW ===== --}}
    <div x-show="view === 'table'" x-transition>
        <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_2px_15px_-4px_rgba(0,0,0,0.07)] overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="font-bold text-gray-800">Daftar Struktur Organisasi</h3>
                <span class="text-xs text-gray-400 bg-gray-100 px-3 py-1 rounded-full font-medium">{{ $structures->count() }} Entri</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-3">No</th>
                            <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-3">Nomor SK</th>
                            <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-3">Bertanggung Jawab Kepada</th>
                            <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-3">Unit Kerja</th>
                            <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-3">Formasi</th>
                            <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-3">Nama Pegawai</th>
                            <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-3">Jabatan</th>
                            <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-3">Pelaksana Kerja</th>
                            <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-3">Periode</th>
                            <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-3">Urutan</th>
                            <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-3">Status</th>
                            <th class="text-right text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($structures as $s)
                        <tr class="hover:bg-gray-50/60 transition-colors">
                            <td class="px-4 py-3 text-gray-400">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 font-mono text-xs text-gray-700">{{ $s->sk_number ?? '-' }}</td>
                            <td class="px-4 py-3 text-gray-600">
                                @if($s->reportsTo && $s->reportsTo->user)
                                    <div class="flex items-center gap-2">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($s->reportsTo->user->name) }}&size=24&background=e5f6ef&color=059669" class="w-6 h-6 rounded-full" alt="">
                                        <span class="text-xs">{{ $s->reportsTo->user->name }}</span>
                                    </div>
                                @else
                                    <span class="text-gray-300 italic text-xs">— Pimpinan Tertinggi —</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if($s->department)
                                    <span class="px-2.5 py-1 bg-blue-50 text-blue-600 text-xs font-bold rounded-lg">{{ $s->department->code }}</span>
                                    <span class="text-gray-600 text-xs ml-1.5">{{ $s->department->name }}</span>
                                @else
                                    <span class="text-gray-300 text-xs">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-gray-100 text-gray-700 font-bold text-xs">{{ $s->formation }}</span>
                            </td>
                            <td class="px-4 py-3">
                                @if($s->user)
                                <div class="flex items-center gap-2.5">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($s->user->name) }}&size=28&background=10b981&color=fff" class="w-7 h-7 rounded-full border border-emerald-100" alt="">
                                    <div>
                                        <p class="font-semibold text-gray-800 text-xs leading-tight">{{ $s->user->name }}</p>
                                        <p class="text-gray-400 text-xs">{{ $s->user->email }}</p>
                                    </div>
                                </div>
                                @else
                                    <span class="text-gray-300 text-xs italic">Belum diisi</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-gray-700 text-xs">{{ $s->position?->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-gray-600 text-xs">{{ $s->acting_role ?? '-' }}</td>
                            <td class="px-4 py-3 text-xs text-gray-500 whitespace-nowrap">
                                @if($s->period_start)
                                    {{ $s->period_start->format('d M Y') }}
                                    @if($s->period_end)
                                        <br><span class="text-gray-400">s/d {{ $s->period_end->format('d M Y') }}</span>
                                    @endif
                                @else
                                    <span class="text-gray-300">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-purple-50 text-purple-700 font-bold text-xs">{{ $s->sort_order }}</span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                @if($s->status === 'aktif')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-emerald-50 text-emerald-700 text-xs font-semibold rounded-full">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-gray-100 text-gray-500 text-xs font-semibold rounded-full">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> Non-aktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <button @click="edit = {
                                        id: {{ $s->id }},
                                        sk_number: '{{ $s->sk_number }}',
                                        user_id: '{{ $s->user_id }}',
                                        department_id: '{{ $s->department_id }}',
                                        position_id: '{{ $s->position_id }}',
                                        reports_to_id: '{{ $s->reports_to_id }}',
                                        acting_role: '{{ $s->acting_role }}',
                                        formation: '{{ $s->formation }}',
                                        sort_order: '{{ $s->sort_order }}',
                                        period_start: '{{ $s->period_start?->format('Y-m-d') }}',
                                        period_end: '{{ $s->period_end?->format('Y-m-d') }}',
                                        status: '{{ $s->status }}'
                                    }; showEditModal = true"
                                    class="p-1.5 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <form action="{{ route('master.org-structures.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus entri ini?')">
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
                            <td colspan="12" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3 text-gray-400">
                                    <svg class="w-14 h-14 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                    <p class="font-medium">Belum ada data struktur organisasi</p>
                                    <p class="text-xs text-gray-400">Mulai tambahkan entri untuk memetakan hierarki perusahaan Anda.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ===== CHART VIEW ===== --}}
    <div x-show="view === 'chart'" x-transition>
        <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_2px_15px_-4px_rgba(0,0,0,0.07)] p-8">
            <h3 class="font-bold text-gray-800 mb-8 text-center text-lg">Bagan Struktur Organisasi</h3>

            @php
                // Build tree: find root nodes (no reports_to_id)
                $roots = $structures->whereNull('reports_to_id')->sortBy('sort_order');
                function renderOrgTree($nodes, $allStructures, $depth = 0) {
                    if ($nodes->isEmpty()) return;
                    $isRoot = $depth === 0;
                    $colors = [
                        0 => ['bg' => 'bg-emerald-600', 'text' => 'text-white', 'border' => 'border-emerald-600', 'badge' => 'bg-emerald-100 text-emerald-700'],
                        1 => ['bg' => 'bg-blue-500', 'text' => 'text-white', 'border' => 'border-blue-500', 'badge' => 'bg-blue-100 text-blue-700'],
                        2 => ['bg' => 'bg-purple-500', 'text' => 'text-white', 'border' => 'border-purple-500', 'badge' => 'bg-purple-100 text-purple-700'],
                        3 => ['bg' => 'bg-amber-500', 'text' => 'text-white', 'border' => 'border-amber-500', 'badge' => 'bg-amber-100 text-amber-700'],
                    ];
                    $color = $colors[min($depth, 3)];
                    echo '<div class="flex flex-col items-center gap-0">';
                    echo '<div class="flex flex-wrap justify-center gap-6 relative">';
                    foreach ($nodes as $node) {
                        $children = $allStructures->where('reports_to_id', $node->id)->sortBy('sort_order');
                        echo '<div class="flex flex-col items-center">';
                        // Card
                        echo '<div class="relative group">';
                        echo '<div class="bg-white border-2 ' . $color['border'] . ' rounded-2xl shadow-md w-44 overflow-hidden transition-all hover:shadow-lg hover:-translate-y-0.5">';
                        echo '<div class="' . $color['bg'] . ' px-3 py-2 text-center">';
                        echo '<p class="' . $color['text'] . ' text-xs font-bold truncate">' . e($node->department?->name ?? 'N/A') . '</p>';
                        echo '</div>';
                        echo '<div class="p-3 text-center">';
                        if ($node->user) {
                            echo '<img src="https://ui-avatars.com/api/?name=' . urlencode($node->user->name) . '&size=40&background=e5f6ef&color=059669" class="w-10 h-10 rounded-full mx-auto mb-2 border-2 border-gray-100" alt="">';
                            echo '<p class="font-bold text-gray-800 text-xs leading-tight">' . e($node->user->name) . '</p>';
                        } else {
                            echo '<div class="w-10 h-10 rounded-full mx-auto mb-2 bg-gray-100 flex items-center justify-center"><svg class=\"w-5 h-5 text-gray-300\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z\"/></svg></div>';
                            echo '<p class="font-bold text-gray-400 text-xs italic">Kosong</p>';
                        }
                        echo '<p class="text-gray-500 text-xs mt-1 truncate">' . e($node->position?->name ?? '-') . '</p>';
                        if ($node->status === 'aktif') {
                            echo '<span class="inline-block mt-1.5 px-2 py-0.5 ' . $color['badge'] . ' text-xs font-semibold rounded-full">Aktif</span>';
                        } else {
                            echo '<span class="inline-block mt-1.5 px-2 py-0.5 bg-gray-100 text-gray-400 text-xs font-semibold rounded-full">Non-aktif</span>';
                        }
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';

                        if ($children->isNotEmpty()) {
                            // Connector line down
                            echo '<div class="w-0.5 h-6 bg-gray-200 mx-auto"></div>';
                            // Render children
                            renderOrgTree($children, $allStructures, $depth + 1);
                        }
                        echo '</div>'; // end node col
                    }
                    echo '</div>';
                    echo '</div>';
                }
            @endphp

            @if($roots->isEmpty())
                <div class="text-center py-12 text-gray-400">
                    <svg class="w-16 h-16 text-gray-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    <p class="font-medium">Belum ada data untuk ditampilkan sebagai bagan.</p>
                    <p class="text-sm mt-1">Tambahkan entri terlebih dahulu melalui tampilan Tabel.</p>
                </div>
            @else
                <div class="overflow-x-auto pb-4">
                    <?php renderOrgTree($roots, $structures); ?>
                </div>
            @endif
        </div>
    </div>

    {{-- ===== MODAL TAMBAH ===== --}}
    <div x-show="showCreateModal" class="fixed inset-0 z-50 overflow-y-auto" style="display:none;">
        <div class="flex items-center justify-center min-h-screen px-4 py-8">
            <div x-show="showCreateModal" x-transition.opacity class="fixed inset-0 bg-black/40 backdrop-blur-sm" @click="showCreateModal = false"></div>
            <div x-show="showCreateModal" x-transition.scale.origin.center class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl z-10">
                <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Tambah Struktur Organisasi</h3>
                        <p class="text-sm text-gray-500 mt-0.5">Isi detail posisi dalam hierarki organisasi.</p>
                    </div>
                    <button @click="showCreateModal = false" class="text-gray-400 hover:text-gray-600 p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <form action="{{ route('master.org-structures.store') }}" method="POST">
                    @csrf
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4 max-h-[65vh] overflow-y-auto">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Nomor SK</label>
                            <input type="text" name="sk_number" placeholder="Contoh: 001/SK/DIR/2025" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Bertanggung Jawab Kepada</label>
                            <select name="reports_to_id" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                                <option value="">— Pimpinan Tertinggi —</option>
                                @foreach($structures as $parent)
                                    <option value="{{ $parent->id }}">{{ $parent->user?->name ?? 'N/A' }} ({{ $parent->position?->name ?? '-' }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Pegawai</label>
                            <select name="user_id" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                                <option value="">— Pilih Pegawai —</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Unit Kerja / Departemen</label>
                            <select name="department_id" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                                <option value="">— Pilih Departemen —</option>
                                @foreach($departments as $dept)
                                    <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Jabatan</label>
                            <select name="position_id" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                                <option value="">— Pilih Jabatan —</option>
                                @foreach($positions as $pos)
                                    <option value="{{ $pos->id }}">{{ $pos->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Pelaksana Kerja</label>
                            <input type="text" name="acting_role" placeholder="Contoh: Pj. Koordinator IGD" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Formasi (Kuota)</label>
                            <input type="number" name="formation" value="1" min="1" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Urutan Tampil</label>
                            <input type="number" name="sort_order" value="1" min="1" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal Mulai</label>
                            <input type="date" name="period_start" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal Berakhir</label>
                            <input type="date" name="period_end" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Status</label>
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
                        <button type="submit" class="px-6 py-2 text-sm font-medium text-white bg-emerald-600 rounded-xl hover:bg-emerald-700 transition-colors shadow-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ===== MODAL EDIT ===== --}}
    <div x-show="showEditModal" class="fixed inset-0 z-50 overflow-y-auto" style="display:none;">
        <div class="flex items-center justify-center min-h-screen px-4 py-8">
            <div x-show="showEditModal" x-transition.opacity class="fixed inset-0 bg-black/40 backdrop-blur-sm" @click="showEditModal = false"></div>
            <div x-show="showEditModal" x-transition.scale.origin.center class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl z-10">
                <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Edit Struktur Organisasi</h3>
                        <p class="text-sm text-gray-500 mt-0.5">Perbarui data posisi dalam hierarki.</p>
                    </div>
                    <button @click="showEditModal = false" class="text-gray-400 hover:text-gray-600 p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <form :action="`/master/org-structures/${edit.id}`" method="POST">
                    @csrf @method('PUT')
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4 max-h-[65vh] overflow-y-auto">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Nomor SK</label>
                            <input type="text" name="sk_number" x-model="edit.sk_number" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Bertanggung Jawab Kepada</label>
                            <select name="reports_to_id" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                                <option value="">— Pimpinan Tertinggi —</option>
                                @foreach($structures as $parent)
                                    <option value="{{ $parent->id }}" :selected="edit.reports_to_id == '{{ $parent->id }}'">{{ $parent->user?->name ?? 'N/A' }} ({{ $parent->position?->name ?? '-' }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Pegawai</label>
                            <select name="user_id" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                                <option value="">— Pilih Pegawai —</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" :selected="edit.user_id == '{{ $user->id }}'">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Unit Kerja / Departemen</label>
                            <select name="department_id" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                                <option value="">— Pilih Departemen —</option>
                                @foreach($departments as $dept)
                                    <option value="{{ $dept->id }}" :selected="edit.department_id == '{{ $dept->id }}'">{{ $dept->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Jabatan</label>
                            <select name="position_id" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                                <option value="">— Pilih Jabatan —</option>
                                @foreach($positions as $pos)
                                    <option value="{{ $pos->id }}" :selected="edit.position_id == '{{ $pos->id }}'">{{ $pos->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Pelaksana Kerja</label>
                            <input type="text" name="acting_role" x-model="edit.acting_role" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Formasi (Kuota)</label>
                            <input type="number" name="formation" x-model="edit.formation" min="1" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Urutan Tampil</label>
                            <input type="number" name="sort_order" x-model="edit.sort_order" min="1" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal Mulai</label>
                            <input type="date" name="period_start" x-model="edit.period_start" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal Berakhir</label>
                            <input type="date" name="period_end" x-model="edit.period_end" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm px-4 py-2.5">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Status</label>
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
                        <button type="submit" class="px-6 py-2 text-sm font-medium text-white bg-emerald-600 rounded-xl hover:bg-emerald-700 transition-colors shadow-sm">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
</x-app-layout>

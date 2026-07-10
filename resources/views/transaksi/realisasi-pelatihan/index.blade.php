<x-app-layout>
    <div class="space-y-6">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">TRANSAKSI</p>
                <h1 class="text-2xl font-bold text-gray-800">Realisasi Pelatihan</h1>
                <p class="text-sm text-gray-500 mt-1">Catatan pelaksanaan dan hasil pelatihan yang telah dijalankan.</p>
            </div>
            <button class="inline-flex items-center gap-2 text-sm font-semibold text-white px-4 py-2 rounded-xl shadow-sm cursor-not-allowed opacity-70" style="background:linear-gradient(135deg,#10b981,#059669);" disabled>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Data
                <span class="text-[10px] bg-white bg-opacity-25 px-1.5 py-0.5 rounded-full ml-1">Segera</span>
            </button>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Total Program</p>
                <p class="text-3xl font-bold text-gray-800">0</p>
            </div>
            <div class="rounded-2xl p-5 border shadow-sm bg-indigo-50 border-indigo-100 text-indigo-600">
                <p class="text-xs font-semibold uppercase tracking-wider mb-2 opacity-80">Selesai</p>
                <p class="text-3xl font-bold">0</p>
            </div>
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Peserta Lulus</p>
                <p class="text-3xl font-bold text-gray-800">0</p>
            </div>
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Rata-rata Nilai</p>
                <p class="text-3xl font-bold text-gray-800">0</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="font-bold text-gray-800">Realisasi Pelatihan</h3>
                <div class="relative">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="text" placeholder="Cari..." class="pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-300">
                </div>
            </div>
            <div class="py-20 text-center">
                <div class="w-16 h-16 rounded-2xl mx-auto mb-4 flex items-center justify-center" style="background:#f0fdf4;">
                    <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d=""></path>
                    </svg>
                </div>
                <p class="font-semibold text-gray-600">Belum ada data Realisasi Pelatihan</p>
                <p class="text-sm text-gray-400 mt-1">Data akan ditampilkan di sini setelah fitur CRUD aktif.</p>
                <div class="mt-4 inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-full" style="background:#fef3c7; color:#92400e;">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Fitur CRUD segera hadir
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

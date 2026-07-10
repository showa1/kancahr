<aside :class="sidebarOpen ? 'w-64' : 'w-20'" class="bg-white flex flex-col h-screen border-r border-gray-100 transition-all duration-300 z-20 shrink-0 relative shadow-sm">
    <!-- Brand / Logo -->
    <div class="h-20 flex items-center px-6 shrink-0" :class="sidebarOpen ? 'justify-start' : 'justify-center'">
        <svg class="w-8 h-8 text-emerald-600 shrink-0" :class="sidebarOpen ? 'mr-3' : ''" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <!-- Clover-like logo to match inspiration -->
            <path d="M12 2C9.5 2 7.5 4 7.5 6.5C7.5 7.7 8 8.8 8.8 9.5C8 10.2 7.5 11.3 7.5 12.5C7.5 15 9.5 17 12 17C14.5 17 16.5 15 16.5 12.5C16.5 11.3 16 10.2 15.2 9.5C16 8.8 16.5 7.7 16.5 6.5C16.5 4 14.5 2 12 2ZM12 4C13.4 4 14.5 5.1 14.5 6.5C14.5 7.9 13.4 9 12 9C10.6 9 9.5 7.9 9.5 6.5C9.5 5.1 10.6 4 12 4ZM12 11C13.4 11 14.5 12.1 14.5 13.5C14.5 14.9 13.4 16 12 16C10.6 16 9.5 14.9 9.5 13.5C9.5 12.1 10.6 11 12 11Z" clip-rule="evenodd" fill-rule="evenodd"></path>
            <path d="M11 16H13V22H11V16Z"></path>
        </svg>
        <span x-show="sidebarOpen" x-transition.opacity.duration.300ms class="text-xl font-bold tracking-tight text-gray-800">Kanca<span class="text-emerald-600">HR</span></span>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 overflow-y-auto sidebar-scroll py-2 px-4 space-y-1.5">
        
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" class="flex items-center py-2.5 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-emerald-600 text-white shadow-md shadow-emerald-600/20' : 'text-gray-500 hover:bg-gray-50 hover:text-emerald-600' }} group transition-all font-medium" :class="sidebarOpen ? 'px-4' : 'justify-center'">
            <svg class="w-5 h-5 shrink-0 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-400 group-hover:text-emerald-500' }}" :class="sidebarOpen ? 'mr-3' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
            </svg>
            <span x-show="sidebarOpen" x-transition.opacity.duration.300ms class="text-sm whitespace-nowrap">Dashboard</span>
        </a>

        <!-- Master Data -->
        <div x-data="{ masterOpen: false }" class="relative">
            <button @click="masterOpen = !masterOpen" class="w-full flex items-center py-2.5 rounded-xl text-gray-500 hover:bg-gray-50 hover:text-emerald-600 group transition-all font-medium" :class="sidebarOpen ? 'px-4 justify-between' : 'justify-center'">
                <div class="flex items-center" :class="sidebarOpen ? '' : 'justify-center w-full'">
                    <svg class="w-5 h-5 shrink-0 text-gray-400 group-hover:text-emerald-500" :class="sidebarOpen ? 'mr-3' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
                    </svg>
                    <span x-show="sidebarOpen" x-transition.opacity.duration.300ms class="text-sm whitespace-nowrap">Data Master</span>
                </div>
                <svg x-show="sidebarOpen" class="w-4 h-4 transition-transform duration-200" :class="masterOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
            <div x-show="masterOpen && sidebarOpen" x-transition class="pl-4 pr-4 py-2 space-y-1">
                <a href="{{ route('master.departments.index') }}" class="flex items-center gap-2.5 text-sm py-2 px-3 rounded-xl transition-colors {{ request()->routeIs('master.departments.*') ? 'text-emerald-600 font-semibold bg-emerald-50' : 'text-gray-500 hover:text-emerald-600 hover:bg-gray-50' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    Departemen
                </a>
                <a href="{{ route('master.positions.index') }}" class="flex items-center gap-2.5 text-sm py-2 px-3 rounded-xl transition-colors {{ request()->routeIs('master.positions.*') ? 'text-emerald-600 font-semibold bg-emerald-50' : 'text-gray-500 hover:text-emerald-600 hover:bg-gray-50' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    Jabatan
                </a>
                <a href="{{ route('master.employment-statuses.index') }}" class="flex items-center gap-2.5 text-sm py-2 px-3 rounded-xl transition-colors {{ request()->routeIs('master.employment-statuses.*') ? 'text-emerald-600 font-semibold bg-emerald-50' : 'text-gray-500 hover:text-emerald-600 hover:bg-gray-50' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                    Status Karyawan
                </a>
                <a href="{{ route('master.org-structures.index') }}" class="flex items-center gap-2.5 text-sm py-2 px-3 rounded-xl transition-colors {{ request()->routeIs('master.org-structures.*') ? 'text-emerald-600 font-semibold bg-emerald-50' : 'text-gray-500 hover:text-emerald-600 hover:bg-gray-50' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9"></path></svg>
                    Struktur Organisasi
                </a>
                <a href="{{ route('master.shifts.index') }}" class="flex items-center gap-2.5 text-sm py-2 px-3 rounded-xl transition-colors {{ request()->routeIs('master.shifts.*') ? 'text-emerald-600 font-semibold bg-emerald-50' : 'text-gray-500 hover:text-emerald-600 hover:bg-gray-50' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Master Shift
                </a>
                <a href="{{ route('master.attendance.index') }}" class="flex items-center gap-2.5 text-sm py-2 px-3 rounded-xl transition-colors {{ request()->routeIs('master.attendance*') ? 'text-emerald-600 font-semibold bg-emerald-50' : 'text-gray-500 hover:text-emerald-600 hover:bg-gray-50' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path></svg>
                    Master Presensi
                    <span class="ml-auto text-[10px] font-bold bg-violet-100 text-violet-600 px-1.5 py-0.5 rounded-full">Baru</span>
                </a>
            </div>
        </div>

        {{-- ===== TRANSAKSI ===== --}}
        <div x-data="{ transaksiOpen: {{ request()->is('transaksi/*') ? 'true' : 'false' }} }" class="relative">
            <button @click="transaksiOpen = !transaksiOpen" class="w-full flex items-center py-2.5 rounded-xl text-gray-500 hover:bg-gray-50 hover:text-emerald-600 group transition-all font-medium" :class="sidebarOpen ? 'px-4 justify-between' : 'justify-center'">
                <div class="flex items-center" :class="sidebarOpen ? '' : 'justify-center w-full'">
                    <svg class="w-5 h-5 shrink-0 text-gray-400 group-hover:text-emerald-500" :class="sidebarOpen ? 'mr-3' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span x-show="sidebarOpen" x-transition.opacity.duration.300ms class="text-sm whitespace-nowrap">Transaksi</span>
                </div>
                <svg x-show="sidebarOpen" class="w-4 h-4 transition-transform duration-200" :class="transaksiOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
            <div x-show="transaksiOpen && sidebarOpen" x-transition class="pl-4 pr-4 py-2 space-y-0.5">
                {{-- 1. Jadwal Kerja --}}
                <a href="{{ route('transaksi.jadwal.index') }}" class="flex items-center gap-2.5 text-sm py-2 px-3 rounded-xl transition-colors {{ request()->routeIs('transaksi.jadwal*') ? 'text-emerald-600 font-semibold bg-emerald-50' : 'text-gray-500 hover:text-emerald-600 hover:bg-gray-50' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Jadwal Kerja
                </a>
                {{-- 2. Data Karyawan --}}
                <a href="{{ route('transaksi.karyawan.index') }}" class="flex items-center gap-2.5 text-sm py-2 px-3 rounded-xl transition-colors {{ request()->routeIs('transaksi.karyawan*') ? 'text-emerald-600 font-semibold bg-emerald-50' : 'text-gray-500 hover:text-emerald-600 hover:bg-gray-50' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Data Karyawan
                </a>
                {{-- 3. Riwayat Karyawan --}}
                <a href="{{ route('transaksi.riwayat.index') }}" class="flex items-center gap-2.5 text-sm py-2 px-3 rounded-xl transition-colors {{ request()->routeIs('transaksi.riwayat*') ? 'text-emerald-600 font-semibold bg-emerald-50' : 'text-gray-500 hover:text-emerald-600 hover:bg-gray-50' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Riwayat Karyawan
                </a>
                {{-- 4. Rekrutmen --}}
                <a href="{{ route('transaksi.rekrutmen.index') }}" class="flex items-center gap-2.5 text-sm py-2 px-3 rounded-xl transition-colors {{ request()->routeIs('transaksi.rekrutmen*') ? 'text-emerald-600 font-semibold bg-emerald-50' : 'text-gray-500 hover:text-emerald-600 hover:bg-gray-50' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    Rekrutmen
                </a>
                {{-- 5. Rencana Rekrutmen --}}
                <a href="{{ route('transaksi.rencana-rekrutmen.index') }}" class="flex items-center gap-2.5 text-sm py-2 px-3 rounded-xl transition-colors {{ request()->routeIs('transaksi.rencana-rekrutmen*') ? 'text-emerald-600 font-semibold bg-emerald-50' : 'text-gray-500 hover:text-emerald-600 hover:bg-gray-50' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Rencana Rekrutmen
                </a>
                {{-- 6. Registrasi Perangkat --}}
                <a href="{{ route('transaksi.registrasi-perangkat.index') }}" class="flex items-center gap-2.5 text-sm py-2 px-3 rounded-xl transition-colors {{ request()->routeIs('transaksi.registrasi-perangkat*') ? 'text-emerald-600 font-semibold bg-emerald-50' : 'text-gray-500 hover:text-emerald-600 hover:bg-gray-50' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path></svg>
                    Registrasi Perangkat
                </a>
                {{-- 7. Presensi --}}
                <a href="{{ route('transaksi.presensi.index') }}" class="flex items-center gap-2.5 text-sm py-2 px-3 rounded-xl transition-colors {{ request()->routeIs('transaksi.presensi*') ? 'text-emerald-600 font-semibold bg-emerald-50' : 'text-gray-500 hover:text-emerald-600 hover:bg-gray-50' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Presensi
                </a>
                {{-- 8. Rencana Pelatihan --}}
                <a href="{{ route('transaksi.rencana-pelatihan.index') }}" class="flex items-center gap-2.5 text-sm py-2 px-3 rounded-xl transition-colors {{ request()->routeIs('transaksi.rencana-pelatihan*') ? 'text-emerald-600 font-semibold bg-emerald-50' : 'text-gray-500 hover:text-emerald-600 hover:bg-gray-50' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    Rencana Pelatihan
                </a>
                {{-- 9. Realisasi Pelatihan --}}
                <a href="{{ route('transaksi.realisasi-pelatihan.index') }}" class="flex items-center gap-2.5 text-sm py-2 px-3 rounded-xl transition-colors {{ request()->routeIs('transaksi.realisasi-pelatihan*') ? 'text-emerald-600 font-semibold bg-emerald-50' : 'text-gray-500 hover:text-emerald-600 hover:bg-gray-50' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Realisasi Pelatihan
                </a>
                {{-- 10. Penilaian Kinerja --}}
                <a href="{{ route('transaksi.penilaian.index') }}" class="flex items-center gap-2.5 text-sm py-2 px-3 rounded-xl transition-colors {{ request()->routeIs('transaksi.penilaian*') ? 'text-emerald-600 font-semibold bg-emerald-50' : 'text-gray-500 hover:text-emerald-600 hover:bg-gray-50' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                    Penilaian Kinerja
                </a>
                {{-- 11. Mutasi Jabatan --}}
                <a href="{{ route('transaksi.mutasi.index') }}" class="flex items-center gap-2.5 text-sm py-2 px-3 rounded-xl transition-colors {{ request()->routeIs('transaksi.mutasi*') ? 'text-emerald-600 font-semibold bg-emerald-50' : 'text-gray-500 hover:text-emerald-600 hover:bg-gray-50' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                    Mutasi Jabatan
                </a>
                {{-- 12. Promosi Karyawan --}}
                <a href="{{ route('transaksi.promosi.index') }}" class="flex items-center gap-2.5 text-sm py-2 px-3 rounded-xl transition-colors {{ request()->routeIs('transaksi.promosi*') ? 'text-emerald-600 font-semibold bg-emerald-50' : 'text-gray-500 hover:text-emerald-600 hover:bg-gray-50' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    Promosi Karyawan
                </a>
            </div>
        </div>

        <!-- Onboarding/Offboarding -->
        <a href="{{ route('onboarding.index') }}" class="flex items-center py-2.5 rounded-xl text-gray-500 hover:bg-gray-50 hover:text-emerald-600 group transition-all font-medium" :class="sidebarOpen ? 'px-4' : 'justify-center'">
            <svg class="w-5 h-5 shrink-0 text-gray-400 group-hover:text-emerald-500" :class="sidebarOpen ? 'mr-3' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
            </svg>
            <span x-show="sidebarOpen" x-transition.opacity.duration.300ms class="text-sm whitespace-nowrap">Orientasi</span>
        </a>

        <!-- Employees -->
        <a href="#" class="flex items-center py-2.5 rounded-xl text-gray-500 hover:bg-gray-50 hover:text-emerald-600 group transition-all font-medium" :class="sidebarOpen ? 'px-4' : 'justify-center'">
            <svg class="w-5 h-5 shrink-0 text-gray-400 group-hover:text-emerald-500" :class="sidebarOpen ? 'mr-3' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <span x-show="sidebarOpen" x-transition.opacity.duration.300ms class="text-sm whitespace-nowrap">Karyawan</span>
        </a>

        <!-- Time Off -->
        <a href="#" class="flex items-center py-2.5 rounded-xl text-gray-500 hover:bg-gray-50 hover:text-emerald-600 group transition-all font-medium" :class="sidebarOpen ? 'px-4' : 'justify-center'">
            <svg class="w-5 h-5 shrink-0 text-gray-400 group-hover:text-emerald-500" :class="sidebarOpen ? 'mr-3' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span x-show="sidebarOpen" x-transition.opacity.duration.300ms class="text-sm whitespace-nowrap">Cuti</span>
        </a>

        <!-- Performance Reviews -->
        <a href="#" class="flex items-center py-2.5 rounded-xl text-gray-500 hover:bg-gray-50 hover:text-emerald-600 group transition-all font-medium" :class="sidebarOpen ? 'px-4' : 'justify-center'">
            <svg class="w-5 h-5 shrink-0 text-gray-400 group-hover:text-emerald-500" :class="sidebarOpen ? 'mr-3' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            <span x-show="sidebarOpen" x-transition.opacity.duration.300ms class="text-sm whitespace-nowrap">Performa</span>
        </a>

        <div class="py-2 border-t border-gray-100 my-2"></div>

        <!-- Settings -->
        <a href="{{ route('profile.edit') }}" class="flex items-center py-2.5 rounded-xl text-gray-500 hover:bg-gray-50 hover:text-emerald-600 group transition-all font-medium" :class="sidebarOpen ? 'px-4' : 'justify-center'">
            <svg class="w-5 h-5 shrink-0 text-gray-400 group-hover:text-emerald-500" :class="sidebarOpen ? 'mr-3' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span x-show="sidebarOpen" x-transition.opacity.duration.300ms class="text-sm whitespace-nowrap">Pengaturan</span>
        </a>
    </nav>
    {{-- Animated Bot Character --}}
    <div x-show="sidebarOpen" x-transition.opacity.duration.400ms class="shrink-0 flex flex-col items-center pb-4 pt-2 select-none">
        <style>
            @keyframes khr-float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-8px); }
            }
            @keyframes khr-wave {
                0%, 100% { transform: rotate(0deg); transform-origin: bottom right; }
                20% { transform: rotate(20deg); transform-origin: bottom right; }
                40% { transform: rotate(-8deg); transform-origin: bottom right; }
                60% { transform: rotate(16deg); transform-origin: bottom right; }
                80% { transform: rotate(-4deg); transform-origin: bottom right; }
            }
            @keyframes khr-blink {
                0%, 90%, 100% { transform: scaleY(1); }
                95% { transform: scaleY(0.1); }
            }
            @keyframes khr-pulse-ring {
                0% { transform: scale(0.8); opacity: 0.6; }
                100% { transform: scale(1.4); opacity: 0; }
            }
            .khr-bot-body { animation: khr-float 3s ease-in-out infinite; }
            .khr-bot-arm-right { animation: khr-wave 2.5s ease-in-out infinite; transform-origin: 10px 4px; }
            .khr-bot-eye { animation: khr-blink 4s ease-in-out infinite; transform-origin: center center; }
            .khr-pulse { animation: khr-pulse-ring 2s ease-out infinite; }
        </style>

        <svg width="90" height="110" viewBox="0 0 90 110" fill="none" xmlns="http://www.w3.org/2000/svg">
            <!-- Shadow / pulse ring -->
            <ellipse class="khr-pulse" cx="45" cy="104" rx="18" ry="5" fill="#10b981" opacity="0.3"/>
            <ellipse cx="45" cy="104" rx="13" ry="3.5" fill="#10b981" opacity="0.2"/>

            <g class="khr-bot-body">
                <!-- Antenna -->
                <line x1="45" y1="8" x2="45" y2="18" stroke="#10b981" stroke-width="2.5" stroke-linecap="round"/>
                <circle cx="45" cy="6" r="4" fill="#10b981"/>
                <circle cx="45" cy="6" r="2" fill="white"/>

                <!-- Head -->
                <rect x="20" y="18" width="50" height="36" rx="12" fill="#ecfdf5" stroke="#10b981" stroke-width="2"/>

                <!-- Eyes -->
                <g class="khr-bot-eye">
                    <rect x="29" y="28" width="10" height="10" rx="3" fill="#10b981"/>
                    <rect x="31" y="30" width="4" height="4" rx="1.5" fill="white"/>
                </g>
                <g class="khr-bot-eye">
                    <rect x="51" y="28" width="10" height="10" rx="3" fill="#10b981"/>
                    <rect x="53" y="30" width="4" height="4" rx="1.5" fill="white"/>
                </g>

                <!-- Mouth smile -->
                <path d="M35 44 Q45 51 55 44" stroke="#10b981" stroke-width="2" stroke-linecap="round" fill="none"/>

                <!-- Body -->
                <rect x="24" y="57" width="42" height="32" rx="10" fill="#ecfdf5" stroke="#10b981" stroke-width="2"/>

                <!-- Chest screen -->
                <rect x="32" y="63" width="26" height="16" rx="5" fill="#10b981" opacity="0.15" stroke="#10b981" stroke-width="1.5"/>
                <rect x="36" y="66" width="8" height="3" rx="1.5" fill="#10b981" opacity="0.7"/>
                <rect x="36" y="71" width="14" height="3" rx="1.5" fill="#10b981" opacity="0.5"/>
                <rect x="36" y="76" width="10" height="2" rx="1" fill="#10b981" opacity="0.4"/>

                <!-- Left arm (static) -->
                <rect x="10" y="59" width="12" height="22" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="2"/>
                <circle cx="16" cy="83" r="5" fill="#ecfdf5" stroke="#10b981" stroke-width="2"/>

                <!-- Right arm (waving) -->
                <g class="khr-bot-arm-right" style="transform-origin: 64px 62px;">
                    <rect x="64" y="59" width="12" height="22" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="2"/>
                    <circle cx="70" cy="83" r="5" fill="#ecfdf5" stroke="#10b981" stroke-width="2"/>
                </g>

                <!-- Legs -->
                <rect x="31" y="90" width="11" height="16" rx="5" fill="#ecfdf5" stroke="#10b981" stroke-width="2"/>
                <rect x="48" y="90" width="11" height="16" rx="5" fill="#ecfdf5" stroke="#10b981" stroke-width="2"/>
                <!-- Feet -->
                <rect x="28" y="102" width="16" height="7" rx="3.5" fill="#10b981"/>
                <rect x="46" y="102" width="16" height="7" rx="3.5" fill="#10b981"/>
            </g>
        </svg>

        <p x-show="sidebarOpen" class="text-xs text-emerald-600 font-semibold mt-1 tracking-wide">KancaBot</p>
        <p x-show="sidebarOpen" class="text-[10px] text-gray-400 mt-0.5">Siap membantu! 👋</p>
    </div>


</aside>

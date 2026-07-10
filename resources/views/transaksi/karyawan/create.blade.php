<x-app-layout>
<div x-data="{
    activeSection: 'pribadi',
    photoPreview: null,
    employeeType: 'tetap',
    scrollTo(id) {
        document.getElementById(id).scrollIntoView({ behavior: 'smooth', block: 'start' });
        this.activeSection = id;
    }
}" class="flex gap-6 relative">

    {{-- ═══════════════ STICKY SIDEBAR NAV ═══════════════ --}}
    <div class="hidden lg:block w-52 shrink-0">
        <div class="sticky top-6">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-100" style="background:linear-gradient(135deg,#10b981,#059669);">
                <p class="text-xs font-bold text-white uppercase tracking-widest">Navigasi Form</p>
            </div>
            <nav class="py-2">
                @foreach([
                    ['id'=>'pribadi',      'label'=>'Data Pribadi',     'icon'=>'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                    ['id'=>'kontak',       'label'=>'Alamat & Kontak',  'icon'=>'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z'],
                    ['id'=>'kepegawaian',  'label'=>'Kepegawaian',      'icon'=>'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                    ['id'=>'keuangan',     'label'=>'Keuangan & BPJS',  'icon'=>'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z'],
                    ['id'=>'tambahan',     'label'=>'Data Tambahan',    'icon'=>'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                    ['id'=>'foto',         'label'=>'Foto & Kontrak',   'icon'=>'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'],
                ] as $nav)
                <button type="button" @click="scrollTo('{{ $nav['id'] }}')"
                    :class="activeSection === '{{ $nav['id'] }}' ? 'text-emerald-600 bg-emerald-50 font-semibold' : 'text-gray-500 hover:text-emerald-600 hover:bg-gray-50'"
                    class="w-full flex items-center gap-2.5 px-4 py-2.5 text-sm transition-colors text-left">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $nav['icon'] }}"></path>
                    </svg>
                    {{ $nav['label'] }}
                </button>
                @endforeach
            </nav>
        </div>

        {{-- Action Buttons --}}
        <div class="mt-4 space-y-2">
            <button type="submit" form="form-karyawan"
                class="w-full flex items-center justify-center gap-2 text-sm font-bold text-white py-2.5 rounded-xl shadow-sm transition"
                style="background:linear-gradient(135deg,#10b981,#059669);">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                Simpan Karyawan
            </button>
            <a href="{{ route('transaksi.karyawan.index') }}"
                class="w-full flex items-center justify-center gap-2 text-sm font-medium text-gray-500 py-2.5 rounded-xl border border-gray-200 hover:bg-gray-50 transition">
                Batal
            </a>
        </div>
        </div>
    </div>

    {{-- ═══════════════ MAIN FORM ═══════════════ --}}
    <div class="flex-1 min-w-0">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-6 flex-wrap gap-3">
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">TRANSAKSI › DATA KARYAWAN</p>
                <h1 class="text-2xl font-bold text-gray-800">Tambah Karyawan Baru</h1>
                <p class="text-sm text-gray-500 mt-1">Lengkapi semua data untuk mendaftarkan karyawan baru.</p>
            </div>
            <div class="flex items-center gap-2 lg:hidden">
                <button type="submit" form="form-karyawan"
                    class="inline-flex items-center gap-2 text-sm font-bold text-white px-4 py-2 rounded-xl"
                    style="background:linear-gradient(135deg,#10b981,#059669);">
                    Simpan
                </button>
                <a href="{{ route('transaksi.karyawan.index') }}" class="text-sm text-gray-500 px-4 py-2 rounded-xl border border-gray-200">Batal</a>
            </div>
        </div>

        @if($errors->any())
        <div class="mb-4 p-4 rounded-2xl bg-red-50 border border-red-100">
            <p class="text-sm font-semibold text-red-700 mb-1">Terdapat kesalahan:</p>
            <ul class="text-sm text-red-600 list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form id="form-karyawan" method="POST" action="{{ route('transaksi.karyawan.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- ═══ SEKSI 1: DATA PRIBADI ═══ --}}
            <div id="pribadi" class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden scroll-mt-6">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3" style="background:linear-gradient(135deg,#f0fdf4,#dcfce7);">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background-color:#10b981;">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-gray-800">Data Pribadi</h2>
                        <p class="text-xs text-gray-500">Informasi identitas dan biodata karyawan</p>
                    </div>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">

                    {{-- NIK --}}
                    <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">NIK Karyawan <span class="text-red-500">*</span></label>
                            <input type="text" name="nik" value="{{ old('nik') }}" placeholder="Nomor Induk Karyawan"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 focus:border-emerald-400 @error('nik') border-red-300 @enderror">
                            @error('nik')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">No. Identitas</label>
                            <div class="flex gap-2">
                                <select name="identity_type" class="px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 bg-gray-50">
                                    <option value="ktp" {{ old('identity_type')=='ktp'?'selected':'' }}>KTP</option>
                                    <option value="sim" {{ old('identity_type')=='sim'?'selected':'' }}>SIM</option>
                                    <option value="passport" {{ old('identity_type')=='passport'?'selected':'' }}>Passport</option>
                                </select>
                                <input type="text" name="identity_number" value="{{ old('identity_number') }}" placeholder="Nomor Identitas"
                                    class="flex-1 px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                            </div>
                        </div>
                    </div>

                    {{-- Gelar Depan --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Gelar Depan</label>
                        <select name="prefix_title" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 bg-white">
                            <option value="">-- Pilih --</option>
                            @foreach(['dr.','drg.','Prof.','Dr.','Ir.','Drs.','Hj.','H.'] as $t)
                            <option value="{{ $t }}" {{ old('prefix_title')==$t?'selected':'' }}>{{ $t }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Nama Lengkap --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="full_name" value="{{ old('full_name') }}" placeholder="Nama lengkap sesuai identitas"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 @error('full_name') border-red-300 @enderror">
                        @error('full_name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Inisial --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Inisial</label>
                        <input type="text" name="initials" value="{{ old('initials') }}" placeholder="cth: BDW" maxlength="10"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                    </div>

                    {{-- Gelar Belakang --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Gelar Belakang</label>
                        <select name="suffix_title" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 bg-white">
                            <option value="">-- Pilih --</option>
                            @foreach(['S.E.','S.T.','S.Kom.','S.H.','M.M.','M.T.','M.B.A.','Ph.D.','Sp.A.','Sp.B.'] as $t)
                            <option value="{{ $t }}" {{ old('suffix_title')==$t?'selected':'' }}>{{ $t }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Nama Panggilan --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Panggilan</label>
                        <input type="text" name="nickname" value="{{ old('nickname') }}" placeholder="Nama panggilan sehari-hari"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                    </div>

                    {{-- Tempat Lahir --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tempat Lahir</label>
                        <input type="text" name="birth_place" value="{{ old('birth_place') }}" placeholder="Kota/Kabupaten kelahiran"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tanggal Lahir</label>
                        <input type="date" name="birth_date" value="{{ old('birth_date') }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <div class="flex gap-4">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="gender" value="L" {{ old('gender','L')=='L'?'checked':'' }} class="w-4 h-4 text-emerald-600 border-gray-300 focus:ring-emerald-400">
                                <span class="text-sm font-medium text-gray-700">Laki-laki</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="gender" value="P" {{ old('gender')=='P'?'checked':'' }} class="w-4 h-4 text-emerald-600 border-gray-300 focus:ring-emerald-400">
                                <span class="text-sm font-medium text-gray-700">Perempuan</span>
                            </label>
                        </div>
                    </div>

                    {{-- Golongan Darah --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Golongan Darah</label>
                        <div class="flex gap-2">
                            <select name="blood_type" class="flex-1 px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 bg-white">
                                <option value="">-- Pilih --</option>
                                @foreach(['A','B','AB','O'] as $b)
                                <option value="{{ $b }}" {{ old('blood_type')==$b?'selected':'' }}>{{ $b }}</option>
                                @endforeach
                            </select>
                            <select name="blood_rhesus" class="px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 bg-white">
                                <option value="">RH</option>
                                <option value="+" {{ old('blood_rhesus')=='+'?'selected':'' }}>RH+</option>
                                <option value="-" {{ old('blood_rhesus')=='-'?'selected':'' }}>RH-</option>
                            </select>
                        </div>
                    </div>

                    {{-- Agama --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Agama</label>
                        <select name="religion" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 bg-white">
                            <option value="">-- Pilih --</option>
                            @foreach(['islam'=>'Islam','kristen'=>'Kristen Protestan','katolik'=>'Katolik','hindu'=>'Hindu','budha'=>'Buddha','konghucu'=>'Konghucu','lainnya'=>'Lainnya'] as $val=>$label)
                            <option value="{{ $val }}" {{ old('religion')==$val?'selected':'' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Suku --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Suku</label>
                        <input type="text" name="ethnicity" value="{{ old('ethnicity') }}" placeholder="Suku / etnis"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                    </div>

                    {{-- Warga Negara --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Warga Negara</label>
                        <select name="nationality" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 bg-white">
                            <option value="WNI" {{ old('nationality','WNI')=='WNI'?'selected':'' }}>WNI (Warga Negara Indonesia)</option>
                            <option value="WNA" {{ old('nationality')=='WNA'?'selected':'' }}>WNA (Warga Negara Asing)</option>
                        </select>
                    </div>

                    {{-- Status Perkawinan --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Status Perkawinan</label>
                        <select name="marital_status" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 bg-white">
                            <option value="">-- Pilih --</option>
                            <option value="belum_kawin" {{ old('marital_status')=='belum_kawin'?'selected':'' }}>Belum Kawin</option>
                            <option value="kawin" {{ old('marital_status')=='kawin'?'selected':'' }}>Kawin</option>
                            <option value="cerai_hidup" {{ old('marital_status')=='cerai_hidup'?'selected':'' }}>Cerai Hidup</option>
                            <option value="cerai_mati" {{ old('marital_status')=='cerai_mati'?'selected':'' }}>Cerai Mati</option>
                        </select>
                    </div>

                    {{-- PTKP --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kode PTKP</label>
                        <select name="ptkp_code" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 bg-white">
                            <option value="">-- Pilih --</option>
                            @foreach(['TK/0'=>'TK/0 - Tidak Kawin, 0 Tanggungan','TK/1'=>'TK/1 - Tidak Kawin, 1 Tanggungan','K/0'=>'K/0 - Kawin, 0 Tanggungan','K/1'=>'K/1 - Kawin, 1 Tanggungan','K/2'=>'K/2 - Kawin, 2 Tanggungan','K/3'=>'K/3 - Kawin, 3 Tanggungan'] as $val=>$label)
                            <option value="{{ $val }}" {{ old('ptkp_code')==$val?'selected':'' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- ═══ SEKSI 2: ALAMAT & KONTAK ═══ --}}
            <div id="kontak" class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden scroll-mt-6">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3" style="background:linear-gradient(135deg,#eff6ff,#dbeafe);">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background-color:#3b82f6;">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-gray-800">Alamat & Kontak</h2>
                        <p class="text-xs text-gray-500">Informasi tempat tinggal dan kontak karyawan</p>
                    </div>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat Tinggal</label>
                        <textarea name="address" rows="3" placeholder="Alamat domisili saat ini"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 resize-none">{{ old('address') }}</textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat KTP</label>
                        <textarea name="ktp_address" rows="3" placeholder="Alamat sesuai KTP"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 resize-none">{{ old('ktp_address') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Provinsi</label>
                        <input type="text" name="province" value="{{ old('province') }}" placeholder="Provinsi"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kabupaten / Kota</label>
                        <input type="text" name="district" value="{{ old('district') }}" placeholder="Kabupaten / Kota"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kecamatan</label>
                        <input type="text" name="sub_district" value="{{ old('sub_district') }}" placeholder="Kecamatan"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kelurahan</label>
                        <input type="text" name="village" value="{{ old('village') }}" placeholder="Kelurahan / Desa"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">No. HP / Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="08xx-xxxx-xxxx"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="karyawan@perusahaan.com"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                    </div>
                </div>
            </div>

            {{-- ═══ SEKSI 3: DATA KEPEGAWAIAN ═══ --}}
            <div id="kepegawaian" class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden scroll-mt-6">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3" style="background:linear-gradient(135deg,#fdf4ff,#fae8ff);">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background-color:#8b5cf6;">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-gray-800">Data Kepegawaian</h2>
                        <p class="text-xs text-gray-500">Jabatan, departemen, dan informasi pekerjaan</p>
                    </div>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Departemen</label>
                        <select name="department_id" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 bg-white">
                            <option value="">-- Pilih Departemen --</option>
                            @foreach($departments as $dept)
                            <option value="{{ $dept->id }}" {{ old('department_id')==$dept->id?'selected':'' }}>{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jabatan</label>
                        <select name="position_id" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 bg-white">
                            <option value="">-- Pilih Jabatan --</option>
                            @foreach($positions as $pos)
                            <option value="{{ $pos->id }}" {{ old('position_id')==$pos->id?'selected':'' }}>{{ $pos->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Status Kepegawaian</label>
                        <select name="employment_status_id" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 bg-white">
                            <option value="">-- Pilih Status --</option>
                            @foreach($employmentStatuses as $status)
                            <option value="{{ $status->id }}" {{ old('employment_status_id')==$status->id?'selected':'' }}>{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jenis Karyawan</label>
                        <select name="employee_type" x-model="employeeType" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 bg-white">
                            <option value="tetap">Karyawan Tetap</option>
                            <option value="kontrak">Karyawan Kontrak</option>
                            <option value="magang">Magang / PKL</option>
                            <option value="freelance">Freelance</option>
                            <option value="outsourcing">Outsourcing</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Pendidikan Terakhir</label>
                        <select name="education" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 bg-white">
                            <option value="">-- Pilih --</option>
                            @foreach(['sd'=>'SD','smp'=>'SMP','sma'=>'SMA/SMK','d1'=>'D1','d2'=>'D2','d3'=>'D3','d4'=>'D4/S1 Terapan','s1'=>'S1','s2'=>'S2 (Magister)','s3'=>'S3 (Doktor)'] as $val=>$label)
                            <option value="{{ $val }}" {{ old('education')==$val?'selected':'' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jurusan / Bidang Studi</label>
                        <input type="text" name="education_major" value="{{ old('education_major') }}" placeholder="Jurusan pendidikan"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Cabang / Lokasi Kerja</label>
                        <input type="text" name="work_branch" value="{{ old('work_branch') }}" placeholder="cth: Kantor Pusat Jakarta"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Golongan / Grade</label>
                        <div class="flex gap-2">
                            <input type="text" name="employee_grade" value="{{ old('employee_grade') }}" placeholder="Golongan"
                                class="flex-1 px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                            <input type="text" name="grade" value="{{ old('grade') }}" placeholder="Grade"
                                class="w-24 px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tanggal Bergabung</label>
                        <input type="date" name="join_date" value="{{ old('join_date') }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                    </div>
                </div>
            </div>

            {{-- ═══ SEKSI 4: KEUANGAN & BPJS ═══ --}}
            <div id="keuangan" class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden scroll-mt-6">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3" style="background:linear-gradient(135deg,#fffbeb,#fef3c7);">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background-color:#f59e0b;">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-gray-800">Keuangan & BPJS</h2>
                        <p class="text-xs text-gray-500">Informasi gaji, pajak, asuransi, dan rekening bank</p>
                    </div>
                </div>
                <div class="p-6 space-y-5">
                    {{-- Gaji & Pajak --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Gaji Pokok</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-medium text-gray-400">Rp</span>
                                <input type="number" name="basic_salary" value="{{ old('basic_salary', 0) }}" placeholder="0"
                                    class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Metode PPh 21</label>
                            <select name="pph21_method" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 bg-white">
                                <option value="">-- Pilih --</option>
                                <option value="gross" {{ old('pph21_method')=='gross'?'selected':'' }}>Gross (Ditanggung Karyawan)</option>
                                <option value="gross_up" {{ old('pph21_method')=='gross_up'?'selected':'' }}>Gross Up (Ditanggung Perusahaan)</option>
                                <option value="netto" {{ old('pph21_method')=='netto'?'selected':'' }}>Netto</option>
                            </select>
                        </div>
                    </div>

                    {{-- NPWP --}}
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider pt-1">NPWP</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nomor NPWP</label>
                            <input type="text" name="npwp" value="{{ old('npwp') }}" placeholder="XX.XXX.XXX.X-XXX.XXX"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tanggal Terdaftar NPWP</label>
                            <input type="date" name="npwp_registration_date" value="{{ old('npwp_registration_date') }}"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat NPWP</label>
                            <textarea name="npwp_address" rows="2" placeholder="Alamat sesuai NPWP"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 resize-none">{{ old('npwp_address') }}</textarea>
                        </div>
                    </div>

                    {{-- BPJS --}}
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider pt-1">BPJS</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">No. BPJS Kesehatan</label>
                            <input type="text" name="bpjs_health_number" value="{{ old('bpjs_health_number') }}" placeholder="Nomor BPJS Kesehatan"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">No. BPJS Ketenagakerjaan</label>
                            <input type="text" name="bpjs_employment_number" value="{{ old('bpjs_employment_number') }}" placeholder="Nomor BPJS Ketenagakerjaan"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tanggal Masuk BPJS</label>
                            <input type="date" name="bpjs_join_date" value="{{ old('bpjs_join_date') }}"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tanggal Keluar BPJS</label>
                            <input type="date" name="bpjs_end_date" value="{{ old('bpjs_end_date') }}"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                        </div>
                    </div>

                    {{-- Bank --}}
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider pt-1">Rekening Bank</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Bank</label>
                            <select name="bank_name" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 bg-white">
                                <option value="">-- Pilih Bank --</option>
                                @foreach(['BCA','BRI','BNI','Mandiri','BTN','CIMB Niaga','Danamon','Permata','BSI','Lainnya'] as $bank)
                                <option value="{{ $bank }}" {{ old('bank_name')==$bank?'selected':'' }}>{{ $bank }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Cabang Bank</label>
                            <input type="text" name="bank_branch" value="{{ old('bank_branch') }}" placeholder="Cabang bank"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">No. Rekening</label>
                            <input type="text" name="bank_account_number" value="{{ old('bank_account_number') }}" placeholder="Nomor rekening"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Atas Nama</label>
                            <input type="text" name="bank_account_name" value="{{ old('bank_account_name') }}" placeholder="Nama pemilik rekening"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                        </div>
                    </div>
                </div>
            </div>

            {{-- ═══ SEKSI 5: DATA TAMBAHAN ═══ --}}
            <div id="tambahan" class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden scroll-mt-6">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3" style="background:linear-gradient(135deg,#f0fdfa,#ccfbf1);">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background-color:#14b8a6;">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-gray-800">Data Tambahan</h2>
                        <p class="text-xs text-gray-500">Informasi fisik, bahasa, dan kompetensi</p>
                    </div>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tinggi Badan</label>
                        <div class="relative">
                            <input type="number" name="height_cm" value="{{ old('height_cm') }}" placeholder="170" step="0.1"
                                class="w-full px-4 pr-12 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs text-gray-400 font-medium">cm</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Berat Badan</label>
                        <div class="relative">
                            <input type="number" name="weight_kg" value="{{ old('weight_kg') }}" placeholder="65" step="0.1"
                                class="w-full px-4 pr-12 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs text-gray-400 font-medium">kg</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Status Kepemilikan Rumah</label>
                        <select name="house_ownership" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 bg-white">
                            <option value="">-- Pilih --</option>
                            @foreach(['Milik Sendiri','Kontrak/Sewa','Rumah Dinas','Kost','Tinggal Bersama Orang Tua'] as $h)
                            <option value="{{ $h }}" {{ old('house_ownership')==$h?'selected':'' }}>{{ $h }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kemampuan Bahasa</label>
                        <input type="text" name="language_ability" value="{{ old('language_ability') }}" placeholder="cth: Indonesia, Inggris, Mandarin"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                    </div>
                    @foreach([['skills','Keterampilan','cth: Microsoft Office, Desain Grafis'],['expertise','Keahlian','cth: Analisis Data, Programming'],['interests','Minat','cth: Teknologi, Komunikasi'],['talents','Bakat','cth: Leadership, Public Speaking']] as [$field,$label,$ph])
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ $label }}</label>
                        <textarea name="{{ $field }}" rows="2" placeholder="{{ $ph }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 resize-none">{{ old($field) }}</textarea>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- ═══ SEKSI 6: FOTO & KONTRAK ═══ --}}
            <div id="foto" class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden scroll-mt-6">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3" style="background:linear-gradient(135deg,#fff1f2,#ffe4e6);">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background-color:#f43f5e;">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-gray-800">Foto & Kontrak</h2>
                        <p class="text-xs text-gray-500">Foto profil dan dokumen kontrak karyawan</p>
                    </div>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Photo Upload --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Foto Karyawan</label>
                        <div class="flex items-start gap-4">
                            <div class="w-28 h-28 rounded-2xl border-2 border-dashed border-gray-200 overflow-hidden flex items-center justify-center bg-gray-50 shrink-0">
                                <template x-if="!photoPreview">
                                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </template>
                                <template x-if="photoPreview">
                                    <img :src="photoPreview" class="w-full h-full object-cover">
                                </template>
                            </div>
                            <div class="flex-1">
                                <label class="cursor-pointer inline-flex items-center gap-2 text-sm font-semibold text-emerald-600 border border-emerald-300 px-4 py-2 rounded-xl hover:bg-emerald-50 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                    Pilih Foto
                                    <input type="file" name="photo" accept="image/*" class="hidden"
                                        @change="photoPreview = URL.createObjectURL($event.target.files[0])">
                                </label>
                                <p class="text-xs text-gray-400 mt-2">JPG, PNG, GIF. Maks 2MB.<br>Ukuran disarankan: 300×300 px.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Kontrak (hanya untuk non-tetap) --}}
                    <div x-show="employeeType !== 'tetap'" x-transition class="space-y-4">
                        <div class="p-3 rounded-xl border border-amber-200 bg-amber-50 text-xs text-amber-700 font-medium flex items-center gap-2">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Isi data kontrak untuk karyawan non-tetap
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">No. Kontrak</label>
                            <input type="text" name="contract_number" value="{{ old('contract_number') }}" placeholder="PKS/2024/XXX"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Mulai Kontrak</label>
                                <input type="date" name="contract_start_date" value="{{ old('contract_start_date') }}"
                                    class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Berakhir Kontrak</label>
                                <input type="date" name="contract_end_date" value="{{ old('contract_end_date') }}"
                                    class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">File Kontrak</label>
                            <label class="cursor-pointer inline-flex items-center gap-2 text-sm font-semibold text-gray-600 border border-gray-200 px-4 py-2 rounded-xl hover:bg-gray-50 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                Upload File
                                <input type="file" name="contract_file" accept=".pdf,.doc,.docx" class="hidden">
                            </label>
                            <p class="text-xs text-gray-400 mt-1">PDF, DOC, DOCX. Maks 5MB.</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Keterangan Kontrak</label>
                            <textarea name="contract_notes" rows="2" placeholder="Catatan atau keterangan kontrak"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 resize-none">{{ old('contract_notes') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bottom Action Bar --}}
            <div class="lg:hidden sticky bottom-0 bg-white border-t border-gray-100 px-4 py-3 -mx-6 flex items-center justify-end gap-3 shadow-lg">
                <a href="{{ route('transaksi.karyawan.index') }}" class="text-sm font-medium text-gray-500 px-4 py-2 rounded-xl border border-gray-200">Batal</a>
                <button type="submit" class="text-sm font-bold text-white px-6 py-2 rounded-xl" style="background:linear-gradient(135deg,#10b981,#059669);">
                    Simpan Karyawan
                </button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>

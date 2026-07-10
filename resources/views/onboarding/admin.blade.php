<x-app-layout>
    <div class="space-y-6" x-data="{ showNewEmployeeModal: false, showNewTemplateModal: false, tasks: [{title: '', description: '', duration: 1}] }">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Manajemen Orientasi Karyawan</h2>
                <p class="text-gray-500 text-sm mt-1">Pantau dan kelola progress orientasi (onboarding) karyawan baru.</p>
            </div>
            <div>
                <button @click="showNewEmployeeModal = true" class="bg-emerald-500 hover:bg-emerald-600 text-white font-medium py-2 px-4 rounded-xl shadow-sm transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Karyawan Baru
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Left Side: New Hires Pipeline -->
            <div class="lg:col-span-2 space-y-4">
                <h3 class="text-lg font-bold text-gray-800 mb-2">Karyawan Baru Terdaftar (Pipeline)</h3>

                @forelse($employees as $emp)
                <!-- Employee Card -->
                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] transition-all hover:shadow-[0_4px_15px_-4px_rgba(0,0,0,0.1)]">
                    <div class="flex flex-col md:flex-row gap-4 items-start md:items-center">
                        <!-- Avatar -->
                        <div class="relative shrink-0">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($emp->name) }}&background=10b981&color=fff" alt="{{ $emp->name }}" class="w-16 h-16 rounded-full border-2 border-emerald-100">
                        </div>
                        
                        <!-- Info -->
                        <div class="flex-grow">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="text-lg font-bold text-gray-800">{{ $emp->name }}</h4>
                                    <p class="text-sm text-gray-500">{{ $emp->department }} Department</p>
                                </div>
                                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-xs font-medium">Joined: {{ $emp->created_at->format('d M Y') }}</span>
                            </div>

                            <!-- Progress Bar -->
                            <div class="mt-4">
                                <div class="flex justify-between text-xs mb-1">
                                    <span class="font-medium text-gray-700">Progress Orientasi</span>
                                    <span class="font-bold {{ $emp->onboarding_progress == 100 ? 'text-emerald-500' : 'text-amber-500' }}">{{ $emp->onboarding_progress }}%</span>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-2">
                                    <div class="{{ $emp->onboarding_progress == 100 ? 'bg-emerald-500' : 'bg-amber-400' }} h-2 rounded-full transition-all duration-500" style="width: {{ $emp->onboarding_progress }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="border-gray-100 my-4">

                    <!-- Tasks & Mentor -->
                    <div class="flex justify-between items-center text-sm">
                        <div class="text-gray-500">
                            <span class="font-medium text-gray-700">{{ $emp->onboardings->where('status', 'completed')->count() }}</span> dari {{ $emp->onboardings->count() }} Tugas Selesai
                        </div>
                        <div>
                            @php
                                $firstTask = $emp->onboardings->first();
                            @endphp
                            @if($firstTask && $firstTask->mentor)
                                <div class="flex items-center gap-2 text-gray-500 bg-gray-50 px-3 py-1.5 rounded-lg border border-gray-100">
                                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    Mentor: <span class="font-medium text-gray-700">{{ $firstTask->mentor->name }}</span>
                                </div>
                            @else
                                <button class="text-emerald-500 hover:text-emerald-600 font-medium text-sm flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg> Set Mentor
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white rounded-2xl p-8 border border-gray-100 text-center text-gray-500">
                    Belum ada karyawan baru.
                </div>
                @endforelse

            </div>

            <!-- Right Side: Templates -->
            <div class="space-y-4">
                <div class="flex justify-between items-center mb-2">
                    <h3 class="text-lg font-bold text-gray-800">Onboarding Templates</h3>
                    <button @click="showNewTemplateModal = true" class="text-emerald-500 hover:text-emerald-600 text-sm font-medium">Buat Baru</button>
                </div>

                @forelse($templates as $template)
                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)]">
                    <div class="flex justify-between items-start mb-2">
                        <h4 class="font-bold text-gray-800">{{ $template->name }}</h4>
                        <span class="text-[10px] font-bold px-2 py-1 bg-blue-50 text-blue-500 rounded-md">{{ $template->department }}</span>
                    </div>
                    <p class="text-xs text-gray-500 mb-4">{{ $template->description }}</p>
                    
                    <div class="bg-gray-50 rounded-xl p-3 border border-gray-100 space-y-2">
                        <p class="text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Daftar Tugas ({{ $template->tasks->count() }})</p>
                        @foreach($template->tasks->take(3) as $task)
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 text-emerald-500 mr-2 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            <span class="truncate">{{ $task->title }}</span>
                        </div>
                        @endforeach
                        @if($template->tasks->count() > 3)
                        <div class="text-xs text-gray-400 pl-6">+ {{ $template->tasks->count() - 3 }} tugas lainnya</div>
                        @endif
                    </div>
                </div>
                @empty
                <div class="bg-white rounded-2xl p-5 border border-gray-100 text-center text-gray-500 text-sm">
                    Belum ada template.
                </div>
                @endforelse
            </div>
        </div>
    <!-- Modal Karyawan Baru -->
    <div x-show="showNewEmployeeModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showNewEmployeeModal" x-transition.opacity class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="showNewEmployeeModal" x-transition.opacity.duration.300ms class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form action="{{ route('onboarding.employee.store') }}" method="POST">
                    @csrf
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-bold text-gray-900" id="modal-title">Tambah Karyawan Baru</h3>
                                <div class="mt-4 space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                        <input type="text" name="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Email</label>
                                        <input type="email" name="email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Departemen</label>
                                        <select name="department" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                            @foreach($templates->pluck('department')->unique() as $dept)
                                                <option value="{{ $dept }}">{{ $dept }}</option>
                                            @endforeach
                                        </select>
                                        <p class="text-xs text-gray-500 mt-1">Karyawan otomatis akan diberikan tugas berdasarkan template departemen ini.</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Password</label>
                                        <input type="text" name="password" value="password" readonly class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-50 sm:text-sm">
                                        <p class="text-xs text-gray-500 mt-1">Default password adalah "password". Karyawan dapat mengubahnya nanti.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse rounded-b-2xl">
                        <button type="submit" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-emerald-600 text-base font-medium text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors">Tambah Karyawan</button>
                        <button type="button" @click="showNewEmployeeModal = false" class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Template Baru -->
    <div x-show="showNewTemplateModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showNewTemplateModal" x-transition.opacity class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="showNewTemplateModal" x-transition.opacity.duration.300ms class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                <form action="{{ route('onboarding.template.store') }}" method="POST">
                    @csrf
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 max-h-[80vh] overflow-y-auto">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-bold text-gray-900" id="modal-title">Buat Onboarding Template Baru</h3>
                                
                                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Template</label>
                                        <input type="text" name="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" placeholder="Contoh: Marketing Onboarding">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Departemen</label>
                                        <input type="text" name="department" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" placeholder="Contoh: Marketing">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                        <textarea name="description" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"></textarea>
                                    </div>
                                </div>

                                <div class="mt-6 border-t border-gray-100 pt-4">
                                    <div class="flex justify-between items-center mb-4">
                                        <h4 class="font-bold text-gray-800">Daftar Tugas (Checklist)</h4>
                                        <button type="button" @click="tasks.push({title: '', description: '', duration: 1})" class="text-emerald-500 hover:text-emerald-600 text-sm font-medium flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg> Tambah Tugas
                                        </button>
                                    </div>

                                    <div class="space-y-4">
                                        <template x-for="(task, index) in tasks" :key="index">
                                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 relative">
                                                <button type="button" @click="tasks.splice(index, 1)" class="absolute top-2 right-2 text-gray-400 hover:text-red-500" x-show="tasks.length > 1">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                </button>
                                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                                    <div class="md:col-span-3">
                                                        <label class="block text-xs font-medium text-gray-700">Judul Tugas</label>
                                                        <input type="text" x-model="task.title" :name="`tasks[${index}][title]`" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                                    </div>
                                                    <div>
                                                        <label class="block text-xs font-medium text-gray-700">Durasi (Hari)</label>
                                                        <input type="number" min="1" x-model="task.duration" :name="`tasks[${index}][duration_days]`" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                                    </div>
                                                    <div class="md:col-span-4">
                                                        <label class="block text-xs font-medium text-gray-700">Deskripsi / Instruksi</label>
                                                        <input type="text" x-model="task.description" :name="`tasks[${index}][description]`" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse rounded-b-2xl border-t border-gray-200">
                        <button type="submit" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-emerald-600 text-base font-medium text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors">Simpan Template</button>
                        <button type="button" @click="showNewTemplateModal = false" class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="space-y-6 max-w-5xl mx-auto">
        
        <!-- Welcome Hero Card -->
        <div class="bg-gradient-to-r from-emerald-500 to-teal-600 rounded-3xl p-8 md:p-12 shadow-lg text-white relative overflow-hidden">
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-2">Selamat Datang di KancaHR, {{ Auth::user()->name }}! 🎉</h2>
                    <p class="text-emerald-50 text-lg max-w-xl">Kami sangat senang Anda bergabung dengan tim {{ Auth::user()->department }}. Selesaikan checklist di bawah ini untuk memulai perjalanan karir Anda bersama kami.</p>
                </div>
                <div class="shrink-0 text-center">
                    <div class="w-32 h-32 rounded-full border-4 border-white/20 bg-white/10 flex items-center justify-center backdrop-blur-sm mx-auto mb-3">
                        <span class="text-4xl font-bold">{{ $progress }}%</span>
                    </div>
                    <span class="text-sm font-medium text-emerald-50 uppercase tracking-wider">Progress Anda</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Left Side: My Checklist -->
            <div class="lg:col-span-2 space-y-4">
                <h3 class="text-xl font-bold text-gray-800">My Checklist (Minggu Pertama)</h3>

                <div class="bg-white rounded-3xl shadow-[0_2px_20px_-4px_rgba(0,0,0,0.05)] border border-gray-100 overflow-hidden">
                    <ul class="divide-y divide-gray-100" id="onboarding-tasks">
                        @forelse($onboardings as $onboarding)
                        <li class="p-5 flex items-start gap-4 hover:bg-gray-50 transition-colors group">
                            <!-- Checkbox -->
                            <div class="shrink-0 mt-1">
                                <button type="button" 
                                    class="w-6 h-6 rounded-full border-2 flex items-center justify-center transition-colors {{ $onboarding->status === 'completed' ? 'bg-emerald-500 border-emerald-500 text-white' : 'border-gray-300 text-transparent hover:border-emerald-500' }}"
                                    onclick="toggleTaskStatus(this, {{ $onboarding->id }}, '{{ $onboarding->status }}')"
                                >
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                </button>
                            </div>

                            <!-- Task Detail -->
                            <div class="flex-grow">
                                <h4 class="text-base font-semibold {{ $onboarding->status === 'completed' ? 'text-gray-400 line-through' : 'text-gray-800 group-hover:text-emerald-600' }} transition-colors">
                                    {{ $onboarding->task->title }}
                                </h4>
                                <p class="text-sm text-gray-500 mt-1">{{ $onboarding->task->description }}</p>
                                
                                <div class="flex items-center gap-4 mt-3">
                                    @if($onboarding->status === 'completed')
                                        <span class="text-xs font-bold px-2 py-1 bg-emerald-50 text-emerald-600 rounded-md">Selesai</span>
                                    @else
                                        <span class="text-xs font-bold px-2 py-1 bg-amber-50 text-amber-600 rounded-md">Batas: {{ $onboarding->due_date->format('d M Y') }}</span>
                                    @endif

                                    @if($onboarding->mentor)
                                    <span class="text-xs text-gray-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        PIC: {{ $onboarding->mentor->name }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="p-8 text-center text-gray-500">
                            Hore! Belum ada tugas orientasi untuk Anda.
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <!-- Right Side: Company Docs -->
            <div class="space-y-6">
                <div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Dokumen Perusahaan</h3>
                    
                    <div class="bg-white rounded-3xl p-6 shadow-[0_2px_20px_-4px_rgba(0,0,0,0.05)] border border-gray-100 space-y-4">
                        
                        <a href="#" class="flex items-center p-3 rounded-2xl hover:bg-gray-50 border border-transparent hover:border-gray-100 transition-all group">
                            <div class="w-10 h-10 rounded-xl bg-red-50 text-red-500 flex items-center justify-center shrink-0 mr-4 group-hover:bg-red-500 group-hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-gray-800 group-hover:text-red-500">Buku Saku Karyawan.pdf</h4>
                                <p class="text-xs text-gray-500">Peraturan & Budaya Perusahaan</p>
                            </div>
                        </a>

                        <a href="#" class="flex items-center p-3 rounded-2xl hover:bg-gray-50 border border-transparent hover:border-gray-100 transition-all group">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center shrink-0 mr-4 group-hover:bg-blue-500 group-hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-gray-800 group-hover:text-blue-500">Struktur Organisasi.pdf</h4>
                                <p class="text-xs text-gray-500">Diagram Hierarchy KancaHR</p>
                            </div>
                        </a>

                        <a href="#" class="flex items-center p-3 rounded-2xl hover:bg-gray-50 border border-transparent hover:border-gray-100 transition-all group">
                            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center shrink-0 mr-4 group-hover:bg-amber-500 group-hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-gray-800 group-hover:text-amber-500">SOP {{ Auth::user()->department }}.pdf</h4>
                                <p class="text-xs text-gray-500">Standar Operasional Prosedur</p>
                            </div>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script for interactive checklist -->
    <script>
        function toggleTaskStatus(buttonElement, taskId, currentStatus) {
            const newStatus = currentStatus === 'completed' ? 'pending' : 'completed';
            
            // Optimistic UI Update
            const h4 = buttonElement.closest('li').querySelector('h4');
            const spanBadgeContainer = buttonElement.closest('li').querySelector('.flex.items-center.gap-4');
            
            if (newStatus === 'completed') {
                buttonElement.classList.remove('border-gray-300', 'text-transparent', 'hover:border-emerald-500');
                buttonElement.classList.add('bg-emerald-500', 'border-emerald-500', 'text-white');
                h4.classList.remove('text-gray-800', 'group-hover:text-emerald-600');
                h4.classList.add('text-gray-400', 'line-through');
            } else {
                buttonElement.classList.add('border-gray-300', 'text-transparent', 'hover:border-emerald-500');
                buttonElement.classList.remove('bg-emerald-500', 'border-emerald-500', 'text-white');
                h4.classList.add('text-gray-800', 'group-hover:text-emerald-600');
                h4.classList.remove('text-gray-400', 'line-through');
            }

            // AJAX Request to Backend (Fetch API)
            fetch(`/onboarding/${taskId}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: newStatus })
            }).then(response => {
                if(response.ok) {
                    // Update currentStatus for next click
                    buttonElement.setAttribute('onclick', `toggleTaskStatus(this, ${taskId}, '${newStatus}')`);
                    // In a real app, you might also want to reload the progress bar here
                    window.location.reload(); 
                }
            });
        }
    </script>
</x-app-layout>

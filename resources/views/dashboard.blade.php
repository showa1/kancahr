<x-app-layout>
    <!-- We hide the default header provided by Breeze/AppLayout in the app layout itself, but here we just don't pass the slot -->

    <div class="space-y-6">
        
        <!-- Row 1: Status Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
            
            <!-- Who is out? -->
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)]">
                <h3 class="text-sm font-bold text-gray-800 mb-4">Siapa yang sedang cuti?</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center text-sm">
                        <span class="font-medium text-gray-700">Budi Santoso</span>
                        <span class="text-[10px] font-bold px-2 py-1 bg-cyan-50 text-cyan-500 rounded-md">Liburan</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="font-medium text-gray-700">Siti Aminah</span>
                        <span class="text-[10px] font-bold px-2 py-1 bg-cyan-50 text-cyan-500 rounded-md">Cuti</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="font-medium text-gray-700">Rina Wijaya</span>
                        <span class="text-[10px] font-bold px-2 py-1 bg-cyan-50 text-cyan-500 rounded-md">Liburan</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="font-medium text-gray-700">Andi Pratama</span>
                        <span class="text-[10px] font-bold px-2 py-1 bg-rose-50 text-rose-500 rounded-md">Cuti Tanpa Tanggungan</span>
                    </div>
                </div>
            </div>

            <!-- My Upcoming Time Off -->
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)]">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-sm font-bold text-gray-800">Jadwal Cuti Saya Mendatang</h3>
                    <button class="text-gray-400 hover:text-gray-600"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path></svg></button>
                </div>
                <div class="space-y-4">
                    <div>
                        <p class="text-xs text-gray-500 mb-1">4 Oktober - 7 Oktober</p>
                        <div class="flex items-center space-x-2">
                            <span class="text-lg font-bold text-gray-800">3 Hari</span>
                            <span class="text-[10px] font-bold px-2 py-1 bg-amber-50 text-amber-500 rounded-md">Sakit</span>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-1">11 Oktober - 10 November</p>
                        <div class="flex items-center space-x-2">
                            <span class="text-lg font-bold text-gray-800">21 Hari</span>
                            <span class="text-[10px] font-bold px-2 py-1 bg-blue-50 text-blue-500 rounded-md">Liburan</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Occasions -->
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)]">
                <h3 class="text-sm font-bold text-gray-800 mb-4">Acara Mendatang</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-[10px] text-gray-400">12 Oktober</p>
                        <div class="flex justify-between items-center text-sm">
                            <span class="font-medium text-gray-700">Budi Santoso</span>
                            <span class="text-[10px] font-bold px-2 py-1 bg-emerald-50 text-emerald-500 rounded-md">Peringatan 1 Tahun</span>
                        </div>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400">13 Oktober</p>
                        <div class="flex justify-between items-center text-sm">
                            <span class="font-medium text-gray-700">Siti Aminah</span>
                            <span class="text-[10px] font-bold px-2 py-1 bg-cyan-50 text-cyan-500 rounded-md">Ulang Tahun</span>
                        </div>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400">14 Oktober</p>
                        <div class="flex justify-between items-center text-sm">
                            <span class="font-medium text-gray-700">Rina Wijaya</span>
                            <span class="text-[10px] font-bold px-2 py-1 bg-cyan-50 text-cyan-500 rounded-md">Ulang Tahun</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Employees -->
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)]">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-sm font-bold text-gray-800">Total Karyawan</h3>
                    <button class="text-gray-400 hover:text-gray-600"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path></svg></button>
                </div>
                <div class="mb-4">
                    <p class="text-[10px] text-gray-400 mb-1">Karyawan Aktif</p>
                    <div class="flex items-end space-x-2">
                        <span class="text-3xl font-bold text-gray-800">35</span>
                        <span class="text-[10px] font-bold px-2 py-1 bg-emerald-50 text-emerald-500 rounded-md mb-1">+ 2 bulan ini</span>
                    </div>
                </div>
                <div>
                    <p class="text-[10px] text-gray-400 mb-1">Karyawan Baru</p>
                    <span class="text-xl font-bold text-amber-400">9</span>
                </div>
            </div>
            
        </div>

        <!-- Row 2: Demographics (Doughnut Charts) -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            
            <!-- Gender -->
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] flex flex-col items-center">
                <h3 class="text-sm font-bold text-gray-800 self-start mb-2">Jenis Kelamin</h3>
                <div class="relative w-32 h-32">
                    <canvas id="genderChart"></canvas>
                </div>
            </div>

            <!-- Employee Age -->
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] flex flex-col items-center">
                <h3 class="text-sm font-bold text-gray-800 self-start mb-2">Usia Karyawan</h3>
                <div class="relative w-32 h-32 flex items-center justify-center">
                    <canvas id="ageChart"></canvas>
                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                        <span class="text-xl font-bold text-gray-800">30.7</span>
                    </div>
                </div>
            </div>

            <!-- Office -->
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] flex flex-col items-center">
                <h3 class="text-sm font-bold text-gray-800 self-start mb-2">Kantor</h3>
                <div class="relative w-32 h-32">
                    <canvas id="officeChart"></canvas>
                </div>
            </div>

            <!-- Department -->
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] flex flex-col items-center">
                <h3 class="text-sm font-bold text-gray-800 self-start mb-2">Departemen</h3>
                <div class="relative w-32 h-32">
                    <canvas id="deptChart"></canvas>
                </div>
            </div>

        </div>

        <!-- Row 3: Probation & Headcounts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            <!-- Probation Period -->
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)]">
                <h3 class="text-sm font-bold text-gray-800 mb-6">Masa Percobaan</h3>
                
                <div class="space-y-5">
                    <div>
                        <div class="flex justify-between text-xs mb-1">
                            <span class="font-medium text-gray-700">Rina Wijaya</span>
                            <span class="font-bold text-gray-800">60 hari lagi</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-1.5">
                            <div class="bg-amber-400 h-1.5 rounded-full" style="width: 30%"></div>
                        </div>
                        <div class="text-[10px] text-gray-400 mt-1">2022/12/31</div>
                    </div>
                    
                    <div>
                        <div class="flex justify-between text-xs mb-1">
                            <span class="font-medium text-gray-700">Andi Pratama</span>
                            <span class="font-bold text-gray-800">15 hari lagi</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-1.5">
                            <div class="bg-emerald-500 h-1.5 rounded-full" style="width: 85%"></div>
                        </div>
                        <div class="text-[10px] text-gray-400 mt-1">2022/10/31</div>
                    </div>

                    <div>
                        <div class="flex justify-between text-xs mb-1">
                            <span class="font-medium text-gray-700">Joko Susilo</span>
                            <span class="font-bold text-gray-800">90 hari lagi</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-1.5">
                            <div class="bg-rose-400 h-1.5 rounded-full" style="width: 10%"></div>
                        </div>
                        <div class="text-[10px] text-gray-400 mt-1">2023/01/30</div>
                    </div>
                </div>
            </div>

            <!-- Headcounts -->
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)]">
                <h3 class="text-sm font-bold text-gray-800 mb-4">Jumlah Karyawan</h3>
                <div class="relative h-48 w-full">
                    <canvas id="headcountChart"></canvas>
                </div>
            </div>

        </div>

    </div>

    <!-- Scripts for Charts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Common options for doughnut charts
            const doughnutOptions = {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: { legend: { display: false }, tooltip: { enabled: true } }
            };

            // Gender Chart
            new Chart(document.getElementById('genderChart').getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['Perempuan', 'Laki-laki'],
                    datasets: [{ data: [51, 49], backgroundColor: ['#ef4444', '#3b82f6'], borderWidth: 0 }]
                },
                options: doughnutOptions
            });

            // Age Chart
            new Chart(document.getElementById('ageChart').getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['20-30', '30-40', '40+'],
                    datasets: [{ data: [56.2, 40.8, 3], backgroundColor: ['#3b82f6', '#f59e0b', '#10b981'], borderWidth: 0 }]
                },
                options: doughnutOptions
            });

            // Office Chart
            new Chart(document.getElementById('officeChart').getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['Pusat', 'Remote'],
                    datasets: [{ data: [61.1, 38.9], backgroundColor: ['#3b82f6', '#f59e0b'], borderWidth: 0 }]
                },
                options: doughnutOptions
            });

            // Department Chart
            new Chart(document.getElementById('deptChart').getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['IT', 'HR', 'Penjualan'],
                    datasets: [{ data: [11, 7, 51.5, 30.5], backgroundColor: ['#ef4444', '#f59e0b', '#10b981', '#3b82f6'], borderWidth: 0 }]
                },
                options: doughnutOptions
            });

            // Headcount Line Chart
            const ctxHeadcount = document.getElementById('headcountChart').getContext('2d');
            let gradientHeadcount = ctxHeadcount.createLinearGradient(0, 0, 0, 200);
            gradientHeadcount.addColorStop(0, 'rgba(16, 185, 129, 0.2)'); // Emerald 500 transparent
            gradientHeadcount.addColorStop(1, 'rgba(16, 185, 129, 0.0)');

            new Chart(ctxHeadcount, {
                type: 'line',
                data: {
                    labels: ['Okt 2021', 'Nov 2021', 'Des 2021', 'Jan 2022', 'Feb 2022', 'Mar 2022', 'Apr 2022', 'Mei 2022', 'Jun 2022'],
                    datasets: [{
                        label: 'Karyawan',
                        data: [25, 26, 26, 28, 38, 37, 36, 35, 34],
                        borderColor: '#10b981',
                        backgroundColor: gradientHeadcount,
                        borderWidth: 2,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#10b981',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { display: false, beginAtZero: false, min: 20 },
                        x: { grid: { display: false }, ticks: { font: { size: 10 }, color: '#9ca3af' } }
                    }
                }
            });
        });
    </script>
</x-app-layout>

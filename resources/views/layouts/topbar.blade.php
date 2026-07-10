<header class="bg-white z-10 shrink-0 border-b border-gray-100">
    <div class="flex items-center justify-between h-16 px-6">
        
        <!-- Left: Search / Toggle -->
        <div class="flex items-center space-x-4">
            <!-- Sidebar Toggle Button -->
            <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white focus:outline-none transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            
            <!-- Search -->
            <div class="relative hidden sm:block">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </span>
                <input type="text" class="w-full sm:w-64 py-2 pl-10 pr-4 text-sm bg-gray-100 dark:bg-gray-700 border-transparent rounded-lg focus:bg-white dark:focus:bg-gray-800 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all dark:text-white" placeholder="Cari sesuatu...">
            </div>
        </div>

        <!-- Right: Profile & Notifications -->
        <div class="flex items-center space-x-4">
            
            <!-- Notifications -->
            <button class="relative p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                <!-- Badge -->
                <span class="absolute top-1 right-1 flex items-center justify-center w-4 h-4 text-[10px] font-bold text-white bg-red-500 rounded-full border-2 border-white dark:border-gray-800">2</span>
            </button>

            <!-- Settings Dropdown -->
            <div class="relative">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center focus:outline-none space-x-2 p-1 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                            <img class="w-8 h-8 rounded-full border-2 border-transparent" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'HR Admin') }}&color=7F9CF5&background=EBF4FF" alt="{{ Auth::user()->name ?? 'Admin' }}">
                            <div class="hidden md:flex flex-col items-start px-2">
                                <span class="text-sm font-semibold text-gray-700 dark:text-gray-200 leading-tight">{{ Auth::user()->name ?? 'HR Admin' }}</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400 leading-tight">Super Admin</span>
                            </div>
                            <svg class="hidden md:block w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profil') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();" class="text-red-500">
                                {{ __('Keluar') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

        </div>
    </div>
</header>

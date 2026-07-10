<x-auth-split-layout>
    <!-- Background Image with Overlay -->
    <div class="relative min-h-screen flex">
        
        <!-- Background Image -->
        <div class="absolute inset-0 z-0 bg-[url('https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80&w=1920')] bg-cover bg-center">
            <!-- Dark Overlay -->
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900/90 to-gray-900/40"></div>
        </div>

        <!-- Content Split -->
        <div class="relative z-10 flex flex-col lg:flex-row w-full h-screen">
            
            <!-- Left Side: Branding / Text -->
            <div class="hidden lg:flex flex-col justify-center w-1/2 p-16 xl:p-24 text-white">
                <div class="mb-8">
                    <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h1 class="text-5xl font-bold mb-6 leading-tight">Elevate Your<br>Workforce Management.</h1>
                <p class="text-lg text-gray-300 max-w-lg mb-10">Streamline your HR processes, empower your employees, and unlock your company's true potential with our next-generation KancaHR platform.</p>
                
                <div class="flex items-center space-x-4 mt-auto">
                    <div class="flex -space-x-3">
                        <img class="w-10 h-10 rounded-full border-2 border-gray-800" src="https://i.pravatar.cc/100?img=1" alt="User">
                        <img class="w-10 h-10 rounded-full border-2 border-gray-800" src="https://i.pravatar.cc/100?img=2" alt="User">
                        <img class="w-10 h-10 rounded-full border-2 border-gray-800" src="https://i.pravatar.cc/100?img=3" alt="User">
                        <img class="w-10 h-10 rounded-full border-2 border-gray-800" src="https://i.pravatar.cc/100?img=4" alt="User">
                    </div>
                    <p class="text-sm text-gray-400">Trusted by over <span class="text-white font-semibold">10,000+</span> professionals worldwide.</p>
                </div>
            </div>

            <!-- Right Side: Login Form (Glassmorphism) -->
            <div class="flex flex-col justify-center items-center w-full lg:w-1/2 p-6 lg:p-16">
                <!-- Glass Card -->
                <div class="w-full max-w-md bg-white/10 dark:bg-gray-900/50 backdrop-blur-xl border border-white/20 shadow-2xl rounded-3xl p-8 sm:p-12 relative overflow-hidden">
                    
                    <!-- Decorative Element -->
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>
                    <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>

                    <div class="relative z-10">
                        <div class="text-center mb-10">
                            <h2 class="text-3xl font-bold text-white mb-2">Welcome Back</h2>
                            <p class="text-gray-300 text-sm">Please sign in to your KancaHR account</p>
                        </div>

                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4 text-green-400" :status="session('status')" />

                        <form method="POST" action="{{ route('login') }}" class="space-y-6">
                            @csrf

                            <!-- Email Address -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-200 mb-2">Email Address</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <input id="email" class="block w-full pl-10 pr-3 py-3 border border-gray-600 rounded-xl leading-5 bg-gray-800/50 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="you@company.com">
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-200 mb-2">Password</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                    <input id="password" class="block w-full pl-10 pr-3 py-3 border border-gray-600 rounded-xl leading-5 bg-gray-800/50 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out" type="password" name="password" required autocomplete="current-password" placeholder="••••••••">
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="flex items-center justify-between mt-4">
                                <label for="remember_me" class="flex items-center">
                                    <input id="remember_me" type="checkbox" class="rounded bg-gray-800/50 border-gray-600 text-blue-500 shadow-sm focus:ring-blue-500 focus:ring-offset-gray-900 h-4 w-4" name="remember">
                                    <span class="ml-2 text-sm text-gray-300">{{ __('Remember me') }}</span>
                                </label>

                                @if (Route::has('password.request'))
                                    <a class="text-sm text-blue-400 hover:text-blue-300 font-medium transition duration-150 ease-in-out" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                            </div>

                            <!-- Submit Button -->
                            <div class="mt-6">
                                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 focus:ring-offset-gray-900 transition duration-150 ease-in-out transform hover:-translate-y-0.5">
                                    {{ __('Sign In') }}
                                </button>
                            </div>
                            
                            <div class="mt-6 text-center">
                                <p class="text-sm text-gray-400">
                                    Don't have an account? 
                                    <a href="{{ route('register') }}" class="font-medium text-blue-400 hover:text-blue-300">Contact HR Admin</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-auth-split-layout>

<header class="bg-white shadow-sm">
    <!-- Top Header -->
    <div class="container mx-auto px-4 py-3 flex items-center justify-between">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="font-['Pacifico'] text-2xl text-primary">LT365</a>
        
        <!-- Search Bar -->
        @include('layouts.components.search-bar')
        
        <!-- Right Section -->
        <div class="flex items-center gap-6">
            <!-- Hotline -->
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                    <i class="ri-phone-line"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Hotline</p>
                    <p class="text-sm font-medium">{{ $general_settings['hotline'] ?? '' }}</p>
                </div>
            </div>
            
            <!-- Auth Section -->
            @auth
                <!-- User Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" 
                        class="flex items-center gap-3 px-3 py-2 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                        <!-- Avatar -->
                        <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center overflow-hidden">
                            @if(auth()->user()->avatar)
                                <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->full_name }}" 
                                    class="w-full h-full object-cover">
                            @else
                                <i class="ri-user-line text-primary"></i>
                            @endif
                        </div>
                        
                        <!-- User Info -->
                        <div class="text-left">
                            <p class="text-sm font-medium text-gray-900 truncate max-w-32">{{ auth()->user()->full_name }}</p>
                            <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                        </div>
                        
                        <!-- Dropdown Icon -->
                        <i class="ri-arrow-down-s-line text-gray-400 transition-transform duration-200"
                            :class="{ 'rotate-180': open }"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" 
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        @click.outside="open = false"
                        class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50">
                        
                        <!-- User Info Header -->
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-sm font-medium text-gray-900">{{ auth()->user()->full_name }}</p>
                            <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                        </div>
                        
                        <!-- Menu Items -->
                        <div class="py-2">
                            <a href="{{ route('user.dashboard') }}" 
                                class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                <i class="ri-dashboard-line w-4 h-4"></i>
                                <span>Dashboard</span>
                            </a>
                            
                            <a href="{{ route('user.profile') }}" 
                                class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                <i class="ri-user-line w-4 h-4"></i>
                                <span>Hồ sơ cá nhân</span>
                            </a>
                            
                            <a href="{{ route('user.downloads') }}" 
                                class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                <i class="ri-download-line w-4 h-4"></i>
                                <span>Tài liệu đã tải</span>
                            </a>
                            
                            <a href="{{ route('user.favorites') }}" 
                                class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                <i class="ri-heart-line w-4 h-4"></i>
                                <span>Yêu thích</span>
                            </a>
                            
                            <a href="{{ route('user.change-password') }}" 
                                class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                <i class="ri-lock-line w-4 h-4"></i>
                                <span>Đổi mật khẩu</span>
                            </a>
                        </div>
                        
                        <div class="border-t border-gray-100 pt-2">
                            <form method="POST" action="{{ route('auth.logout') }}" class="block">
                                @csrf
                                <button type="submit" 
                                    class="flex items-center gap-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200 w-full text-left">
                                    <i class="ri-logout-circle-line w-4 h-4"></i>
                                    <span>Đăng xuất</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <!-- Guest Auth Buttons -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('auth.login') }}" 
                        class="px-4 py-2 text-primary border border-primary rounded-button hover:bg-primary/5 transition-colors duration-200 text-sm font-medium whitespace-nowrap">
                        Đăng nhập
                    </a>
                    <a href="{{ route('auth.register') }}" 
                        class="px-4 py-2 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors duration-200 text-sm font-medium whitespace-nowrap">
                        Đăng ký
                    </a>
                </div>
            @endauth
        </div>
    </div>
</header>

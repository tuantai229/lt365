<header class="bg-white shadow-sm">
    <!-- Top Header -->
    <div class="container mx-auto px-4 py-3 flex items-center justify-between">
        <!-- Logo -->
        <a href="#" class="font-['Pacifico'] text-2xl text-primary">LT365</a>
        
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
                    <p class="text-sm font-medium">0987 654 321</p>
                </div>
            </div>
            
            <!-- Auth Buttons -->
            <div class="flex items-center gap-3">
                <button class="px-4 py-2 text-primary border border-primary rounded-button hover:bg-primary/5 transition-colors duration-200 text-sm font-medium whitespace-nowrap !rounded-button">Đăng nhập</button>
                <button class="px-4 py-2 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors duration-200 text-sm font-medium whitespace-nowrap !rounded-button">Đăng ký</button>
            </div>
        </div>
    </div>
</header>

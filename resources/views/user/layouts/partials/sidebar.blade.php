<div class="bg-white p-6 rounded-lg shadow-sm">
    <!-- User Info -->
    <div class="flex items-center gap-4 pb-6 border-b border-gray-200">
        <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center overflow-hidden">
            @if(auth()->user()->avatar)
                <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->full_name }}" class="w-full h-full object-cover">
            @else
                <i class="ri-user-line text-3xl text-primary"></i>
            @endif
        </div>
        <div>
            <h3 class="font-bold text-lg text-gray-900">{{ auth()->user()->full_name }}</h3>
            <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="mt-6 space-y-2">
        <a href="{{ route('user.dashboard') }}" 
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors duration-200 text-sm font-medium
           {{ request()->routeIs('user.dashboard') ? 'bg-primary/10 text-primary' : 'text-gray-600 hover:bg-gray-50' }}">
            <i class="ri-dashboard-line w-5 h-5"></i>
            <span>Tổng quan</span>
        </a>
        
        <a href="{{ route('user.profile') }}" 
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors duration-200 text-sm font-medium
           {{ request()->routeIs('user.profile') ? 'bg-primary/10 text-primary' : 'text-gray-600 hover:bg-gray-50' }}">
            <i class="ri-user-line w-5 h-5"></i>
            <span>Hồ sơ cá nhân</span>
        </a>

        <a href="{{ route('user.downloads') }}" 
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors duration-200 text-sm font-medium
           {{ request()->routeIs('user.downloads') ? 'bg-primary/10 text-primary' : 'text-gray-600 hover:bg-gray-50' }}">
            <i class="ri-download-cloud-2-line w-5 h-5"></i>
            <span>Tài liệu đã tải</span>
        </a>

        <a href="{{ route('user.favorites') }}" 
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors duration-200 text-sm font-medium
           {{ request()->routeIs('user.favorites') ? 'bg-primary/10 text-primary' : 'text-gray-600 hover:bg-gray-50' }}">
            <i class="ri-heart-line w-5 h-5"></i>
            <span>Danh sách yêu thích</span>
        </a>

        <a href="{{ route('user.change-password') }}" 
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors duration-200 text-sm font-medium
           {{ request()->routeIs('user.change-password') ? 'bg-primary/10 text-primary' : 'text-gray-600 hover:bg-gray-50' }}">
            <i class="ri-lock-password-line w-5 h-5"></i>
            <span>Đổi mật khẩu</span>
        </a>

        <!-- Logout -->
        <form method="POST" action="{{ route('auth.logout') }}">
            @csrf
            <button type="submit" 
                    class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors duration-200 text-sm font-medium text-gray-600 hover:bg-gray-50 w-full">
                <i class="ri-logout-circle-r-line w-5 h-5"></i>
                <span>Đăng xuất</span>
            </button>
        </form>
    </nav>
</div>

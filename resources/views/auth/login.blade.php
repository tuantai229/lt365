@extends('layouts.auth')

@section('title', 'Đăng nhập')

@section('content')
<!-- Login Form Card -->
<div class="form-card rounded-2xl p-8">
    <!-- Header -->
    <div class="text-center mb-8">
        <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="ri-login-circle-line text-2xl text-primary"></i>
        </div>
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Chào mừng trở lại</h1>
        <p class="text-gray-600">Đăng nhập để tiếp tục với LT365</p>
    </div>

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg mb-6">
            <ul class="text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Login Form -->
    <form method="POST" action="{{ route('auth.login') }}" class="space-y-6">
        @csrf
        
        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <div class="relative">
                <input type="email" id="email" name="email" required
                    value="{{ old('email') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200 input-focus @error('email') border-red-500 @enderror"
                    placeholder="example@email.com">
                <div class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                    <i class="ri-mail-line"></i>
                </div>
            </div>
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Mật khẩu</label>
            <div class="relative">
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200 input-focus @error('password') border-red-500 @enderror"
                    placeholder="Nhập mật khẩu">
                <button type="button" onclick="togglePassword('password', 'passwordIcon')" 
                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <i id="passwordIcon" class="ri-eye-line"></i>
                </button>
            </div>
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember & Forgot -->
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <input type="checkbox" id="remember" name="remember"
                    class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary/20"
                    {{ old('remember') ? 'checked' : '' }}>
                <label for="remember" class="text-sm text-gray-700">Ghi nhớ đăng nhập</label>
            </div>
            <a href="#" class="text-sm text-primary hover:underline">Quên mật khẩu?</a>
        </div>

        <!-- Submit Button -->
        <button type="submit" id="loginBtn"
            class="w-full bg-primary text-white py-3 px-6 rounded-button font-medium hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
            <span id="loginText">Đăng nhập</span>
            <i id="loginLoadingIcon" class="ri-loader-4-line animate-spin ml-2 hidden"></i>
        </button>

        <!-- Register Link -->
        <div class="text-center pt-4">
            <p class="text-gray-600">
                Chưa có tài khoản? 
                <a href="{{ route('auth.register') }}" class="text-primary font-medium hover:underline">Đăng ký miễn phí</a>
            </p>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    // Login form submission
    document.querySelector('form').addEventListener('submit', function(e) {
        const loginBtn = document.getElementById('loginBtn');
        const loginText = document.getElementById('loginText');
        const loadingIcon = document.getElementById('loginLoadingIcon');
        
        loginBtn.disabled = true;
        loginText.textContent = 'Đang đăng nhập...';
        loadingIcon.classList.remove('hidden');
    });
</script>
@endpush

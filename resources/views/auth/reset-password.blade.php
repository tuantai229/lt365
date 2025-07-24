@extends('layouts.auth')

@section('title', 'Đặt lại mật khẩu')

@section('content')
<!-- Reset Password Card -->
<div class="form-card rounded-2xl p-8">
    <!-- Header -->
    <div class="text-center mb-8">
        <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="ri-key-2-line text-2xl text-primary"></i>
        </div>
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Đặt lại mật khẩu</h1>
        <p class="text-gray-600">Tạo mật khẩu mới cho tài khoản của bạn</p>
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

    <!-- Reset Form -->
    <form id="resetPasswordForm" method="POST" action="{{ route('auth.password.update') }}" class="space-y-6">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <div class="relative">
                <input type="email" id="email" name="email" required value="{{ old('email', $request->email) }}"
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

        <!-- Mật khẩu mới -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                Mật khẩu mới <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200 input-focus @error('password') border-red-500 @enderror"
                    placeholder="Tối thiểu 8 ký tự"
                    onkeyup="checkPasswordStrength(this.value)">
                <button type="button" onclick="togglePassword('password', 'passwordIcon')" 
                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <i id="passwordIcon" class="ri-eye-line"></i>
                </button>
            </div>
            <!-- Password strength indicator -->
            <div class="mt-2">
                <div class="password-strength">
                    <div id="strengthBar" class="h-full transition-all duration-300"></div>
                </div>
                <p id="strengthText" class="text-xs text-gray-500 mt-1">Nhập mật khẩu để kiểm tra độ mạnh</p>
            </div>
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Xác nhận mật khẩu mới -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                Xác nhận mật khẩu <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <input type="password" id="password_confirmation" name="password_confirmation" required
                    class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200 input-focus"
                    placeholder="Nhập lại mật khẩu">
                <button type="button" onclick="togglePassword('password_confirmation', 'confirmPasswordIcon')" 
                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <i id="confirmPasswordIcon" class="ri-eye-line"></i>
                </button>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" id="submitBtn"
            class="w-full bg-primary text-white py-3 px-6 rounded-button font-medium hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
            <span id="submitText">Đặt lại mật khẩu</span>
            <i id="loadingIcon" class="ri-loader-4-line animate-spin ml-2 hidden"></i>
        </button>
    </form>
</div>
@endsection

@push('scripts')
<script>
    // Password strength checker
    function checkPasswordStrength(password) {
        const strengthBar = document.getElementById('strengthBar');
        const strengthText = document.getElementById('strengthText');
        
        let strength = 0;
        const checks = [
            /.{8,}/, /[a-z]/, /[A-Z]/, /[0-9]/, /[^A-Za-z0-9]/
        ];
        
        checks.forEach(check => {
            if (check.test(password)) strength++;
        });
        
        if (password.length === 0) {
            strengthBar.className = 'h-full transition-all duration-300';
            strengthText.textContent = 'Nhập mật khẩu để kiểm tra độ mạnh';
            strengthText.className = 'text-xs text-gray-500 mt-1';
        } else if (strength < 3) {
            strengthBar.className = 'h-full transition-all duration-300 strength-weak';
            strengthText.textContent = 'Mật khẩu yếu';
            strengthText.className = 'text-xs text-red-500 mt-1';
        } else if (strength < 5) {
            strengthBar.className = 'h-full transition-all duration-300 strength-medium';
            strengthText.textContent = 'Mật khẩu trung bình';
            strengthText.className = 'text-xs text-yellow-600 mt-1';
        } else {
            strengthBar.className = 'h-full transition-all duration-300 strength-strong';
            strengthText.textContent = 'Mật khẩu mạnh';
            strengthText.className = 'text-xs text-green-600 mt-1';
        }
    }

    // Form submission
    document.getElementById('resetPasswordForm')?.addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('submitBtn');
        if (submitBtn.disabled) {
            e.preventDefault();
            return;
        }
        const submitText = document.getElementById('submitText');
        const loadingIcon = document.getElementById('loadingIcon');
        
        submitBtn.disabled = true;
        submitText.textContent = 'Đang xử lý...';
        loadingIcon.classList.remove('hidden');
    });
</script>
@endpush

@extends('layouts.auth')

@section('title', 'Đăng ký tài khoản')

@section('content')
<!-- Form Card -->
<div class="form-card rounded-2xl p-8">
    <!-- Header -->
    <div class="text-center mb-8">
        <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="ri-user-add-line text-2xl text-primary"></i>
        </div>
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Tạo tài khoản mới</h1>
        <p class="text-gray-600">Gia nhập cộng đồng 20,000+ phụ huynh cùng LT365</p>
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

    <!-- Form -->
    <form method="POST" action="{{ route('auth.register') }}" class="space-y-6">
        @csrf
        
        <!-- Họ và tên -->
        <div>
            <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">
                Họ và tên <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <input type="text" id="full_name" name="full_name" required
                    value="{{ old('full_name') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200 input-focus @error('full_name') border-red-500 @enderror"
                    placeholder="Nhập họ và tên đầy đủ">
                <div class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                    <i class="ri-user-line"></i>
                </div>
            </div>
            @error('full_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                Email <span class="text-red-500">*</span>
            </label>
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

        <!-- Số điện thoại -->
        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                Số điện thoại <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <input type="tel" id="phone" name="phone" required
                    value="{{ old('phone') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200 input-focus @error('phone') border-red-500 @enderror"
                    placeholder="0987 654 321">
                <div class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                    <i class="ri-phone-line"></i>
                </div>
            </div>
            @error('phone')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Mật khẩu -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                Mật khẩu <span class="text-red-500">*</span>
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

        <!-- Xác nhận mật khẩu -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                Xác nhận mật khẩu <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <input type="password" id="password_confirmation" name="password_confirmation" required
                    class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200 input-focus"
                    placeholder="Nhập lại mật khẩu"
                    onkeyup="checkPasswordMatch()">
                <button type="button" onclick="togglePassword('password_confirmation', 'confirmPasswordIcon')" 
                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <i id="confirmPasswordIcon" class="ri-eye-line"></i>
                </button>
            </div>
        </div>

        <!-- Checkbox -->
        <div class="space-y-3">
            <div class="flex items-start gap-3">
                <input type="checkbox" id="terms" name="terms" required
                    class="mt-1 w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary/20 @error('terms') border-red-500 @enderror">
                <label for="terms" class="text-sm text-gray-700">
                    Tôi đồng ý với 
                    <a href="#" class="text-primary hover:underline">Điều khoản sử dụng</a> 
                    và 
                    <a href="#" class="text-primary hover:underline">Chính sách bảo mật</a> 
                    của LT365 <span class="text-red-500">*</span>
                </label>
            </div>
            @error('terms')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
            
            <div class="flex items-start gap-3">
                <input type="checkbox" id="newsletter" name="newsletter"
                    class="mt-1 w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary/20">
                <label for="newsletter" class="text-sm text-gray-700">
                    Tôi muốn nhận email thông báo về tin tức tuyển sinh và tài liệu mới
                </label>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" id="submitBtn"
            class="w-full bg-primary text-white py-3 px-6 rounded-button font-medium hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
            <span id="submitText">Đăng ký tài khoản</span>
            <i id="submitIcon" class="ri-arrow-right-line ml-2 hidden"></i>
            <i id="loadingIcon" class="ri-loader-4-line animate-spin ml-2 hidden"></i>
        </button>

        <!-- Divider -->
        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-4 bg-white text-gray-500">hoặc</span>
            </div>
        </div>

        <!-- Login Link -->
        <div class="text-center">
            <p class="text-gray-600">
                Đã có tài khoản? 
                <a href="{{ route('auth.login') }}" class="text-primary font-medium hover:underline">Đăng nhập ngay</a>
            </p>
        </div>
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
            /.{8,}/, // At least 8 characters
            /[a-z]/, // Lowercase
            /[A-Z]/, // Uppercase
            /[0-9]/, // Numbers
            /[^A-Za-z0-9]/ // Special characters
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

    // Password match checker
    function checkPasswordMatch() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;
        
        if (confirmPassword.length > 0) {
            if (password === confirmPassword) {
                showValidation('password_confirmation', '', true);
            } else {
                showValidation('password_confirmation', 'Mật khẩu không khớp', false);
            }
        }
    }

    // Form submission
    document.getElementById('registerForm')?.addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');
        const loadingIcon = document.getElementById('loadingIcon');
        
        // Show loading state
        submitBtn.disabled = true;
        submitText.textContent = 'Đang xử lý...';
        loadingIcon.classList.remove('hidden');
    });
</script>
@endpush

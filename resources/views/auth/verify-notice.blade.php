@extends('layouts.auth')

@section('title', 'Xác thực email')

@section('content')
<!-- Verification Card -->
<div class="form-card rounded-2xl p-8 text-center">
    <!-- Icon -->
    <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
        <i class="ri-mail-check-line text-3xl text-blue-600"></i>
    </div>

    <!-- Content -->
    <h1 class="text-2xl font-bold text-gray-900 mb-4">Kiểm tra email của bạn</h1>
    <p class="text-gray-600 mb-6">
        Chúng tôi đã gửi liên kết xác thực đến địa chỉ email:
    </p>
    <p class="text-lg font-medium text-primary mb-8">{{ $email }}</p>

    <!-- Instructions -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6 text-left">
        <h3 class="font-medium text-blue-800 mb-2">Hướng dẫn:</h3>
        <ol class="text-sm text-blue-700 space-y-1">
            <li>1. Mở email trong hộp thư của bạn</li>
            <li>2. Click vào liên kết "Xác thực tài khoản"</li>
            <li>3. Quay lại trang này để hoàn tất</li>
        </ol>
    </div>

    <!-- Timer -->
    <div class="mb-6">
        <p class="text-sm text-gray-500">
            Link sẽ hết hạn sau: 
            <span id="timer" class="font-medium text-orange-600">59:59</span>
        </p>
    </div>

    <!-- Display resend errors -->
    @error('resend')
        <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg mb-6 text-sm">
            {{ $message }}
        </div>
    @enderror

    <!-- Action Buttons -->
    <div class="space-y-3">
        <form method="POST" action="{{ route('auth.verify.resend') }}" class="inline-block w-full" id="resendForm">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">
            <button type="submit" id="resendBtn" 
                class="w-full bg-primary text-white py-3 px-6 rounded-button font-medium hover:bg-primary/90 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                <i class="ri-refresh-line mr-2"></i>
                <span id="resendText">Gửi lại email xác thực</span>
            </button>
        </form>
        
        <a href="{{ route('auth.register') }}" 
            class="w-full border border-gray-300 text-gray-700 py-3 px-6 rounded-button font-medium hover:bg-gray-50 transition-all duration-200 inline-flex items-center justify-center">
            <i class="ri-edit-line mr-2"></i>
            Thay đổi địa chỉ email
        </a>
    </div>

    <!-- Help -->
    <div class="mt-8 pt-6 border-t border-gray-200">
        <p class="text-sm text-gray-500 mb-3">Không nhận được email?</p>
        <div class="text-xs text-gray-400 space-y-1">
            <p>• Kiểm tra thư mục Spam/Junk</p>
            <p>• Đảm bảo email chính xác</p>
            <p>• Liên hệ hỗ trợ: <a href="tel:0987654321" class="text-primary">0987 654 321</a></p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let linkTimeLeft = 60 * 60; // 60 minutes for link expiration
        const linkTimerEl = document.getElementById('timer');
        
        const linkTimerInterval = setInterval(() => {
            linkTimeLeft--;
            const minutes = Math.floor(linkTimeLeft / 60);
            const seconds = linkTimeLeft % 60;
            if (linkTimerEl) {
                linkTimerEl.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            }
            if (linkTimeLeft <= 0) {
                clearInterval(linkTimerInterval);
                if (linkTimerEl) linkTimerEl.textContent = '00:00';
                showAlert('Liên kết đã hết hạn. Vui lòng gửi lại email xác thực.', 'warning');
            }
        }, 1000);

        const resendBtn = document.getElementById('resendBtn');
        const resendText = document.getElementById('resendText');
        let resendCooldown = 60; // 60 seconds cooldown

        function startResendCooldown() {
            resendBtn.disabled = true;
            const cooldownInterval = setInterval(() => {
                resendCooldown--;
                resendText.textContent = `Gửi lại sau ${resendCooldown}s`;
                if (resendCooldown <= 0) {
                    clearInterval(cooldownInterval);
                    resendBtn.disabled = false;
                    resendText.textContent = 'Gửi lại email xác thực';
                    resendCooldown = 60; // Reset for next click
                }
            }, 1000);
        }

        // Start cooldown on page load
        startResendCooldown();

        // Handle form submission for resend
        document.getElementById('resendForm').addEventListener('submit', function(e) {
            const resendBtn = document.getElementById('resendBtn');
            const resendText = document.getElementById('resendText');
            
            resendBtn.disabled = true;
            resendText.textContent = 'Đang gửi...';

            // After submission, the page will reload and the cooldown will restart
        });
    });
</script>
@endpush

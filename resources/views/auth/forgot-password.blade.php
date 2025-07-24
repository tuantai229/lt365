@extends('layouts.auth')

@section('title', 'Quên mật khẩu')

@section('content')
<!-- Forgot Password Card -->
<div class="form-card rounded-2xl p-8">
    <!-- Header -->
    <div class="text-center mb-8">
        <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="ri-lock-unlock-line text-2xl text-orange-600"></i>
        </div>
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Quên mật khẩu?</h1>
        <p class="text-gray-600">Nhập email để nhận liên kết đặt lại mật khẩu</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg mb-6 text-sm">
            {{ session('status') }}
        </div>
    @endif

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
    <form id="resetForm" method="POST" action="{{ route('auth.password.email') }}" class="space-y-6">
        @csrf
        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email đã đăng ký</label>
            <div class="relative">
                <input type="email" id="email" name="email" required value="{{ old('email') }}"
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

        <!-- Submit Button -->
        <button type="submit" id="resetBtn"
            class="w-full bg-primary text-white py-3 px-6 rounded-button font-medium hover:bg-primary/90 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
            <span id="resetText">Gửi liên kết đặt lại</span>
            <i id="resetLoadingIcon" class="ri-loader-4-line animate-spin ml-2 hidden"></i>
        </button>

        <!-- Back to Login -->
        <div class="text-center pt-4">
            <a href="{{ route('auth.login') }}" class="text-primary font-medium hover:underline">
                <i class="ri-arrow-left-line mr-1"></i>
                Quay lại đăng nhập
            </a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('resetForm')?.addEventListener('submit', function(e) {
        const resetBtn = document.getElementById('resetBtn');
        
        if (resetBtn.disabled) {
            e.preventDefault();
            return;
        }

        const resetText = document.getElementById('resetText');
        const loadingIcon = document.getElementById('resetLoadingIcon');
        
        resetBtn.disabled = true;
        resetText.textContent = 'Đang gửi...';
        loadingIcon.classList.remove('hidden');
    });
</script>
@endpush

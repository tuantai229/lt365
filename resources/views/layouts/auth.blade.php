<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Authentication') - LT365</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4f46e5',
                        secondary: '#f59e0b'
                    },
                    borderRadius: {
                        'button': '8px'
                    }
                }
            }
        }
    </script>
    <style>
        .auth-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .form-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .input-focus:focus {
            transform: translateY(-1px);
            box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.1);
        }
        .password-strength {
            height: 4px;
            background: #e5e7eb;
            border-radius: 2px;
            overflow: hidden;
        }
        .strength-weak { background: #ef4444; width: 33%; }
        .strength-medium { background: #f59e0b; width: 66%; }
        .strength-strong { background: #10b981; width: 100%; }
    </style>
    @stack('styles')
</head>
<body class="auth-container">
    <!-- Header đơn giản -->
    <header class="relative z-10 pt-6 pb-4">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between">
                <!-- Back Button -->
                <button onclick="history.back()" class="flex items-center gap-2 text-white/80 hover:text-white transition-colors duration-200">
                    <i class="ri-arrow-left-line text-xl"></i>
                    <span class="hidden sm:inline">Quay lại</span>
                </button>
                
                <!-- Logo -->
                <a href="{{ url('/') }}" class="font-['Pacifico'] text-3xl text-white">LT365</a>
                
                <!-- Spacer for center alignment -->
                <div class="w-20"></div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-md">
            @yield('content')

            <!-- Additional Info -->
            <div class="text-center mt-6 text-white/80 text-sm">
                <p>🎉 Miễn phí 100% • 📚 20,000+ tài liệu • ⭐ Đánh giá 4.8/5</p>
            </div>
        </div>
    </main>

    <!-- Footer tối giản -->
    <footer class="relative z-10 py-8 text-center">
        <div class="container mx-auto px-4">
            <div class="text-white/60 text-sm space-y-3">
                <p>&copy; 2025 LT365. Tất cả quyền được bảo lưu.</p>
                <div class="flex justify-center gap-6">
                    <a href="#" class="hover:text-white/80 transition-colors duration-200">Chính sách bảo mật</a>
                    <a href="#" class="hover:text-white/80 transition-colors duration-200">Điều khoản sử dụng</a>
                    <a href="#" class="hover:text-white/80 transition-colors duration-200">Hỗ trợ</a>
                </div>
                <div class="flex justify-center gap-4 mt-4">
                    <a href="#" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-colors duration-200">
                        <i class="ri-facebook-fill text-white/60"></i>
                    </a>
                    <a href="#" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-colors duration-200">
                        <i class="ri-youtube-fill text-white/60"></i>
                    </a>
                    <a href="#" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-colors duration-200">
                        <i class="ri-phone-line text-white/60"></i>
                    </a>
                </div>
                <p class="text-xs">Hotline hỗ trợ: <span class="text-white/80 font-medium">0987 654 321</span></p>
            </div>
        </div>
    </footer>

    <!-- JavaScript chung -->
    <script>
        // Toggle password visibility
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('ri-eye-line');
                icon.classList.add('ri-eye-off-line');
            } else {
                input.type = 'password';
                icon.classList.remove('ri-eye-off-line');
                icon.classList.add('ri-eye-line');
            }
        }

        // Form validation helper
        function showValidation(inputId, message, isValid) {
            const input = document.getElementById(inputId);
            const errorDiv = input.parentNode.querySelector('.error-message');
            
            if (isValid) {
                input.classList.remove('border-red-500', 'focus:ring-red-200');
                input.classList.add('border-green-500', 'focus:ring-green-200');
                if (errorDiv) errorDiv.remove();
            } else {
                input.classList.remove('border-green-500', 'focus:ring-green-200');
                input.classList.add('border-red-500', 'focus:ring-red-200');
                
                if (!errorDiv) {
                    const div = document.createElement('div');
                    div.className = 'error-message text-red-500 text-sm mt-1';
                    div.textContent = message;
                    input.parentNode.appendChild(div);
                }
            }
        }

        // Show alert messages
        function showAlert(message, type = 'info') {
            const colors = {
                success: 'bg-green-100 border-green-300 text-green-700',
                error: 'bg-red-100 border-red-300 text-red-700',
                warning: 'bg-yellow-100 border-yellow-300 text-yellow-700',
                info: 'bg-blue-100 border-blue-300 text-blue-700'
            };

            const alertDiv = document.createElement('div');
            alertDiv.className = `fixed top-4 right-4 z-50 p-4 border rounded-lg ${colors[type]} max-w-sm`;
            alertDiv.innerHTML = `
                <div class="flex items-center gap-2">
                    <span>${message}</span>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-auto">
                        <i class="ri-close-line"></i>
                    </button>
                </div>
            `;
            
            document.body.appendChild(alertDiv);
            
            setTimeout(() => {
                if (alertDiv.parentElement) {
                    alertDiv.remove();
                }
            }, 5000);
        }

        // Handle Laravel flash messages
        @if(session('success'))
            showAlert('{{ session('success') }}', 'success');
        @endif
        
        @if(session('error'))
            showAlert('{{ session('error') }}', 'error');
        @endif
        
        @if(session('warning'))
            showAlert('{{ session('warning') }}', 'warning');
        @endif
        
        @if(session('info'))
            showAlert('{{ session('info') }}', 'info');
        @endif
    </script>

    @stack('scripts')
</body>
</html>

<section class="py-12 bg-gradient-to-r from-primary to-indigo-700 text-white">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-6">Đăng ký nhận tài liệu mới nhất</h2>
            <p class="text-xl mb-8 opacity-90">Nhận thông báo về đề thi, tài liệu ôn tập và tin tức tuyển sinh mới nhất qua email</p>
            
            <form action="{{ route('newsletter.subscribe') }}" method="POST" class="newsletter-form flex flex-col md:flex-row gap-4 max-w-lg mx-auto">
                @csrf
                <div class="flex-1 relative">
                    <input type="email" 
                           name="email"
                           placeholder="Nhập email của bạn..." 
                           class="newsletter-email w-full py-3 px-4 rounded-button text-gray-900 focus:outline-none focus:ring-2 focus:ring-white/20"
                           required>
                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none text-gray-400">
                        <i class="ri-mail-line"></i>
                    </div>
                </div>
                <button type="submit" class="newsletter-submit-btn md:w-auto px-6 py-3 bg-white text-primary font-medium rounded-button hover:bg-gray-100 transition-colors duration-200 whitespace-nowrap">
                    <span class="btn-text">Đăng ký ngay</span>
                    <span class="loading-spinner hidden">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-primary inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Đang xử lý...
                    </span>
                </button>
            </form>
            
            <!-- Message display area -->
            <div class="newsletter-message hidden mt-4">
                <div class="p-3 rounded-lg text-sm font-medium max-w-lg mx-auto"></div>
            </div>
            
            <p class="text-sm opacity-80 mt-4">15,000+ phụ huynh đã đăng ký nhận tài liệu từ LT365</p>
        </div>
    </div>
</section>

<section class="py-12 bg-gradient-to-r from-primary to-indigo-700 text-white">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-6">Đăng ký nhận tin tức tuyển sinh mới nhất</h2>
            <p class="text-lg mb-8 opacity-90">Cập nhật thông tin tuyển sinh, lịch thi và các quy định mới ngay khi có thông báo chính thức</p>
            
            <form action="{{ route('newsletter.subscribe') }}" method="POST" class="newsletter-form flex flex-col md:flex-row gap-4 mb-4 max-w-2xl mx-auto">
                @csrf
                <div class="flex-1">
                    <input type="email" 
                           name="email" 
                           placeholder="Nhập email của bạn" 
                           class="newsletter-email w-full p-3 rounded-button border-none focus:outline-none focus:ring-2 focus:ring-white/30 bg-white/10 text-white placeholder-white/70"
                           required>
                </div>
                <button type="submit" 
                        class="newsletter-submit-btn md:w-auto px-6 py-3 bg-white text-primary font-medium rounded-button hover:bg-gray-100 transition-colors duration-200 whitespace-nowrap !rounded-button">
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
            <div class="newsletter-message hidden mb-4">
                <div class="p-3 rounded-lg text-sm font-medium"></div>
            </div>
            
            <p class="text-sm opacity-80">15,000+ phụ huynh đã đăng ký nhận thông tin từ LT365</p>
        </div>
    </div>
</section>

@push('scripts')
    <script src="{{ asset('js/newsletter.js') }}" defer></script>
@endpush

<!-- CTA Form -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto bg-gradient-to-r from-primary to-indigo-700 rounded-xl shadow-xl overflow-hidden">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/2 p-8 text-white">
                    <h2 class="text-3xl font-bold mb-4">Sẵn sàng chinh phục kỳ thi chuyển cấp?</h2>
                    <p class="mb-6">Đăng ký nhận tư vấn miễn phí từ đội ngũ chuyên gia của LT365 để có lộ trình ôn tập phù hợp nhất cho con</p>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center text-white">
                                <i class="ri-user-star-line"></i>
                            </div>
                            <span>Đội ngũ giáo viên giàu kinh nghiệm</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center text-white">
                                <i class="ri-book-open-line"></i>
                            </div>
                            <span>Tài liệu luyện thi chất lượng cao</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center text-white">
                                <i class="ri-road-map-line"></i>
                            </div>
                            <span>Lộ trình học tập cá nhân hóa</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <div class="flex -space-x-2">
                            <img src="{{ asset('html/images/ff94b4ae9d28ffb64ceb4291357e4c9b.jpg') }}" alt="Phụ huynh 1" class="w-10 h-10 rounded-full border-2 border-white">
                            <img src="{{ asset('html/images/a288dc0e7524b87127c3af6deef29339.jpg') }}" alt="Phụ huynh 2" class="w-10 h-10 rounded-full border-2 border-white">
                            <img src="{{ asset('html/images/c5a9379a501da2a0b19620f40b75f8cb.jpg') }}" alt="Phụ huynh 3" class="w-10 h-10 rounded-full border-2 border-white">
                        </div>
                        <span class="text-sm">5,000+ phụ huynh đã đăng ký</span>
                    </div>
                </div>
                
                <div class="md:w-1/2 bg-white p-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Đăng ký tư vấn miễn phí</h3>
                    
                    <form action="{{ route('contact.store') }}" method="POST" class="cta-contact-form space-y-4">
                        @csrf
                        <div>
                            <label for="cta-name" class="block text-sm font-medium text-gray-700 mb-1">Họ và tên phụ huynh</label>
                            <input type="text" id="cta-name" name="name" placeholder="Nhập họ và tên" class="w-full p-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" required>
                        </div>
                        
                        <div>
                            <label for="cta-email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" id="cta-email" name="email" placeholder="Nhập email" class="w-full p-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" required>
                        </div>
                        
                        <div>
                            <label for="cta-phone" class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại</label>
                            <input type="tel" id="cta-phone" name="phone" placeholder="Nhập số điện thoại" class="w-full p-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" required>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Cấp học quan tâm</label>
                            <div class="space-y-2">
                                <label for="cta-grade-1" class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" id="cta-grade-1" name="grade" value="Thi vào lớp 1" class="form-radio text-primary focus:ring-primary/50">
                                    <span>Thi vào lớp 1</span>
                                </label>
                                <label for="cta-grade-6" class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" id="cta-grade-6" name="grade" value="Thi vào lớp 6" class="form-radio text-primary focus:ring-primary/50">
                                    <span>Thi vào lớp 6</span>
                                </label>
                                <label for="cta-grade-10" class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" id="cta-grade-10" name="grade" value="Thi vào lớp 10" class="form-radio text-primary focus:ring-primary/50">
                                    <span>Thi vào lớp 10</span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="cta-agree" name="agree_terms" class="form-checkbox rounded text-primary focus:ring-primary/50" required>
                            <label for="cta-agree" class="text-sm cursor-pointer">Tôi đồng ý với <a href="#" class="text-primary hover:underline">điều khoản sử dụng</a> và <a href="#" class="text-primary hover:underline">chính sách bảo mật</a></label>
                        </div>

                        <!-- Message display area -->
                        <div class="cta-message hidden">
                            <div class="p-3 rounded-lg text-sm font-medium"></div>
                        </div>
                        
                        <button type="submit" class="cta-submit-btn w-full py-3 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors duration-200 font-medium whitespace-nowrap !rounded-button">
                            <span class="btn-text">Đăng ký ngay</span>
                            <span class="loading-spinner hidden">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Đang xử lý...
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

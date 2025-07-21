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
                    
                    <form class="space-y-4" id="cta-form">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Họ và tên phụ huynh</label>
                            <input type="text" placeholder="Nhập họ và tên" class="w-full p-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại</label>
                            <input type="tel" placeholder="Nhập số điện thoại" class="w-full p-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Cấp học quan tâm</label>
                            <div class="space-y-2">
                                <div class="flex items-center gap-2">
                                    <div class="custom-radio" id="radio-lop1"></div>
                                    <label for="radio-lop1" class="cursor-pointer">Thi vào lớp 1</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="custom-radio" id="radio-lop6"></div>
                                    <label for="radio-lop6" class="cursor-pointer">Thi vào lớp 6</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="custom-radio" id="radio-lop10"></div>
                                    <label for="radio-lop10" class="cursor-pointer">Thi vào lớp 10</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <div class="custom-checkbox" id="checkbox-agree"></div>
                            <label for="checkbox-agree" class="text-sm cursor-pointer">Tôi đồng ý với <a href="#" class="text-primary hover:underline">điều khoản sử dụng</a> và <a href="#" class="text-primary hover:underline">chính sách bảo mật</a></label>
                        </div>
                        
                        <button type="submit" class="w-full py-3 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors duration-200 font-medium whitespace-nowrap !rounded-button">Đăng ký ngay</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

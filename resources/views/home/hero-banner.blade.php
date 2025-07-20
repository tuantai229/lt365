<!-- Hero Banner Slider -->
<section class="relative overflow-hidden bg-gray-100">
    <div class="container mx-auto px-4 py-6">
        <div class="hero-slider-container relative w-full overflow-hidden rounded-lg shadow-lg" style="height: 450px;">
            
            <!-- Slide 1: Đồng hành cùng con vào trường chuyên -->
            <div class="hero-slide active" style="background-image: url('{{ asset('html/images/0185df70dbcee70ff37980a67a92ce64.jpg') }}'); background-size: cover; background-position: center;">
                <div class="absolute inset-0 bg-gradient-to-r from-primary/80 to-transparent"></div>
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full container mx-auto px-4 md:px-10 flex">
                        <div class="w-1/2 text-white">
                            <h2 class="text-4xl font-bold mb-4">Đồng hành cùng con vào trường chuyên</h2>
                            <p class="text-lg mb-6">Cung cấp tài liệu, kinh nghiệm và tư vấn chuyên sâu giúp học sinh và phụ huynh tự tin vượt qua kỳ thi chuyển cấp</p>
                            <div class="flex gap-4">
                                <button class="px-6 py-3 bg-white text-primary font-medium rounded-button hover:bg-gray-100 transition-colors duration-200 whitespace-nowrap !rounded-button">Tìm tài liệu</button>
                                <button class="px-6 py-3 bg-secondary text-white font-medium rounded-button hover:bg-secondary/90 transition-colors duration-200 whitespace-nowrap !rounded-button">Đăng ký tư vấn</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2: Học cùng thầy giỏi -->
            <div class="hero-slide" style="background-image: url('{{ asset('html/images/slide-giaovien.png') }}'); background-size: cover; background-position: center;">
                <div class="absolute inset-0 bg-gradient-to-r from-green-600/80 to-transparent"></div>
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full container mx-auto px-4 md:px-10 flex">
                        <div class="w-1/2 text-white">
                            <h2 class="text-4xl font-bold mb-4">Học cùng thầy giỏi – vào trường chuyên dễ dàng hơn</h2>
                            <p class="text-lg mb-6">Hơn 50 trung tâm & giáo viên luyện thi chuyển cấp uy tín, được phụ huynh tin chọn trên toàn quốc.</p>
                            <div class="flex gap-4">
                                <button class="px-6 py-3 bg-white text-green-600 font-medium rounded-button hover:bg-gray-100 transition-colors duration-200 whitespace-nowrap !rounded-button">Tìm giáo viên phù hợp</button>
                                <button class="px-6 py-3 bg-secondary text-white font-medium rounded-button hover:bg-secondary/90 transition-colors duration-200 whitespace-nowrap !rounded-button">Xem trung tâm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 3: Chọn đúng trường -->
            <div class="hero-slide" style="background-image: url('{{ asset('html/images/slide-tuvan.png') }}'); background-size: cover; background-position: center;">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600/80 to-transparent"></div>
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full container mx-auto px-4 md:px-10 flex">
                        <div class="w-1/2 text-white">
                            <h2 class="text-4xl font-bold mb-4">Chọn đúng trường, đúng hướng đi</h2>
                            <p class="text-lg mb-6">Chuyên gia tư vấn giáo dục LT365 giúp phụ huynh lựa chọn trường phù hợp nhất với năng lực và sở thích của con.</p>
                            <div class="flex gap-4">
                                <button class="px-6 py-3 bg-white text-blue-600 font-medium rounded-button hover:bg-gray-100 transition-colors duration-200 whitespace-nowrap !rounded-button">Đăng ký tư vấn 1-1</button>
                                <button class="px-6 py-3 bg-secondary text-white font-medium rounded-button hover:bg-secondary/90 transition-colors duration-200 whitespace-nowrap !rounded-button">Xem trường phù hợp</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 4: Cập nhật lịch thi -->
            <div class="hero-slide" style="background-image: url('{{ asset('html/images/slide-lichthi.png') }}'); background-size: cover; background-position: center;">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-600/80 to-transparent"></div>
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full container mx-auto px-4 md:px-10 flex">
                        <div class="w-1/2 text-white">
                            <h2 class="text-4xl font-bold mb-4">Cập nhật lịch thi mới nhất năm 2025</h2>
                            <p class="text-lg mb-6">Theo dõi lịch thi, chỉ tiêu tuyển sinh và thông báo quan trọng từ các trường chuyên, trường top.</p>
                            <div class="flex gap-4">
                                <button class="px-6 py-3 bg-white text-purple-600 font-medium rounded-button hover:bg-gray-100 transition-colors duration-200 whitespace-nowrap !rounded-button">Xem lịch thi 2025</button>
                                <button class="px-6 py-3 bg-secondary text-white font-medium rounded-button hover:bg-secondary/90 transition-colors duration-200 whitespace-nowrap !rounded-button">Nhận thông báo qua email</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Navigation Arrows -->
            <button class="slider-nav-btn absolute left-4 top-1/2 transform -translate-y-1/2 w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white hover:bg-white/30 transition-colors duration-200 z-20" onclick="previousSlide()">
                <i class="ri-arrow-left-s-line text-2xl"></i>
            </button>
            <button class="slider-nav-btn absolute right-4 top-1/2 transform -translate-y-1/2 w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white hover:bg-white/30 transition-colors duration-200 z-20" onclick="nextSlide()">
                <i class="ri-arrow-right-s-line text-2xl"></i>
            </button>
            
            <!-- Slider Indicators -->
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-2 z-20">
                <button class="slide-indicator w-3 h-3 rounded-full bg-white opacity-100" onclick="goToSlide(0)"></button>
                <button class="slide-indicator w-3 h-3 rounded-full bg-white opacity-50" onclick="goToSlide(1)"></button>
                <button class="slide-indicator w-3 h-3 rounded-full bg-white opacity-50" onclick="goToSlide(2)"></button>
                <button class="slide-indicator w-3 h-3 rounded-full bg-white opacity-50" onclick="goToSlide(3)"></button>
            </div>
        </div>
    </div>
</section>

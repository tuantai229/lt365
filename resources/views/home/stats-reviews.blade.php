<!-- Thống kê & Đánh giá -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Thống kê -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12">
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <div class="text-3xl font-bold text-primary mb-2">10,000+</div>
                <p class="text-gray-600">Tài liệu</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <div class="text-3xl font-bold text-primary mb-2">500+</div>
                <p class="text-gray-600">Trường học</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <div class="text-3xl font-bold text-primary mb-2">50,000+</div>
                <p class="text-gray-600">Thành viên</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <div class="text-3xl font-bold text-primary mb-2">4.8/5</div>
                <p class="text-gray-600">Đánh giá</p>
            </div>
        </div>
        
        <!-- Đánh giá -->
        <h2 class="text-3xl font-bold text-center mb-10">Phụ huynh nói gì về chúng tôi</h2>
        
        <div class="content-slider-wrapper">
            <div class="content-slider flex overflow-x-auto gap-6 pb-4 -mx-4 px-4" id="reviewSlider">
                <!-- Các item đánh giá -->
                <!-- Đánh giá 1 -->
                <div class="bg-white rounded-lg shadow-md p-6 min-w-[350px]">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
                            <img src="{{ asset('html/images/ef17c185dacb5a2bbf309f78e126433f.jpg') }}" alt="Chị Nguyễn Thị Hà" class="w-full h-full object-cover object-top">
                        </div>
                        <div>
                            <h4 class="font-bold">Chị Nguyễn Thị Hà</h4>
                            <div class="flex text-yellow-400">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600">"Tôi rất hài lòng với tài liệu ôn thi vào lớp 1 của LT365. Con tôi đã vượt qua kỳ thi vào trường Tiểu học Thăng Long một cách dễ dàng. Cảm ơn đội ngũ LT365 rất nhiều!"</p>
                </div>
                
                <!-- Đánh giá 2 -->
                <div class="bg-white rounded-lg shadow-md p-6 min-w-[350px]">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
                            <img src="{{ asset('html/images/c6aa794681e3876e3fffebc450fdafda.jpg') }}" alt="Anh Trần Minh Đức" class="w-full h-full object-cover object-top">
                        </div>
                        <div>
                            <h4 class="font-bold">Anh Trần Minh Đức</h4>
                            <div class="flex text-yellow-400">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-half-fill"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600">"Tư vấn chọn trường của LT365 rất hữu ích. Nhờ có sự hướng dẫn chi tiết, gia đình tôi đã chọn được trường THCS phù hợp nhất cho con. Đội ngũ tư vấn rất nhiệt tình và chuyên nghiệp."</p>
                </div>
                
                <!-- Đánh giá 3 -->
                <div class="bg-white rounded-lg shadow-md p-6 min-w-[350px]">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
                            <img src="{{ asset('html/images/9dd31202e9f05056bfbfb5ef7cbdea35.jpg') }}" alt="Chị Lê Thị Hồng Nhung" class="w-full h-full object-cover object-top">
                        </div>
                        <div>
                            <h4 class="font-bold">Chị Lê Thị Hồng Nhung</h4>
                            <div class="flex text-yellow-400">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-line"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600">"Đề thi thử vào lớp 10 của LT365 rất sát với đề thi thật. Con tôi đã luyện tập với bộ đề này và đạt kết quả cao trong kỳ thi vào trường THPT chuyên. Rất đáng để thử!"</p>
                </div>
            </div>
            
            <!-- Navigation buttons -->
            <button class="nav-btn absolute left-0 top-1/2 transform -translate-y-1/2 w-10 h-10 rounded-full bg-white shadow-md flex items-center justify-center z-10 -ml-5" onclick="slideContent('reviewSlider', 'prev')" id="reviewPrev">
                <i class="ri-arrow-left-s-line"></i>
            </button>
            <button class="nav-btn absolute right-0 top-1/2 transform -translate-y-1/2 w-10 h-10 rounded-full bg-white shadow-md flex items-center justify-center z-10 -mr-5" onclick="slideContent('reviewSlider', 'next')" id="reviewNext">
                <i class="ri-arrow-right-s-line"></i>
            </button>
        </div>
    </div>
</section>

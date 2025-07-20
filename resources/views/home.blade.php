@extends('layouts.app')

@section('title', 'LT365 - Đồng hành cùng con vào trường chuyên')

@section('content')
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

    <!-- Khối Chuyển Cấp Nhanh -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-10">Đồng hành cùng con vào trường chuyên</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Lớp 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                    <div class="h-40 bg-blue-50 flex items-center justify-center">
                        <img src="{{ asset('html/images/dc78c9c0887200a40954cba8e72a3499.jpg') }}" alt="Thi vào lớp 1" class="w-full h-full object-cover object-top">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-3 text-primary">Thi vào lớp 1</h3>
                        <ul class="mb-4 space-y-2">
                            <li class="flex items-center gap-2">
                                <i class="ri-check-line text-green-500"></i>
                                <span>5 trường tiểu học hàng đầu Hà Nội</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <i class="ri-check-line text-green-500"></i>
                                <span>Lịch thi tuyển sinh năm 2025-2026</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <i class="ri-check-line text-green-500"></i>
                                <span>Bộ đề luyện thi mẫu cập nhật</span>
                            </li>
                        </ul>
                        <a href="#" class="inline-block px-4 py-2 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors duration-200 text-sm font-medium whitespace-nowrap !rounded-button">Xem thêm</a>
                    </div>
                </div>
                
                <!-- Lớp 6 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                    <div class="h-40 bg-indigo-50 flex items-center justify-center">
                        <img src="{{ asset('html/images/3d7d5e0502820a5e09cf3fb76caa9d88.jpg') }}" alt="Thi vào lớp 6" class="w-full h-full object-cover object-top">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-3 text-primary">Thi vào lớp 6</h3>
                        <ul class="mb-4 space-y-2">
                            <li class="flex items-center gap-2">
                                <i class="ri-check-line text-green-500"></i>
                                <span>Top trường THCS chất lượng cao</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <i class="ri-check-line text-green-500"></i>
                                <span>Cấu trúc đề thi các môn năm 2025</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <i class="ri-check-line text-green-500"></i>
                                <span>Tài liệu luyện thi chuyên sâu</span>
                            </li>
                        </ul>
                        <a href="#" class="inline-block px-4 py-2 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors duration-200 text-sm font-medium whitespace-nowrap !rounded-button">Xem thêm</a>
                    </div>
                </div>
                
                <!-- Lớp 10 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                    <div class="h-40 bg-purple-50 flex items-center justify-center">
                        <img src="{{ asset('html/images/2ea343b800b7ca44c1844291afa997e9.jpg') }}" alt="Thi vào lớp 10" class="w-full h-full object-cover object-top">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-3 text-primary">Thi vào lớp 10</h3>
                        <ul class="mb-4 space-y-2">
                            <li class="flex items-center gap-2">
                                <i class="ri-check-line text-green-500"></i>
                                <span>Trường chuyên & trường top THPT</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <i class="ri-check-line text-green-500"></i>
                                <span>Điểm chuẩn 3 năm gần nhất</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <i class="ri-check-line text-green-500"></i>
                                <span>Đề thi thử & đáp án chi tiết</span>
                            </li>
                        </ul>
                        <a href="#" class="inline-block px-4 py-2 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors duration-200 text-sm font-medium whitespace-nowrap !rounded-button">Xem thêm</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tìm kiếm thông minh -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-10">Tìm kiếm thông minh</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Tìm trường -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold mb-4 flex items-center">
                        <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary mr-2">
                            <i class="ri-building-4-line"></i>
                        </div>
                        Tìm trường
                    </h3>
                    <form class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Cấp học</label>
                            <div class="relative">
                                <select class="w-full p-3 border border-gray-200 rounded-button appearance-none focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary pr-8">
                                    <option value="">Chọn cấp học</option>
                                    <option value="tieu-hoc">Tiểu học</option>
                                    <option value="thcs">THCS</option>
                                    <option value="thpt">THPT</option>
                                </select>
                                <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                    <i class="ri-arrow-down-s-line text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tỉnh/Thành phố</label>
                            <div class="relative">
                                <select class="w-full p-3 border border-gray-200 rounded-button appearance-none focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary pr-8">
                                    <option value="">Chọn tỉnh/thành phố</option>
                                    <option value="ha-noi">Hà Nội</option>
                                    <option value="ho-chi-minh">TP. Hồ Chí Minh</option>
                                    <option value="da-nang">Đà Nẵng</option>
                                    <option value="hai-phong">Hải Phòng</option>
                                </select>
                                <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                    <i class="ri-arrow-down-s-line text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Xã/Phường</label>
                            <div class="relative">
                                <select class="w-full p-3 border border-gray-200 rounded-button appearance-none focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary pr-8">
                                    <option value="">Chọn xã/phường</option>
                                    <option value="cau-giay">Cầu Giấy</option>
                                    <option value="hai-ba-trung">Hai Bà Trưng</option>
                                    <option value="hoan-kiem">Hoàn Kiếm</option>
                                    <option value="dong-da">Đống Đa</option>
                                </select>
                                <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                    <i class="ri-arrow-down-s-line text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="w-full py-3 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors duration-200 font-medium whitespace-nowrap !rounded-button">Tìm kiếm trường</button>
                    </form>
                </div>
                
                <!-- Tìm đề -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold mb-4 flex items-center">
                        <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary mr-2">
                            <i class="ri-file-list-3-line"></i>
                        </div>
                        Tìm đề thi
                    </h3>
                    <form class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Khối lớp</label>
                            <div class="relative">
                                <select class="w-full p-3 border border-gray-200 rounded-button appearance-none focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary pr-8">
                                    <option value="">Chọn khối lớp</option>
                                    <option value="lop-1">Lớp 1</option>
                                    <option value="lop-6">Lớp 6</option>
                                    <option value="lop-10">Lớp 10</option>
                                </select>
                                <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                    <i class="ri-arrow-down-s-line text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Môn học</label>
                            <div class="relative">
                                <select class="w-full p-3 border border-gray-200 rounded-button appearance-none focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary pr-8">
                                    <option value="">Chọn môn học</option>
                                    <option value="toan">Toán</option>
                                    <option value="tieng-viet">Tiếng Việt</option>
                                    <option value="tieng-anh">Tiếng Anh</option>
                                    <option value="tu-nhien-xa-hoi">Tự nhiên & Xã hội</option>
                                </select>
                                <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                    <i class="ri-arrow-down-s-line text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Năm</label>
                            <div class="relative">
                                <select class="w-full p-3 border border-gray-200 rounded-button appearance-none focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary pr-8">
                                    <option value="">Chọn năm</option>
                                    <option value="2025">2025</option>
                                    <option value="2024">2024</option>
                                    <option value="2023">2023</option>
                                    <option value="2022">2022</option>
                                </select>
                                <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                    <i class="ri-arrow-down-s-line text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="w-full py-3 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors duration-200 font-medium whitespace-nowrap !rounded-button">Tìm kiếm đề thi</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Tài liệu nổi bật -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-10">Tài liệu nổi bật</h2>
            
            <!-- Tabs -->
            <div class="flex justify-center mb-8">
                <div class="inline-flex bg-gray-100 p-1 rounded-full">
                    <button class="px-6 py-2 rounded-full bg-primary text-white font-medium text-sm whitespace-nowrap !rounded-full">Lớp 1</button>
                    <button class="px-6 py-2 rounded-full text-gray-700 font-medium text-sm hover:bg-gray-200 whitespace-nowrap !rounded-full">Lớp 6</button>
                    <button class="px-6 py-2 rounded-full text-gray-700 font-medium text-sm hover:bg-gray-200 whitespace-nowrap !rounded-full">Lớp 10</button>
                    <button class="px-6 py-2 rounded-full text-gray-700 font-medium text-sm hover:bg-gray-200 whitespace-nowrap !rounded-full">Mới nhất</button>
                </div>
            </div>
            
            <!-- Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Item 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                    <div class="h-40 bg-gray-100">
                        <img src="{{ asset('html/images/07e791490904af9f8bc3ef510c9468af.jpg') }}" alt="Tài liệu luyện thi vào lớp 1" class="w-full h-full object-cover object-top">
                    </div>
                    <div class="p-4">
                        <div class="flex items-center mb-2">
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Tiếng Việt</span>
                            <span class="ml-auto text-sm text-gray-500 flex items-center">
                                <i class="ri-download-line mr-1"></i> 1,245
                            </span>
                        </div>
                        <h3 class="font-medium mb-2 line-clamp-2 h-12">Bộ đề luyện thi vào lớp 1 Trường Tiểu học Chu Văn An năm 2025</h3>
                        <div class="flex items-center justify-between mt-3">
                            <div class="flex items-center">
                                <div class="w-6 h-6 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                    <i class="ri-file-pdf-line"></i>
                                </div>
                                <span class="ml-1 text-sm text-gray-500">25 trang</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Item 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                    <div class="h-40 bg-gray-100">
                        <img src="{{ asset('html/images/abbce31f5647a93a0fe6bae2535c2c5c.jpg') }}" alt="Đề thi Toán lớp 1" class="w-full h-full object-cover object-top">
                    </div>
                    <div class="p-4">
                        <div class="flex items-center mb-2">
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Toán</span>
                            <span class="ml-auto text-sm text-gray-500 flex items-center">
                                <i class="ri-download-line mr-1"></i> 987
                            </span>
                        </div>
                        <h3 class="font-medium mb-2 line-clamp-2 h-12">Đề thi thử vào lớp 1 Trường Tiểu học Nguyễn Siêu năm 2025</h3>
                        <div class="flex items-center justify-between mt-3">
                            <div class="flex items-center">
                                <div class="w-6 h-6 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                    <i class="ri-file-pdf-line"></i>
                                </div>
                                <span class="ml-1 text-sm text-gray-500">15 trang</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Item 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                    <div class="h-40 bg-gray-100">
                        <img src="{{ asset('html/images/f3f07ca941d0c2d8c3175a41499270fa.jpg') }}" alt="Đề thi Tiếng Anh lớp 1" class="w-full h-full object-cover object-top">
                    </div>
                    <div class="p-4">
                        <div class="flex items-center mb-2">
                            <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">Tiếng Anh</span>
                            <span class="ml-auto text-sm text-gray-500 flex items-center">
                                <i class="ri-download-line mr-1"></i> 756
                            </span>
                        </div>
                        <h3 class="font-medium mb-2 line-clamp-2 h-12">Bộ đề luyện thi Tiếng Anh vào lớp 1 chương trình quốc tế</h3>
                        <div class="flex items-center justify-between mt-3">
                            <div class="flex items-center">
                                <div class="w-6 h-6 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                    <i class="ri-file-pdf-line"></i>
                                </div>
                                <span class="ml-1 text-sm text-gray-500">20 trang</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Item 4 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                    <div class="h-40 bg-gray-100">
                        <img src="{{ asset('html/images/a01ca0f2a8f2c8e8587e1ffe1893ccb0.jpg') }}" alt="Đề thi Tự nhiên & Xã hội lớp 1" class="w-full h-full object-cover object-top">
                    </div>
                    <div class="p-4">
                        <div class="flex items-center mb-2">
                            <span class="px-2 py-1 bg-orange-100 text-orange-800 text-xs rounded-full">Tự nhiên & Xã hội</span>
                            <span class="ml-auto text-sm text-gray-500 flex items-center">
                                <i class="ri-download-line mr-1"></i> 623
                            </span>
                        </div>
                        <h3 class="font-medium mb-2 line-clamp-2 h-12">Tài liệu ôn tập Tự nhiên & Xã hội dành cho học sinh lớp 1</h3>
                        <div class="flex items-center justify-between mt-3">
                            <div class="flex items-center">
                                <div class="w-6 h-6 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                    <i class="ri-file-pdf-line"></i>
                                </div>
                                <span class="ml-1 text-sm text-gray-500">18 trang</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-8">
                <a href="#" class="inline-flex items-center text-primary font-medium hover:underline">
                    Xem tất cả tài liệu
                    <i class="ri-arrow-right-line ml-1"></i>
                </a>
            </div>
        </div>
    </section>
    <!-- Tin tức & Lịch thi -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-10">Tin tức & Lịch thi</h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Tin tức -->
                <div class="lg:col-span-2">
                    <h3 class="text-xl font-bold mb-6 flex items-center">
                        <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary mr-2">
                            <i class="ri-newspaper-line"></i>
                        </div>
                        Tin tuyển sinh mới nhất
                    </h3>
                    
                    <!-- Tin nổi bật -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                        <div class="flex flex-col md:flex-row">
                            <div class="md:w-2/5">
                                <img src="{{ asset('html/images/0668b9e8706c79925cfba198a4a0ff35.jpg') }}" alt="Tin tuyển sinh" class="w-full h-full object-cover object-top">
                            </div>
                            <div class="md:w-3/5 p-6">
                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                    <span class="flex items-center">
                                        <i class="ri-calendar-line mr-1"></i>
                                        27/06/2025
                                    </span>
                                    <span class="mx-2">•</span>
                                    <span class="flex items-center">
                                        <i class="ri-eye-line mr-1"></i>
                                        1,245 lượt xem
                                    </span>
                                </div>
                                <h4 class="text-lg font-bold mb-2">Hà Nội công bố kế hoạch tuyển sinh đầu cấp năm học 2025-2026</h4>
                                <p class="text-gray-600 mb-4">Sở Giáo dục và Đào tạo Hà Nội vừa công bố kế hoạch tuyển sinh đầu cấp năm học 2025-2026 với nhiều điểm mới về phương thức xét tuyển và thời gian đăng ký.</p>
                                <a href="#" class="inline-flex items-center text-primary font-medium hover:underline">
                                    Đọc tiếp
                                    <i class="ri-arrow-right-line ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tin khác -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                            <div class="p-4">
                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                    <span>25/06/2025</span>
                                    <span class="mx-2">•</span>
                                    <span>Tuyển sinh</span>
                                </div>
                                <h4 class="font-medium mb-2 line-clamp-2">Trường THCS Nguyễn Tất Thành công bố phương án tuyển sinh lớp 6 năm 2025</h4>
                                <a href="#" class="inline-flex items-center text-primary text-sm hover:underline">
                                    Đọc tiếp
                                    <i class="ri-arrow-right-line ml-1"></i>
                                </a>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                            <div class="p-4">
                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                    <span>24/06/2025</span>
                                    <span class="mx-2">•</span>
                                    <span>Tuyển sinh</span>
                                </div>
                                <h4 class="font-medium mb-2 line-clamp-2">Trường THPT chuyên Hà Nội - Amsterdam điều chỉnh cấu trúc đề thi lớp 10</h4>
                                <a href="#" class="inline-flex items-center text-primary text-sm hover:underline">
                                    Đọc tiếp
                                    <i class="ri-arrow-right-line ml-1"></i>
                                </a>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                            <div class="p-4">
                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                    <span>23/06/2025</span>
                                    <span class="mx-2">•</span>
                                    <span>Thành tích</span>
                                </div>
                                <h4 class="font-medium mb-2 line-clamp-2">Học sinh Việt Nam đạt thành tích cao trong kỳ thi Toán quốc tế IMO 2025</h4>
                                <a href="#" class="inline-flex items-center text-primary text-sm hover:underline">
                                    Đọc tiếp
                                    <i class="ri-arrow-right-line ml-1"></i>
                                </a>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                            <div class="p-4">
                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                    <span>22/06/2025</span>
                                    <span class="mx-2">•</span>
                                    <span>Tuyển sinh</span>
                                </div>
                                <h4 class="font-medium mb-2 line-clamp-2">TP.HCM công bố chỉ tiêu tuyển sinh lớp 10 các trường THPT công lập</h4>
                                <a href="#" class="inline-flex items-center text-primary text-sm hover:underline">
                                    Đọc tiếp
                                    <i class="ri-arrow-right-line ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Lịch thi -->
                <div>
                    <h3 class="text-xl font-bold mb-6 flex items-center">
                        <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary mr-2">
                            <i class="ri-calendar-event-line"></i>
                        </div>
                        Lịch thi sắp diễn ra
                    </h3>
                    
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-4 bg-primary text-white">
                            <div class="flex justify-between items-center">
                                <h4 class="font-bold">Tháng 7, 2025</h4>
                                <div class="flex gap-2">
                                    <button class="w-8 h-8 rounded-full hover:bg-white/20 flex items-center justify-center">
                                        <i class="ri-arrow-left-s-line"></i>
                                    </button>
                                    <button class="w-8 h-8 rounded-full hover:bg-white/20 flex items-center justify-center">
                                        <i class="ri-arrow-right-s-line"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-4 border-b">
                            <div class="flex items-center">
                                <div class="w-14 h-14 rounded-lg bg-red-100 text-red-600 flex flex-col items-center justify-center">
                                    <span class="text-sm font-medium">T7</span>
                                    <span class="text-lg font-bold">05</span>
                                </div>
                                <div class="ml-4">
                                    <h5 class="font-medium">Thi tuyển sinh lớp 10 chuyên</h5>
                                    <p class="text-sm text-gray-500">THPT Chuyên Hà Nội - Amsterdam</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-4 border-b">
                            <div class="flex items-center">
                                <div class="w-14 h-14 rounded-lg bg-blue-100 text-blue-600 flex flex-col items-center justify-center">
                                    <span class="text-sm font-medium">CN</span>
                                    <span class="text-lg font-bold">06</span>
                                </div>
                                <div class="ml-4">
                                    <h5 class="font-medium">Thi tuyển sinh lớp 10 chuyên</h5>
                                    <p class="text-sm text-gray-500">THPT Chuyên Nguyễn Huệ</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-4 border-b">
                            <div class="flex items-center">
                                <div class="w-14 h-14 rounded-lg bg-gray-100 text-gray-600 flex flex-col items-center justify-center">
                                    <span class="text-sm font-medium">T2</span>
                                    <span class="text-lg font-bold">14</span>
                                </div>
                                <div class="ml-4">
                                    <h5 class="font-medium">Thi tuyển sinh lớp 6</h5>
                                    <p class="text-sm text-gray-500">THCS Cầu Giấy</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-4 border-b">
                            <div class="flex items-center">
                                <div class="w-14 h-14 rounded-lg bg-gray-100 text-gray-600 flex flex-col items-center justify-center">
                                    <span class="text-sm font-medium">T7</span>
                                    <span class="text-lg font-bold">19</span>
                                </div>
                                <div class="ml-4">
                                    <h5 class="font-medium">Thi tuyển sinh lớp 1</h5>
                                    <p class="text-sm text-gray-500">Tiểu học Thăng Long</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-4">
                            <div class="flex items-center">
                                <div class="w-14 h-14 rounded-lg bg-gray-100 text-gray-600 flex flex-col items-center justify-center">
                                    <span class="text-sm font-medium">CN</span>
                                    <span class="text-lg font-bold">20</span>
                                </div>
                                <div class="ml-4">
                                    <h5 class="font-medium">Thi tuyển sinh lớp 1</h5>
                                    <p class="text-sm text-gray-500">Tiểu học Nguyễn Siêu</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Giáo viên & Trung tâm -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-10">Giáo viên & Trung tâm uy tín</h2>
            
            <!-- Trung tâm đối tác -->
            <div class="mb-10">
                <h3 class="text-xl font-bold mb-6">Trung tâm luyện thi</h3>
                
                <div class="content-slider-wrapper">
                    <div class="content-slider flex overflow-x-auto gap-6 pb-4 -mx-4 px-4" id="centerSlider">
                        <!-- Trung tâm 1 -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 min-w-[280px]">
                            <div class="h-40 bg-gray-100">
                                <img src="{{ asset('html/images/0668b9e8706c79925cfba198a4a0ff35.jpg') }}" alt="Trung tâm Excellence" class="w-full h-full object-cover">
                            </div>
                            <div class="p-4">
                                <h4 class="font-bold mb-1">Trung tâm Excellence</h4>
                                <p class="text-sm text-gray-600 mb-2">Chuyên luyện thi vào lớp 10 - 8 năm kinh nghiệm</p>
                                <p class="text-xs text-gray-500 mb-3">Địa chỉ: 123 Nguyễn Trãi, Thanh Xuân, Hà Nội</p>
                                <button class="w-full py-2 border border-primary text-primary rounded-button hover:bg-primary/5 transition-colors duration-200 text-sm font-medium whitespace-nowrap">Xem chi tiết</button>
                            </div>
                        </div>
                        
                        <!-- Trung tâm 2 -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 min-w-[280px]">
                            <div class="h-40 bg-gray-100">
                                <img src="{{ asset('html/images/0668b9e8706c79925cfba198a4a0ff35.jpg') }}" alt="Trung tâm Thành Đạt" class="w-full h-full object-cover">
                            </div>
                            <div class="p-4">
                                <h4 class="font-bold mb-1">Trung tâm Thành Đạt</h4>
                                <p class="text-sm text-gray-600 mb-2">Luyện thi vào lớp 6 & 10 - 12 năm kinh nghiệm</p>
                                <p class="text-xs text-gray-500 mb-3">Địa chỉ: 456 Láng Hạ, Đống Đa, Hà Nội</p>
                                <button class="w-full py-2 border border-primary text-primary rounded-button hover:bg-primary/5 transition-colors duration-200 text-sm font-medium whitespace-nowrap">Xem chi tiết</button>
                            </div>
                        </div>
                        
                        <!-- Trung tâm 3 -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 min-w-[280px]">
                            <div class="h-40 bg-gray-100">
                                <img src="{{ asset('html/images/0668b9e8706c79925cfba198a4a0ff35.jpg') }}" alt="Trung tâm Vượt Khó" class="w-full h-full object-cover">
                            </div>
                            <div class="p-4">
                                <h4 class="font-bold mb-1">Trung tâm Vượt Khó</h4>
                                <p class="text-sm text-gray-600 mb-2">Chuyên môn Toán - Lý - Hóa - 10 năm kinh nghiệm</p>
                                <p class="text-xs text-gray-500 mb-3">Địa chỉ: 789 Giải Phóng, Hai Bà Trưng, Hà Nội</p>
                                <button class="w-full py-2 border border-primary text-primary rounded-button hover:bg-primary/5 transition-colors duration-200 text-sm font-medium whitespace-nowrap">Xem chi tiết</button>
                            </div>
                        </div>
                        
                        <!-- Trung tâm 4 -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 min-w-[280px]">
                            <div class="h-40 bg-gray-100">
                                <img src="{{ asset('html/images/0668b9e8706c79925cfba198a4a0ff35.jpg') }}" alt="Trung tâm Tri Thức" class="w-full h-full object-cover">
                            </div>
                            <div class="p-4">
                                <h4 class="font-bold mb-1">Trung tâm Tri Thức</h4>
                                <p class="text-sm text-gray-600 mb-2">Luyện thi vào lớp 1 & 6 - 6 năm kinh nghiệm</p>
                                <p class="text-xs text-gray-500 mb-3">Địa chỉ: 321 Trần Duy Hưng, Cầu Giấy, Hà Nội</p>
                                <button class="w-full py-2 border border-primary text-primary rounded-button hover:bg-primary/5 transition-colors duration-200 text-sm font-medium whitespace-nowrap">Xem chi tiết</button>
                            </div>
                        </div>
                        
                        <!-- Trung tâm 4 -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 min-w-[280px]">
                            <div class="h-40 bg-gray-100">
                                <img src="{{ asset('html/images/0668b9e8706c79925cfba198a4a0ff35.jpg') }}" alt="Trung tâm Tri Thức" class="w-full h-full object-cover">
                            </div>
                            <div class="p-4">
                                <h4 class="font-bold mb-1">Trung tâm Tri Thức 2</h4>
                                <p class="text-sm text-gray-600 mb-2">Luyện thi vào lớp 1 & 6 - 6 năm kinh nghiệm</p>
                                <p class="text-xs text-gray-500 mb-3">Địa chỉ: 321 Trần Duy Hưng, Cầu Giấy, Hà Nội</p>
                                <button class="w-full py-2 border border-primary text-primary rounded-button hover:bg-primary/5 transition-colors duration-200 text-sm font-medium whitespace-nowrap">Xem chi tiết</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Navigation buttons -->
                    <button class="nav-btn absolute left-0 top-1/2 transform -translate-y-1/2 w-10 h-10 rounded-full bg-white shadow-md flex items-center justify-center z-10 -ml-5" onclick="slideContent('centerSlider', 'prev')" id="centerPrev">
                        <i class="ri-arrow-left-s-line"></i>
                    </button>
                    <button class="nav-btn absolute right-0 top-1/2 transform -translate-y-1/2 w-10 h-10 rounded-full bg-white shadow-md flex items-center justify-center z-10 -mr-5" onclick="slideContent('centerSlider', 'next')" id="centerNext">
                        <i class="ri-arrow-right-s-line"></i>
                    </button>
                </div>
            </div>
            
            <!-- Giáo viên -->
            <div>
                <h3 class="text-xl font-bold mb-6">Giáo viên nổi bật</h3>
                
                <div class="content-slider-wrapper">
                    <div class="content-slider flex overflow-x-auto gap-6 pb-4 -mx-4 px-4" id="teacherSlider">
                        <!-- Giáo viên 1 -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 min-w-[280px]">
                            <div class="h-40 bg-gray-100">
                                <img src="{{ asset('html/images/f464b08c95c56053708d1bc74dde0dd7.jpg') }}" alt="Cô Nguyễn Thị Minh Tâm" class="w-full h-full object-cover object-top">
                            </div>
                            <div class="p-4">
                                <h4 class="font-bold mb-1">Cô Nguyễn Thị Minh Tâm</h4>
                                <p class="text-sm text-gray-600 mb-2">Giáo viên Toán - 15 năm kinh nghiệm</p>
                                <p class="text-xs text-gray-500 mb-3">Chuyên luyện thi vào lớp 10 chuyên Toán</p>
                                <button class="w-full py-2 border border-primary text-primary rounded-button hover:bg-primary/5 transition-colors duration-200 text-sm font-medium whitespace-nowrap">Xem hồ sơ</button>
                            </div>
                        </div>
                        
                        <!-- Giáo viên 2 -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 min-w-[280px]">
                            <div class="h-40 bg-gray-100">
                                <img src="{{ asset('html/images/dc3fcb235fe648f6dac93f2bf0128997.jpg') }}" alt="Thầy Trần Văn Hùng" class="w-full h-full object-cover object-top">
                            </div>
                            <div class="p-4">
                                <h4 class="font-bold mb-1">Thầy Trần Văn Hùng</h4>
                                <p class="text-sm text-gray-600 mb-2">Giáo viên Vật lý - 12 năm kinh nghiệm</p>
                                <p class="text-xs text-gray-500 mb-3">Chuyên luyện thi vào lớp 10 chuyên Lý</p>
                                <button class="w-full py-2 border border-primary text-primary rounded-button hover:bg-primary/5 transition-colors duration-200 text-sm font-medium whitespace-nowrap">Xem hồ sơ</button>
                            </div>
                        </div>
                        
                        <!-- Giáo viên 3 -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 min-w-[280px]">
                            <div class="h-40 bg-gray-100">
                                <img src="{{ asset('html/images/6cfe2cac141bcd649791cfb9ece95e1a.jpg') }}" alt="Cô Lê Thị Hương" class="w-full h-full object-cover object-top">
                            </div>
                            <div class="p-4">
                                <h4 class="font-bold mb-1">Cô Lê Thị Hương</h4>
                                <p class="text-sm text-gray-600 mb-2">Giáo viên Ngữ văn - 18 năm kinh nghiệm</p>
                                <p class="text-xs text-gray-500 mb-3">Chuyên luyện thi vào lớp 10 chuyên Văn</p>
                                <button class="w-full py-2 border border-primary text-primary rounded-button hover:bg-primary/5 transition-colors duration-200 text-sm font-medium whitespace-nowrap">Xem hồ sơ</button>
                            </div>
                        </div>
                        
                        <!-- Giáo viên 4 -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 min-w-[280px]">
                            <div class="h-40 bg-gray-100">
                                <img src="{{ asset('html/images/4e1e3992075f830aed7a9fde53d8ecd0.jpg') }}" alt="Thầy Lê Minh Đức" class="w-full h-full object-cover object-top">
                            </div>
                            <div class="p-4">
                                <h4 class="font-bold mb-1">Thầy Lê Minh Đức</h4>
                                <p class="text-sm text-gray-600 mb-2">Giáo viên Tự nhiên & Xã hội - 10 năm kinh nghiệm</p>
                                <p class="text-xs text-gray-500 mb-3">Chuyên luyện thi vào lớp 6 và lớp 1</p>
                                <button class="w-full py-2 border border-primary text-primary rounded-button hover:bg-primary/5 transition-colors duration-200 text-sm font-medium whitespace-nowrap">Xem hồ sơ</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Navigation buttons -->
                    <button class="nav-btn absolute left-0 top-1/2 transform -translate-y-1/2 w-10 h-10 rounded-full bg-white shadow-md flex items-center justify-center z-10 -ml-5" onclick="slideContent('teacherSlider', 'prev')" id="teacherPrev">
                        <i class="ri-arrow-left-s-line"></i>
                    </button>
                    <button class="nav-btn absolute right-0 top-1/2 transform -translate-y-1/2 w-10 h-10 rounded-full bg-white shadow-md flex items-center justify-center z-10 -mr-5" onclick="slideContent('teacherSlider', 'next')" id="teacherNext">
                        <i class="ri-arrow-right-s-line"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

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
    
    @include('layouts.components.newsletter-form')
@endsection

@push('scripts')
<script id="checkbox-script">
    document.addEventListener('DOMContentLoaded', function() {
        const customCheckboxes = document.querySelectorAll('.custom-checkbox');
        
        customCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('click', function() {
                this.classList.toggle('checked');
                const input = this.nextElementSibling;
                if (input && input.type === 'checkbox') {
                    input.checked = !input.checked;
                }
            });
        });
    });
</script>
<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.hero-slide');
    const indicators = document.querySelectorAll('.slide-indicator');
    const totalSlides = slides.length;

    function updateSlide(slideIndex) {
        // Remove active class from all slides and indicators
        slides.forEach((slide, index) => {
            slide.classList.remove('active', 'prev');
            if (index < slideIndex) {
                slide.classList.add('prev');
            } else if (index === slideIndex) {
                slide.classList.add('active');
            }
        });

        indicators.forEach((indicator, index) => {
            indicator.classList.toggle('active', index === slideIndex);
            indicator.style.opacity = index === slideIndex ? '1' : '0.5';
        });

        currentSlide = slideIndex;
    }

    function nextSlide() {
        const nextIndex = (currentSlide + 1) % totalSlides;
        updateSlide(nextIndex);
    }

    function previousSlide() {
        const prevIndex = (currentSlide - 1 + totalSlides) % totalSlides;
        updateSlide(prevIndex);
    }

    function goToSlide(slideIndex) {
        updateSlide(slideIndex);
    }

    // Auto-play slider
    setInterval(nextSlide, 5000);

    // Checkbox functionality
    document.addEventListener('DOMContentLoaded', function() {
        const customCheckboxes = document.querySelectorAll('.custom-checkbox');
        
        customCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('click', function() {
                this.classList.toggle('checked');
                const input = this.nextElementSibling;
                if (input && input.type === 'checkbox') {
                    input.checked = !input.checked;
                }
            });
        });
    });

    // Content slider functionality
    function slideContent(sliderId, direction) {
        const slider = document.getElementById(sliderId);
        const scrollAmount = 300; // Điều chỉnh theo độ rộng item
        
        if (direction === 'next') {
            slider.scrollLeft += scrollAmount;
        } else {
            slider.scrollLeft -= scrollAmount;
        }
        
        // Update button states
        updateSliderButtons(sliderId);
    }

    function updateSliderButtons(sliderId) {
        const slider = document.getElementById(sliderId);
        const prevBtn = document.getElementById(sliderId.replace('Slider', 'Prev'));
        const nextBtn = document.getElementById(sliderId.replace('Slider', 'Next'));
        
        if (prevBtn && nextBtn) {
            // Check if at start
            prevBtn.disabled = slider.scrollLeft <= 0;
            
            // Check if at end
            const maxScroll = slider.scrollWidth - slider.clientWidth;
            nextBtn.disabled = slider.scrollLeft >= maxScroll - 10; // -10 for tolerance
        }
    }

    // Initialize slider buttons on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateSliderButtons('centerSlider');
        updateSliderButtons('teacherSlider');
        updateSliderButtons('reviewSlider');
        
        // Add scroll event listeners to update buttons
        ['centerSlider', 'teacherSlider', 'reviewSlider'].forEach(sliderId => {
            const slider = document.getElementById(sliderId);
            if (slider) {
                slider.addEventListener('scroll', () => updateSliderButtons(sliderId));
            }
        });
    });
</script>
@endpush

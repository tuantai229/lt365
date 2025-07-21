<!-- Danh sách trường nổi bật -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10">Trường 
    @switch($grade)
        @case(1)
            tiểu học
            @break
        @case(6)
            THCS
            @break
        @case(10)
            THPT
            @break
    @endswitch
    nổi bật
</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
            <!-- Trường 1 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                <div class="h-40 bg-gray-100">
                    <img src="{{ asset('html/images/62a2bfa0ddfca1caac1f5c907d2661e1.jpg') }}" alt="Tiểu học Chu Văn An" class="w-full h-full object-cover object-top">
                </div>
                <div class="p-5">
                    <div class="flex items-center mb-3">
                        <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary mr-2">
                            <i class="ri-building-4-line"></i>
                        </div>
                        <div>
                            <h3 class="font-bold">Tiểu học Chu Văn An</h3>
                            <p class="text-xs text-gray-500">Quận Hai Bà Trưng</p>
                        </div>
                    </div>
                    
                    <div class="flex gap-2 mb-3">
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Công lập</span>
                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Song ngữ</span>
                    </div>
                    
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="ri-group-line mr-2 text-primary"></i>
                            <span>Chỉ tiêu: 180 học sinh</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="ri-book-open-line mr-2 text-primary"></i>
                            <span>Chương trình: Chuẩn + Tiếng Anh</span>
                        </div>
                    </div>
                    
                    <button class="w-full py-2 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors duration-200 text-sm font-medium whitespace-nowrap !rounded-button">Xem chi tiết</button>
                </div>
            </div>
            
            <!-- Trường 2 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                <div class="h-40 bg-gray-100">
                    <img src="{{ asset('html/images/62a2bfa0ddfca1caac1f5c907d2661e1.jpg') }}" alt="Tiểu học Thăng Long" class="w-full h-full object-cover object-top">
                </div>
                <div class="p-5">
                    <div class="flex items-center mb-3">
                        <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary mr-2">
                            <i class="ri-building-4-line"></i>
                        </div>
                        <div>
                            <h3 class="font-bold">Tiểu học Thăng Long</h3>
                            <p class="text-xs text-gray-500">Quận Cầu Giấy</p>
                        </div>
                    </div>
                    
                    <div class="flex gap-2 mb-3">
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Công lập</span>
                        <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">STEM</span>
                    </div>
                    
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="ri-group-line mr-2 text-primary"></i>
                            <span>Chỉ tiêu: 200 học sinh</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="ri-book-open-line mr-2 text-primary"></i>
                            <span>Chương trình: Chuẩn + STEM</span>
                        </div>
                    </div>
                    
                    <button class="w-full py-2 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors duration-200 text-sm font-medium whitespace-nowrap !rounded-button">Xem chi tiết</button>
                </div>
            </div>
            
            <!-- Trường 3 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                <div class="h-40 bg-gray-100">
                    <img src="{{ asset('html/images/62a2bfa0ddfca1caac1f5c907d2661e1.jpg') }}" alt="Tiểu học Nguyễn Siêu" class="w-full h-full object-cover object-top">
                </div>
                <div class="p-5">
                    <div class="flex items-center mb-3">
                        <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary mr-2">
                            <i class="ri-building-4-line"></i>
                        </div>
                        <div>
                            <h3 class="font-bold">Tiểu học Nguyễn Siêu</h3>
                            <p class="text-xs text-gray-500">Quận Hoàn Kiếm</p>
                        </div>
                    </div>
                    
                    <div class="flex gap-2 mb-3">
                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">Tư thục</span>
                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Quốc tế</span>
                    </div>
                    
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="ri-group-line mr-2 text-primary"></i>
                            <span>Chỉ tiêu: 120 học sinh</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="ri-book-open-line mr-2 text-primary"></i>
                            <span>Chương trình: Cambridge</span>
                        </div>
                    </div>
                    
                    <button class="w-full py-2 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors duration-200 text-sm font-medium whitespace-nowrap !rounded-button">Xem chi tiết</button>
                </div>
            </div>
            
            <!-- Trường 4 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                <div class="h-40 bg-gray-100">
                    <img src="{{ asset('html/images/62a2bfa0ddfca1caac1f5c907d2661e1.jpg') }}" alt="Tiểu học Kim Liên" class="w-full h-full object-cover object-top">
                </div>
                <div class="p-5">
                    <div class="flex items-center mb-3">
                        <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary mr-2">
                            <i class="ri-building-4-line"></i>
                        </div>
                        <div>
                            <h3 class="font-bold">Tiểu học Kim Liên</h3>
                            <p class="text-xs text-gray-500">Quận Đống Đa</p>
                        </div>
                    </div>
                    
                    <div class="flex gap-2 mb-3">
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Công lập</span>
                        <span class="px-2 py-1 bg-orange-100 text-orange-800 text-xs rounded-full">Nghệ thuật</span>
                    </div>
                    
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="ri-group-line mr-2 text-primary"></i>
                            <span>Chỉ tiêu: 160 học sinh</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="ri-book-open-line mr-2 text-primary"></i>
                            <span>Chương trình: Chuẩn + Nghệ thuật</span>
                        </div>
                    </div>
                    
                    <button class="w-full py-2 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors duration-200 text-sm font-medium whitespace-nowrap !rounded-button">Xem chi tiết</button>
                </div>
            </div>
            
            <!-- Trường 5 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                <div class="h-40 bg-gray-100">
                    <img src="{{ asset('html/images/62a2bfa0ddfca1caac1f5c907d2661e1.jpg') }}" alt="Tiểu học Đinh Tiên Hoàng" class="w-full h-full object-cover object-top">
                </div>
                <div class="p-5">
                    <div class="flex items-center mb-3">
                        <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary mr-2">
                            <i class="ri-building-4-line"></i>
                        </div>
                        <div>
                            <h3 class="font-bold">Tiểu học Đinh Tiên Hoàng</h3>
                            <p class="text-xs text-gray-500">Quận Ba Đình</p>
                        </div>
                    </div>
                    
                    <div class="flex gap-2 mb-3">
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Công lập</span>
                        <span class="px-2 py-1 bg-indigo-100 text-indigo-800 text-xs rounded-full">Toán học</span>
                    </div>
                    
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="ri-group-line mr-2 text-primary"></i>
                            <span>Chỉ tiêu: 140 học sinh</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="ri-book-open-line mr-2 text-primary"></i>
                            <span>Chương trình: Chuẩn + Toán nâng cao</span>
                        </div>
                    </div>
                    
                    <button class="w-full py-2 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors duration-200 text-sm font-medium whitespace-nowrap !rounded-button">Xem chi tiết</button>
                </div>
            </div>
            
            <!-- Trường 6 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                <div class="h-40 bg-gray-100">
                    <img src="{{ asset('html/images/62a2bfa0ddfca1caac1f5c907d2661e1.jpg') }}" alt="Tiểu học Lê Quý Đôn" class="w-full h-full object-cover object-top">
                </div>
                <div class="p-5">
                    <div class="flex items-center mb-3">
                        <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary mr-2">
                            <i class="ri-building-4-line"></i>
                        </div>
                        <div>
                            <h3 class="font-bold">Tiểu học Lê Quý Đôn</h3>
                            <p class="text-xs text-gray-500">Quận Thanh Xuân</p>
                        </div>
                    </div>
                    
                    <div class="flex gap-2 mb-3">
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Công lập</span>
                        <span class="px-2 py-1 bg-teal-100 text-teal-800 text-xs rounded-full">Công nghệ</span>
                    </div>
                    
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="ri-group-line mr-2 text-primary"></i>
                            <span>Chỉ tiêu: 170 học sinh</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="ri-book-open-line mr-2 text-primary"></i>
                            <span>Chương trình: Chuẩn + Tin học</span>
                        </div>
                    </div>
                    
                    <button class="w-full py-2 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors duration-200 text-sm font-medium whitespace-nowrap !rounded-button">Xem chi tiết</button>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-8">
            <a href="#" class="inline-flex items-center text-primary font-medium hover:underline">
                Khám phá tất cả các trường
                <i class="ri-arrow-right-line ml-1"></i>
            </a>
        </div>
    </div>
</section>

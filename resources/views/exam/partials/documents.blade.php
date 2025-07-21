<!-- Đề thi và tài liệu -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10">Đề thi và tài liệu lớp {{ $grade }}</h2>
        
        <!-- Tabs -->
        <div class="flex justify-center mb-8">
            <div class="inline-flex bg-gray-100 p-1 rounded-full">
                <button class="px-6 py-2 rounded-full bg-primary text-white font-medium text-sm whitespace-nowrap !rounded-full">Mới nhất</button>
                <button class="px-6 py-2 rounded-full text-gray-700 font-medium text-sm hover:bg-gray-200 whitespace-nowrap !rounded-full">Phổ biến</button>
                <button class="px-6 py-2 rounded-full text-gray-700 font-medium text-sm hover:bg-gray-200 whitespace-nowrap !rounded-full">Miễn phí</button>
            </div>
        </div>
        
        <!-- Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Tài liệu 1 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                <div class="h-40 bg-gray-100">
                    <img src="{{ asset('html/images/a63d36922ba8edd9e7f86405d8809253.jpg') }}" alt="Đề thi Toán lớp 1" class="w-full h-full object-cover object-top">
                </div>
                <div class="p-4">
                    <div class="flex items-center mb-2">
                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Toán</span>
                        <span class="ml-auto text-sm text-gray-500 flex items-center">
                            <i class="ri-download-line mr-1"></i> 1,542
                        </span>
                    </div>
                    <h3 class="font-medium mb-2 line-clamp-2 h-12">Bộ đề thi Toán vào lớp 1 - Trường Tiểu học Chu Văn An 2025</h3>
                    <div class="flex items-center justify-between mt-3">
                        <div class="flex items-center">
                            <div class="w-6 h-6 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                <i class="ri-file-pdf-line"></i>
                            </div>
                            <span class="ml-1 text-sm text-gray-500">15 trang</span>
                        </div>
                        <button class="px-3 py-1.5 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors duration-200 text-sm whitespace-nowrap !rounded-button">Tải xuống</button>
                    </div>
                </div>
            </div>
            
            <!-- Tài liệu 2 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                <div class="h-40 bg-gray-100">
                    <img src="{{ asset('html/images/a63d36922ba8edd9e7f86405d8809253.jpg') }}" alt="Đề thi Tiếng Việt lớp 1" class="w-full h-full object-cover object-top">
                </div>
                <div class="p-4">
                    <div class="flex items-center mb-2">
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Tiếng Việt</span>
                        <span class="ml-auto text-sm text-gray-500 flex items-center">
                            <i class="ri-download-line mr-1"></i> 1,234
                        </span>
                    </div>
                    <h3 class="font-medium mb-2 line-clamp-2 h-12">Đề thi Tiếng Việt vào lớp 1 - Trường Tiểu học Thăng Long</h3>
                    <div class="flex items-center justify-between mt-3">
                        <div class="flex items-center">
                            <div class="w-6 h-6 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                <i class="ri-file-pdf-line"></i>
                            </div>
                            <span class="ml-1 text-sm text-gray-500">18 trang</span>
                        </div>
                        <button class="px-3 py-1.5 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors duration-200 text-sm whitespace-nowrap !rounded-button">Tải xuống</button>
                    </div>
                </div>
            </div>
            
            <!-- Tài liệu 3 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                <div class="h-40 bg-gray-100">
                    <img src="{{ asset('html/images/a63d36922ba8edd9e7f86405d8809253.jpg') }}" alt="Đề thi Tiếng Anh lớp 1" class="w-full h-full object-cover object-top">
                </div>
                <div class="p-4">
                    <div class="flex items-center mb-2">
                        <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">Tiếng Anh</span>
                        <span class="ml-auto text-sm text-gray-500 flex items-center">
                            <i class="ri-download-line mr-1"></i> 987
                        </span>
                    </div>
                    <h3 class="font-medium mb-2 line-clamp-2 h-12">Bộ đề Tiếng Anh cơ bản cho trẻ vào lớp 1 - Chương trình quốc tế</h3>
                    <div class="flex items-center justify-between mt-3">
                        <div class="flex items-center">
                            <div class="w-6 h-6 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                <i class="ri-file-pdf-line"></i>
                            </div>
                            <span class="ml-1 text-sm text-gray-500">12 trang</span>
                        </div>
                        <button class="px-3 py-1.5 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors duration-200 text-sm whitespace-nowrap !rounded-button">Tải xuống</button>
                    </div>
                </div>
            </div>
            
            <!-- Tài liệu 4 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                <div class="h-40 bg-gray-100">
                    <img src="{{ asset('html/images/a63d36922ba8edd9e7f86405d8809253.jpg') }}" alt="Tư duy logic lớp 1" class="w-full h-full object-cover object-top">
                </div>
                <div class="p-4">
                    <div class="flex items-center mb-2">
                        <span class="px-2 py-1 bg-orange-100 text-orange-800 text-xs rounded-full">Tư duy logic</span>
                        <span class="ml-auto text-sm text-gray-500 flex items-center">
                            <i class="ri-download-line mr-1"></i> 756
                        </span>
                    </div>
                    <h3 class="font-medium mb-2 line-clamp-2 h-12">Bài tập phát triển tư duy logic cho trẻ chuẩn bị vào lớp 1</h3>
                    <div class="flex items-center justify-between mt-3">
                        <div class="flex items-center">
                            <div class="w-6 h-6 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                <i class="ri-file-pdf-line"></i>
                            </div>
                            <span class="ml-1 text-sm text-gray-500">20 trang</span>
                        </div>
                        <button class="px-3 py-1.5 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors duration-200 text-sm whitespace-nowrap !rounded-button">Tải xuống</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-8">
            <a href="#" class="inline-flex items-center text-primary font-medium hover:underline">
                Xem thêm tài liệu
                <i class="ri-arrow-right-line ml-1"></i>
            </a>
        </div>
    </div>
</section>

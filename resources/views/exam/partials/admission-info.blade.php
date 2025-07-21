<!-- Thông tin tuyển sinh -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10">Thông tin tuyển sinh lớp {{ $grade }}</h2>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Tin tức -->
            <div class="lg:col-span-2">
                <h3 class="text-xl font-bold mb-6 flex items-center">
                    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary mr-2">
                        <i class="ri-newspaper-line"></i>
                    </div>
                    Tin tuyển sinh lớp {{ $grade }}
                </h3>
                
                <!-- Tin nổi bật -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                    <div class="flex flex-col md:flex-row">
                        <div class="md:w-2/5">
                            <img src="{{ asset('html/images/0668b9e8706c79925cfba198a4a0ff35.jpg') }}" alt="Tuyển sinh lớp 1" class="w-full h-full object-cover object-top">
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
                                    2,134 lượt xem
                                </span>
                            </div>
                            <h4 class="text-lg font-bold mb-2">Hà Nội công bố kế hoạch tuyển sinh lớp 1 năm học 2025-2026</h4>
                            <p class="text-gray-600 mb-4">Sở GD&ĐT Hà Nội vừa chính thức công bố kế hoạch tuyển sinh lớp 1 năm học 2025-2026 với nhiều điểm mới về phương thức xét tuyển, thời gian đăng ký và quy trình thi tuyển.</p>
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
                            <h4 class="font-medium mb-2 line-clamp-2">Trường Tiểu học Chu Văn An công bố chỉ tiêu tuyển sinh lớp 1 năm 2025</h4>
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
                            <h4 class="font-medium mb-2 line-clamp-2">Tiểu học Thăng Long thông báo lịch thi tuyển sinh lớp 1</h4>
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
                                <span>Quy định</span>
                            </div>
                            <h4 class="font-medium mb-2 line-clamp-2">Thay đổi mới trong quy định độ tuổi đăng ký dự tuyển lớp 1</h4>
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
                                <span>Hướng dẫn</span>
                            </div>
                            <h4 class="font-medium mb-2 line-clamp-2">Hướng dẫn chi tiết cách đăng ký online tuyển sinh lớp 1</h4>
                            <a href="#" class="inline-flex items-center text-primary text-sm hover:underline">
                                Đọc tiếp
                                <i class="ri-arrow-right-line ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-6">
                    <a href="#" class="inline-flex items-center text-primary font-medium hover:underline">
                        Xem tất cả thông tin tuyển sinh
                        <i class="ri-arrow-right-line ml-1"></i>
                    </a>
                </div>
            </div>
            
            <!-- Lịch thi -->
            <div>
                <h3 class="text-xl font-bold mb-6 flex items-center">
                    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary mr-2">
                        <i class="ri-calendar-event-line"></i>
                    </div>
                    Lịch thi lớp {{ $grade }} sắp diễn ra
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
                                <h5 class="font-medium">Thi tuyển sinh lớp 1</h5>
                                <p class="text-sm text-gray-500">Tiểu học Chu Văn An</p>
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
                                <h5 class="font-medium">Thi tuyển sinh lớp 1</h5>
                                <p class="text-sm text-gray-500">Tiểu học Thăng Long</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4 border-b">
                        <div class="flex items-center">
                            <div class="w-14 h-14 rounded-lg bg-green-100 text-green-600 flex flex-col items-center justify-center">
                                <span class="text-sm font-medium">T2</span>
                                <span class="text-lg font-bold">07</span>
                            </div>
                            <div class="ml-4">
                                <h5 class="font-medium">Thi tuyển sinh lớp 1</h5>
                                <p class="text-sm text-gray-500">Tiểu học Nguyễn Siêu</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4 border-b">
                        <div class="flex items-center">
                            <div class="w-14 h-14 rounded-lg bg-orange-100 text-orange-600 flex flex-col items-center justify-center">
                                <span class="text-sm font-medium">T4</span>
                                <span class="text-lg font-bold">09</span>
                            </div>
                            <div class="ml-4">
                                <h5 class="font-medium">Thi tuyển sinh lớp 1</h5>
                                <p class="text-sm text-gray-500">Tiểu học Kim Liên</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="w-14 h-14 rounded-lg bg-purple-100 text-purple-600 flex flex-col items-center justify-center">
                                <span class="text-sm font-medium">T6</span>
                                <span class="text-lg font-bold">11</span>
                            </div>
                            <div class="ml-4">
                                <h5 class="font-medium">Thi tuyển sinh lớp 1</h5>
                                <p class="text-sm text-gray-500">Tiểu học Đinh Tiên Hoàng</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@extends('layouts.app')

@section('title', 'Tin tức')

@section('content')
<!-- Breadcrumb -->
<div class="bg-gray-100 py-3">
    <div class="container mx-auto px-4">
        <div class="flex items-center text-sm text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-primary">Trang chủ</a>
            <span class="mx-2">
                <i class="ri-arrow-right-s-line"></i>
            </span>
            <span class="text-primary font-medium">Tin tức</span>
        </div>
    </div>
</div>

<!-- Tin nổi bật -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10">Tin tức nổi bật</h2>
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-8 bg-white rounded-lg shadow-md overflow-hidden border border-gray-100">
                <div class="h-64">
                    <img src="/images/0668b9e8706c79925cfba198a4a0ff35.jpg" alt="Tin tuyển sinh nổi bật" class="w-full h-full object-cover object-top">
                </div>
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <span class="flex items-center">
                            <i class="ri-calendar-line mr-1"></i>
                            28/06/2025
                        </span>
                        <span class="mx-2">•</span>
                        <span class="flex items-center">
                            <i class="ri-eye-line mr-1"></i>
                            3,247 lượt xem
                        </span>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Bộ GD&ĐT công bố kế hoạch tuyển sinh toàn quốc năm học 2025-2026</h3>
                    <p class="text-gray-600 mb-6">Bộ Giáo dục và Đào tạo vừa chính thức ban hành kế hoạch tuyển sinh toàn quốc cho năm học 2025-2026 với nhiều điểm mới quan trọng về phương thức xét tuyển, thời gian đăng ký và quy trình thi tuyển ở tất cả các cấp học từ tiểu học đến trung học phổ thông.</p>
                    <a href="#" class="inline-flex items-center text-primary font-medium hover:underline">
                        Đọc tiếp
                        <i class="ri-arrow-right-line ml-1"></i>
                    </a>
                </div>
            </div>
            
            <div class="lg:col-span-4 space-y-4">
                <!-- Tin phụ 1 -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-shadow duration-300">
                    <div class="flex">
                        <div class="w-20 h-14 flex-shrink-0">
                            <img src="/images/0668b9e8706c79925cfba198a4a0ff35.jpg" alt="Hà Nội công bố chỉ tiêu" class="w-full h-full object-cover object-top rounded-l-lg">
                        </div>
                        <div class="flex-1 p-3">
                            <div class="flex items-center text-xs text-gray-500 mb-1">
                                <i class="ri-calendar-line mr-1"></i>
                                <span>27/06/2025</span>
                            </div>
                            <h4 class="font-medium text-sm line-clamp-2 leading-tight">Hà Nội công bố chỉ tiêu tuyển sinh các trường tiểu học năm 2025</h4>
                        </div>
                    </div>
                </div>
                
                <!-- Tin phụ 2 -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-shadow duration-300">
                    <div class="flex">
                        <div class="w-20 h-14 flex-shrink-0">
                            <img src="/images/0668b9e8706c79925cfba198a4a0ff35.jpg" alt="TP.HCM điều chỉnh điểm chuẩn" class="w-full h-full object-cover object-top rounded-l-lg">
                        </div>
                        <div class="flex-1 p-3">
                            <div class="flex items-center text-xs text-gray-500 mb-1">
                                <i class="ri-calendar-line mr-1"></i>
                                <span>26/06/2025</span>
                            </div>
                            <h4 class="font-medium text-sm line-clamp-2 leading-tight">TP.HCM điều chỉnh điểm chuẩn tuyển sinh lớp 10 năm 2025</h4>
                        </div>
                    </div>
                </div>
                
                <!-- Tin phụ 3 -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-shadow duration-300">
                    <div class="flex">
                        <div class="w-20 h-14 flex-shrink-0">
                            <img src="/images/0668b9e8706c79925cfba198a4a0ff35.jpg" alt="Trường chuyên thay đổi đề thi" class="w-full h-full object-cover object-top rounded-l-lg">
                        </div>
                        <div class="flex-1 p-3">
                            <div class="flex items-center text-xs text-gray-500 mb-1">
                                <i class="ri-calendar-line mr-1"></i>
                                <span>25/06/2025</span>
                            </div>
                            <h4 class="font-medium text-sm line-clamp-2 leading-tight">Các trường chuyên thay đổi cấu trúc đề thi năm 2025</h4>
                        </div>
                    </div>
                </div>
                
                <!-- Tin phụ 4 -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-shadow duration-300">
                    <div class="flex">
                        <div class="w-20 h-14 flex-shrink-0">
                            <img src="/images/0668b9e8706c79925cfba198a4a0ff35.jpg" alt="Quy định mới về thi lớp 6" class="w-full h-full object-cover object-top rounded-l-lg">
                        </div>
                        <div class="flex-1 p-3">
                            <div class="flex items-center text-xs text-gray-500 mb-1">
                                <i class="ri-calendar-line mr-1"></i>
                                <span>24/06/2025</span>
                            </div>
                            <h4 class="font-medium text-sm line-clamp-2 leading-tight">Quy định mới về thi tuyển sinh vào lớp 6 THCS</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Danh sách tin tức -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10">Tất cả tin tức</h2>
        
        <!-- Danh sách tin -->
        <div class="space-y-6 max-w-4xl mx-auto">
            <!-- Tin 1 -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-shadow duration-300">
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-1/4">
                        <img src="/images/0668b9e8706c79925cfba198a4a0ff35.jpg" alt="Hướng dẫn đăng ký online" class="w-full h-full object-cover object-top">
                    </div>
                    <div class="md:w-3/4 p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <span class="flex items-center">
                                <i class="ri-calendar-line mr-1"></i>
                                23/06/2025
                            </span>
                            <span class="mx-2">•</span>
                            <span class="flex items-center">
                                <i class="ri-eye-line mr-1"></i>
                                1,892 lượt xem
                            </span>
                            <span class="mx-2">•</span>
                            <span class="flex items-center">
                                <i class="ri-chat-3-line mr-1"></i>
                                24 bình luận
                            </span>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Hướng dẫn chi tiết đăng ký tuyển sinh online năm 2025</h3>
                        <p class="text-gray-600 mb-3">Quy trình đăng ký tuyển sinh trực tuyến được áp dụng tại hầu hết các tỉnh thành với nhiều cải tiến mới giúp phụ huynh dễ dàng thực hiện thủ tục.</p>
                        <a href="#" class="inline-flex items-center text-primary text-sm hover:underline">
                            Đọc tiếp
                            <i class="ri-arrow-right-line ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Tin 2 -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-shadow duration-300">
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-1/4">
                        <img src="/images/0668b9e8706c79925cfba198a4a0ff35.jpg" alt="Lịch thi tuyển sinh" class="w-full h-full object-cover object-top">
                    </div>
                    <div class="md:w-3/4 p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <span class="flex items-center">
                                <i class="ri-calendar-line mr-1"></i>
                                22/06/2025
                            </span>
                            <span class="mx-2">•</span>
                            <span class="flex items-center">
                                <i class="ri-eye-line mr-1"></i>
                                2,156 lượt xem
                            </span>
                            <span class="mx-2">•</span>
                            <span class="flex items-center">
                                <i class="ri-chat-3-line mr-1"></i>
                                31 bình luận
                            </span>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Lịch thi tuyển sinh các cấp học năm 2025 - Cập nhật mới nhất</h3>
                        <p class="text-gray-600 mb-3">Tổng hợp lịch thi tuyển sinh đầu cấp năm học 2025-2026 của các tỉnh thành trên toàn quốc, bao gồm thời gian đăng ký, thi tuyển và công bố kết quả.</p>
                        <a href="#" class="inline-flex items-center text-primary text-sm hover:underline">
                            Đọc tiếp
                            <i class="ri-arrow-right-line ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tin 3 -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-shadow duration-300">
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-1/4">
                        <img src="/images/0668b9e8706c79925cfba198a4a0ff35.jpg" alt="Kết quả tuyển sinh" class="w-full h-full object-cover object-top">
                    </div>
                    <div class="md:w-3/4 p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <span class="flex items-center">
                                <i class="ri-calendar-line mr-1"></i>
                                21/06/2025
                            </span>
                            <span class="mx-2">•</span>
                            <span class="flex items-center">
                                <i class="ri-eye-line mr-1"></i>
                                1,743 lượt xem
                            </span>
                            <span class="mx-2">•</span>
                            <span class="flex items-center">
                                <i class="ri-chat-3-line mr-1"></i>
                                18 bình luận
                            </span>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Thống kê kết quả tuyển sinh năm 2024 - Bài học cho năm 2025</h3>
                        <p class="text-gray-600 mb-3">Phân tích chi tiết kết quả tuyển sinh năm học 2024-2025 giúp phụ huynh và học sinh có cái nhìn tổng quan để chuẩn bị tốt hơn cho kỳ thi sắp tới.</p>
                        <a href="#" class="inline-flex items-center text-primary text-sm hover:underline">
                            Đọc tiếp
                            <i class="ri-arrow-right-line ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tin 4 -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-shadow duration-300">
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-1/4">
                        <img src="/images/0668b9e8706c79925cfba198a4a0ff35.jpg" alt="Đổi mới giáo dục" class="w-full h-full object-cover object-top">
                    </div>
                    <div class="md:w-3/4 p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <span class="flex items-center">
                                <i class="ri-calendar-line mr-1"></i>
                                20/06/2025
                            </span>
                            <span class="mx-2">•</span>
                            <span class="flex items-center">
                                <i class="ri-eye-line mr-1"></i>
                                1,568 lượt xem
                            </span>
                            <span class="mx-2">•</span>
                            <span class="flex items-center">
                                <i class="ri-chat-3-line mr-1"></i>
                                12 bình luận
                            </span>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Chương trình giáo dục phổ thông mới 2025 - Những thay đổi quan trọng</h3>
                        <p class="text-gray-600 mb-3">Chương trình giáo dục phổ thông 2025 có nhiều điểm mới về nội dung, phương pháp giảng dạy và đánh giá, ảnh hưởng trực tiếp đến tuyển sinh đầu cấp.</p>
                        <a href="#" class="inline-flex items-center text-primary text-sm hover:underline">
                            Đọc tiếp
                            <i class="ri-arrow-right-line ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tin 5 -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-shadow duration-300">
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-1/4">
                        <img src="/images/0668b9e8706c79925cfba198a4a0ff35.jpg" alt="Tư vấn phụ huynh" class="w-full h-full object-cover object-top">
                    </div>
                    <div class="md:w-3/4 p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <span class="flex items-center">
                                <i class="ri-calendar-line mr-1"></i>
                                19/06/2025
                            </span>
                            <span class="mx-2">•</span>
                            <span class="flex items-center">
                                <i class="ri-eye-line mr-1"></i>
                                2,034 lượt xem
                            </span>
                            <span class="mx-2">•</span>
                            <span class="flex items-center">
                                <i class="ri-chat-3-line mr-1"></i>
                                45 bình luận
                            </span>
                        </div>
                        <h3 class="text-lg font-bold mb-2">5 sai lầm phụ huynh thường mắc phải khi chọn trường cho con</h3>
                        <p class="text-gray-600 mb-3">Những sai lầm phổ biến mà phụ huynh thường gặp trong quá trình chọn trường và cách khắc phục để đưa ra quyết định đúng đắn nhất cho con em.</p>
                        <a href="#" class="inline-flex items-center text-primary text-sm hover:underline">
                            Đọc tiếp
                            <i class="ri-arrow-right-line ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex flex-col items-center">
            <div class="flex items-center gap-2 mb-4">
                <button class="px-3 py-2 border border-gray-300 rounded-button hover:bg-gray-50 transition-colors duration-200" disabled>
                    <i class="ri-arrow-left-line"></i>
                </button>
                <button class="px-3 py-2 bg-primary text-white rounded-button">1</button>
                <button class="px-3 py-2 border border-gray-300 rounded-button hover:bg-gray-50 transition-colors duration-200">2</button>
                <button class="px-3 py-2 border border-gray-300 rounded-button hover:bg-gray-50 transition-colors duration-200">3</button>
                <button class="px-3 py-2 border border-gray-300 rounded-button hover:bg-gray-50 transition-colors duration-200">4</button>
                <span class="px-3 py-2 text-gray-500">...</span>
                <button class="px-3 py-2 border border-gray-300 rounded-button hover:bg-gray-50 transition-colors duration-200">15</button>
                <button class="px-3 py-2 border border-gray-300 rounded-button hover:bg-gray-50 transition-colors duration-200">
                    <i class="ri-arrow-right-line"></i>
                </button>
            </div>
            <p class="text-sm text-gray-600">Hiển thị 1-10 của 247 tin tức</p>
        </div>
    </div>
</section>
@endsection

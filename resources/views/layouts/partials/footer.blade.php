<footer class="bg-gray-800 text-white pt-12 pb-6">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
            <!-- Column 1 -->
            <div>
                <h3 class="text-xl font-bold mb-4">Về LT365</h3>
                <p class="text-gray-300 mb-4">Cung cấp thông tin, tài liệu và tư vấn chuyên sâu về thi chuyển cấp cho phụ huynh và học sinh trên toàn quốc.</p>
                @include('layouts.components.social-links')
            </div>
            
            <!-- Column 2 -->
            <div>
                <h3 class="text-xl font-bold mb-4">Danh mục</h3>
                <ul class="space-y-2 text-gray-300">
                    <li><a href="#" class="hover:text-white">Thi vào lớp 1</a></li>
                    <li><a href="#" class="hover:text-white">Thi vào lớp 6</a></li>
                    <li><a href="#" class="hover:text-white">Thi vào lớp 10</a></li>
                    <li><a href="#" class="hover:text-white">Tài liệu ôn thi</a></li>
                    <li><a href="#" class="hover:text-white">Tin tức tuyển sinh</a></li>
                    <li><a href="#" class="hover:text-white">Giáo viên & Trung tâm</a></li>
                </ul>
            </div>
            
            <!-- Column 3 -->
            <div>
                <h3 class="text-xl font-bold mb-4">Hỗ trợ</h3>
                <ul class="space-y-2 text-gray-300">
                    <li><a href="#" class="hover:text-white">Câu hỏi thường gặp</a></li>
                    <li><a href="#" class="hover:text-white">Hướng dẫn sử dụng</a></li>
                    <li><a href="#" class="hover:text-white">Chính sách bảo mật</a></li>
                    <li><a href="#" class="hover:text-white">Điều khoản sử dụng</a></li>
                    <li><a href="#" class="hover:text-white">Quy định thanh toán</a></li>
                    <li><a href="#" class="hover:text-white">Liên hệ hỗ trợ</a></li>
                </ul>
            </div>
            
            <!-- Column 4 -->
            <div>
                <h3 class="text-xl font-bold mb-4">Liên hệ</h3>
                <ul class="space-y-3 text-gray-300">
                    <li class="flex items-start">
                        <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                            <i class="ri-phone-fill"></i>
                        </div>
                        <div>
                            <p class="font-medium text-white">Hotline</p>
                            <p>0987 654 321</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                            <i class="ri-mail-fill"></i>
                        </div>
                        <div>
                            <p class="font-medium text-white">Email</p>
                            <p>info@lt365.vn</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                            <i class="ri-map-pin-fill"></i>
                        </div>
                        <div>
                            <p class="font-medium text-white">Địa chỉ</p>
                            <p>Số 123 Đường Cầu Giấy, Quận Cầu Giấy, Hà Nội</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                            <i class="ri-time-fill"></i>
                        </div>
                        <div>
                            <p class="font-medium text-white">Giờ làm việc</p>
                            <p>8:00 - 17:30, Thứ Hai - Thứ Bảy</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-gray-700 pt-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm mb-4 md:mb-0">© 2025 LT365. Tất cả quyền được bảo lưu.</p>
                <div class="flex items-center gap-4">
                    <a href="#" class="text-gray-400 hover:text-white text-sm">Chính sách bảo mật</a>
                    <span class="text-gray-600">|</span>
                    <a href="#" class="text-gray-400 hover:text-white text-sm">Điều khoản sử dụng</a>
                    <span class="text-gray-600">|</span>
                    <a href="#" class="text-gray-400 hover:text-white text-sm">Sitemap</a>
                </div>
            </div>
        </div>
    </div>
</footer>

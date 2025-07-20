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

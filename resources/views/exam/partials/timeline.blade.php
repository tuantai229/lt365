<!-- Timeline Lịch thi -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        @php
            $currentMonth = now()->month;
            $currentYear = now()->year;
            if ($currentMonth < 8) {
                $fromYear = $currentYear - 1;
                $toYear = $currentYear;
            } else {
                $fromYear = $currentYear;
                $toYear = $currentYear + 1;
            }
        @endphp
        <h2 class="text-3xl font-bold text-center mb-10">Lịch thi chuyển cấp chung {{ $fromYear }}-{{ $toYear }}</h2>
        
        <div class="max-w-4xl mx-auto relative">
            <!-- Timeline line -->
            <div class="timeline-line"></div>
            
            <!-- Timeline items -->
            <div class="ml-10 space-y-8">
                <!-- Tháng 3-4 -->
                <div class="relative timeline-item" style="--timeline-color: #4f46e5;">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center mb-3">
                            <div class="w-12 h-12 rounded-lg bg-primary/10 flex flex-col items-center justify-center text-primary">
                                <span class="text-sm font-medium">Tháng</span>
                                <span class="text-lg font-bold">3-4</span>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-primary">Công bố thông tin</h4>
                                <p class="text-gray-600">Các trường công bố kế hoạch, chỉ tiêu, phương thức tuyển sinh.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Tháng 4-5 -->
                <div class="relative timeline-item" style="--timeline-color: #f59e0b;">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center mb-3">
                            <div class="w-12 h-12 rounded-lg bg-secondary/10 flex flex-col items-center justify-center text-secondary">
                                <span class="text-sm font-medium">Tháng</span>
                                <span class="text-lg font-bold">4-5</span>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-secondary">Nộp hồ sơ</h4>
                                <p class="text-gray-600">Phụ huynh và học sinh chuẩn bị và nộp hồ sơ đăng ký dự thi.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Tháng 6 -->
                <div class="relative timeline-item" style="--timeline-color: #ef4444;">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center mb-3">
                            <div class="w-12 h-12 rounded-lg bg-red-100 flex flex-col items-center justify-center text-red-600">
                                <span class="text-sm font-medium">Tháng</span>
                                <span class="text-lg font-bold">6</span>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-red-600">Tổ chức thi</h4>
                                <p class="text-gray-600">Các kỳ thi vào lớp 1, 6, 10 diễn ra, đặc biệt căng thẳng cho lớp 10.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Tháng 7 -->
                <div class="relative timeline-item" style="--timeline-color: #10b981;">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center mb-3">
                            <div class="w-12 h-12 rounded-lg bg-green-100 flex flex-col items-center justify-center text-green-600">
                                <span class="text-sm font-medium">Tháng</span>
                                <span class="text-lg font-bold">7</span>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-green-600">Công bố kết quả</h4>
                                <p class="text-gray-600">Công bố điểm thi, điểm chuẩn và danh sách trúng tuyển.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tháng 8 -->
                <div class="relative timeline-item" style="--timeline-color: #6b7280;">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center mb-3">
                            <div class="w-12 h-12 rounded-lg bg-gray-200 flex flex-col items-center justify-center text-gray-600">
                                <span class="text-sm font-medium">Tháng</span>
                                <span class="text-lg font-bold">8</span>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-gray-600">Nhập học</h4>
                                <p class="text-gray-600">Học sinh làm thủ tục nhập học và chuẩn bị cho năm học mới.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

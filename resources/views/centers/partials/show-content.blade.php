<!-- Hero Section -->
<section class="py-8 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Center Header -->
                <div class="flex flex-col md:flex-row gap-6 mb-8">
                    <!-- Center Image -->
                    <div class="md:w-1/3">
                        @if($center->featuredImage)
                            <img src="{{ $center->featuredImage->url }}" alt="{{ $center->name }}" class="w-full h-48 object-cover rounded-lg shadow-md">
                        @else
                            <img src="{{ asset('html/images/0668b9e8706c79925cfba198a4a0ff35.jpg') }}" alt="{{ $center->name }}" class="w-full h-48 object-cover rounded-lg shadow-md">
                        @endif
                    </div>
                    
                    <!-- Center Info -->
                    <div class="md:w-2/3">
                        <div class="flex items-start justify-between mb-3">
                            <h1 class="text-3xl font-bold text-gray-900">{{ $center->name }}</h1>
                            @if($center->experience > 0)
                                <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-sm font-medium whitespace-nowrap">{{ $center->experience }} năm kinh nghiệm</span>
                            @endif
                        </div>
                        
                        @if($center->tagline)
                            <p class="text-lg text-gray-600 mb-4">{{ $center->tagline }}</p>
                        @endif
                        
                        <div class="space-y-2">
                            @if($center->address)
                                <div class="flex items-center gap-2 text-gray-700">
                                    <i class="ri-map-pin-line text-primary"></i>
                                    <span>{{ $center->address }}</span>
                                </div>
                            @endif
                            @if($center->phone)
                                <div class="flex items-center gap-2 text-gray-700">
                                    <i class="ri-phone-line text-primary"></i>
                                    <span>{{ $center->phone }}</span>
                                </div>
                            @endif
                            @if($center->email)
                                <div class="flex items-center gap-2 text-gray-700">
                                    <i class="ri-mail-line text-primary"></i>
                                    <span>{{ $center->email }}</span>
                                </div>
                            @endif
                            @if($center->website)
                                <div class="flex items-center gap-2 text-gray-700">
                                    <i class="ri-global-line text-primary"></i>
                                    <span>{{ $center->website }}</span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="flex gap-3 mt-4">
                            @if($center->phone)
                                <button class="px-6 py-3 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors duration-200 font-medium flex items-center gap-2">
                                    <i class="ri-phone-line"></i>
                                    Gọi ngay
                                </button>
                            @endif
                            <button class="px-6 py-3 border border-primary text-primary rounded-button hover:bg-primary/5 transition-colors duration-200 font-medium flex items-center gap-2">
                                <i class="ri-message-line"></i>
                                Nhắn tin
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Center Details -->
                <div class="space-y-8">
                    <!-- About Section -->
                    <div class="bg-white border border-gray-200 rounded-lg p-6">
                        <h2 class="text-2xl font-bold mb-4 text-gray-900">Giới thiệu chung</h2>
                        <div class="prose max-w-none">
                            @if($center->content)
                                {!! $center->content !!}
                            @else
                                <p class="text-gray-700 mb-4">
                                    {{ $center->name }} là một trung tâm luyện thi uy tín với đội ngũ giáo viên giàu kinh nghiệm và phương pháp giảng dạy hiện đại. Chúng tôi tự hào là địa chỉ tin cậy của hàng nghìn phụ huynh và học sinh.
                                </p>
                                
                                <p class="text-gray-700 mb-4">
                                    Trung tâm chuyên đào tạo luyện thi chuyển cấp với chương trình học được thiết kế khoa học, từ cơ bản đến nâng cao, phù hợp với từng đối tượng học sinh.
                                </p>
                                
                                <h3 class="text-lg font-semibold mb-3 text-gray-900">Tầm nhìn và sứ mệnh</h3>
                                <ul class="list-disc list-inside space-y-2 text-gray-700 mb-4">
                                    <li>Trở thành trung tâm luyện thi hàng đầu</li>
                                    <li>Đào tạo thế hệ học sinh có tư duy logic và khả năng sáng tạo</li>
                                    <li>Mang lại cơ hội học tập tốt nhất cho mọi học sinh</li>
                                    <li>Xây dựng môi trường học tập tích cực và hiệu quả</li>
                                </ul>
                            @endif
                        </div>
                    </div>

                    <!-- Specialties Section -->
                    <div class="bg-white border border-gray-200 rounded-lg p-6">
                        <h2 class="text-2xl font-bold mb-4 text-gray-900">Chuyên môn và dịch vụ</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Cấp học -->
                            @if($center->levels->isNotEmpty())
                                <div>
                                    <h3 class="text-lg font-semibold mb-3 text-gray-900">Cấp học chuyên biệt</h3>
                                    <div class="space-y-2">
                                        @foreach($center->levels as $level)
                                            <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-lg">
                                                <i class="ri-graduation-cap-line text-blue-600"></i>
                                                <span class="font-medium">{{ $level->name }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Môn học -->
                            @if($center->subjects->isNotEmpty())
                                <div>
                                    <h3 class="text-lg font-semibold mb-3 text-gray-900">Môn học giảng dạy</h3>
                                    <div class="grid grid-cols-2 gap-2">
                                        @foreach($center->subjects as $subject)
                                            <div class="flex items-center gap-2 p-2 bg-purple-50 rounded">
                                                <i class="ri-book-line text-purple-600"></i>
                                                <span class="text-sm">{{ $subject->name }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Loại hình đào tạo -->
                        <div class="mt-6">
                            <h3 class="text-lg font-semibold mb-3 text-gray-900">Hình thức học tập</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="border border-gray-200 rounded-lg p-4 text-center">
                                    <i class="ri-group-line text-2xl text-primary mb-2"></i>
                                    <h4 class="font-medium mb-1">Lớp học nhóm</h4>
                                    <p class="text-sm text-gray-600">8-12 học sinh/lớp</p>
                                </div>
                                <div class="border border-gray-200 rounded-lg p-4 text-center">
                                    <i class="ri-user-line text-2xl text-primary mb-2"></i>
                                    <h4 class="font-medium mb-1">Kèm riêng 1:1</h4>
                                    <p class="text-sm text-gray-600">Theo yêu cầu</p>
                                </div>
                                <div class="border border-gray-200 rounded-lg p-4 text-center">
                                    <i class="ri-computer-line text-2xl text-primary mb-2"></i>
                                    <h4 class="font-medium mb-1">Học online</h4>
                                    <p class="text-sm text-gray-600">Linh hoạt thời gian</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Gallery Section -->
                    <div class="bg-white border border-gray-200 rounded-lg p-6">
                        <h2 class="text-2xl font-bold mb-4 text-gray-900">Hình ảnh trung tâm</h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <img src="{{ asset('html/images/0668b9e8706c79925cfba198a4a0ff35.jpg') }}" alt="Phòng học 1" class="w-full h-32 object-cover rounded-lg">
                            <img src="{{ asset('html/images/2ea343b800b7ca44c1844291afa997e9.jpg') }}" alt="Phòng học 2" class="w-full h-32 object-cover rounded-lg">
                            <img src="{{ asset('html/images/3d7d5e0502820a5e09cf3fb76caa9d88.jpg') }}" alt="Khu vực nghỉ ngơi" class="w-full h-32 object-cover rounded-lg">
                            <img src="{{ asset('html/images/0668b9e8706c79925cfba198a4a0ff35.jpg') }}" alt="Thư viện" class="w-full h-32 object-cover rounded-lg">
                            <img src="{{ asset('html/images/2ea343b800b7ca44c1844291afa997e9.jpg') }}" alt="Sảnh chính" class="w-full h-32 object-cover rounded-lg">
                            <img src="{{ asset('html/images/3d7d5e0502820a5e09cf3fb76caa9d88.jpg') }}" alt="Lớp học" class="w-full h-32 object-cover rounded-lg">
                        </div>
                    </div>

                    <!-- News Section -->
                    @if(isset($featuredNews) && $featuredNews->isNotEmpty())
                        <div class="bg-white border border-gray-200 rounded-lg p-6">
                            <h2 class="text-2xl font-bold mb-4 text-gray-900">Tin tức nổi bật</h2>
                            <div class="space-y-4">
                                @foreach($featuredNews->take(3) as $news)
                                    <article class="border-b border-gray-200 pb-4 last:border-b-0">
                                        <div class="flex items-start gap-4">
                                            @if($news->featuredImage)
                                                <img src="{{ $news->featuredImage->url }}" alt="{{ $news->name }}" class="w-20 h-16 object-cover rounded">
                                            @else
                                                <img src="{{ asset('html/images/0668b9e8706c79925cfba198a4a0ff35.jpg') }}" alt="{{ $news->name }}" class="w-20 h-16 object-cover rounded">
                                            @endif
                                            <div class="flex-1">
                                                <h3 class="font-semibold mb-2 hover:text-primary cursor-pointer">{{ $news->name }}</h3>
                                                <p class="text-sm text-gray-600 mb-2">{{ Str::limit(strip_tags($news->content), 150) }}</p>
                                                <div class="flex items-center text-xs text-gray-500">
                                                    <i class="ri-calendar-line mr-1"></i>
                                                    <span>{{ $news->created_at->format('d/m/Y') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                            <button class="mt-4 text-primary hover:underline text-sm font-medium">Xem tất cả tin tức</button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="sticky top-4 space-y-6">
                    <!-- Contact Form -->
                    <div class="bg-white border border-gray-200 rounded-lg p-6">
                        <h3 class="text-xl font-bold mb-4 text-gray-900">Đăng ký tư vấn</h3>
                        <form class="space-y-4">
                            <div>
                                <input type="text" placeholder="Họ tên phụ huynh" class="w-full p-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                            </div>
                            <div>
                                <input type="tel" placeholder="Số điện thoại" class="w-full p-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                            </div>
                            <div>
                                <input type="text" placeholder="Tên con và năm sinh" class="w-full p-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                            </div>
                            <div>
                                <select class="w-full p-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                                    <option value="">Cấp học quan tâm</option>
                                    @if($center->levels->isNotEmpty())
                                        @foreach($center->levels as $level)
                                            <option value="{{ $level->slug }}">{{ $level->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div>
                                <textarea placeholder="Ghi chú hoặc câu hỏi" rows="3" class="w-full p-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary resize-none"></textarea>
                            </div>
                            <button type="submit" class="w-full py-3 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors duration-200 font-medium">
                                Gửi yêu cầu tư vấn
                            </button>
                        </form>
                        <p class="text-xs text-gray-500 mt-3">* Chúng tôi sẽ liên hệ với bạn trong vòng 24h</p>
                    </div>
                    
                    <!-- Quick Contact -->
                    <div class="bg-white border border-gray-200 rounded-lg p-6">
                        <h3 class="text-xl font-bold mb-4 text-gray-900">Liên hệ nhanh</h3>
                        <div class="space-y-3">
                            @if($center->phone)
                                <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-lg">
                                    <i class="ri-phone-line text-blue-600"></i>
                                    <div>
                                        <p class="font-medium text-sm">Hotline tư vấn</p>
                                        <p class="text-blue-600 font-semibold">{{ $center->phone }}</p>
                                    </div>
                                </div>
                            @endif
                            @if($center->phone)
                                <div class="flex items-center gap-3 p-3 bg-green-50 rounded-lg">
                                    <i class="ri-message-line text-green-600"></i>
                                    <div>
                                        <p class="font-medium text-sm">Zalo/Viber</p>
                                        <p class="text-green-600 font-semibold">{{ $center->phone }}</p>
                                    </div>
                                </div>
                            @endif
                            @if($center->email)
                                <div class="flex items-center gap-3 p-3 bg-red-50 rounded-lg">
                                    <i class="ri-mail-line text-red-600"></i>
                                    <div>
                                        <p class="font-medium text-sm">Email</p>
                                        <p class="text-red-600 font-semibold text-xs">{{ $center->email }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Map Section -->
                    <div class="bg-white border border-gray-200 rounded-lg p-6">
                        <h3 class="text-xl font-bold mb-4 text-gray-900">Vị trí trung tâm</h3>
                        <div class="bg-gray-200 h-48 rounded-lg mb-4 flex items-center justify-center">
                            <div class="text-center text-gray-500">
                                <i class="ri-map-pin-line text-3xl mb-2"></i>
                                <p class="text-sm">Bản đồ Google Maps</p>
                                <p class="text-xs">{{ $center->address }}</p>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center gap-2">
                                <i class="ri-bus-line text-primary"></i>
                                <span>Bus: Tuyến 01, 18, 32</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="ri-train-line text-primary"></i>
                                <span>Metro: Ga gần nhất (500m)</span>
                            </div>
                        </div>
                    </div>

                    <!-- Related Centers -->
                    @if(isset($relatedCenters) && $relatedCenters->isNotEmpty())
                        <div class="bg-white border border-gray-200 rounded-lg p-6">
                            <h3 class="text-xl font-bold mb-4 text-gray-900">Trung tâm liên quan</h3>
                            <div class="space-y-4">
                                @foreach($relatedCenters->take(3) as $relatedCenter)
                                    <div class="border border-gray-200 rounded-lg p-3">
                                        <h4 class="font-medium mb-1">{{ $relatedCenter->name }}</h4>
                                        @if($relatedCenter->tagline)
                                            <p class="text-sm text-gray-600 mb-2">{{ $relatedCenter->tagline }}</p>
                                        @endif
                                        <p class="text-xs text-gray-500">{{ $relatedCenter->address }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

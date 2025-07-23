<section class="py-8 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Teacher Header -->
                <div class="flex flex-col md:flex-row gap-6 mb-8">
                    <!-- Teacher Image -->
                    <div class="md:w-1/3">
                        <img src="{{ get_image_url($teacher->featured_image_url) }}" alt="{{ $teacher->name }}" class="w-full h-64 object-cover object-top rounded-lg shadow-md">
                    </div>
                    
                    <!-- Teacher Info -->
                    <div class="md:w-2/3">
                        <div class="flex items-start justify-between mb-3">
                            <h1 class="text-3xl font-bold text-gray-900">{{ $teacher->name }}</h1>
                            @if($teacher->experience > 0)
                                <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-sm font-medium whitespace-nowrap">{{ $teacher->experience }} năm kinh nghiệm</span>
                            @endif
                        </div>
                        
                        @if($teacher->tagline)
                            <p class="text-lg text-gray-600 mb-4">{{ $teacher->tagline }}</p>
                        @endif
                        
                        <div class="space-y-2">
                            @if($teacher->subjects->count() > 0)
                                <div class="flex items-center gap-2 text-gray-700">
                                    <i class="ri-book-line text-primary"></i>
                                    <span>Chuyên môn: {{ $teacher->subjects->pluck('name')->join(', ') }}</span>
                                </div>
                            @endif
                            @if($teacher->levels->count() > 0)
                                <div class="flex items-center gap-2 text-gray-700">
                                    <i class="ri-graduation-cap-line text-primary"></i>
                                    <span>Đối tượng: {{ $teacher->levels->pluck('name')->join(', ') }}</span>
                                </div>
                            @endif
                            @if($teacher->province)
                                <div class="flex items-center gap-2 text-gray-700">
                                    <i class="ri-map-pin-line text-primary"></i>
                                    <span>
                                        Địa điểm: {{ $teacher->province->name }}
                                        @if($teacher->commune_id > 0 && $teacher->commune)
                                            ({{ $teacher->commune->name }})
                                        @endif
                                    </span>
                                </div>
                            @endif
                            @if($teacher->phone)
                                <div class="flex items-center gap-2 text-gray-700">
                                    <i class="ri-phone-line text-primary"></i>
                                    <span>Điện thoại: {{ $teacher->phone }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                @if($teacher->content)
                    <!-- About Section -->
                    <div class="bg-white border border-gray-200 rounded-lg p-6 mb-6">
                        <h2 class="text-2xl font-bold mb-4 text-gray-900">Giới thiệu</h2>
                        <div class="prose max-w-none text-gray-700">
                            {!! $teacher->content !!}
                        </div>
                    </div>
                @endif

                <!-- Subjects & Levels -->
                @if($teacher->subjects->count() > 0 || $teacher->levels->count() > 0)
                    <div class="bg-white border border-gray-200 rounded-lg p-6 mb-6">
                        <h2 class="text-2xl font-bold mb-4 text-gray-900">Chuyên môn giảng dạy</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($teacher->subjects->count() > 0)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center gap-3 mb-2">
                                        <i class="ri-book-line text-2xl text-primary"></i>
                                        <h4 class="font-medium">Môn học</h4>
                                    </div>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($teacher->subjects as $subject)
                                            <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-sm">{{ $subject->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            
                            @if($teacher->levels->count() > 0)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center gap-3 mb-2">
                                        <i class="ri-graduation-cap-line text-2xl text-primary"></i>
                                        <h4 class="font-medium">Cấp học</h4>
                                    </div>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($teacher->levels as $level)
                                            <span class="bg-secondary/10 text-secondary px-3 py-1 rounded-full text-sm">{{ $level->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
            
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Contact Card -->
                <div class="bg-white border border-gray-200 rounded-lg p-6 mb-6 top-6">
                    <h3 class="text-xl font-bold mb-4 text-gray-900">Liên hệ tư vấn</h3>
                    
                    <!-- Contact Info -->
                    <div class="space-y-3 mb-6">
                        @if($teacher->phone)
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                    <i class="ri-phone-line"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Điện thoại</p>
                                    <p class="font-medium">{{ $teacher->phone }}</p>
                                </div>
                            </div>
                        @endif
                        
                        @if($teacher->email)
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                    <i class="ri-mail-line"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Email</p>
                                    <p class="font-medium">{{ $teacher->email }}</p>
                                </div>
                            </div>
                        @endif
                        
                        @if($teacher->province)
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                    <i class="ri-map-pin-line"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Địa điểm dạy</p>
                                    <p class="font-medium">
                                        {{ $teacher->province->name }}
                                        @if($teacher->commune_id > 0 && $teacher->commune)
                                            ({{ $teacher->commune->name }})
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <!-- CTA Buttons -->
                    <div class="space-y-3">
                        @if($teacher->phone)
                            <a href="tel:{{ $teacher->phone }}" class="w-full py-3 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors duration-200 font-medium text-center block">
                                <i class="ri-phone-line mr-2"></i>
                                Liên hệ ngay
                            </a>
                        @endif
                        <button class="w-full py-3 border border-primary text-primary rounded-lg hover:bg-primary/5 transition-colors duration-200 font-medium">
                            <i class="ri-message-line mr-2"></i>
                            Nhắn tin tư vấn
                        </button>
                    </div>
                </div>

                <!-- Quick Info -->
                <div class="bg-white border border-gray-200 rounded-lg p-6 mb-6">
                    <h3 class="text-xl font-bold mb-4 text-gray-900">Thông tin nhanh</h3>
                    <div class="space-y-3">
                        @if($teacher->experience > 0)
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Kinh nghiệm:</span>
                                <span class="font-medium">{{ $teacher->experience }} năm</span>
                            </div>
                        @endif
                        @if($teacher->subjects->count() > 0)
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Chuyên môn:</span>
                                <span class="font-medium">{{ $teacher->subjects->first()->name }}</span>
                            </div>
                        @endif
                        @if($teacher->levels->count() > 0)
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Đối tượng:</span>
                                <span class="font-medium">{{ $teacher->levels->pluck('name')->join(', ') }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Related Teachers -->
                @if($relatedTeachers->count() > 0)
                    <div class="bg-white border border-gray-200 rounded-lg p-6">
                        <h3 class="text-xl font-bold mb-4 text-gray-900">Giáo viên tương tự</h3>
                        <div class="space-y-4">
                            @foreach($relatedTeachers as $relatedTeacher)
                                <div class="flex items-center gap-4 p-3 border border-gray-100 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                    <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-100 flex-shrink-0">
                                        @if($relatedTeacher->featuredImage)
                                            <img src="{{ asset('storage/' . $relatedTeacher->featuredImage->path) }}" alt="{{ $relatedTeacher->name }}" class="w-full h-full object-cover">
                                        @else
                                            <img src="{{ asset('html/images/0668b9e8706c79925cfba198a4a0ff35.jpg') }}" alt="{{ $relatedTeacher->name }}" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-medium text-gray-900 truncate">{{ $relatedTeacher->name }}</h4>
                                        @if($relatedTeacher->subjects->count() > 0)
                                            <p class="text-sm text-gray-600">{{ $relatedTeacher->subjects->first()->name }}</p>
                                        @endif
                                        @if($relatedTeacher->experience > 0)
                                            <p class="text-xs text-gray-500">{{ $relatedTeacher->experience }} năm kinh nghiệm</p>
                                        @endif
                                    </div>
                                    <a href="{{ route('teachers.show', [$relatedTeacher->slug, $relatedTeacher->id]) }}" class="px-3 py-1 text-sm bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors duration-200">
                                        Xem
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

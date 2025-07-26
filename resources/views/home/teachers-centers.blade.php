<!-- Giáo viên & Trung tâm -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10">Giáo viên & Trung tâm uy tín</h2>
        
        <!-- Trung tâm đối tác -->
        @if(!empty($selectedCenters) && count($selectedCenters) > 0)
            <div class="mb-10">
                <h3 class="text-xl font-bold mb-6">Trung tâm luyện thi</h3>
                
                <div class="content-slider-wrapper">
                    <div class="content-slider flex overflow-x-auto gap-6 pb-4 -mx-4 px-4" id="centerSlider">
                        @foreach($selectedCenters as $center)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 min-w-[280px]">
                                <div class="h-40 bg-gray-100">
                                    <img src="{{ asset($center->featured_image_url ?? 'html/images/default-center.jpg') }}" alt="{{ $center->name ?? '' }}" class="w-full h-full object-cover">
                                </div>
                                <div class="p-4">
                                    <h4 class="font-bold mb-1">{{ $center->name ?? '' }}</h4>
                                    <p class="text-sm text-gray-600 mb-2">{{ $center->tagline ?? '' }}</p>
                                    <p class="text-xs text-gray-500 mb-3">Địa chỉ: {{ $center->address ?? '' }}</p>
                                    <a href="{{ route('centers.show', $center->slug) }}" class="w-full py-2 border border-primary text-primary rounded-button hover:bg-primary/5 transition-colors duration-200 text-sm font-medium whitespace-nowrap">Xem chi tiết</a>
                                </div>
                            </div>
                        @endforeach
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
        @endif
        
        <!-- Giáo viên -->
        @if(!empty($selectedTeachers) && count($selectedTeachers) > 0)
            <div>
                <h3 class="text-xl font-bold mb-6">Giáo viên nổi bật</h3>
                
                <div class="content-slider-wrapper">
                    <div class="content-slider flex overflow-x-auto gap-6 pb-4 -mx-4 px-4" id="teacherSlider">
                        @foreach($selectedTeachers as $teacher)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 min-w-[280px]">
                                <div class="h-40 bg-gray-100">
                                    <img src="{{ asset($teacher->featured_image_url ?? 'html/images/default-teacher.jpg') }}" alt="{{ $teacher->name ?? '' }}" class="w-full h-full object-cover object-top">
                                </div>
                                <div class="p-4">
                                    <h4 class="font-bold mb-1">{{ $teacher->name ?? '' }}</h4>
                                    <p class="text-sm text-gray-600 mb-2">{{ $teacher->tagline ?? '' }}</p>
                                    <p class="text-xs text-gray-500 mb-3">Chuyên luyện thi vào lớp 10 chuyên Toán</p>
                                    <a href="{{ route('teachers.show', $teacher->slug) }}" class="w-full py-2 border border-primary text-primary rounded-button hover:bg-primary/5 transition-colors duration-200 text-sm font-medium whitespace-nowrap">Xem hồ sơ</a>
                                </div>
                            </div>
                        @endforeach
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
        @endif
    </div>
</section>

<!-- Thống kê & Đánh giá -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Thống kê -->
        @if(!empty($statsReviews['stats']))
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12">
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="text-3xl font-bold text-primary mb-2">{{ $statsReviews['stats']['documents'] ?? '0' }}</div>
                    <p class="text-gray-600">Tài liệu</p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="text-3xl font-bold text-primary mb-2">{{ $statsReviews['stats']['schools'] ?? '0' }}</div>
                    <p class="text-gray-600">Trường học</p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="text-3xl font-bold text-primary mb-2">{{ $statsReviews['stats']['members'] ?? '0' }}</div>
                    <p class="text-gray-600">Thành viên</p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="text-3xl font-bold text-primary mb-2">{{ $statsReviews['stats']['rating'] ?? '0' }}</div>
                    <p class="text-gray-600">Đánh giá</p>
                </div>
            </div>
        @endif
        
        <!-- Đánh giá -->
        @if(!empty($statsReviews['reviews']) && count($statsReviews['reviews']) > 0)
            <h2 class="text-3xl font-bold text-center mb-10">Phụ huynh nói gì về chúng tôi</h2>
            
            <div class="content-slider-wrapper">
                <div class="content-slider flex overflow-x-auto gap-6 pb-4 -mx-4 px-4" id="reviewSlider">
                    @foreach($statsReviews['reviews'] as $review)
                        <div class="bg-white rounded-lg shadow-md p-6 min-w-[350px]">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
                                    <img src="{{ get_image_url($review['avatar'] ?? null) }}" alt="{{ $review['name'] ?? '' }}" class="w-full h-full object-cover object-top">
                                </div>
                                <div>
                                    <h4 class="font-bold">{{ $review['name'] ?? '' }}</h4>
                                    <div class="flex text-yellow-400">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= ($review['rating'] ?? 0))
                                                <i class="ri-star-fill"></i>
                                            @elseif($i - 0.5 <= ($review['rating'] ?? 0))
                                                <i class="ri-star-half-fill"></i>
                                            @else
                                                <i class="ri-star-line"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <p class="text-gray-600">"{{ $review['review_content'] ?? '' }}"</p>
                        </div>
                    @endforeach
                </div>
                
                <!-- Navigation buttons -->
                <button class="nav-btn absolute left-0 top-1/2 transform -translate-y-1/2 w-10 h-10 rounded-full bg-white shadow-md flex items-center justify-center z-10 -ml-5" onclick="slideContent('reviewSlider', 'prev')" id="reviewPrev">
                    <i class="ri-arrow-left-s-line"></i>
                </button>
                <button class="nav-btn absolute right-0 top-1/2 transform -translate-y-1/2 w-10 h-10 rounded-full bg-white shadow-md flex items-center justify-center z-10 -mr-5" onclick="slideContent('reviewSlider', 'next')" id="reviewNext">
                    <i class="ri-arrow-right-s-line"></i>
                </button>
            </div>
        @endif
    </div>
</section>

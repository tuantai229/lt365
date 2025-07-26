<!-- Hero Banner Slider -->
<section class="relative overflow-hidden bg-gray-100 hero-slider-wrapper">
    <div class="container mx-auto px-4 py-6">
        <div class="hero-slider-container relative w-full overflow-hidden rounded-lg shadow-lg" style="height: 450px;">
            
            @if(!empty($heroSlides) && count($heroSlides) > 0)
                @foreach($heroSlides as $index => $slide)
                    <div class="hero-slide {{ $index === 0 ? 'active' : '' }}" style="background-image: url('{{ get_image_url($slide['image'] ?? null) }}'); background-size: cover; background-position: center;">
                        <div class="absolute inset-0 bg-gradient-to-r from-primary/80 to-transparent"></div>
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full container mx-auto px-4 md:px-10 flex">
                                <div class="w-1/2 text-white">
                                    <h2 class="text-4xl font-bold mb-4">{{ $slide['title'] ?? '' }}</h2>
                                    <p class="text-lg mb-6">{{ $slide['description'] ?? '' }}</p>
                                    <div class="flex gap-4">
                                        @if($slide['button1_text'] ?? '')
                                            <a href="{{ $slide['button1_url'] ?? '#' }}" class="px-6 py-3 {{ $slide['button1_color_class'] ?? 'bg-white text-primary' }} font-medium rounded-button hover:opacity-90 transition-colors duration-200 whitespace-nowrap !rounded-button">
                                                {{ $slide['button1_text'] }}
                                            </a>
                                        @endif
                                        @if($slide['button2_text'] ?? '')
                                            <a href="{{ $slide['button2_url'] ?? '#' }}" class="px-6 py-3 {{ $slide['button2_color_class'] ?? 'bg-secondary text-white' }} font-medium rounded-button hover:opacity-90 transition-colors duration-200 whitespace-nowrap !rounded-button">
                                                {{ $slide['button2_text'] }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Fallback slide if no data -->
                <div class="hero-slide active" style="background-image: url('{{ asset('html/images/0185df70dbcee70ff37980a67a92ce64.jpg') }}'); background-size: cover; background-position: center;">
                    <div class="absolute inset-0 bg-gradient-to-r from-primary/80 to-transparent"></div>
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full container mx-auto px-4 md:px-10 flex">
                            <div class="w-1/2 text-white">
                                <h2 class="text-4xl font-bold mb-4">Đồng hành cùng con vào trường chuyên</h2>
                                <p class="text-lg mb-6">Cung cấp tài liệu, kinh nghiệm và tư vấn chuyên sâu giúp học sinh và phụ huynh tự tin vượt qua kỳ thi chuyển cấp</p>
                                <div class="flex gap-4">
                                    <button class="px-6 py-3 bg-white text-primary font-medium rounded-button hover:bg-gray-100 transition-colors duration-200 whitespace-nowrap !rounded-button">Tìm tài liệu</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            
            <!-- Navigation Arrows -->
            @if(!empty($heroSlides) && count($heroSlides) > 1)
                <button class="slider-nav-btn prev-btn absolute left-4 top-1/2 transform -translate-y-1/2 w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white hover:bg-white/30 transition-colors duration-200 z-20">
                    <i class="ri-arrow-left-s-line text-2xl"></i>
                </button>
                <button class="slider-nav-btn next-btn absolute right-4 top-1/2 transform -translate-y-1/2 w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white hover:bg-white/30 transition-colors duration-200 z-20">
                    <i class="ri-arrow-right-s-line text-2xl"></i>
                </button>
                
                <!-- Slider Indicators -->
                <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-2 z-20">
                    @foreach($heroSlides as $index => $slide)
                        <button class="slide-indicator w-3 h-3 rounded-full bg-white {{ $index === 0 ? 'opacity-100' : 'opacity-50' }}"></button>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Results Section -->
<section class="py-8">
    <div class="container mx-auto px-4">
        <!-- Results Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold">Trung tâm luyện thi</h2>
                <p class="text-gray-600">Tìm thấy {{ $centers->total() }} trung tâm phù hợp</p>
            </div>
        </div>

        <!-- Centers Grid -->
        <div id="centersGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($centers as $center)
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                    <div class="h-40 bg-gray-100 relative">
                        @if($center->featuredImage)
                            <img src="{{ $center->featuredImage->url }}" alt="{{ $center->name }}" class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('html/images/0668b9e8706c79925cfba198a4a0ff35.jpg') }}" alt="{{ $center->name }}" class="w-full h-full object-cover">
                        @endif
                        <button class="absolute top-3 right-3 w-8 h-8 rounded-full bg-white/80 flex items-center justify-center text-gray-400 hover:text-red-500 transition-colors duration-200" data-favorite-btn data-center-id="{{ $center->id }}">
                            <i class="ri-heart-line"></i>
                        </button>
                    </div>
                    <div class="p-5">
                        <div class="flex gap-2 mb-3">
                            @if($center->levels->isNotEmpty())
                                @foreach($center->levels->take(2) as $centerLevel)
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">{{ $centerLevel->name }}</span>
                                @endforeach
                            @endif
                            @if($center->experience > 0)
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">{{ $center->experience }} năm KN</span>
                            @endif
                        </div>
                        <h3 class="font-bold text-lg mb-2">{{ $center->name }}</h3>
                        @if($center->tagline)
                            <p class="text-sm text-gray-600 mb-2">{{ $center->tagline }}</p>
                        @endif
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <i class="ri-map-pin-line mr-1"></i>
                            <span>{{ $center->address }}</span>
                        </div>
                        <div class="text-sm text-gray-600 mb-4">
                            @if($center->subjects->isNotEmpty())
                                <p><strong>Môn dạy:</strong> {{ $center->subjects->pluck('name')->join(', ') }}</p>
                            @endif
                            <p><strong>Phương pháp:</strong> Đào tạo chuyên sâu</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('centers.show', [$center->slug, $center->id]) }}" class="flex-1 py-2 border border-primary text-primary rounded-button hover:bg-primary/5 transition-colors duration-200 text-sm font-medium text-center">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <div class="text-gray-400 mb-4">
                        <i class="ri-building-line text-6xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Không tìm thấy trung tâm nào</h3>
                    <p class="text-gray-500 mb-4">Thử thay đổi bộ lọc để tìm kiếm kết quả phù hợp hơn</p>
                    <a href="{{ route('centers.index') }}" class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors duration-200">
                        <i class="ri-refresh-line mr-2"></i>
                        Xem tất cả trung tâm
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($centers->hasPages())
            <div class="flex items-center justify-between mt-8">
                <div class="flex gap-2">
                    @if($centers->onFirstPage())
                        <span class="px-3 py-2 border border-gray-300 rounded-button text-gray-400 cursor-not-allowed">
                            <i class="ri-arrow-left-line"></i>
                        </span>
                    @else
                        <a href="{{ $centers->previousPageUrl() }}" class="px-3 py-2 border border-gray-300 rounded-button hover:bg-gray-50 transition-colors duration-200">
                            <i class="ri-arrow-left-line"></i>
                        </a>
                    @endif

                    @foreach($centers->getUrlRange(1, $centers->lastPage()) as $page => $url)
                        @if($page == $centers->currentPage())
                            <span class="px-3 py-2 bg-primary text-white rounded-button">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-3 py-2 border border-gray-300 rounded-button hover:bg-gray-50 transition-colors duration-200">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if($centers->hasMorePages())
                        <a href="{{ $centers->nextPageUrl() }}" class="px-3 py-2 border border-gray-300 rounded-button hover:bg-gray-50 transition-colors duration-200">
                            <i class="ri-arrow-right-line"></i>
                        </a>
                    @else
                        <span class="px-3 py-2 border border-gray-300 rounded-button text-gray-400 cursor-not-allowed">
                            <i class="ri-arrow-right-line"></i>
                        </span>
                    @endif
                </div>
                <p class="text-sm text-gray-600">
                    Hiển thị {{ $centers->firstItem() }}-{{ $centers->lastItem() }} của {{ $centers->total() }} trung tâm
                </p>
            </div>
        @endif
    </div>
</section>

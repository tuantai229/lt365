<footer class="mt-8 pt-6 border-t border-gray-200">
    <!-- Tags -->
    <div class="mb-6">
        <h4 class="text-sm font-medium text-gray-700 mb-3">Từ khóa:</h4>
        <div class="flex flex-wrap gap-2">
            @foreach($document->tags as $tag)
                <span class="px-3 py-1 bg-primary/10 text-primary rounded-full text-sm">{{ $tag->name }}</span>
            @endforeach
        </div>
    </div>

    <!-- Rating & Actions -->
    <div class="mb-6">
        <h4 class="text-sm font-medium text-gray-700 mb-3">Đánh giá:</h4>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Rating Display - Smaller Column -->
            <div class="lg:col-span-1">
                @include('partials.rating-display', ['ratingStats' => $ratingStats])
            </div>
            
            <!-- Rating Form - Larger Column -->
            <div class="lg:col-span-2">
                @include('partials.rating-form', [
                    'ratingStats' => $ratingStats,
                    'userRating' => $userRating,
                    'type' => 'document',
                    'typeId' => $document->id
                ])
            </div>
        </div>
    </div>

    <!-- Ratings List -->
    <div class="mb-6">
        <h4 class="text-sm font-medium text-gray-700 mb-4">Nhận xét từ người dùng:</h4>
        
        @if($ratings->count() > 0)
            <div class="space-y-4">
                @foreach($ratings as $rating)
                    <div class="bg-white border border-gray-200 rounded-lg p-4">
                        <div class="flex items-start gap-3">
                            <!-- User Avatar -->
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-medium text-primary">
                                        {{ strtoupper(substr($rating->user->full_name ?? 'A', 0, 1)) }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Rating Content -->
                            <div class="flex-1 min-w-0">
                                <!-- User Info & Rating -->
                                <div class="flex items-center gap-3 mb-2">
                                    <h5 class="text-sm font-medium text-gray-900 truncate">
                                        {{ $rating->user->full_name ?? 'Người dùng ẩn danh' }}
                                    </h5>
                                    <div class="flex items-center gap-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $rating->rating)
                                                <i class="ri-star-fill text-yellow-400 text-sm"></i>
                                            @else
                                                <i class="ri-star-line text-gray-300 text-sm"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="text-xs text-gray-500">
                                        {{ $rating->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                
                                <!-- Review Text -->
                                @if($rating->review)
                                    <p class="text-sm text-gray-700 leading-relaxed">
                                        {{ $rating->review }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if($ratings->hasPages())
                <div class="mt-6">
                    {{ $ratings->appends(request()->query())->links('pagination::tailwind') }}
                </div>
            @endif
        @else
            <div class="text-center py-8 bg-gray-50 rounded-lg">
                <i class="ri-chat-3-line text-3xl text-gray-400 mb-2"></i>
                <p class="text-sm text-gray-500">Chưa có nhận xét nào cho tài liệu này</p>
                <p class="text-xs text-gray-400 mt-1">Hãy là người đầu tiên đánh giá và chia sẻ trải nghiệm của bạn!</p>
            </div>
        @endif
    </div>

    <!-- Share Buttons -->
    <div class="mb-6">
        <h4 class="text-sm font-medium text-gray-700 mb-3">Chia sẻ tài liệu:</h4>
        <div class="flex gap-3">
            <button class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-button hover:bg-blue-700 transition-colors">
                <i class="ri-facebook-fill"></i>
                <span>Facebook</span>
            </button>
            <button class="flex items-center gap-2 px-4 py-2 bg-blue-500 text-white rounded-button hover:bg-blue-600 transition-colors">
                <i class="ri-message-line"></i>
                <span>Zalo</span>
            </button>
            <button class="flex items-center gap-2 px-4 py-2 bg-gray-600 text-white rounded-button hover:bg-gray-700 transition-colors">
                <i class="ri-link"></i>
                <span>Copy link</span>
            </button>
        </div>
    </div>
</footer>

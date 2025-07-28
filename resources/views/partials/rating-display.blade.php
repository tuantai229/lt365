@php
    $stats = $ratingStats ?? [];
    $average = $stats['average'] ?? 0;
    $total = $stats['total'] ?? 0;
    $breakdown = $stats['breakdown'] ?? [];
@endphp

<div class="rating-display">
    @if($total > 0)
        <!-- Rating Summary -->
        <div class="rating-summary flex items-center gap-4 mb-4">
            <div class="rating-score">
                <div class="flex items-center gap-2">
                    <div class="stars flex">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= floor($average))
                                <i class="ri-star-fill text-yellow-400"></i>
                            @elseif($i <= $average)
                                <i class="ri-star-half-fill text-yellow-400"></i>
                            @else
                                <i class="ri-star-line text-gray-300"></i>
                            @endif
                        @endfor
                    </div>
                    <span class="rating-text text-sm font-medium text-gray-700">
                        ({{ number_format($average, 1) }}/5 - {{ $total }} {{ $total == 1 ? 'đánh giá' : 'đánh giá' }})
                    </span>
                </div>
            </div>
        </div>

        <!-- Rating Breakdown -->
        <div class="rating-breakdown mb-4">
            @foreach($breakdown as $star => $count)
                <div class="rating-bar flex items-center gap-3 mb-2">
                    <div class="star-label flex items-center gap-1 w-12">
                        <span class="text-sm">{{ $star }}</span>
                        <i class="ri-star-fill text-yellow-400 text-xs"></i>
                    </div>
                    <div class="bar-container flex-1 bg-gray-200 rounded h-2 overflow-hidden">
                        <div class="bar bg-yellow-400 h-full rounded" 
                             style="width: {{ $total > 0 ? ($count / $total * 100) : 0 }}%"></div>
                    </div>
                    <span class="count text-sm text-gray-600 w-8">{{ $count }}</span>
                </div>
            @endforeach
        </div>
    @else
        <!-- No Ratings Yet -->
        <div class="no-ratings text-center py-4">
            <div class="flex items-center justify-center gap-2 mb-2">
                @for($i = 1; $i <= 5; $i++)
                    <i class="ri-star-line text-gray-300"></i>
                @endfor
            </div>
            <p class="text-sm text-gray-500">Chưa có đánh giá nào</p>
        </div>
    @endif
</div>

<style>
    .rating-display .rating-bar {
        font-size: 0.875rem;
    }
    
    .rating-display .bar-container {
        transition: all 0.3s ease;
    }
    
    .rating-display .bar {
        transition: width 0.5s ease;
    }
    
    .rating-display .stars i {
        font-size: 1.125rem;
    }
    
    .rating-display .no-ratings .ri-star-line {
        font-size: 1.5rem;
    }
</style>

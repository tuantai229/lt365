@if($schoolNews->count() > 0)
@php
    $featuredNewsItem = $schoolNews->shift();
@endphp
<!-- News Section -->
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Tin tức về trường</h2>
    
    <!-- Featured News -->
    @if($featuredNewsItem)
    <div class="mb-6 p-4 bg-blue-50 rounded-lg border-l-4 border-blue-500">
        <div class="flex items-center text-sm text-gray-500 mb-2">
            <i class="ri-calendar-line mr-1"></i>
            <span>{{ $featuredNewsItem->created_at->format('d/m/Y') }}</span>
        </div>
        <h3 class="text-lg font-bold mb-2">{{ $featuredNewsItem->name }}</h3>
        <p class="text-gray-700 mb-3 line-clamp-2">{{ $featuredNewsItem->description ?? Str::limit(strip_tags($featuredNewsItem->content), 150) }}</p>
        <a href="{{ route('news.show', ['slug' => $featuredNewsItem->slug, 'id' => $featuredNewsItem->id]) }}" class="inline-flex items-center text-primary font-medium hover:underline">
            Đọc tiếp
            <i class="ri-arrow-right-line ml-1"></i>
        </a>
    </div>
    @endif

    <!-- News List -->
    @if($schoolNews->count() > 0)
    <div class="space-y-4">
        @foreach($schoolNews as $news)
        <div class="flex gap-4 p-3 hover:bg-gray-50 rounded-lg transition-colors">
            <div class="w-24 h-16 bg-gray-100 rounded flex-shrink-0">
                <a href="{{ route('news.show', ['slug' => $news->slug, 'id' => $news->id]) }}">
                    <img src="{{ $news->featured_image_url }}" alt="{{ $news->name }}" class="w-full h-full object-cover rounded">
                </a>
            </div>
            <div class="flex-1">
                <div class="flex items-center text-xs text-gray-500 mb-1">
                    <i class="ri-calendar-line mr-1"></i>
                    <span>{{ $news->created_at->format('d/m/Y') }}</span>
                </div>
                <h4 class="font-medium text-sm mb-1 line-clamp-2">
                    <a href="{{ route('news.show', ['slug' => $news->slug, 'id' => $news->id]) }}" class="hover:text-primary">{{ $news->name }}</a>
                </h4>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    <div class="text-center mt-6">
        <a href="#" class="inline-flex items-center text-primary font-medium hover:underline">
            Xem tất cả tin tức
            <i class="ri-arrow-right-line ml-1"></i>
        </a>
    </div>
</div>
@endif

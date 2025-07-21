<!-- Widget 1: Tài liệu liên quan -->
<div class="bg-white rounded-lg shadow-sm border border-gray-100 mb-6">
    <div class="p-6">
        <h3 class="text-lg font-bold mb-4 flex items-center">
            <div class="w-6 h-6 rounded bg-primary/10 flex items-center justify-center text-primary mr-2">
                <i class="ri-file-text-line"></i>
            </div>
            Tài liệu liên quan
        </h3>
        
        <div class="space-y-4">
            @forelse($relatedDocuments as $related)
                <article class="flex gap-3">
                    <div class="w-20 h-16 bg-gray-100 rounded overflow-hidden flex-shrink-0">
                        <a href="{{ route('documents.show', ['slug' => $related->slug, 'id' => $related->id]) }}">
                            <img src="{{ $related->featured_image_url }}" alt="{{ $related->name }}" class="w-full h-full object-cover">
                        </a>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="font-medium text-sm line-clamp-2 mb-1">
                            <a href="{{ route('documents.show', ['slug' => $related->slug, 'id' => $related->id]) }}" class="hover:text-primary">{{ $related->name }}</a>
                        </h4>
                        <div class="text-xs text-gray-500 flex items-center gap-2">
                            <span>{{ number_format($related->download_count ?? 0) }} lượt tải</span>
                            <span>•</span>
                            <span class="difficulty-badge difficulty-{{ $related->difficulty_class }}">{{ $related->difficulty }}</span>
                        </div>
                    </div>
                </article>
            @empty
                <p class="text-sm text-gray-500">Không có tài liệu liên quan.</p>
            @endforelse
        </div>
    </div>
</div>

<!-- Widget 2: Đề thi được tải nhiều nhất -->
<div class="bg-white rounded-lg shadow-sm border border-gray-100 mb-6">
    <div class="p-6">
        <h3 class="text-lg font-bold mb-4 flex items-center">
            <div class="w-6 h-6 rounded bg-orange-100 flex items-center justify-center text-orange-600 mr-2">
                <i class="ri-fire-line"></i>
            </div>
            Tải nhiều nhất
        </h3>
        
        <div class="space-y-3">
            @forelse($mostDownloaded as $index => $item)
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full {{ ['bg-red-100 text-red-600', 'bg-orange-100 text-orange-600', 'bg-yellow-100 text-yellow-600', 'bg-gray-100 text-gray-600', 'bg-gray-100 text-gray-600'][$index] }} flex items-center justify-center font-bold text-sm">{{ $index + 1 }}</div>
                    <div class="flex-1">
                        <h4 class="font-medium text-sm line-clamp-1">
                            <a href="{{ route('documents.show', ['slug' => $item->slug, 'id' => $item->id]) }}" class="hover:text-primary">{{ $item->name }}</a>
                        </h4>
                        <div class="text-xs text-gray-500">{{ number_format($item->download_count) }} lượt tải</div>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500">Chưa có dữ liệu.</p>
            @endforelse
        </div>
    </div>
</div>

<!-- Widget 3: Danh mục tài liệu -->
<div class="bg-white rounded-lg shadow-sm border border-gray-100 mb-6">
    <div class="p-6">
        <h3 class="text-lg font-bold mb-4 flex items-center">
            <div class="w-6 h-6 rounded bg-green-100 flex items-center justify-center text-green-600 mr-2">
                <i class="ri-folder-line"></i>
            </div>
            Danh mục tài liệu
        </h3>
        
        <ul class="space-y-2">
            @forelse($documentCategories as $category)
                <li>
                    <a href="{{ route('documents.by-type', $category->slug) }}" class="flex items-center justify-between py-2 px-3 rounded hover:bg-gray-50 transition-colors">
                        <span class="text-sm">{{ $category->name }}</span>
                        <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">{{ $category->documents_count }}</span>
                    </a>
                </li>
            @empty
                <li><p class="text-sm text-gray-500">Đang tải...</p></li>
            @endforelse
        </ul>
    </div>
</div>

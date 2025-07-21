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
            @if(count($relatedDocuments) > 0)
                @foreach($relatedDocuments as $related)
                    <article class="flex gap-3">
                        <div class="w-20 h-16 bg-gray-100 rounded overflow-hidden flex-shrink-0">
                            <img src="{{ asset($related->image) }}" alt="{{ $related->name }}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-medium text-sm line-clamp-2 mb-1">
                                <a href="{{ route('documents.show', ['slug' => $related->slug, 'id' => $related->id]) }}" class="hover:text-primary">{{ $related->name }}</a>
                            </h4>
                            <div class="text-xs text-gray-500 flex items-center gap-2">
                                <span>{{ number_format($related->download_count ?? 0) }} lượt tải</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            @else
                <p class="text-sm text-gray-500">Không có tài liệu liên quan.</p>
            @endif
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
            <!-- Placeholder -->
            <p class="text-sm text-gray-500">Chưa có dữ liệu.</p>
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
            <!-- Placeholder -->
            <li><a href="#" class="text-sm text-gray-600 hover:text-primary">Đang tải...</a></li>
        </ul>
    </div>
</div>

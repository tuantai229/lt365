<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        @if($teachers->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($teachers as $teacher)
<div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
    <a href="{{ route('teachers.show', [$teacher->slug, $teacher->id]) }}" class="block p-6 text-center">
        <div class="w-20 h-20 rounded-full mx-auto mb-4 overflow-hidden bg-gray-100">
            <img src="{{ get_image_url($teacher->featured_image_url) }}" alt="{{ $teacher->name }}" class="w-full h-full object-cover">
        </div>
        <div class="flex items-start justify-between mb-2">
            <h4 class="font-bold text-lg text-primary hover:text-primary/80 transition-colors flex-1">{{ $teacher->name }}</h4>
            <button class="text-gray-400 hover:text-red-500 transition-colors duration-200" data-favorite-btn data-teacher-id="{{ $teacher->id }}">
                <i class="ri-heart-line text-lg"></i>
            </button>
        </div>
    </a>
    <div class="px-6 pb-6 text-center">
        <div class="space-y-2 mb-4">
                                @if($teacher->subjects->count() > 0 && $teacher->levels->count() > 0)
                                    <p class="text-sm text-gray-600">
                                        <i class="ri-book-line mr-2 text-primary"></i>
                                        <span class="font-medium">{{ $teacher->subjects->first()->name }} - {{ $teacher->levels->first()->name }}</span>
                                    </p>
                                @endif
                                @if($teacher->experience > 0)
                                    <p class="text-sm text-gray-600">
                                        <i class="ri-time-line mr-2 text-primary"></i>
                                        <span>{{ $teacher->experience }} năm kinh nghiệm</span>
                                    </p>
                                @endif
                                @if($teacher->province)
                                    <p class="text-sm text-gray-600">
                                        <i class="ri-map-pin-line mr-2 text-primary"></i>
                                        <span>
                                            {{ $teacher->province->name }}
                                            @if($teacher->commune_id > 0 && $teacher->commune)
                                                ({{ $teacher->commune->name }})
                                            @endif
                                        </span>
                                    </p>
                                @endif
        </div>
        <a href="{{ route('teachers.show', [$teacher->slug, $teacher->id]) }}" 
           class="w-full inline-block py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors duration-200 text-sm font-medium">
            Xem chi tiết
        </a>
    </div>
</div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($teachers->hasPages())
                <div class="mt-8">
                    {{ $teachers->links('vendor.pagination.custom') }}
                </div>
            @endif
        @else
            <div class="text-center py-12">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-100 flex items-center justify-center">
                    <i class="ri-user-search-line text-2xl text-gray-400"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Không tìm thấy giáo viên</h3>
                <p class="text-gray-600 mb-4">Hãy thử điều chỉnh bộ lọc hoặc từ khóa tìm kiếm khác</p>
                <a href="{{ route('teachers.index') }}" class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors duration-200">
                    <i class="ri-refresh-line mr-2"></i>
                    Xem tất cả giáo viên
                </a>
            </div>
        @endif
    </div>
</section>

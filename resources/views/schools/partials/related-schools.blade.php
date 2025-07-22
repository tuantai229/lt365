<!-- Related Schools -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10">
            @if($school->level)
                Trường {{ $school->level->name }} khác 
                @if($school->province)
                    tại {{ $school->province->name }}
                @endif
            @else
                Trường học liên quan
            @endif
        </h2>
        
        @if($relatedSchools && $relatedSchools->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
                @foreach($relatedSchools->take(3) as $relatedSchool)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                        <div class="h-32 bg-gray-100">
                            <img src="{{ $relatedSchool->featured_image_url }}" alt="{{ $relatedSchool->name }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-4">
                            <div class="flex gap-2 mb-2">
                                @foreach($relatedSchool->schoolTypes as $type)
                                    <span class="px-2 py-1 {{ $type->slug == 'cong-lap' ? 'bg-blue-100 text-blue-800' : ($type->slug == 'tu-thuc' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800') }} text-xs rounded-full">
                                        {{ $type->name }}
                                    </span>
                                @endforeach
                                @if($relatedSchool->level)
                                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">{{ $relatedSchool->level->name }}</span>
                                @endif
                            </div>
                            <h3 class="font-bold mb-2">{{ $relatedSchool->name }}</h3>
                            <p class="text-sm text-gray-600 mb-3">{{ $relatedSchool->province->name ?? 'Chưa xác định' }}</p>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-500">Chỉ tiêu: {{ number_format($relatedSchool->admission_quota ?? 0) }}</span>
                                <a href="{{ route('schools.show', [$relatedSchool->slug ?? 'school', $relatedSchool->id]) }}" class="text-primary hover:underline">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('schools.index') }}" class="inline-flex items-center text-primary font-medium hover:underline">
                    Xem tất cả trường {{ $school->level->name ?? 'học' }}
                    <i class="ri-arrow-right-line ml-1"></i>
                </a>
            </div>
        @else
            <!-- Empty state for related schools -->
            <div class="text-center py-8">
                <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="ri-building-4-line text-2xl text-gray-400"></i>
                </div>
                <p class="text-gray-600 mb-4">Chưa có trường học liên quan</p>
                <a href="{{ route('schools.index') }}" class="inline-flex items-center text-primary font-medium hover:underline">
                    Khám phá tất cả trường học
                    <i class="ri-arrow-right-line ml-1"></i>
                </a>
            </div>
        @endif
    </div>
</section>

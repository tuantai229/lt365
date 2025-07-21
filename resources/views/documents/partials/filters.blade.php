@php
    $currentLevel = $level ?? null;
    $currentSubject = $subject ?? null;
    $currentType = $documentType ?? null;

    // Build the base URL for query string filters by preserving the current route and its parameters
    $queryStringBaseUrl = url()->current();
@endphp

<!-- Filter Section -->
<section class="py-8 bg-white border-b border-gray-200">
    <div class="container mx-auto px-4">
        <!-- Quick Filter Tags -->
        <div class="flex flex-wrap items-center gap-3 mb-6">
            <span class="text-sm font-medium text-gray-700">Lọc nhanh:</span>
            <a href="{{ $queryStringBaseUrl . '?' . http_build_query(request()->except('filter')) }}" class="filter-tag px-4 py-2 {{ !request('filter') ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700' }} text-sm rounded-full hover:bg-primary/90 transition-all duration-200">Tất cả</a>
            <a href="{{ $queryStringBaseUrl . '?' . http_build_query(array_merge(request()->query(), ['filter' => 'popular'])) }}" class="filter-tag px-4 py-2 {{ request('filter') == 'popular' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700' }} text-sm rounded-full hover:bg-gray-200 transition-all duration-200">Phổ biến</a>
            <a href="{{ $queryStringBaseUrl . '?' . http_build_query(array_merge(request()->query(), ['filter' => 'free'])) }}" class="filter-tag px-4 py-2 {{ request('filter') == 'free' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700' }} text-sm rounded-full hover:bg-gray-200 transition-all duration-200">Miễn phí</a>
            <a href="{{ $queryStringBaseUrl . '?' . http_build_query(array_merge(request()->query(), ['filter' => 'paid'])) }}" class="filter-tag px-4 py-2 {{ request('filter') == 'paid' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700' }} text-sm rounded-full hover:bg-gray-200 transition-all duration-200">Có phí</a>
        </div>

        <!-- Advanced Filters -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Cấp học -->
            <div class="relative">
                <select id="level-filter" class="w-full py-2 px-3 border border-gray-200 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                    <option value="">Tất cả cấp học</option>
                    @foreach($levels as $level_option)
                        <option value="{{ $level_option->slug }}" @if($currentLevel && $currentLevel->id == $level_option->id) selected @endif>{{ $level_option->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Môn học -->
            <div class="relative">
                <select id="subject-filter" class="w-full py-2 px-3 border border-gray-200 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                    <option value="">Tất cả môn học</option>
                    @foreach($subjects as $subject_option)
                        <option value="{{ $subject_option->slug }}" @if($currentSubject && $currentSubject->id == $subject_option->id) selected @endif>{{ $subject_option->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Loại tài liệu -->
            <div class="relative">
                <select id="type-filter" class="w-full py-2 px-3 border border-gray-200 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                    <option value="">Tất cả loại</option>
                    @foreach($documentTypes as $type_option)
                        <option value="{{ $type_option->slug }}" @if($currentType && $currentType->id == $type_option->id) selected @endif>{{ $type_option->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Sắp xếp -->
            <div class="relative">
                <select id="sort-filter" class="w-full py-2 px-3 border border-gray-200 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                    <option value="" @if(!request('sort')) selected @endif disabled>Sắp xếp</option>
                    <option value="newest" @if(request('sort') == 'newest') selected @endif>Mới nhất</option>
                    <option value="downloads" @if(request('sort') == 'downloads') selected @endif>Nhiều lượt tải</option>
                    <option value="name" @if(request('sort') == 'name') selected @endif>Tên A-Z</option>
                </select>
            </div>
        </div>

        <!-- Reset Button -->
        <div class="mt-4 flex justify-end">
            <a href="{{ route('documents.index') }}" class="text-sm text-gray-600 hover:text-primary font-medium transition-colors duration-200">
                <i class="ri-delete-bin-line mr-1"></i>
                Xóa lọc tìm
            </a>
        </div>
    </div>
</section>

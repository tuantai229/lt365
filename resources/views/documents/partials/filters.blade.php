@php
    $currentLevel = $level ?? null;
    $currentSubject = $subject ?? null;
    $currentType = $documentType ?? null;
    $currentSort = request('sort');
    $currentFilter = request('filter');

    // Build the base URL for query string filters by preserving the current route and its parameters
    $queryStringBaseUrl = url()->current();
    
    // Function to generate query string for quick filters
    function get_query_string($param, $value) {
        $query = request()->query();
        if ($value === null) {
            unset($query[$param]);
        } else {
            $query[$param] = $value;
        }
        return http_build_query($query);
    }
@endphp

<!-- Filter Section -->
<section class="py-8 bg-white border-b border-gray-200">
    <div class="container mx-auto px-4">
        <!-- Quick Filters & Sorting -->
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            <!-- Quick Filter Tags -->
            <div class="flex flex-wrap items-center gap-3">
                <span class="text-sm font-medium text-gray-700">Lọc nhanh:</span>
                <a href="{{ $queryStringBaseUrl . '?' . get_query_string('filter', null) }}" class="filter-tag px-4 py-2 {{ !$currentFilter ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700' }} text-sm rounded-full hover:bg-primary/90 transition-all duration-200">Tất cả</a>
                <a href="{{ $queryStringBaseUrl . '?' . get_query_string('filter', 'popular') }}" class="filter-tag px-4 py-2 {{ $currentFilter == 'popular' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700' }} text-sm rounded-full hover:bg-gray-200 transition-all duration-200">Phổ biến</a>
                <a href="{{ $queryStringBaseUrl . '?' . get_query_string('filter', 'free') }}" class="filter-tag px-4 py-2 {{ $currentFilter == 'free' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700' }} text-sm rounded-full hover:bg-gray-200 transition-all duration-200">Miễn phí</a>
                <a href="{{ $queryStringBaseUrl . '?' . get_query_string('filter', 'paid') }}" class="filter-tag px-4 py-2 {{ $currentFilter == 'paid' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700' }} text-sm rounded-full hover:bg-gray-200 transition-all duration-200">Có phí</a>
            </div>

            <!-- Sắp xếp -->
            <div class="relative">
                <select id="sort-filter" class="appearance-none bg-white border border-gray-300 rounded-button px-4 py-3 pr-10 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                    <option value="" @if(!$currentSort) selected @endif>Sắp xếp mặc định</option>
                    <option value="newest" @if($currentSort == 'newest') selected @endif>Mới nhất</option>
                    <option value="downloads" @if($currentSort == 'downloads') selected @endif>Nhiều lượt tải</option>
                    <option value="name" @if($currentSort == 'name') selected @endif>Tên A-Z</option>
                </select>
                <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                    <i class="ri-arrow-down-s-line text-gray-400"></i>
                </div>
            </div>
        </div>

        <!-- Advanced Filters Form -->
        <form id="document-filter-form" method="GET">
            <div class="flex flex-col lg:flex-row gap-4">
                <!-- Cấp học -->
                <div class="relative flex-1">
                    <select id="level-filter" name="level" class="w-full appearance-none bg-white border border-gray-300 rounded-button px-4 py-3 pr-10 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                        <option value="">Tất cả cấp học</option>
                        @foreach($levels as $level_option)
                            <option value="{{ $level_option->slug }}" @if($currentLevel && $currentLevel->id == $level_option->id) selected @endif>{{ $level_option->name }}</option>
                        @endforeach
                    </select>
                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                        <i class="ri-arrow-down-s-line text-gray-400"></i>
                    </div>
                </div>

                <!-- Môn học -->
                <div class="relative flex-1">
                    <select id="subject-filter" name="subject" class="w-full appearance-none bg-white border border-gray-300 rounded-button px-4 py-3 pr-10 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                        <option value="">Tất cả môn học</option>
                        @foreach($subjects as $subject_option)
                            <option value="{{ $subject_option->slug }}" @if($currentSubject && $currentSubject->id == $subject_option->id) selected @endif>{{ $subject_option->name }}</option>
                        @endforeach
                    </select>
                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                        <i class="ri-arrow-down-s-line text-gray-400"></i>
                    </div>
                </div>

                <!-- Loại tài liệu -->
                <div class="relative flex-1">
                    <select id="type-filter" name="type" class="w-full appearance-none bg-white border border-gray-300 rounded-button px-4 py-3 pr-10 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                        <option value="">Tất cả loại</option>
                        @foreach($documentTypes as $type_option)
                            <option value="{{ $type_option->slug }}" @if($currentType && $currentType->id == $type_option->id) selected @endif>{{ $type_option->name }}</option>
                        @endforeach
                    </select>
                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                        <i class="ri-arrow-down-s-line text-gray-400"></i>
                    </div>
                </div>
                
                <!-- Search Button -->
                <button type="submit" class="search-btn px-6 py-3 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors duration-200 flex items-center justify-center gap-2 font-medium">
                    <i class="ri-search-line"></i>
                    <span>Tìm tài liệu</span>
                </button>
            </div>
        </form>

        <!-- Active Filters Display & Reset -->
        @if($currentLevel || $currentSubject || $currentType)
            <div class="mt-4 flex flex-wrap items-center gap-2">
                <span class="text-sm text-gray-600">Bộ lọc hiện tại:</span>
                
                @if($currentType)
                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                        {{ $currentType->name }}
                    </span>
                @endif
                
                @if($currentLevel)
                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                        {{ $currentLevel->name }}
                    </span>
                @endif

                @if($currentSubject)
                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm">
                        {{ $currentSubject->name }}
                    </span>
                @endif
                
                <a href="{{ route('documents.index') }}" class="inline-flex items-center gap-1 px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm hover:bg-red-200">
                    <i class="ri-refresh-line text-xs"></i>
                    Xóa tất cả
                </a>
            </div>
        @endif
    </div>
</section>

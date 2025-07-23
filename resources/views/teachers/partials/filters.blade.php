<!-- Filter & Search Section -->
<section class="py-8 bg-white border-b border-gray-200">
    <div class="container mx-auto px-4">
        <form id="teacher-filter-form" method="GET">
            <div class="flex flex-col lg:flex-row gap-6">
                <!-- Search Bar -->
                <div class="flex-1">
                    <div class="relative">
                        <input 
                            type="search" 
                            name="search"
                            placeholder="Tìm kiếm theo tên giáo viên..." 
                            value="{{ request('search') }}"
                            class="w-full py-3 pl-12 pr-4 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
                        >
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 flex items-center justify-center text-gray-400">
                            <i class="ri-search-line"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Filters -->
                <div class="flex flex-wrap gap-3">
                    <!-- Province Filter -->
                    <div class="relative">
                        <select 
                            id="province-filter" 
                            name="province"
                            class="appearance-none bg-white border border-gray-300 rounded-button px-4 py-3 pr-10 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
                        >
                            <option value="">Tỉnh/Thành phố</option>
                            @foreach($provinces as $provinceOption)
                                <option 
                                    value="{{ $provinceOption->slug }}"
                                    {{ (isset($province) && $province && $province->id == $provinceOption->id) ? 'selected' : '' }}
                                >
                                    {{ $provinceOption->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                            <i class="ri-arrow-down-s-line text-gray-400"></i>
                        </div>
                    </div>

                    <!-- Level Filter -->
                    <div class="relative">
                        <select 
                            id="level-filter" 
                            name="level"
                            class="appearance-none bg-white border border-gray-300 rounded-button px-4 py-3 pr-10 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
                        >
                            <option value="">Tất cả cấp học</option>
                            @foreach($levels as $levelOption)
                                <option 
                                    value="{{ $levelOption->slug }}"
                                    {{ (isset($level) && $level && $level->id == $levelOption->id) ? 'selected' : '' }}
                                >
                                    {{ $levelOption->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                            <i class="ri-arrow-down-s-line text-gray-400"></i>
                        </div>
                    </div>
                    
                    <!-- Subject Filter -->
                    <div class="relative">
                        <select 
                            id="subject-filter" 
                            name="subject"
                            class="appearance-none bg-white border border-gray-300 rounded-button px-4 py-3 pr-10 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
                        >
                            <option value="">Tất cả môn học</option>
                            @foreach($subjects as $subjectOption)
                                <option 
                                    value="{{ $subjectOption->slug }}"
                                    {{ (isset($subject) && $subject && $subject->id == $subjectOption->id) ? 'selected' : '' }}
                                >
                                    {{ $subjectOption->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                            <i class="ri-arrow-down-s-line text-gray-400"></i>
                        </div>
                    </div>
                    
                    <!-- Search Button -->
                    <button type="submit" class="search-btn px-6 py-3 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors duration-200 flex items-center gap-2 font-medium">
                        <i class="ri-search-line"></i>
                        <span>Tìm giáo viên</span>
                    </button>
                </div>
            </div>
        </form>

        <!-- Active Filters Display -->
        @if(isset($level) || isset($province) || isset($subject) || request('search'))
            <div class="mt-4 flex flex-wrap gap-2">
                <span class="text-sm text-gray-600">Bộ lọc hiện tại:</span>
                
                @if(request('search'))
                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-primary/10 text-primary rounded-full text-sm">
                        <i class="ri-search-line text-xs"></i>
                        "{{ request('search') }}"
                        <a href="{{ request()->url() }}" class="ml-1 hover:text-primary/80">
                            <i class="ri-close-line text-xs"></i>
                        </a>
                    </span>
                @endif
                
                @if(isset($province) && $province)
                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                        <i class="ri-map-pin-line text-xs"></i>
                        {{ $province->name }}
                        <a href="{{ route('teachers.index') }}" class="ml-1 hover:text-green-600">
                            <i class="ri-close-line text-xs"></i>
                        </a>
                    </span>
                @endif

                @if(isset($level) && $level)
                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                        <i class="ri-graduation-cap-line text-xs"></i>
                        {{ $level->name }}
                        <a href="{{ route('teachers.index') }}" class="ml-1 hover:text-blue-600">
                            <i class="ri-close-line text-xs"></i>
                        </a>
                    </span>
                @endif
                
                @if(isset($subject) && $subject)
                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm">
                        <i class="ri-book-line text-xs"></i>
                        {{ $subject->name }}
                        <a href="{{ route('teachers.index') }}" class="ml-1 hover:text-purple-600">
                            <i class="ri-close-line text-xs"></i>
                        </a>
                    </span>
                @endif
                
                <a href="{{ route('teachers.index') }}" class="inline-flex items-center gap-1 px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm hover:bg-red-200">
                    <i class="ri-refresh-line text-xs"></i>
                    Xóa tất cả
                </a>
            </div>
        @endif
    </div>
</section>

<section class="py-8 bg-white border-b">
    <div class="container mx-auto px-4">
        <div class="bg-gray-50 rounded-lg p-6">
            <h3 class="text-lg font-bold mb-4">Tìm kiếm nâng cao</h3>
            
            <form id="teacher-filter-form" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                    <!-- Tỉnh/Thành phố -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tỉnh/Thành phố</label>
                        <select id="province-filter" name="province" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                            <option value="">Tất cả tỉnh/thành</option>
                            @foreach($provinces as $provinceOption)
                                <option value="{{ $provinceOption->slug }}" {{ (isset($province) && $province && $province->id == $provinceOption->id) ? 'selected' : '' }}>
                                    {{ $provinceOption->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Cấp học -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cấp học</label>
                        <select id="level-filter" name="level" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                            <option value="">Tất cả cấp học</option>
                            @foreach($levels as $levelOption)
                                <option value="{{ $levelOption->slug }}" {{ (isset($level) && $level && $level->id == $levelOption->id) ? 'selected' : '' }}>
                                    {{ $levelOption->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Môn học -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Môn học</label>
                        <select id="subject-filter" name="subject" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                            <option value="">Tất cả môn học</option>
                            @foreach($subjects as $subjectOption)
                                <option value="{{ $subjectOption->slug }}" {{ (isset($subject) && $subject && $subject->id == $subjectOption->id) ? 'selected' : '' }}>
                                    {{ $subjectOption->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Tìm kiếm -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tìm kiếm</label>
                        <input type="text" name="search" placeholder="Tên giáo viên..." value="{{ request('search') }}" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                    </div>
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors duration-200">
                            <i class="ri-search-line mr-2"></i>Tìm kiếm
                        </button>
                        <a href="{{ route('teachers.index') }}" class="px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                            <i class="ri-refresh-line mr-2"></i>Đặt lại
                        </a>
                    </div>
                    
                    <!-- Results count -->
                    <div class="text-sm text-gray-600">
                        Tìm thấy <span class="font-medium text-primary">{{ $teachers->total() }}</span> giáo viên
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

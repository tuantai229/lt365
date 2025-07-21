<!-- Filter Section -->
<section class="py-8 bg-white border-b border-gray-200">
    <div class="container mx-auto px-4">
        <!-- Quick Filter Tags -->
        <div class="flex flex-wrap items-center gap-3 mb-6">
            <span class="text-sm font-medium text-gray-700">Lọc nhanh:</span>
            <button class="filter-tag px-4 py-2 bg-primary text-white text-sm rounded-full hover:bg-primary/90 transition-all duration-200">Tất cả</button>
            <button class="filter-tag px-4 py-2 bg-gray-100 text-gray-700 text-sm rounded-full hover:bg-gray-200 transition-all duration-200">Miễn phí</button>
            <button class="filter-tag px-4 py-2 bg-gray-100 text-gray-700 text-sm rounded-full hover:bg-gray-200 transition-all duration-200">Mới nhất</button>
            <button class="filter-tag px-4 py-2 bg-gray-100 text-gray-700 text-sm rounded-full hover:bg-gray-200 transition-all duration-200">Phổ biến</button>
        </div>

        <!-- Advanced Filters -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Cấp học -->
            <div class="relative">
                <select class="w-full py-2 px-3 border border-gray-200 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                    <option value="">Tất cả cấp học</option>
                    @foreach($levels as $level)
                        <option value="{{ $level->slug }}">{{ $level->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Môn học -->
            <div class="relative">
                <select class="w-full py-2 px-3 border border-gray-200 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                    <option value="">Tất cả môn học</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->slug }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Loại tài liệu -->
            <div class="relative">
                <select class="w-full py-2 px-3 border border-gray-200 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                    <option value="">Tất cả loại</option>
                    @foreach($documentTypes as $type)
                        <option value="{{ $type->slug }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Sắp xếp -->
            <div class="relative">
                <select class="w-full py-2 px-3 border border-gray-200 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                    <option value="newest">Mới nhất</option>
                    <option value="popular">Phổ biến nhất</option>
                    <option value="download">Nhiều lượt tải</option>
                    <option value="name">Tên A-Z</option>
                </select>
            </div>
        </div>
    </div>
</section>

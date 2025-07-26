<!-- Tìm kiếm thông minh -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10">Tìm kiếm thông minh</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Tìm trường -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-bold mb-4 flex items-center">
                    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary mr-2">
                        <i class="ri-building-4-line"></i>
                    </div>
                    Tìm trường
                </h3>
                <form id="smart-search-school-form" class="space-y-4">
                    <div>
                        <label for="ss-school-level" class="block text-sm font-medium text-gray-700 mb-1">Cấp học</label>
                        <div class="relative">
                            <select id="ss-school-level" class="w-full p-3 border border-gray-200 rounded-button appearance-none focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary pr-8">
                                <option value="">Chọn cấp học</option>
                                @foreach($schoolLevels as $level)
                                    <option value="{{ $level->slug }}">{{ $level->name }}</option>
                                @endforeach
                            </select>
                            <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                <i class="ri-arrow-down-s-line text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="ss-school-province" class="block text-sm font-medium text-gray-700 mb-1">Tỉnh/Thành phố</label>
                        <div class="relative">
                            <select id="ss-school-province" class="w-full p-3 border border-gray-200 rounded-button appearance-none focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary pr-8">
                                <option value="">Chọn tỉnh/thành phố</option>
                                @foreach($provinces as $province)
                                    <option value="{{ $province->slug }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                            <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                <i class="ri-arrow-down-s-line text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="ss-school-type" class="block text-sm font-medium text-gray-700 mb-1">Loại trường</label>
                        <div class="relative">
                            <select id="ss-school-type" class="w-full p-3 border border-gray-200 rounded-button appearance-none focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary pr-8">
                                <option value="">Loại trường</option>
                                @foreach($schoolTypes as $type)
                                    <option value="{{ $type->slug }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                <i class="ri-arrow-down-s-line text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="w-full py-3 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors duration-200 font-medium whitespace-nowrap !rounded-button">Tìm kiếm trường</button>
                </form>
            </div>
            
            <!-- Tìm tài liệu -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-bold mb-4 flex items-center">
                    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary mr-2">
                        <i class="ri-file-list-3-line"></i>
                    </div>
                    Tìm tài liệu
                </h3>
                <form id="smart-search-document-form" class="space-y-4">
                    <div>
                        <label for="ss-doc-level" class="block text-sm font-medium text-gray-700 mb-1">Khối lớp</label>
                        <div class="relative">
                            <select id="ss-doc-level" class="w-full p-3 border border-gray-200 rounded-button appearance-none focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary pr-8">
                                <option value="">Chọn khối lớp</option>
                                @foreach($documentLevels as $level)
                                    <option value="{{ $level->slug }}">{{ $level->name }}</option>
                                @endforeach
                            </select>
                            <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                <i class="ri-arrow-down-s-line text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="ss-doc-subject" class="block text-sm font-medium text-gray-700 mb-1">Môn học</label>
                        <div class="relative">
                            <select id="ss-doc-subject" class="w-full p-3 border border-gray-200 rounded-button appearance-none focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary pr-8">
                                <option value="">Chọn môn học</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->slug }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                            <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                <i class="ri-arrow-down-s-line text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="ss-doc-type" class="block text-sm font-medium text-gray-700 mb-1">Loại tài liệu</label>
                        <div class="relative">
                            <select id="ss-doc-type" class="w-full p-3 border border-gray-200 rounded-button appearance-none focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary pr-8">
                                <option value="">Tất cả loại</option>
                                @foreach($documentTypes as $type)
                                    <option value="{{ $type->slug }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                <i class="ri-arrow-down-s-line text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="w-full py-3 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors duration-200 font-medium whitespace-nowrap !rounded-button">Tìm kiếm tài liệu</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Tin tức & Lịch thi -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10">Tin tức & Lịch thi</h2>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Tin tức -->
            <div class="lg:col-span-2">
                <h3 class="text-xl font-bold mb-6 flex items-center">
                    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary mr-2">
                        <i class="ri-newspaper-line"></i>
                    </div>
                    Tin tuyển sinh mới nhất
                </h3>
                
                @if(!empty($selectedNews) && count($selectedNews) > 0)
                    <!-- Tin nổi bật -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                        <div class="flex flex-col md:flex-row">
                            <div class="md:w-2/5">
                                <img src="{{ asset($selectedNews[0]->featured_image_url ?? 'html/images/default-news.jpg') }}" alt="{{ $selectedNews[0]->name ?? '' }}" class="w-full h-full object-cover object-top">
                            </div>
                            <div class="md:w-3/5 p-6">
                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                    <span class="flex items-center">
                                        <i class="ri-calendar-line mr-1"></i>
                                        {{ $selectedNews[0]->created_at->format('d/m/Y') }}
                                    </span>
                                    <span class="mx-2">•</span>
                                    <span class="flex items-center">
                                        <i class="ri-eye-line mr-1"></i>
                                        {{ $selectedNews[0]->view_count ?? 0 }} lượt xem
                                    </span>
                                </div>
                                <h4 class="text-lg font-bold mb-2">{{ $selectedNews[0]->name ?? '' }}</h4>
                                <p class="text-gray-600 mb-4">{{ Str::limit(strip_tags($selectedNews[0]->content ?? ''), 150) }}</p>
                                <a href="{{ route('news.show', ['slug' => $selectedNews[0]->slug, 'id' => $selectedNews[0]->id]) }}" class="inline-flex items-center text-primary font-medium hover:underline">
                                    Đọc tiếp
                                    <i class="ri-arrow-right-line ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tin khác -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($selectedNews->slice(1) as $news)
                            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                                <div class="p-4">
                                    <div class="flex items-center text-sm text-gray-500 mb-2">
                                        <span>{{ $news->created_at->format('d/m/Y') }}</span>
                                        <span class="mx-2">•</span>
                                        <span>{{ $news->categories->first()->name ?? 'Tuyển sinh' }}</span>
                                    </div>
                                    <h4 class="font-medium mb-2 line-clamp-2">{{ $news->name ?? '' }}</h4>
                                    <a href="{{ route('news.show', ['slug' => $news->slug, 'id' => $news->id]) }}" class="inline-flex items-center text-primary text-sm hover:underline">
                                        Đọc tiếp
                                        <i class="ri-arrow-right-line ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            
            <!-- Lịch thi -->
            <div>
                <h3 class="text-xl font-bold mb-6 flex items-center">
                    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary mr-2">
                        <i class="ri-calendar-event-line"></i>
                    </div>
                    Lịch thi sắp diễn ra
                </h3>
                
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-4 bg-primary text-white">
                        <div class="flex justify-between items-center">
                            <h4 class="font-bold">Tháng 7, 2025</h4>
                            <div class="flex gap-2">
                                <button class="w-8 h-8 rounded-full hover:bg-white/20 flex items-center justify-center">
                                    <i class="ri-arrow-left-s-line"></i>
                                </button>
                                <button class="w-8 h-8 rounded-full hover:bg-white/20 flex items-center justify-center">
                                    <i class="ri-arrow-right-s-line"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4 border-b">
                        <div class="flex items-center">
                            <div class="w-14 h-14 rounded-lg bg-red-100 text-red-600 flex flex-col items-center justify-center">
                                <span class="text-sm font-medium">T7</span>
                                <span class="text-lg font-bold">05</span>
                            </div>
                            <div class="ml-4">
                                <h5 class="font-medium">Thi tuyển sinh lớp 10 chuyên</h5>
                                <p class="text-sm text-gray-500">THPT Chuyên Hà Nội - Amsterdam</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4 border-b">
                        <div class="flex items-center">
                            <div class="w-14 h-14 rounded-lg bg-blue-100 text-blue-600 flex flex-col items-center justify-center">
                                <span class="text-sm font-medium">CN</span>
                                <span class="text-lg font-bold">06</span>
                            </div>
                            <div class="ml-4">
                                <h5 class="font-medium">Thi tuyển sinh lớp 10 chuyên</h5>
                                <p class="text-sm text-gray-500">THPT Chuyên Nguyễn Huệ</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4 border-b">
                        <div class="flex items-center">
                            <div class="w-14 h-14 rounded-lg bg-gray-100 text-gray-600 flex flex-col items-center justify-center">
                                <span class="text-sm font-medium">T2</span>
                                <span class="text-lg font-bold">14</span>
                            </div>
                            <div class="ml-4">
                                <h5 class="font-medium">Thi tuyển sinh lớp 6</h5>
                                <p class="text-sm text-gray-500">THCS Cầu Giấy</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4 border-b">
                        <div class="flex items-center">
                            <div class="w-14 h-14 rounded-lg bg-gray-100 text-gray-600 flex flex-col items-center justify-center">
                                <span class="text-sm font-medium">T7</span>
                                <span class="text-lg font-bold">19</span>
                            </div>
                            <div class="ml-4">
                                <h5 class="font-medium">Thi tuyển sinh lớp 1</h5>
                                <p class="text-sm text-gray-500">Tiểu học Thăng Long</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="w-14 h-14 rounded-lg bg-gray-100 text-gray-600 flex flex-col items-center justify-center">
                                <span class="text-sm font-medium">CN</span>
                                <span class="text-lg font-bold">20</span>
                            </div>
                            <div class="ml-4">
                                <h5 class="font-medium">Thi tuyển sinh lớp 1</h5>
                                <p class="text-sm text-gray-500">Tiểu học Nguyễn Siêu</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

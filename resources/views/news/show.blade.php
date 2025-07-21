@extends('layouts.app')

@section('title', $news->title)

@section('content')
<!-- Breadcrumb -->
<div class="bg-gray-100 py-3">
    <div class="container mx-auto px-4">
        <div class="flex items-center text-sm text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-primary">Trang chủ</a>
            <span class="mx-2">
                <i class="ri-arrow-right-s-line"></i>
            </span>
            <a href="{{ route('news.index') }}" class="hover:text-primary">Tin tức</a>
            <span class="mx-2">
                <i class="ri-arrow-right-s-line"></i>
            </span>
            <span class="text-primary font-medium">{{ $news->title }}</span>
        </div>
    </div>
</div>

<!-- Main Content -->
<section class="py-8 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Main Article Content (8 columns) -->
            <article class="lg:col-span-8">
                <!-- Article Header -->
                <header class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $news->title }}</h1>
                    
                    <!-- Meta Information -->
                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-6">
                        <div class="flex items-center gap-2">
                            <i class="ri-calendar-line text-primary"></i>
                            <span>{{ $news->created_at->format('d/m/Y') }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="bg-primary text-white px-2 py-1 rounded text-xs font-medium">Tuyển sinh</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="ri-eye-line text-primary"></i>
                            <span>{{ $news->views ?? 0 }} lượt xem</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="ri-time-line text-primary"></i>
                            <span>5 phút đọc</span>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    <div class="mb-8">
                        <img src="{{ $news->image_url ?? '/images/0668b9e8706c79925cfba198a4a0ff35.jpg' }}" alt="{{ $news->title }}" class="w-full h-80 object-cover rounded-lg shadow-md">
                        <p class="text-sm text-gray-500 mt-2 italic">{{ $news->image_caption }}</p>
                    </div>
                </header>
                <!-- Article Content -->
                <div class="article-content prose max-w-none">
                    {!! $news->content !!}
                </div>

                <!-- Article Footer -->
                <footer class="mt-8 pt-6 border-t border-gray-200">
                    <!-- Tags -->
                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-700 mb-3">Từ khóa:</h4>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 bg-primary/10 text-primary rounded-full text-sm">Tuyển sinh 2025</span>
                            <span class="px-3 py-1 bg-primary/10 text-primary rounded-full text-sm">Bộ GD&ĐT</span>
                            <span class="px-3 py-1 bg-primary/10 text-primary rounded-full text-sm">Thi vào lớp 10</span>
                            <span class="px-3 py-1 bg-primary/10 text-primary rounded-full text-sm">Kế hoạch tuyển sinh</span>
                            <span class="px-3 py-1 bg-primary/10 text-primary rounded-full text-sm">Lịch thi</span>
                        </div>
                    </div>

                    <!-- Share Buttons -->
                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-700 mb-3">Chia sẻ bài viết:</h4>
                        <div class="flex gap-3">
                            <button class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-button hover:bg-blue-700 transition-colors">
                                <i class="ri-facebook-fill"></i>
                                <span>Facebook</span>
                            </button>
                            <button class="flex items-center gap-2 px-4 py-2 bg-blue-500 text-white rounded-button hover:bg-blue-600 transition-colors">
                                <i class="ri-message-line"></i>
                                <span>Zalo</span>
                            </button>
                            <button class="flex items-center gap-2 px-4 py-2 bg-gray-600 text-white rounded-button hover:bg-gray-700 transition-colors">
                                <i class="ri-link"></i>
                                <span>Copy link</span>
                            </button>
                            <button class="flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-button hover:bg-green-700 transition-colors">
                                <i class="ri-printer-line"></i>
                                <span>In bài viết</span>
                            </button>
                        </div>
                    </div>
                </footer>
            </article>
            <!-- Sidebar (4 columns) -->
            <aside class="lg:col-span-4">
                <!-- Widget 1: Tin liên quan -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-bold mb-4 flex items-center">
                            <div class="w-6 h-6 rounded bg-primary/10 flex items-center justify-center text-primary mr-2">
                                <i class="ri-article-line"></i>
                            </div>
                            Tin tức liên quan
                        </h3>
                        
                        <div class="space-y-4">
                            <article class="flex gap-3">
                                <div class="w-20 h-16 bg-gray-100 rounded overflow-hidden flex-shrink-0">
                                    <img src="/images/dc78c9c0887200a40954cba8e72a3499.jpg" alt="Tin liên quan" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-medium text-sm line-clamp-2 mb-1">
                                        <a href="#" class="hover:text-primary">Hà Nội công bố chỉ tiêu tuyển sinh lớp 10 các trường THPT công lập</a>
                                    </h4>
                                    <div class="text-xs text-gray-500 flex items-center gap-2">
                                        <span>27/06/2025</span>
                                        <span>•</span>
                                        <span>2,156 lượt xem</span>
                                    </div>
                                </div>
                            </article>

                            <article class="flex gap-3">
                                <div class="w-20 h-16 bg-gray-100 rounded overflow-hidden flex-shrink-0">
                                    <img src="/images/bb4d0c34d4f0b44aedef392759b46b9d.jpg" alt="Tin liên quan" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-medium text-sm line-clamp-2 mb-1">
                                        <a href="#" class="hover:text-primary">TP.HCM điều chỉnh cấu trúc đề thi tuyển sinh lớp 10 năm 2025</a>
                                    </h4>
                                    <div class="text-xs text-gray-500 flex items-center gap-2">
                                        <span>26/06/2025</span>
                                        <span>•</span>
                                        <span>1,834 lượt xem</span>
                                    </div>
                                </div>
                            </article>

                            <article class="flex gap-3">
                                <div class="w-20 h-16 bg-gray-100 rounded overflow-hidden flex-shrink-0">
                                    <img src="/images/2ea343b800b7ca44c1844291afa997e9.jpg" alt="Tin liên quan" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-medium text-sm line-clamp-2 mb-1">
                                        <a href="#" class="hover:text-primary">Lịch thi tuyển sinh vào các trường chuyên toàn quốc 2025</a>
                                    </h4>
                                    <div class="text-xs text-gray-500 flex items-center gap-2">
                                        <span>25/06/2025</span>
                                        <span>•</span>
                                        <span>3,421 lượt xem</span>
                                    </div>
                                </div>
                            </article>

                            <article class="flex gap-3">
                                <div class="w-20 h-16 bg-gray-100 rounded overflow-hidden flex-shrink-0">
                                    <img src="/images/0668b9e8706c79925cfba198a4a0ff35.jpg" alt="Tin liên quan" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-medium text-sm line-clamp-2 mb-1">
                                        <a href="#" class="hover:text-primary">Điểm chuẩn các trường THPT Hà Nội dự báo tăng nhẹ năm 2025</a>
                                    </h4>
                                    <div class="text-xs text-gray-500 flex items-center gap-2">
                                        <span>24/06/2025</span>
                                        <span>•</span>
                                        <span>2,987 lượt xem</span>
                                    </div>
                                </div>
                            </article>
                        </div>

                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <a href="#" class="text-primary text-sm font-medium hover:underline">Xem tất cả tin tuyển sinh →</a>
                        </div>
                    </div>
                </div>

                <!-- Widget 2: Tin nổi bật -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-bold mb-4 flex items-center">
                            <div class="w-6 h-6 rounded bg-red-100 flex items-center justify-center text-red-600 mr-2">
                                <i class="ri-fire-line"></i>
                            </div>
                            Tin nổi bật
                        </h3>
                        
                        <div class="space-y-4">
                            <article>
                                <div class="mb-2">
                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs font-medium">HOT</span>
                                </div>
                                <h4 class="font-medium text-sm mb-2 line-clamp-2">
                                    <a href="#" class="hover:text-primary">Học sinh Việt Nam đạt thành tích cao trong kỳ thi Toán quốc tế IMO 2025</a>
                                </h4>
                                <div class="text-xs text-gray-500 flex items-center gap-2">
                                    <span>23/06/2025</span>
                                    <span>•</span>
                                    <span class="text-red-600 font-medium">15,432 lượt xem</span>
                                </div>
                            </article>

                            <article>
                                <div class="mb-2">
                                    <span class="bg-orange-100 text-orange-800 px-2 py-1 rounded text-xs font-medium">TRENDING</span>
                                </div>
                                <h4 class="font-medium text-sm mb-2 line-clamp-2">
                                    <a href="#" class="hover:text-primary">Top 10 trường THPT có điểm chuẩn cao nhất Hà Nội 2024</a>
                                </h4>
                                <div class="text-xs text-gray-500 flex items-center gap-2">
                                    <span>22/06/2025</span>
                                    <span>•</span>
                                    <span class="text-orange-600 font-medium">8,765 lượt xem</span>
                                </div>
                            </article>

                            <article>
                                <h4 class="font-medium text-sm mb-2 line-clamp-2">
                                    <a href="#" class="hover:text-primary">Kinh nghiệm ôn thi vào lớp 10 từ học sinh đạt điểm cao</a>
                                </h4>
                                <div class="text-xs text-gray-500 flex items-center gap-2">
                                    <span>21/06/2025</span>
                                    <span>•</span>
                                    <span>5,234 lượt xem</span>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>

                <!-- Widget 3: Danh mục tin tức -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-bold mb-4 flex items-center">
                            <div class="w-6 h-6 rounded bg-green-100 flex items-center justify-center text-green-600 mr-2">
                                <i class="ri-folder-line"></i>
                            </div>
                            Danh mục tin tức
                        </h3>
                        
                        <ul class="space-y-2">
                            <li>
                                <a href="#" class="flex items-center justify-between py-2 px-3 rounded hover:bg-gray-50 transition-colors">
                                    <span class="text-sm">Thông tin tuyển sinh</span>
                                    <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">127</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center justify-between py-2 px-3 rounded hover:bg-gray-50 transition-colors">
                                    <span class="text-sm">Tư vấn chọn trường</span>
                                    <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">89</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center justify-between py-2 px-3 rounded hover:bg-gray-50 transition-colors">
                                    <span class="text-sm">Kinh nghiệm thi cử</span>
                                    <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">156</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center justify-between py-2 px-3 rounded hover:bg-gray-50 transition-colors">
                                    <span class="text-sm">Thành tích học sinh</span>
                                    <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">43</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center justify-between py-2 px-3 rounded hover:bg-gray-50 transition-colors">
                                    <span class="text-sm">Chính sách giáo dục</span>
                                    <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">67</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection

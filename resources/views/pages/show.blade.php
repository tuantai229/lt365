@extends('layouts.app')

@section('title', $page->name)

@section('content')
    <!-- Breadcrumb -->
    <div class="bg-gray-100 py-3">
        <div class="container mx-auto px-4">
            <div class="flex items-center text-sm text-gray-600">
                <a href="{{ route('home') }}" class="hover:text-primary">Trang chủ</a>
                <span class="mx-2">
                    <i class="ri-arrow-right-s-line"></i>
                </span>
                <span class="text-primary font-medium">{{ $page->name }}</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <section class="py-8 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Main Content (8 columns) -->
                <article class="lg:col-span-8">
                    <!-- Page Header -->
                    <header class="mb-8">
                        <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $page->name }}</h1>
                        
                        <!-- Meta Information -->
                        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-6">
                            <div class="flex items-center">
                                <i class="ri-calendar-line mr-1"></i>
                                <span>Cập nhật: {{ $page->updated_at->format('d/m/Y') }}</span>
                            </div>
                        </div>
                    </header>

                    <!-- Content Body -->
                    <div class="prose prose-lg max-w-none">
                        {!! $page->content !!}
                    </div>

                </article>
                <!-- Sidebar (4 columns) -->
                <aside class="lg:col-span-4">
                    <!-- Widget 1: Liên kết nhanh -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 mb-6">
                        <div class="p-6">
                            <h3 class="text-lg font-bold mb-4 flex items-center">
                                <div class="w-6 h-6 rounded bg-primary/10 flex items-center justify-center text-primary mr-2">
                                    <i class="ri-links-line"></i>
                                </div>
                                Liên kết nhanh
                            </h3>
                            
                            <div class="space-y-3">
                                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                    <div class="w-8 h-8 rounded bg-blue-100 flex items-center justify-center text-blue-600">
                                        <i class="ri-question-line"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-sm">Câu hỏi thường gặp</h4>
                                        <p class="text-xs text-gray-500">FAQ & Hỗ trợ</p>
                                    </div>
                                </a>

                                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                    <div class="w-8 h-8 rounded bg-green-100 flex items-center justify-center text-green-600">
                                        <i class="ri-phone-line"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-sm">Liên hệ hỗ trợ</h4>
                                        <p class="text-xs text-gray-500">1900 xxxx</p>
                                    </div>
                                </a>

                                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                    <div class="w-8 h-8 rounded bg-purple-100 flex items-center justify-center text-purple-600">
                                        <i class="ri-download-line"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-sm">Tài liệu mới nhất</h4>
                                        <p class="text-xs text-gray-500">Cập nhật hàng ngày</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Widget 2: Thông tin hữu ích -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 mb-6">
                        <div class="p-6">
                            <h3 class="text-lg font-bold mb-4 flex items-center">
                                <div class="w-6 h-6 rounded bg-orange-100 flex items-center justify-center text-orange-600 mr-2">
                                    <i class="ri-lightbulb-line"></i>
                                </div>
                                Mẹo sử dụng
                            </h3>
                            
                            <div class="space-y-4">
                                <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r">
                                    <h4 class="font-medium text-sm mb-1">Tìm kiếm hiệu quả</h4>
                                    <p class="text-xs text-gray-600">Sử dụng từ khóa cụ thể như "đề thi toán lớp 10" để có kết quả chính xác hơn.</p>
                                </div>

                                <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded-r">
                                    <h4 class="font-medium text-sm mb-1">Lưu tài liệu yêu thích</h4>
                                    <p class="text-xs text-gray-600">Đăng nhập để lưu các tài liệu vào thư mục cá nhân của bạn.</p>
                                </div>

                                <div class="bg-purple-50 border-l-4 border-purple-400 p-4 rounded-r">
                                    <h4 class="font-medium text-sm mb-1">Theo dõi cập nhật</h4>
                                    <p class="text-xs text-gray-600">Bật thông báo để nhận tin tức mới nhất về tuyển sinh.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection

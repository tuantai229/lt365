@extends('layouts.app')

@section('title', 'Tin tức')

@section('content')
<!-- Breadcrumb -->
<div class="bg-gray-100 py-3">
    <div class="container mx-auto px-4">
        <div class="flex items-center text-sm text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-primary">Trang chủ</a>
            <span class="mx-2">
                <i class="ri-arrow-right-s-line"></i>
            </span>
            <span class="text-primary font-medium">Tin tức</span>
        </div>
    </div>
</div>

@php
    $featuredNews = $news->where('is_featured', true)->take(5);
    $mainFeatured = $featuredNews->first();
    $sideFeatured = $featuredNews->slice(1);
@endphp

@if($mainFeatured)
<!-- Tin nổi bật -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10">Tin tức nổi bật</h2>
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-8 bg-white rounded-lg shadow-md overflow-hidden border border-gray-100">
                <a href="{{ route('news.show', ['slug' => $mainFeatured->slug, 'id' => $mainFeatured->id]) }}" class="block h-64">
                    <img src="{{ $mainFeatured->featured_image_url }}" alt="{{ $mainFeatured->name }}" class="w-full h-full object-cover object-top">
                </a>
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <span class="flex items-center">
                            <i class="ri-calendar-line mr-1"></i>
                            {{ $mainFeatured->created_at->format('d/m/Y') }}
                        </span>
                        <span class="mx-2">•</span>
                        <span class="flex items-center">
                            <i class="ri-eye-line mr-1"></i>
                            {{ $mainFeatured->view_count }} lượt xem
                        </span>
                    </div>
                    <h3 class="text-xl font-bold mb-4">
                        <a href="{{ route('news.show', ['slug' => $mainFeatured->slug, 'id' => $mainFeatured->id]) }}" class="hover:text-primary">{{ $mainFeatured->name }}</a>
                    </h3>
                    <p class="text-gray-600 mb-6">{{ Str::limit(strip_tags($mainFeatured->content), 200) }}</p>
                    <a href="{{ route('news.show', ['slug' => $mainFeatured->slug, 'id' => $mainFeatured->id]) }}" class="inline-flex items-center text-primary font-medium hover:underline">
                        Đọc tiếp
                        <i class="ri-arrow-right-line ml-1"></i>
                    </a>
                </div>
            </div>
            
            @if($sideFeatured->isNotEmpty())
            <div class="lg:col-span-4 space-y-4">
                @foreach($sideFeatured as $item)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-shadow duration-300">
                    <a href="{{ route('news.show', ['slug' => $item->slug, 'id' => $item->id]) }}" class="flex">
                        <div class="w-20 h-14 flex-shrink-0">
                            <img src="{{ $item->featured_image_url }}" alt="{{ $item->name }}" class="w-full h-full object-cover object-top rounded-l-lg">
                        </div>
                        <div class="flex-1 p-3">
                            <div class="flex items-center text-xs text-gray-500 mb-1">
                                <i class="ri-calendar-line mr-1"></i>
                                <span>{{ $item->created_at->format('d/m/Y') }}</span>
                            </div>
                            <h4 class="font-medium text-sm line-clamp-2 leading-tight">{{ $item->name }}</h4>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</section>
@endif

<!-- Danh sách tin tức -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-8">
                <h2 class="text-3xl font-bold mb-6">Tất cả tin tức</h2>
                
                @if($news->isNotEmpty())
                <div class="space-y-6">
                    @foreach($news as $item)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex flex-col md:flex-row">
                            <a href="{{ route('news.show', ['slug' => $item->slug, 'id' => $item->id]) }}" class="md:w-1/4 block">
                                <img src="{{ $item->featured_image_url }}" alt="{{ $item->name }}" class="w-full h-full object-cover object-top">
                            </a>
                            <div class="md:w-3/4 p-6">
                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                    <span class="flex items-center">
                                        <i class="ri-calendar-line mr-1"></i>
                                        {{ $item->created_at->format('d/m/Y') }}
                                    </span>
                                    <span class="mx-2">•</span>
                                    <span class="flex items-center">
                                        <i class="ri-eye-line mr-1"></i>
                                        {{ $item->view_count }} lượt xem
                                    </span>
                                    @if($item->comments_count > 0)
                                    <span class="mx-2">•</span>
                                    <span class="flex items-center">
                                        <i class="ri-chat-3-line mr-1"></i>
                                        {{ $item->comments_count }} bình luận
                                    </span>
                                    @endif
                                </div>
                                <h3 class="text-lg font-bold mb-2">
                                    <a href="{{ route('news.show', ['slug' => $item->slug, 'id' => $item->id]) }}" class="hover:text-primary">{{ $item->name }}</a>
                                </h3>
                                <p class="text-gray-600 mb-3">{{ Str::limit(strip_tags($item->content), 150) }}</p>
                                <a href="{{ route('news.show', ['slug' => $item->slug, 'id' => $item->id]) }}" class="inline-flex items-center text-primary text-sm hover:underline">
                                    Đọc tiếp
                                    <i class="ri-arrow-right-line ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $news->links() }}
                </div>
                @else
                <div class="text-center py-12">
                    <p class="text-gray-500">Chưa có tin tức nào.</p>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-4">
                <div class="sticky top-24">
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                        <h3 class="text-xl font-bold mb-4">Danh mục</h3>
                        <ul class="space-y-2">
                            <li>
                                <a href="{{ route('news.index') }}" class="flex justify-between items-center text-gray-700 hover:text-primary transition-colors duration-200">
                                    <span>Tất cả</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            @foreach($categories as $category)
                            <li>
                                <a href="{{ route('news.by-category', $category->slug) }}" class="flex justify-between items-center text-gray-700 hover:text-primary transition-colors duration-200">
                                    <span>{{ $category->name }}</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

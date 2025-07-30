@extends('layouts.app')

@section('title', $news->name)

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
            @if($news->categories->first())
            <span class="mx-2">
                <i class="ri-arrow-right-s-line"></i>
            </span>
            <a href="{{ route('news.by-category', $news->categories->first()->slug) }}" class="hover:text-primary">{{ $news->categories->first()->name }}</a>
            @endif
            <span class="mx-2">
                <i class="ri-arrow-right-s-line"></i>
            </span>
            <span class="text-primary font-medium">{{ Str::limit($news->name, 50) }}</span>
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
                    <div class="flex items-center justify-between mb-4">
                        <h1 class="text-3xl font-bold text-gray-900">{{ $news->name }}</h1>
                        <button class="text-gray-400 hover:text-red-500 transition-colors duration-200" data-favorite-btn data-news-id="{{ $news->id }}">
                            <i class="ri-heart-line text-2xl"></i>
                        </button>
                    </div>
                    
                    <!-- Meta Information -->
                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-6">
                        <div class="flex items-center gap-2">
                            <i class="ri-calendar-line text-primary"></i>
                            <span>{{ $news->created_at->format('d/m/Y') }}</span>
                        </div>
                        @if($news->categories->isNotEmpty())
                        <div class="flex items-center gap-2">
                            @foreach($news->categories as $category)
                                <a href="{{ route('news.by-category', $category->slug) }}" class="bg-primary text-white px-2 py-1 rounded text-xs font-medium hover:bg-primary-dark">{{ $category->name }}</a>
                            @endforeach
                        </div>
                        @endif
                        <div class="flex items-center gap-2">
                            <i class="ri-eye-line text-primary"></i>
                            <span>{{ $news->view_count }} lượt xem</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="ri-time-line text-primary"></i>
                            <span>5 phút đọc</span>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    <div class="mb-8">
                        <img src="{{ $news->featured_image_url }}" alt="{{ $news->name }}" class="w-full h-80 object-cover rounded-lg shadow-md">
                        {{-- <p class="text-sm text-gray-500 mt-2 italic">{{ $news->image_caption }}</p> --}}
                    </div>
                </header>
                <!-- Article Content -->
                <div class="article-content prose max-w-none">
                    {!! $news->content !!}
                </div>

                <!-- Article Footer -->
                <footer class="mt-8 pt-6 border-t border-gray-200">
                    @if($news->tags->isNotEmpty())
                    <!-- Tags -->
                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-700 mb-3">Từ khóa:</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($news->tags as $tag)
                            <a href="#" class="px-3 py-1 bg-primary/10 text-primary rounded-full text-sm hover:bg-primary/20">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    @endif

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

                <!-- Comments Section -->
                <div class="mt-12 pt-8 border-t border-gray-200">
                    <x-comments.comment-list 
                        type="news" 
                        :type-id="$news->id" 
                    />
                </div>
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
                        
                        @if($relatedNews->isNotEmpty())
                        <div class="space-y-4">
                            @foreach($relatedNews as $related)
                            <article class="flex gap-3">
                                <a href="{{ route('news.show', ['slug' => $related->slug, 'id' => $related->id]) }}" class="w-20 h-16 bg-gray-100 rounded overflow-hidden flex-shrink-0">
                                    <img src="{{ $related->featured_image_url }}" alt="{{ $related->name }}" class="w-full h-full object-cover">
                                </a>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-medium text-sm line-clamp-2 mb-1">
                                        <a href="{{ route('news.show', ['slug' => $related->slug, 'id' => $related->id]) }}" class="hover:text-primary">{{ $related->name }}</a>
                                    </h4>
                                    <div class="text-xs text-gray-500 flex items-center gap-2">
                                        <span>{{ $related->created_at->format('d/m/Y') }}</span>
                                        <span>•</span>
                                        <span>{{ $related->view_count }} lượt xem</span>
                                    </div>
                                </div>
                            </article>
                            @endforeach
                        </div>
                        @if($news->categories->first())
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <a href="{{ route('news.by-category', $news->categories->first()->slug) }}" class="text-primary text-sm font-medium hover:underline">Xem tất cả tin {{ $news->categories->first()->name }} →</a>
                        </div>
                        @endif
                        @else
                        <p class="text-sm text-gray-500">Không có tin tức liên quan.</p>
                        @endif
                    </div>
                </div>

            </aside>
        </div>
    </div>
</section>
@endsection

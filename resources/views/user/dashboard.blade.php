@extends('user.layouts.app')

@section('title', 'Tổng quan tài khoản')

@section('content')
    <!-- Header -->
    <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Chào mừng trở lại, {{ $user->full_name }}!</h1>
        <p class="text-gray-600 mt-1">Đây là tổng quan về hoạt động của bạn trên hệ thống.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Downloads -->
        <div class="bg-white p-6 rounded-lg shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                <i class="ri-download-cloud-2-line text-2xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Tài liệu đã tải</p>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['downloads'] }}</p>
            </div>
        </div>
        <!-- Favorites -->
        <div class="bg-white p-6 rounded-lg shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center text-red-600">
                <i class="ri-heart-line text-2xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Đã yêu thích</p>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['favorites'] }}</p>
            </div>
        </div>
        <!-- Comments -->
        <div class="bg-white p-6 rounded-lg shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                <i class="ri-message-2-line text-2xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Bình luận</p>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['comments'] }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Activity Timeline -->
        <div class="lg:col-span-2">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Hoạt động gần đây</h2>
                <div class="space-y-6">
                    @forelse ($activityTimeline as $activity)
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full {{ $activity['color'] }} flex items-center justify-center flex-shrink-0">
                                <i class="{{ $activity['icon'] }} text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-800">
                                    {{ $activity['description'] }}
                                    @if ($activity['model'])
                                        <a href="#" class="font-semibold text-primary hover:underline">
                                            {{ $activity['model']->name ?? Str::limit($activity['content'], 30) }}
                                        </a>
                                    @endif
                                </p>
                                <p class="text-xs text-gray-500 mt-1">{{ $activity['date']->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">Chưa có hoạt động nào gần đây.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Right Column: Recommendations & Shortcuts -->
        <div class="space-y-8">
            <!-- Recommendations -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Gợi ý cho bạn</h2>
                <div class="space-y-4">
                    @forelse ($recommendations as $doc)
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded bg-gray-100 flex items-center justify-center text-primary flex-shrink-0">
                                <i class="ri-file-text-line"></i>
                            </div>
                            <div>
                                <a href="#" class="text-sm font-medium text-gray-800 hover:text-primary line-clamp-1">{{ $doc->name }}</a>
                                <p class="text-xs text-gray-500">{{ $doc->level->name ?? '' }} - {{ $doc->subject->name ?? '' }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm">Chưa có gợi ý nào.</p>
                    @endforelse
                </div>
            </div>

            <!-- Shortcuts -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Truy cập nhanh</h2>
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('documents.index') }}" class="text-center bg-primary/5 hover:bg-primary/10 p-4 rounded-lg">
                        <i class="ri-book-3-line text-2xl text-primary"></i>
                        <p class="text-sm font-medium mt-2 text-gray-800">Tài liệu</p>
                    </a>
                    <a href="{{ route('schools.index') }}" class="text-center bg-primary/5 hover:bg-primary/10 p-4 rounded-lg">
                        <i class="ri-school-line text-2xl text-primary"></i>
                        <p class="text-sm font-medium mt-2 text-gray-800">Trường học</p>
                    </a>
                    <a href="{{ route('user.profile') }}" class="text-center bg-primary/5 hover:bg-primary/10 p-4 rounded-lg">
                        <i class="ri-user-settings-line text-2xl text-primary"></i>
                        <p class="text-sm font-medium mt-2 text-gray-800">Hồ sơ</p>
                    </a>
                    <a href="{{ route('contact.index') }}" class="text-center bg-primary/5 hover:bg-primary/10 p-4 rounded-lg">
                        <i class="ri-customer-service-2-line text-2xl text-primary"></i>
                        <p class="text-sm font-medium mt-2 text-gray-800">Hỗ trợ</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

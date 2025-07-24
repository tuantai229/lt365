@extends('user.layouts.app')

@section('title', 'Danh sách yêu thích')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-sm">
    <h1 class="text-2xl font-bold text-gray-900 border-b border-gray-200 pb-4 mb-6">Danh sách yêu thích</h1>

    <div class="space-y-4">
        @forelse ($favorites as $favorite)
            @if($favorite->item)
                @php
                    $item = $favorite->item;
                    $type = ucfirst($favorite->type);
                    $details = [
                        'Document' => ['icon' => 'ri-file-text-line', 'label' => 'Tài liệu', 'route' => 'documents.show', 'params' => ['slug' => $item->slug, 'id' => $item->id]],
                        'School' => ['icon' => 'ri-school-line', 'label' => 'Trường học', 'route' => 'schools.show', 'params' => ['slug' => $item->slug, 'id' => $item->id]],
                        'News' => ['icon' => 'ri-newspaper-line', 'label' => 'Tin tức', 'route' => 'news.show', 'params' => ['slug' => $item->slug, 'id' => $item->id]],
                        'Center' => ['icon' => 'ri-building-line', 'label' => 'Trung tâm', 'route' => 'centers.show', 'params' => ['slug' => $item->slug, 'id' => $item->id]],
                        'Teacher' => ['icon' => 'ri-user-star-line', 'label' => 'Giáo viên', 'route' => 'teachers.show', 'params' => ['slug' => $item->slug, 'id' => $item->id]],
                    ][$type] ?? null;
                @endphp

                @if($details && $item)
                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-md bg-gray-100 flex items-center justify-center text-gray-500">
                            <i class="{{ $details['icon'] }} text-xl"></i>
                        </div>
                        <div>
                            <a href="{{ route($details['route'], $details['params']) }}" class="font-semibold text-gray-900 hover:text-primary">
                                {{ $item->name }}
                            </a>
                            <div class="flex items-center gap-2 text-sm text-gray-500 mt-1">
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-primary/10 text-primary">{{ $details['label'] }}</span>
                                <span>•</span>
                                <span>Yêu thích lúc: {{ $favorite->created_at->format('d/m/Y') }}</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="text-red-500 hover:text-red-700" 
                                data-favorite-btn 
                                data-{{ $favorite->type }}-id="{{ $favorite->type_id }}"
                                title="Bỏ yêu thích">
                            <i class="ri-heart-fill text-xl"></i>
                        </button>
                    </div>
                </div>
                @endif
            @else
                {{-- Handle case where item was deleted --}}
                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg bg-gray-50">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-md bg-gray-100 flex items-center justify-center text-gray-400">
                            <i class="ri-close-line text-xl"></i>
                        </div>
                        <div>
                            <span class="font-semibold text-gray-500">{{ ucfirst($favorite->type) }} đã bị xóa</span>
                            <div class="flex items-center gap-2 text-sm text-gray-400 mt-1">
                                <span>Yêu thích lúc: {{ $favorite->created_at->format('d/m/Y') }}</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="text-gray-400 hover:text-gray-600" 
                                onclick="this.closest('.flex').remove()"
                                title="Xóa khỏi danh sách">
                            <i class="ri-delete-bin-line text-xl"></i>
                        </button>
                    </div>
                </div>
            @endif
        @empty
            <div class="text-center py-12 text-gray-500">
                <i class="ri-heart-line text-4xl mb-2"></i>
                <p>Bạn chưa có mục yêu thích nào.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-12">
        {{ $favorites->links('vendor.pagination.custom') }}
    </div>
</div>
@endsection

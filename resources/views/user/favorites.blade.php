@extends('user.layouts.app')

@section('title', 'Danh sách yêu thích')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-sm">
    <h1 class="text-2xl font-bold text-gray-900 border-b border-gray-200 pb-4 mb-6">Danh sách yêu thích</h1>

    <div class="space-y-4">
        @forelse ($favorites as $favorite)
            @if($favorite->favoritable)
                @php
                    $item = $favorite->favoritable;
                    $type = \Illuminate\Support\Str::afterLast($favorite->favoritable_type, '\\');
                    $details = [
                        'Document' => ['icon' => 'ri-file-text-line', 'label' => 'Tài liệu', 'route' => 'documents.show', 'params' => ['slug' => $item->slug, 'id' => $item->id]],
                        'School' => ['icon' => 'ri-school-line', 'label' => 'Trường học', 'route' => 'schools.show', 'params' => ['slug' => $item->slug, 'id' => $item->id]],
                        'News' => ['icon' => 'ri-newspaper-line', 'label' => 'Tin tức', 'route' => 'news.show', 'params' => ['slug' => $item->slug, 'id' => $item->id]],
                        'Center' => ['icon' => 'ri-building-line', 'label' => 'Trung tâm', 'route' => 'centers.show', 'params' => ['slug' => $item->slug, 'id' => $item->id]],
                        'Teacher' => ['icon' => 'ri-user-star-line', 'label' => 'Giáo viên', 'route' => 'teachers.show', 'params' => ['slug' => $item->slug, 'id' => $item->id]],
                    ][$type] ?? null;
                @endphp

                @if($details)
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
                        {{-- Unfavorite button can be implemented with JavaScript later --}}
                        <button class="text-red-500 hover:text-red-700" title="Bỏ yêu thích">
                            <i class="ri-heart-fill text-xl"></i>
                        </button>
                    </div>
                </div>
                @endif
            @endif
        @empty
            <div class="text-center py-12 text-gray-500">
                <i class="ri-heart-line text-4xl mb-2"></i>
                <p>Bạn chưa có mục yêu thích nào.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $favorites->links() }}
    </div>
</div>
@endsection

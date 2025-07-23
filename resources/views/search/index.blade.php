@extends('layouts.app')

@section('title')
    Kết quả tìm kiếm cho "{{ $query }}"
@endsection

@section('content')
<div class="container mx-auto py-8">
    <div class="mb-4">
        <h1 class="text-3xl font-bold">Tìm kiếm</h1>
        <p class="text-gray-600">Kết quả cho từ khóa: <span class="font-semibold">"{{ $query }}"</span></p>
    </div>

    @if($results->isEmpty())
        <div class="text-center py-16">
            <p class="text-xl text-gray-700">Không tìm thấy kết quả nào phù hợp.</p>
        </div>
    @else
        <div class="space-y-6">
            @foreach($results as $result)
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <a href="{{ $result['url'] }}">
                                <img src="{{ $result['image_url'] }}" alt="{{ $result['title'] }}" class="w-24 h-24 object-cover rounded-md">
                            </a>
                        </div>
                        <div class="flex-grow">
                            <div class="text-sm text-gray-500">
                                <span class="font-semibold text-green-700">{{ $result['category_label'] }}</span>
                            </div>
                            <h2 class="text-xl font-semibold text-blue-700 hover:underline">
                                <a href="{{ $result['url'] }}">{{ $result['title'] }}</a>
                            </h2>
                            <p class="text-sm text-gray-600 mt-1">{{ $result['description'] }}</p>
                            <div class="text-xs text-gray-500 mt-2 space-x-4">
                                @foreach($result['meta_info'] as $key => $value)
                                    @if(!empty($value))
                                        <span>
                                            <strong class="font-medium">{{ $key }}:</strong> 
                                            <span>{{ is_array($value) ? implode(', ', $value) : $value }}</span>
                                        </span>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $results->appends(request()->query())->links('vendor.pagination.custom') }}
        </div>
    @endif
</div>
@endsection

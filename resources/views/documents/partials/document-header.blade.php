<header class="mb-8">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-3xl font-bold text-gray-900">{{ $document->name }}</h1>
        <button class="text-gray-400 hover:text-red-500 transition-colors duration-200" data-favorite-btn data-document-id="{{ $document->id }}">
            <i class="ri-heart-line text-2xl"></i>
        </button>
    </div>
    
    <!-- Meta Information -->
    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-6">
        <div class="flex items-center gap-2">
            <i class="ri-calendar-line text-primary"></i>
            <span>Tải lên: {{ $document->created_at->format('d/m/Y') }}</span>
        </div>
        @if($document->documentType)
        <div class="flex items-center gap-2">
            <span class="bg-primary text-white px-2 py-1 rounded text-xs font-medium">{{ $document->documentType->name }}</span>
        </div>
        @endif
        <div class="flex items-center gap-2">
            <i class="ri-download-line text-primary"></i>
            <span>{{ number_format($document->download_count) }} lượt tải</span>
        </div>
        <div class="flex items-center gap-2">
            <i class="ri-file-line text-primary"></i>
            <span>{{ $document->formatted_file_type }} | {{ $document->formatted_file_size }}</span>
        </div>
        <div class="difficulty-badge difficulty-{{ $document->difficulty_class }}">
            <i class="ri-star-fill"></i>
            <span>{{ $document->difficulty }}</span>
        </div>
    </div>

    <!-- Featured Image -->
    <div class="mb-6">
        <img src="{{ $document->featured_image_url }}" alt="{{ $document->name }}" class="w-full h-60 object-cover rounded-lg shadow-md">
        <p class="text-sm text-gray-500 mt-2 italic">{{ $document->name }}</p>
    </div>
</header>

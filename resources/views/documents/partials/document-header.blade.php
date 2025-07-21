<header class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $document->name }}</h1>
    
    <!-- Meta Information -->
    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-6">
        <div class="flex items-center gap-2">
            <i class="ri-calendar-line text-primary"></i>
            <span>Tải lên: {{ $document->created_at->format('d/m/Y') }}</span>
        </div>
        <div class="flex items-center gap-2">
            <span class="bg-primary text-white px-2 py-1 rounded text-xs font-medium">{{ $document->document_type }}</span>
        </div>
        <div class="flex items-center gap-2">
            <i class="ri-download-line text-primary"></i>
            <span>{{ number_format($document->view_count) }} lượt tải</span>
        </div>
        <div class="flex items-center gap-2">
            <i class="ri-file-line text-primary"></i>
            <span>{{ $document->page_count }} trang | {{ $document->file_size }}</span>
        </div>
        <div class="difficulty-badge difficulty-{{ $document->difficulty }}">
            <i class="ri-star-fill"></i>
            <span>{{ ucfirst($document->difficulty) }}</span>
        </div>
    </div>

    <!-- Featured Image -->
    <div class="mb-6">
        <img src="{{ asset('html/' . $document->image) }}" alt="{{ $document->name }}" class="w-full h-60 object-cover rounded-lg shadow-md">
        <p class="text-sm text-gray-500 mt-2 italic">{{ $document->name }}</p>
    </div>
</header>

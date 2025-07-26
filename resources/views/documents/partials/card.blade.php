<div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
    <a href="{{ route('documents.show', ['slug' => $document->slug, 'id' => $document->id]) }}" class="block">
        <div class="h-40 bg-gray-100">
            <img src="{{ asset($document->image) }}" alt="{{ $document->name }}" class="w-full h-full object-cover">
        </div>
        <div class="p-4">
            <div class="flex items-center justify-between mb-2">
                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">{{ $document->subject->name ?? 'N/A' }}</span>
                <div class="flex items-center gap-2">
                    <span class="px-2 py-1 {{ $document->is_free ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }} text-xs rounded-full">
                        {{ $document->is_free ? 'Miễn phí' : number_format($document->price) . ' VND' }}
                    </span>
                    <button class="text-gray-400 hover:text-red-500 transition-colors duration-200" data-favorite-btn data-document-id="{{ $document->id }}">
                        <i class="ri-heart-line text-lg"></i>
                    </button>
                </div>
            </div>
            <h3 class="font-medium mb-2 line-clamp-2 h-12">{{ $document->name }}</h3>
            <div class="flex items-center text-xs text-gray-500 mb-3">
                <span class="flex items-center mr-4">
                    <i class="ri-download-line mr-1"></i> {{ $document->download_count ?? 0 }}
                </span>
                <span class="flex items-center">
                    <i class="ri-calendar-line mr-1"></i> {{ $document->created_at->format('d/m/Y') }}
                </span>
            </div>
            <div class="flex items-center justify-between mt-3">
                <div class="flex items-center">
                    <div class="w-6 h-6 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                        <i class="ri-file-pdf-line"></i>
                    </div>
                    <span class="ml-1 text-sm text-gray-500">{{ $document->formatted_file_type }} | {{ $document->formatted_file_size }}</span>
                </div>
            </div>
        </div>
    </a>
</div>

@if($schoolDocuments->count() > 0)
<!-- Documents Section -->
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Tài liệu thi tuyển</h2>
    
    <!-- Documents Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($schoolDocuments as $document)
        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                    @if($document->formatted_file_type == 'PDF')
                        <i class="ri-file-pdf-line text-red-600"></i>
                    @elseif(in_array($document->formatted_file_type, ['DOC', 'DOCX']))
                        <i class="ri-file-word-line text-blue-600"></i>
                    @else
                        <i class="ri-file-text-line text-green-600"></i>
                    @endif
                </div>
                <div>
                    <h3 class="font-medium">{{ $document->name }}</h3>
                    <p class="text-xs text-gray-500">{{ $document->formatted_file_type }} - {{ $document->formatted_file_size }}</p>
                </div>
            </div>
            <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $document->description }}</p>
            <div class="flex justify-between items-center">
                <span class="text-xs text-gray-500 flex items-center">
                    <i class="ri-download-line mr-1"></i> {{ number_format($document->download_count) }} lượt tải
                </span>
                <a href="{{ route('documents.show', ['slug' => $document->slug, 'id' => $document->id]) }}" class="px-3 py-1 bg-primary text-white rounded text-sm hover:bg-primary/90 transition-colors">
                    Tải xuống
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <div class="text-center mt-6">
        <a href="#" class="inline-flex items-center text-primary font-medium hover:underline">
            Xem thêm tài liệu
            <i class="ri-arrow-right-line ml-1"></i>
        </a>
    </div>
</div>
@endif

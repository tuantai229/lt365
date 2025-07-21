<!-- Document Grid Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">

        <!-- Document Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
            @if(count($documents) > 0)
                @foreach($documents as $document)
                    @include('documents.partials.card', ['document' => $document])
                @endforeach
            @else
                <!-- Placeholder cards -->
                @for ($i = 0; $i < 8; $i++)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                        <div class="h-40 bg-gray-100">
                            <img src="{{ asset('html/images/a63d36922ba8edd9e7f86405d8809253.jpg') }}" alt="Document Placeholder" class="w-full h-full object-cover">
                        </div>
                        <div class="p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Toán</span>
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Miễn phí</span>
                            </div>
                            <h3 class="font-medium mb-2 line-clamp-2 h-12">Bộ đề thi Toán vào lớp 1 - Trường Chu Văn An 2025</h3>
                            <div class="flex items-center text-xs text-gray-500 mb-3">
                                <span class="flex items-center mr-4">
                                    <i class="ri-download-line mr-1"></i> 1,542
                                </span>
                                <span class="flex items-center">
                                    <i class="ri-calendar-line mr-1"></i> 15/06/2025
                                </span>
                            </div>
                        </div>
                    </div>
                @endfor
            @endif
        </div>

        <!-- Pagination -->
        <div class="flex items-center justify-center gap-2">
            <button class="px-3 py-2 border border-gray-200 rounded-button hover:bg-gray-100 transition-colors duration-200" disabled>
                <i class="ri-arrow-left-line"></i>
            </button>
            <button class="px-3 py-2 bg-primary text-white rounded-button">1</button>
            <button class="px-3 py-2 border border-gray-200 rounded-button hover:bg-gray-100 transition-colors duration-200">2</button>
            <button class="px-3 py-2 border border-gray-200 rounded-button hover:bg-gray-100 transition-colors duration-200">3</button>
            <span class="px-3 py-2 text-gray-500">...</span>
            <button class="px-3 py-2 border border-gray-200 rounded-button hover:bg-gray-100 transition-colors duration-200">24</button>
            <button class="px-3 py-2 border border-gray-200 rounded-button hover:bg-gray-100 transition-colors duration-200">
                <i class="ri-arrow-right-line"></i>
            </button>
        </div>
    </div>
</section>

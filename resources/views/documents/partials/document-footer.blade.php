<footer class="mt-8 pt-6 border-t border-gray-200">
    <!-- Tags -->
    <div class="mb-6">
        <h4 class="text-sm font-medium text-gray-700 mb-3">Từ khóa:</h4>
        <div class="flex flex-wrap gap-2">
            @foreach($document->tags as $tag)
                <span class="px-3 py-1 bg-primary/10 text-primary rounded-full text-sm">{{ $tag }}</span>
            @endforeach
        </div>
    </div>

    <!-- Rating & Actions -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-2">
                <span class="text-sm font-medium text-gray-700">Đánh giá:</span>
                <div class="flex items-center">
                    <i class="ri-star-fill text-yellow-400"></i>
                    <i class="ri-star-fill text-yellow-400"></i>
                    <i class="ri-star-fill text-yellow-400"></i>
                    <i class="ri-star-fill text-yellow-400"></i>
                    <i class="ri-star-fill text-yellow-400"></i>
                    <span class="ml-2 text-sm text-gray-600">(4.8/5 - 156 đánh giá)</span>
                </div>
            </div>
        </div>
        <button class="flex items-center gap-2 px-6 py-3 bg-green-600 text-white rounded-button hover:bg-green-700 transition-colors font-medium">
            <i class="ri-download-cloud-line"></i>
            <span>Tải xuống miễn phí</span>
        </button>
    </div>

    <!-- Share Buttons -->
    <div class="mb-6">
        <h4 class="text-sm font-medium text-gray-700 mb-3">Chia sẻ tài liệu:</h4>
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
        </div>
    </div>
</footer>

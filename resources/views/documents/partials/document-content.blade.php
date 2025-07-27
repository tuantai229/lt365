<!-- Document Description -->
<div class="mb-8">
    <div class="bg-blue-50 border-l-4 border-primary p-4 rounded-r-lg mb-6">
        <h3 class="text-lg font-semibold text-primary mb-2">Thông tin tài liệu</h3>
        <p class="text-gray-700">{{ $document->description }}</p>
    </div>
</div>

@if ($document->file_type === 'application/pdf' && $document->file_path)
<!-- PDF Viewer Section -->
<div class="mb-8">
    <div class="pdf-viewer">
        <!-- PDF Controls -->
        <div class="pdf-controls">
            <div class="flex items-center gap-4">
                <span class="text-sm font-medium text-gray-700">Xem tài liệu:</span>
                <div class="flex items-center gap-2">
                    <button class="p-2 hover:bg-gray-200 rounded transition-colors" title="Thu nhỏ">
                        <i class="ri-zoom-out-line"></i>
                    </button>
                    <span class="text-sm text-gray-600">100%</span>
                    <button class="p-2 hover:bg-gray-200 rounded transition-colors" title="Phóng to">
                        <i class="ri-zoom-in-line"></i>
                    </button>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <button class="flex items-center gap-2 px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded transition-colors text-sm">
                    <i class="ri-fullscreen-line"></i>
                    <span>Toàn màn hình</span>
                </button>
                <button class="flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors text-sm font-medium">
                    <i class="ri-download-line"></i>
                    <span>Tải xuống</span>
                </button>
            </div>
        </div>
        
        <!-- PDF Embed -->
        <div class="relative">
            <iframe 
                src="{{ $document->displayable_file_url }}" 
                width="100%" 
                height="800" 
                class="border-0"
                title="{{ $document->name }}">
            </iframe>
            <!-- Fallback for browsers that don't support PDF viewing -->
            <div class="absolute inset-0 flex items-center justify-center bg-gray-100" style="display: none;" id="pdf-fallback">
                <div class="text-center">
                    <i class="ri-file-pdf-line text-6xl text-red-500 mb-4"></i>
                    <h3 class="text-lg font-semibold mb-2">Không thể hiển thị PDF</h3>
                    <p class="text-gray-600 mb-4">Trình duyệt của bạn không hỗ trợ xem PDF trực tiếp.</p>
                    <button class="px-4 py-2 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors">
                        <i class="ri-download-line mr-2"></i>
                        Tải xuống để xem
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

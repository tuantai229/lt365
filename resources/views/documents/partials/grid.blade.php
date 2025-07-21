<!-- Document Grid Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">

        <!-- Document Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
            @forelse($documents as $document)
                @include('documents.partials.card', ['document' => $document])
            @empty
                <div class="col-span-full text-center py-12">
                    <img src="{{ asset('images/empty-box.svg') }}" alt="Không có dữ liệu" class="mx-auto h-24 w-24 mb-4">
                    <p class="text-gray-600 font-medium">Chưa có tài liệu nào phù hợp với tiêu chí của bạn.</p>
                    <p class="text-sm text-gray-500 mt-2">Vui lòng thử lại với các bộ lọc khác hoặc quay lại sau.</p>
                    <a href="{{ route('documents.index') }}" class="mt-6 inline-block bg-primary text-white px-6 py-2 rounded-button hover:bg-primary/90 transition-colors">
                        Xóa bộ lọc
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $documents->links('vendor.pagination.custom') }}
        </div>
    </div>
</section>

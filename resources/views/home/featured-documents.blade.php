<!-- Tài liệu nổi bật -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10">Tài liệu nổi bật</h2>

        <!-- Tabs -->
        <div class="flex justify-center mb-8" id="featured-docs-tabs">
            <div class="inline-flex bg-gray-100 p-1 rounded-full">
                <button data-tab="latest" class="px-6 py-2 rounded-full bg-primary text-white font-medium text-sm whitespace-nowrap !rounded-full transition-colors duration-300">
                    Mới nhất
                </button>
                @foreach($featuredDocumentLevels as $level)
                <button data-tab="{{ $level->slug }}" class="px-6 py-2 rounded-full text-gray-700 hover:bg-gray-200 font-medium text-sm whitespace-nowrap !rounded-full transition-colors duration-300">
                    {{ $level->name }}
                </button>
                @endforeach
            </div>
        </div>

        <!-- Grid -->
        <div id="featured-docs-panels">
            <!-- Latest Tab Panel -->
            <div data-panel="latest" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($featuredDocuments['latest'] as $document)
                    @include('documents.partials.card', ['document' => $document])
                @endforeach
            </div>

            <!-- Level Tab Panels -->
            @foreach($featuredDocumentLevels as $level)
            <div data-panel="{{ $level->slug }}" class="hidden grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @if(isset($featuredDocuments[$level->slug]))
                    @foreach($featuredDocuments[$level->slug] as $document)
                        @include('documents.partials.card', ['document' => $document])
                    @endforeach
                @endif
            </div>
            @endforeach
        </div>

        <div class="text-center mt-8">
            <a href="{{ route('documents.index') }}" class="inline-flex items-center text-primary font-medium hover:underline">
                Xem tất cả tài liệu
                <i class="ri-arrow-right-line ml-1"></i>
            </a>
        </div>
    </div>
</section>

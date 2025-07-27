<!-- Đề thi và tài liệu -->
<section class="py-12 bg-gray-50" x-data="{ activeTab: 'latest' }">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10">Đề thi và tài liệu lớp {{ $grade }}</h2>
        
        <!-- Tabs -->
        <div class="flex justify-center mb-8">
            <div class="inline-flex bg-gray-100 p-1 rounded-full">
                <button @click="activeTab = 'latest'" 
                        :class="{'bg-primary text-white': activeTab === 'latest', 'text-gray-700 hover:bg-gray-200': activeTab !== 'latest'}"
                        class="px-6 py-2 rounded-full font-medium text-sm whitespace-nowrap !rounded-full transition-colors duration-300">
                    Mới nhất
                </button>
                <button @click="activeTab = 'featured'"
                        :class="{'bg-primary text-white': activeTab === 'featured', 'text-gray-700 hover:bg-gray-200': activeTab !== 'featured'}"
                        class="px-6 py-2 rounded-full font-medium text-sm whitespace-nowrap !rounded-full transition-colors duration-300">
                    Phổ biến
                </button>
            </div>
        </div>
        
        <!-- Grid Panels -->
        <div>
            <!-- Latest Documents Panel -->
            <div x-show="activeTab === 'latest'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @if(isset($documents['latest']) && count($documents['latest']) > 0)
                    @foreach($documents['latest'] as $document)
                        @include('documents.partials.card', ['document' => $document])
                    @endforeach
                @else
                    <div class="col-span-full text-center py-8">
                        <p class="text-gray-500">Chưa có tài liệu mới nào cho cấp học này.</p>
                    </div>
                @endif
            </div>

            <!-- Featured Documents Panel -->
            <div x-show="activeTab === 'featured'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" style="display: none;">
                @if(isset($documents['featured']) && count($documents['featured']) > 0)
                    @foreach($documents['featured'] as $document)
                        @include('documents.partials.card', ['document' => $document])
                    @endforeach
                @else
                    <div class="col-span-full text-center py-8">
                        <p class="text-gray-500">Chưa có tài liệu phổ biến nào cho cấp học này.</p>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="text-center mt-8">
            <a href="{{ route('documents.index') }}" class="inline-flex items-center text-primary font-medium hover:underline">
                Xem thêm tài liệu
                <i class="ri-arrow-right-line ml-1"></i>
            </a>
        </div>
    </div>
</section>

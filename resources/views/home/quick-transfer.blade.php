<!-- Khối Chuyển Cấp Nhanh -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10">{{ $quickTransfer['title'] ?? 'Đồng hành cùng con vào trường chuyên' }}</h2>
        
        @if(!empty($quickTransfer['boxes']) && count($quickTransfer['boxes']) > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($quickTransfer['boxes'] as $box)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                        <div class="h-40 bg-blue-50 flex items-center justify-center">
                            <img src="{{ get_image_url($box['image'] ?? null) }}" alt="{{ $box['title'] ?? '' }}" class="w-full h-full object-cover object-top">
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-3 text-primary">{{ $box['title'] ?? '' }}</h3>
                            @if(!empty($box['description']))
                                <ul class="mb-4 space-y-2">
                                    @foreach(explode("\n", $box['description']) as $line)
                                        <li class="flex items-center gap-2">
                                            <i class="ri-check-line text-green-500"></i>
                                            <span>{{ trim($line) }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            <a href="{{ $box['button_url'] ?? '#' }}" class="inline-block px-4 py-2 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors duration-200 text-sm font-medium whitespace-nowrap !rounded-button">Xem thêm</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

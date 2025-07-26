<!-- Tin tức & Lịch thi -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10">Tin tức & Lịch thi</h2>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Tin tức -->
            <div class="lg:col-span-2">
                <h3 class="text-xl font-bold mb-6 flex items-center">
                    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary mr-2">
                        <i class="ri-newspaper-line"></i>
                    </div>
                    Tin tuyển sinh mới nhất
                </h3>
                
                @if(!empty($selectedNews) && count($selectedNews) > 0)
                    <!-- Tin nổi bật -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                        <div class="flex flex-col md:flex-row">
                            <div class="md:w-2/5">
                                <a href="{{ route('news.show', ['slug' => $selectedNews[0]->slug, 'id' => $selectedNews[0]->id]) }}">
                                    <img src="{{ get_image_url($selectedNews[0]->featured_image_url) }}" alt="{{ $selectedNews[0]->name ?? '' }}" class="w-full h-full object-cover object-top">
                                </a>
                            </div>
                            <div class="md:w-3/5 p-6">
                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                    <span class="flex items-center">
                                        <i class="ri-calendar-line mr-1"></i>
                                        {{ $selectedNews[0]->created_at->format('d/m/Y') }}
                                    </span>
                                    <span class="mx-2">•</span>
                                    <span class="flex items-center">
                                        <i class="ri-eye-line mr-1"></i>
                                        {{ $selectedNews[0]->view_count ?? 0 }} lượt xem
                                    </span>
                                </div>
                                <h4 class="text-lg font-bold mb-2">
                                    <a href="{{ route('news.show', ['slug' => $selectedNews[0]->slug, 'id' => $selectedNews[0]->id]) }}" class="hover:text-primary transition-colors">
                                        {{ $selectedNews[0]->name ?? '' }}
                                    </a>
                                </h4>
                                <p class="text-gray-600 mb-4">{{ Str::limit(strip_tags($selectedNews[0]->content ?? ''), 150) }}</p>
                                <a href="{{ route('news.show', ['slug' => $selectedNews[0]->slug, 'id' => $selectedNews[0]->id]) }}" class="inline-flex items-center text-primary font-medium hover:underline">
                                    Đọc tiếp
                                    <i class="ri-arrow-right-line ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tin khác -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($selectedNews->slice(1) as $news)
                            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                                <div class="p-4">
                                    <div class="flex items-center text-sm text-gray-500 mb-2">
                                        <span>{{ $news->created_at->format('d/m/Y') }}</span>
                                        <span class="mx-2">•</span>
                                        <span>{{ $news->categories->first()->name ?? 'Tuyển sinh' }}</span>
                                    </div>
                                    <h4 class="font-medium mb-2 line-clamp-2">
                                        <a href="{{ route('news.show', ['slug' => $news->slug, 'id' => $news->id]) }}" class="hover:text-primary transition-colors">
                                            {{ $news->name ?? '' }}
                                        </a>
                                    </h4>
                                    <a href="{{ route('news.show', ['slug' => $news->slug, 'id' => $news->id]) }}" class="inline-flex items-center text-primary text-sm hover:underline">
                                        Đọc tiếp
                                        <i class="ri-arrow-right-line ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            
            <!-- Lịch thi -->
            <div>
                <h3 class="text-xl font-bold mb-6 flex items-center">
                    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary mr-2">
                        <i class="ri-calendar-event-line"></i>
                    </div>
                    Lịch thi sắp diễn ra
                </h3>
                
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if(!empty($upcomingSchedules))
                        @php
                            $colors = [
                                ['bg' => 'bg-red-100', 'text' => 'text-red-600'],
                                ['bg' => 'bg-orange-100', 'text' => 'text-orange-600'],
                                ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-600'],
                                ['bg' => 'bg-green-100', 'text' => 'text-green-600'],
                                ['bg' => 'bg-blue-100', 'text' => 'text-blue-600'],
                            ];
                        @endphp
                        @foreach($upcomingSchedules as $index => $event)
                            <a href="{{ route('schools.show', ['slug' => $event['school_slug'], 'id' => $event['school_id']]) }}#admission-info" class="block p-4 border-b hover:bg-gray-50">
                                <div class="flex items-center">
                                    @php
                                        $color = $colors[$index % count($colors)];
                                    @endphp
                                    <div class="w-14 h-14 rounded-lg {{ $color['bg'] }} {{ $color['text'] }} flex flex-col items-center justify-center">
                                        <span class="text-sm font-medium">T{{ $event['date']->dayOfWeek + 1 }}</span>
                                        <span class="text-lg font-bold">{{ $event['date']->format('d') }}</span>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="font-medium">{{ $event['title'] }}</h5>
                                        <p class="text-sm text-gray-500">{{ $event['school'] }}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @else
                        <div class="p-4 text-center text-gray-500">
                            Không có lịch thi nào sắp diễn ra.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

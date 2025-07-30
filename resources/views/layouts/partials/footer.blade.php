<footer class="bg-gray-800 text-white pt-12 pb-6">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
            <!-- Column 1 -->
            <div>
                <h3 class="text-xl font-bold mb-4">Về LT365</h3>
                <p class="text-gray-300 mb-4">{{ $general_settings['footer_intro'] ?? '' }}</p>
                @include('layouts.components.social-links')
            </div>
            
            <!-- Column 2 -->
            <div>
                <h3 class="text-xl font-bold mb-4">Danh mục</h3>
                <ul class="space-y-2 text-gray-300">
                    @if(isset($footer_category_links) && is_array($footer_category_links))
                        @foreach($footer_category_links as $link)
                            <li><a href="{{ url($link['url']) }}" class="hover:text-white">{{ $link['title'] }}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>
            
            <!-- Column 3 -->
            <div>
                <h3 class="text-xl font-bold mb-4">Hỗ trợ</h3>
                <ul class="space-y-2 text-gray-300">
                    @if(isset($footer_support_links) && is_array($footer_support_links))
                        @foreach($footer_support_links as $link)
                            <li><a href="{{ url($link['url']) }}" class="hover:text-white">{{ $link['title'] }}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>
            
            <!-- Column 4 -->
            <div>
                <h3 class="text-xl font-bold mb-4">Liên hệ</h3>
                <ul class="space-y-3 text-gray-300">
                    <li class="flex items-start">
                        <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                            <i class="ri-phone-fill"></i>
                        </div>
                        <div>
                            <p class="font-medium text-white">Hotline</p>
                            <p>{{ $general_settings['hotline'] ?? '' }}</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                            <i class="ri-mail-fill"></i>
                        </div>
                        <div>
                            <p class="font-medium text-white">Email</p>
                            <p>{{ $general_settings['email'] ?? '' }}</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                            <i class="ri-map-pin-fill"></i>
                        </div>
                        <div>
                            <p class="font-medium text-white">Địa chỉ</p>
                            <p>{{ $general_settings['address'] ?? '' }}</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                            <i class="ri-time-fill"></i>
                        </div>
                        <div>
                            <p class="font-medium text-white">Giờ làm việc</p>
                            <p>{{ $general_settings['working_hours'] ?? '' }}</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-gray-700 pt-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm mb-4 md:mb-0">© 2025 LT365. Tất cả quyền được bảo lưu.</p>
                <div class="flex items-center gap-4">
                    <a href="{{ route('sitemap') }}" class="text-gray-400 hover:text-white text-sm">Sitemap</a>
                    <span class="text-gray-500">|</span>
                    <a href="{{ route('rss') }}" class="text-gray-400 hover:text-white text-sm">RSS</a>
                </div>
            </div>
        </div>
    </div>
</footer>

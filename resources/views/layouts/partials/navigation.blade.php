<nav class="bg-primary text-white">
    <div class="container mx-auto px-4">
        <ul class="flex">
            @if(isset($main_navigation) && is_array($main_navigation))
                @foreach($main_navigation as $navItem)
                    <li class="relative group">
                        <a href="{{ url($navItem['url']) }}" class="block px-4 py-3 hover:bg-primary/80 flex items-center">
                            {{ $navItem['title'] }}
                            @if(!empty($navItem['children']))
                                <i class="ri-arrow-down-s-line ml-1"></i>
                            @endif
                        </a>
                        @if(!empty($navItem['children']))
                            <div class="absolute top-full left-0 bg-white text-gray-800 shadow-lg rounded-md w-56 z-50 opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-all duration-300">
                                <div class="py-2">
                                    @foreach($navItem['children'] as $childItem)
                                        <a href="{{ url($childItem['url']) }}" class="block px-4 py-2 hover:bg-gray-100">
                                            {{ $childItem['title'] }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</nav>

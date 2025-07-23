<!-- Breadcrumb -->
<div class="bg-gray-100 py-3">
    <div class="container mx-auto px-4">
        <div class="flex items-center text-sm text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-primary">Trang chủ</a>
            <span class="mx-2">
                <i class="ri-arrow-right-s-line"></i>
            </span>
            
            @if(isset($level) && $level && isset($subject) && $subject && isset($province) && $province)
                <a href="{{ route('centers.index') }}" class="hover:text-primary">Trung tâm</a>
                <span class="mx-2">
                    <i class="ri-arrow-right-s-line"></i>
                </span>
                <a href="{{ route('centers.by-level', $level->slug) }}" class="hover:text-primary">{{ $level->name }}</a>
                <span class="mx-2">
                    <i class="ri-arrow-right-s-line"></i>
                </span>
                <a href="{{ route('centers.by-level-subject', [$level->slug, $subject->slug]) }}" class="hover:text-primary">{{ $subject->name }}</a>
                <span class="mx-2">
                    <i class="ri-arrow-right-s-line"></i>
                </span>
                <span class="text-primary font-medium">{{ $province->name }}</span>
            @elseif(isset($level) && $level && isset($subject) && $subject)
                <a href="{{ route('centers.index') }}" class="hover:text-primary">Trung tâm</a>
                <span class="mx-2">
                    <i class="ri-arrow-right-s-line"></i>
                </span>
                <a href="{{ route('centers.by-level', $level->slug) }}" class="hover:text-primary">{{ $level->name }}</a>
                <span class="mx-2">
                    <i class="ri-arrow-right-s-line"></i>
                </span>
                <span class="text-primary font-medium">{{ $subject->name }}</span>
            @elseif(isset($level) && $level && isset($province) && $province)
                <a href="{{ route('centers.index') }}" class="hover:text-primary">Trung tâm</a>
                <span class="mx-2">
                    <i class="ri-arrow-right-s-line"></i>
                </span>
                <a href="{{ route('centers.by-level', $level->slug) }}" class="hover:text-primary">{{ $level->name }}</a>
                <span class="mx-2">
                    <i class="ri-arrow-right-s-line"></i>
                </span>
                <span class="text-primary font-medium">{{ $province->name }}</span>
            @elseif(isset($subject) && $subject && isset($province) && $province)
                <a href="{{ route('centers.index') }}" class="hover:text-primary">Trung tâm</a>
                <span class="mx-2">
                    <i class="ri-arrow-right-s-line"></i>
                </span>
                <a href="{{ route('centers.by-subject', $subject->slug) }}" class="hover:text-primary">{{ $subject->name }}</a>
                <span class="mx-2">
                    <i class="ri-arrow-right-s-line"></i>
                </span>
                <span class="text-primary font-medium">{{ $province->name }}</span>
            @elseif(isset($level) && $level)
                <a href="{{ route('centers.index') }}" class="hover:text-primary">Trung tâm</a>
                <span class="mx-2">
                    <i class="ri-arrow-right-s-line"></i>
                </span>
                <span class="text-primary font-medium">{{ $level->name }}</span>
            @elseif(isset($subject) && $subject)
                <a href="{{ route('centers.index') }}" class="hover:text-primary">Trung tâm</a>
                <span class="mx-2">
                    <i class="ri-arrow-right-s-line"></i>
                </span>
                <span class="text-primary font-medium">{{ $subject->name }}</span>
            @elseif(isset($province) && $province)
                <a href="{{ route('centers.index') }}" class="hover:text-primary">Trung tâm</a>
                <span class="mx-2">
                    <i class="ri-arrow-right-s-line"></i>
                </span>
                <span class="text-primary font-medium">{{ $province->name }}</span>
            @else
                <span class="text-primary font-medium">Trung tâm</span>
            @endif
        </div>
    </div>
</div>

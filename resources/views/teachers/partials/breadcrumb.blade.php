<div class="bg-gray-100 py-3">
    <div class="container mx-auto px-4">
        <div class="flex items-center text-sm text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-primary">Trang chủ</a>
            <span class="mx-2">
                <i class="ri-arrow-right-s-line"></i>
            </span>
            <a href="{{ route('teachers.index') }}" class="hover:text-primary">Giáo viên</a>
            
            @if(isset($level) && $level)
                <span class="mx-2">
                    <i class="ri-arrow-right-s-line"></i>
                </span>
                <span class="text-primary font-medium">{{ $level->name }}</span>
            @endif
            
            @if(isset($subject) && $subject)
                <span class="mx-2">
                    <i class="ri-arrow-right-s-line"></i>
                </span>
                <span class="text-primary font-medium">{{ $subject->name }}</span>
            @endif
            
            @if(isset($province) && $province)
                <span class="mx-2">
                    <i class="ri-arrow-right-s-line"></i>
                </span>
                <span class="text-primary font-medium">{{ $province->name }}</span>
            @endif
        </div>
    </div>
</div>

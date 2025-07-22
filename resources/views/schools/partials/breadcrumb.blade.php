<!-- Breadcrumb -->
<div class="bg-gray-100 py-3">
    <div class="container mx-auto px-4">
        <div class="flex items-center text-sm text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-primary">Trang chủ</a>
            <span class="mx-2">
                <i class="ri-arrow-right-s-line"></i>
            </span>
            <a href="{{ route('schools.index') }}" class="hover:text-primary">Trường học</a>
            
            @if(isset($level) && $level)
                <span class="mx-2"><i class="ri-arrow-right-s-line"></i></span>
                @if(isset($school))
                    <a href="{{ route('schools.by-level', $level->slug) }}" class="hover:text-primary">{{ $level->name }}</a>
                @else
                    <span class="text-primary font-medium">{{ $level->name }}</span>
                @endif
            @endif
            
            @if(isset($province) && $province)
                <span class="mx-2"><i class="ri-arrow-right-s-line"></i></span>
                @if(isset($school))
                    <a href="{{ route('schools.by-province', $province->slug) }}" class="hover:text-primary">{{ $province->name }}</a>
                @else
                    <span class="text-primary font-medium">{{ $province->name }}</span>
                @endif
            @endif
            
            @if(isset($schoolType) && $schoolType)
                <span class="mx-2"><i class="ri-arrow-right-s-line"></i></span>
                @if(isset($school))
                    <a href="{{ route('schools.by-type', $schoolType->slug) }}" class="hover:text-primary">{{ $schoolType->name }}</a>
                @else
                    <span class="text-primary font-medium">{{ $schoolType->name }}</span>
                @endif
            @endif
            
            @if(isset($school))
                <span class="mx-2"><i class="ri-arrow-right-s-line"></i></span>
                <span class="text-primary font-medium">{{ $school->name }}</span>
            @endif
        </div>
    </div>
</div>

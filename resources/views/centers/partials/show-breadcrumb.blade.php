<!-- Breadcrumb -->
<div class="bg-gray-100 py-3">
    <div class="container mx-auto px-4">
        <div class="flex items-center text-sm text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-primary">Trang chủ</a>
            <span class="mx-2">
                <i class="ri-arrow-right-s-line"></i>
            </span>
            <a href="#" class="hover:text-primary">Giáo viên & Trung tâm</a>
            <span class="mx-2">
                <i class="ri-arrow-right-s-line"></i>
            </span>
            <a href="{{ route('centers.index') }}" class="hover:text-primary">Trung tâm</a>
            <span class="mx-2">
                <i class="ri-arrow-right-s-line"></i>
            </span>
            <span class="text-primary font-medium">{{ $center->name }}</span>
        </div>
    </div>
</div>

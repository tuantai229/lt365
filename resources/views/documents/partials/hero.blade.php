<!-- Breadcrumb -->
<div class="bg-gray-100 py-3">
    <div class="container mx-auto px-4">
        <div class="flex items-center text-sm text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-primary">Trang chủ</a>
            <span class="mx-2">
                <i class="ri-arrow-right-s-line"></i>
            </span>
            <span class="text-primary font-medium">Tài liệu & Đề thi</span>
        </div>
    </div>
</div>
<!-- Hero Banner -->
<section class="relative overflow-hidden bg-gray-100">
    <div class="container mx-auto px-4 py-6">
        <div class="relative w-full overflow-hidden rounded-lg shadow-lg" style="height: 350px; background-image: url('{{ asset('html/images/bb4d0c34d4f0b44aedef392759b46b9d.jpg') }}'); background-size: cover; background-position: center;">
            <div class="absolute inset-0 bg-gradient-to-r from-primary/80 to-transparent"></div>
            <div class="absolute inset-0 flex items-center">
                <div class="w-full container mx-auto px-4 md:px-10 flex">
                    <div class="w-1/2 text-white">
                        <h1 class="text-4xl font-bold mb-4">Tài liệu & Đề thi chuyển cấp</h1>
                        <p class="text-lg mb-6">Kho tài liệu phong phú với hàng nghìn đề thi, bài tập và tài liệu ôn tập cho mọi cấp học từ tiểu học đến THPT</p>
                        <div class="flex gap-4">
                            <button class="px-6 py-3 bg-white text-primary font-medium rounded-button hover:bg-gray-100 transition-colors duration-200 whitespace-nowrap !rounded-button">Tìm tài liệu</button>
                            <button class="px-6 py-3 bg-secondary text-white font-medium rounded-button hover:bg-secondary/90 transition-colors duration-200 whitespace-nowrap !rounded-button">Tải miễn phí</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

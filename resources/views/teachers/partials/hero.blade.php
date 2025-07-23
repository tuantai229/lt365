<section class="relative overflow-hidden bg-gray-100">
    <div class="container mx-auto px-4 py-6">
        <div class="relative w-full overflow-hidden rounded-lg shadow-lg" style="height: 300px; background-image: url('{{ asset('html/images/slide-giaovien.png') }}'); background-size: cover; background-position: center;">
            <div class="absolute inset-0 bg-gradient-to-r from-primary/80 to-transparent"></div>
            <div class="absolute inset-0 flex items-center">
                <div class="w-full container mx-auto px-4 md:px-10 flex">
                    <div class="w-2/3 text-white">
                        <h1 class="text-3xl font-bold mb-3">
                            @if(isset($level) && $level)
                                Giáo viên {{ $level->name }} uy tín
                            @elseif(isset($subject) && $subject)
                                Giáo viên {{ $subject->name }} chuyên nghiệp
                            @elseif(isset($province) && $province)
                                Giáo viên tại {{ $province->name }}
                            @else
                                Danh sách giáo viên uy tín
                            @endif
                        </h1>
                        <p class="text-lg mb-4">Tìm kiếm giáo viên có kinh nghiệm và phương pháp giảng dạy hiệu quả cho con bạn</p>
                        <div class="flex items-center gap-6 text-sm">
                            <div class="flex items-center gap-2">
                                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                                    <i class="ri-user-3-line text-white"></i>
                                </div>
                                <div>
                                    <p class="font-medium">{{ $teachers->total() }}+ Giáo viên</p>
                                    <p class="text-white/80">Kinh nghiệm cao</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                                    <i class="ri-graduation-cap-line text-white"></i>
                                </div>
                                <div>
                                    <p class="font-medium">15,000+ Học sinh</p>
                                    <p class="text-white/80">Đã được hỗ trợ</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Hero Banner -->
<section class="relative overflow-hidden bg-gray-100">
    <div class="container mx-auto px-4 py-6">
        <div class="relative w-full overflow-hidden rounded-lg shadow-lg" style="height: 300px; background-image: url('{{ asset('html/images/3d7d5e0502820a5e09cf3fb76caa9d88.jpg') }}'); background-size: cover; background-position: center;">
            <div class="absolute inset-0 bg-gradient-to-r from-primary/80 to-transparent"></div>
            <div class="absolute inset-0 flex items-center">
                <div class="w-full container mx-auto px-4 md:px-10 flex">
                    <div class="w-2/3 text-white">
                        <h1 class="text-3xl font-bold mb-3">
                            @if(isset($level) && $level && isset($subject) && $subject && isset($province) && $province)
                                Trung tâm luyện thi {{ $level->name }} môn {{ $subject->name }} tại {{ $province->name }}
                            @elseif(isset($level) && $level && isset($subject) && $subject)
                                Trung tâm luyện thi {{ $level->name }} môn {{ $subject->name }}
                            @elseif(isset($level) && $level && isset($province) && $province)
                                Trung tâm luyện thi {{ $level->name }} tại {{ $province->name }}
                            @elseif(isset($subject) && $subject && isset($province) && $province)
                                Trung tâm dạy {{ $subject->name }} tại {{ $province->name }}
                            @elseif(isset($level) && $level)
                                Trung tâm luyện thi {{ $level->name }}
                            @elseif(isset($subject) && $subject)
                                Trung tâm dạy {{ $subject->name }}
                            @elseif(isset($province) && $province)
                                Trung tâm luyện thi tại {{ $province->name }}
                            @else
                                Danh sách trung tâm luyện thi
                            @endif
                        </h1>
                        <p class="text-lg mb-4">Khám phá và tìm hiểu thông tin chi tiết về các trung tâm luyện thi chuyển cấp uy tín trên toàn quốc</p>
                        <div class="flex items-center gap-6 text-sm">
                            <div class="flex items-center gap-2">
                                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                                    <i class="ri-building-line text-xl"></i>
                                </div>
                                <span class="font-medium">{{ $centers->total() }}+ trung tâm</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                                    <i class="ri-user-star-line text-xl"></i>
                                </div>
                                <span class="font-medium">Giáo viên giỏi</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                                    <i class="ri-map-pin-line text-xl"></i>
                                </div>
                                <span class="font-medium">Toàn quốc</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

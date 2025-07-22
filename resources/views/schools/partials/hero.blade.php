<!-- Hero Banner -->
<section class="relative overflow-hidden bg-gray-100">
    <div class="container mx-auto px-4 py-6">
        <div class="relative w-full overflow-hidden rounded-lg shadow-lg" style="height: 300px; background-image: url('{{ asset('html/images/3d7d5e0502820a5e09cf3fb76caa9d88.jpg') }}'); background-size: cover; background-position: center;">
            <div class="absolute inset-0 bg-gradient-to-r from-primary/80 to-transparent"></div>
            <div class="absolute inset-0 flex items-center">
                <div class="w-full container mx-auto px-4 md:px-10 flex">
                    <div class="w-2/3 text-white">
                        <h1 class="text-3xl font-bold mb-3">
                            @if(isset($level) && $level)
                                Danh sách trường {{ $level->name }}
                            @elseif(isset($province) && $province)
                                Trường học tại {{ $province->name }}
                            @elseif(isset($schoolType) && $schoolType)
                                Trường {{ $schoolType->name }}
                            @else
                                Danh sách trường học
                            @endif
                        </h1>
                        <p class="text-lg mb-4">
                            @if(isset($level) && $level)
                                Khám phá và tìm hiểu thông tin chi tiết về các trường {{ $level->name }} chất lượng cao trên toàn quốc
                            @elseif(isset($province) && $province)
                                Tìm hiểu thông tin về các trường học chất lượng cao tại {{ $province->name }}
                            @elseif(isset($schoolType) && $schoolType)
                                Danh sách các trường {{ $schoolType->name }} uy tín và chất lượng
                            @else
                                Khám phá và tìm hiểu thông tin chi tiết về các trường học chất lượng cao trên toàn quốc
                            @endif
                        </p>
                        <div class="flex items-center gap-6 text-sm">
                            <div class="flex items-center gap-2">
                                <i class="ri-building-4-line text-lg"></i>
                                <span>{{ $schools->total() ?? 0 }}+ trường học</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="ri-map-pin-line text-lg"></i>
                                <span>
                                    @if(isset($province) && $province)
                                        {{ $province->name }}
                                    @else
                                        34 tỉnh thành
                                    @endif
                                </span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="ri-information-line text-lg"></i>
                                <span>Cập nhật {{ date('Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

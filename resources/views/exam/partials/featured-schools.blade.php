<!-- Danh sách trường nổi bật -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10">Trường 
            @switch($grade)
                @case(1)
                    tiểu học
                    @break
                @case(6)
                    THCS
                    @break
                @case(10)
                    THPT
                    @break
            @endswitch
            nổi bật
        </h2>
        
        @if(!empty($featuredSchools) && count($featuredSchools) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
                @foreach($featuredSchools as $school)
                    @include('schools.partials.school-card', ['school' => $school])
                @endforeach
            </div>
            
            <div class="text-center mt-8">
                <a href="{{ route('schools.by-level', ['levelSlug' => $featuredSchools->first()->level->slug ?? '']) }}" class="inline-flex items-center text-primary font-medium hover:underline">
                    Khám phá tất cả các trường
                    <i class="ri-arrow-right-line ml-1"></i>
                </a>
            </div>
        @else
            <div class="bg-white rounded-lg p-8 text-center max-w-2xl mx-auto border">
                <div class="text-gray-400 mb-4">
                    <i class="ri-building-line text-5xl"></i>
                </div>
                <h4 class="text-xl font-medium text-gray-700 mb-2">Chưa có trường nổi bật</h4>
                <p class="text-gray-500">
                    Hiện tại chưa có trường nổi bật nào cho 
                    @switch($grade)
                        @case(1)
                            cấp tiểu học
                            @break
                        @case(6)
                            cấp THCS
                            @break
                        @case(10)
                            cấp THPT
                            @break
                    @endswitch. 
                    Chúng tôi đang cập nhật dữ liệu.
                </p>
            </div>
        @endif
    </div>
</section>

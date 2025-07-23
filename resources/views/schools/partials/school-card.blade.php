<!-- School Card -->
<div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
    <a href="{{ route('schools.show', [$school->slug ?? 'school', $school->id]) }}" class="block h-40 bg-gray-100">
        <img src="{{ get_image_url($school->featured_image_url) }}" alt="{{ $school->name }}" class="w-full h-full object-cover object-top">
    </a>
    <div class="p-5">
        <div class="flex items-start justify-between mb-3">
            <div class="flex-1">
                <a href="{{ route('schools.show', [$school->slug ?? 'school', $school->id]) }}">
                    <h3 class="font-bold text-lg mb-1 hover:text-primary transition-colors">{{ $school->name }}</h3>
                </a>
                <p class="text-sm text-gray-600 flex items-center">
                    <i class="ri-map-pin-line mr-1"></i>
                    {{ $school->province->name ?? 'Chưa xác định' }}
                </p>
            </div>
            <button class="text-gray-400 hover:text-red-500 transition-colors duration-200" data-favorite-btn data-school-id="{{ $school->id }}">
                <i class="ri-heart-line text-lg"></i>
            </button>
        </div>
        
        <div class="flex gap-2 mb-4">
            @foreach($school->schoolTypes as $type)
                <span class="px-2 py-1 {{ $type->slug == 'cong-lap' ? 'bg-blue-100 text-blue-800' : ($type->slug == 'tu-thuc' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800') }} text-xs rounded-full">
                    {{ $type->name }}
                </span>
            @endforeach
            
            @if($school->level)
                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">{{ $school->level->name }}</span>
            @endif
        </div>
        
        <div class="space-y-2 mb-4">
            <div class="flex items-center justify-between text-sm">
                <span class="text-gray-600 flex items-center">
                    <i class="ri-group-line mr-2 text-primary"></i>
                    Chỉ tiêu:
                </span>
                <span class="font-medium">{{ number_format($school->latestAdmission->total_students ?? 0) }} học sinh</span>
            </div>
            <div class="flex items-center justify-between text-sm">
                <span class="text-gray-600 flex items-center">
                    <i class="ri-money-dollar-circle-line mr-2 text-primary"></i>
                    Học phí:
                </span>
                <span class="font-medium {{ isset($school->latestAdmission->estimated_tuition_fee) ? ($school->latestAdmission->estimated_tuition_fee > 0 ? 'text-orange-600' : 'text-green-600') : 'text-gray-500' }}">
                    @if(isset($school->latestAdmission->estimated_tuition_fee))
                        @if($school->latestAdmission->estimated_tuition_fee > 0)
                            {{ number_format($school->latestAdmission->estimated_tuition_fee) }}đ/tháng
                        @else
                            Miễn phí
                        @endif
                    @else
                        Chưa cập nhật
                    @endif
                </span>
            </div>
            <div class="flex items-center justify-between text-sm">
                <span class="text-gray-600 flex items-center">
                    <i class="ri-calendar-line mr-2 text-primary"></i>
                    Tuyển sinh:
                </span>
                <span class="font-medium">
                    @if($school->latestAdmission && $school->latestAdmission->exam_date)
                        {{ \Carbon\Carbon::parse($school->latestAdmission->exam_date)->format('d-m-Y') }}
                    @else
                        Chưa công bố
                    @endif
                </span>
            </div>
        </div>
        
        <div class="flex gap-2">
            <a href="{{ route('schools.show', [$school->slug ?? 'school', $school->id]) }}" 
               class="flex-1 py-2 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors duration-200 text-sm font-medium text-center">
                Xem chi tiết
            </a>
        </div>
    </div>
</div>

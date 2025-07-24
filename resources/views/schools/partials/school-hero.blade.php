<!-- Hero Section -->
<section class="py-8 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Info -->
            <div class="lg:col-span-3">
                <div class="flex flex-col md:flex-row gap-6">
                    <!-- School Logo/Image -->
                    <div class="w-full md:w-48 h-48 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
        <img src="{{ $school->featured_image_url }}" alt="{{ $school->name }}" class="w-full h-full object-cover">
                    </div>
                    
                    <!-- School Details -->
                    <div class="flex-1">
                        <div class="flex gap-2 mb-3">
                            @foreach($school->schoolTypes as $type)
                                <span class="px-3 py-1 {{ $type->slug == 'cong-lap' ? 'bg-blue-100 text-blue-800' : ($type->slug == 'tu-thuc' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800') }} text-sm rounded-full">
                                    {{ $type->name }}
                                </span>
                            @endforeach
                            
                            @if($school->level)
                                <span class="px-3 py-1 bg-green-100 text-green-800 text-sm rounded-full">{{ $school->level->name }}</span>
                            @endif
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <h1 class="text-3xl font-bold text-gray-800">{{ $school->name }}</h1>
                            <button class="text-gray-400 hover:text-red-500 transition-colors duration-200" data-favorite-btn data-school-id="{{ $school->id }}">
                                <i class="ri-heart-line text-2xl"></i>
                            </button>
                        </div>
                        <p class="text-gray-600 mb-4">{{ $school->tagline ?? 'Trường học chất lượng cao với môi trường giáo dục hiện đại và chuyên nghiệp' }}</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                            <div class="flex items-center gap-2">
                                <i class="ri-map-pin-line text-primary"></i>
                                <span class="text-gray-700">{{ $school->province->name ?? 'Chưa xác định' }}</span>
                            </div>
                            @if($school->phone)
                                <div class="flex items-center gap-2">
                                    <i class="ri-phone-line text-primary"></i>
                                    <span class="text-gray-700">{{ $school->phone }}</span>
                                </div>
                            @endif
                            @if($school->website)
                                <div class="flex items-center gap-2">
                                    <i class="ri-global-line text-primary"></i>
                                    <a href="{{ $school->website }}" target="_blank" class="text-gray-700 hover:text-primary">{{ $school->website }}</a>
                                </div>
                            @endif
                            @if($school->email)
                                <div class="flex items-center gap-2">
                                    <i class="ri-mail-line text-primary"></i>
                                    <a href="mailto:{{ $school->email }}" class="text-gray-700 hover:text-primary">{{ $school->email }}</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="space-y-6">
                @if($school->admissionInfo)
                <!-- Quick Stats -->
                <div class="bg-gradient-to-br from-primary to-indigo-700 text-white p-6 rounded-lg">
                    <h3 class="text-lg font-bold mb-4">Tuyển sinh {{ $school->admissionInfo->year }}</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span>Chỉ tiêu:</span>
                            <span class="font-bold">{{ number_format($school->admissionInfo->total_students ?? 0) }} học sinh</span>
                        </div>
                        @if($school->admissionInfo->register_start_date)
                            <div class="flex justify-between">
                                <span>Đăng ký:</span>
                                <span class="font-bold">{{ \Carbon\Carbon::parse($school->admissionInfo->register_start_date)->format('d/m') }} - {{ \Carbon\Carbon::parse($school->admissionInfo->register_end_date ?? $school->admissionInfo->register_start_date)->format('d/m') }}</span>
                            </div>
                        @endif
                        @if($school->admissionInfo->exam_date)
                            <div class="flex justify-between">
                                <span>Thi tuyển:</span>
                                <span class="font-bold">{{ \Carbon\Carbon::parse($school->admissionInfo->exam_date)->format('d/m/Y') }}</span>
                            </div>
                        @endif
                    </div>
                    <button class="w-full mt-4 py-2 bg-white text-primary font-medium rounded-button hover:bg-gray-100 transition-colors duration-200" data-consultation-btn>
                        Tư vấn miễn phí
                    </button>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

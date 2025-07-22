<!-- Main Content -->
<section class="py-8 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-3 space-y-8">
                <!-- About School -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-bold mb-4">Giới thiệu về trường</h2>
                    <div class="prose max-w-none text-gray-700">
                        @if($school->description)
                            {!! nl2br(e($school->description)) !!}
                        @else
                            <p class="mb-4">{{ $school->name }} là một trường học uy tín với chất lượng giáo dục cao. Trường cam kết mang đến cho học sinh một môi trường học tập tốt nhất, phát triển toàn diện cả về kiến thức và kỹ năng.</p>
                            <p class="mb-4">Với đội ngũ giáo viên giàu kinh nghiệm và cơ sở vật chất hiện đại, trường tạo điều kiện tối ưu cho sự phát triển của học sinh.</p>
                            <p>Phương châm giáo dục của trường là "Học tập - Rèn luyện - Sáng tạo", giúp học sinh không chỉ có kiến thức vững vàng mà còn phát triển nhân cách và kỹ năng sống.</p>
                        @endif
                    </div>
                </div>

                <!-- Admission Info -->
                @if($school->admission_quota || $school->admission_start_date)
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h2 class="text-2xl font-bold mb-4 text-primary">Thông tin tuyển sinh 2025</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            @if($school->admission_quota)
                                <div class="p-4 bg-primary/5 rounded-lg">
                                    <h3 class="font-bold text-primary mb-2">Chỉ tiêu tuyển sinh</h3>
                                    <p class="text-2xl font-bold text-gray-800">{{ number_format($school->admission_quota) }} học sinh</p>
                                    @if($school->total_classes)
                                        <p class="text-sm text-gray-600">{{ $school->total_classes }} lớp × {{ $school->total_classes > 0 ? round($school->admission_quota / $school->total_classes) : 0 }} học sinh/lớp</p>
                                    @endif
                                </div>
                            @endif
                            @if($school->tuition_fee !== null)
                                <div class="p-4 bg-green-50 rounded-lg">
                                    <h3 class="font-bold text-green-700 mb-2">Học phí ước tính</h3>
                                    @if($school->tuition_fee > 0)
                                        <p class="text-lg font-bold text-gray-800">{{ number_format($school->tuition_fee) }}đ/tháng</p>
                                        <p class="text-sm text-gray-600">Chương trình chuẩn</p>
                                    @else
                                        <p class="text-lg font-bold text-gray-800">Miễn phí</p>
                                        <p class="text-sm text-gray-600">Trường công lập</p>
                                    @endif
                                </div>
                            @endif
                        </div>

                        @if($school->admission_start_date || $school->exam_date)
                            <div class="space-y-4">
                                @if($school->admission_start_date)
                                    <div>
                                        <h3 class="font-bold text-lg mb-3">Lịch trình tuyển sinh</h3>
                                        <div class="space-y-3">
                                            <div class="flex items-center gap-4 p-3 bg-blue-50 rounded-lg">
                                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                    <i class="ri-calendar-line text-blue-600"></i>
                                                </div>
                                                <div>
                                                    <p class="font-medium">Đăng ký hồ sơ</p>
                                                    <p class="text-sm text-gray-600">
                                                        {{ \Carbon\Carbon::parse($school->admission_start_date)->format('d/m/Y') }} 
                                                        @if($school->admission_end_date) 
                                                            - {{ \Carbon\Carbon::parse($school->admission_end_date)->format('d/m/Y') }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            @if($school->exam_date)
                                                <div class="flex items-center gap-4 p-3 bg-yellow-50 rounded-lg">
                                                    <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                                                        <i class="ri-file-list-line text-yellow-600"></i>
                                                    </div>
                                                    <div>
                                                        <p class="font-medium">Thi tuyển</p>
                                                        <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($school->exam_date)->format('d/m/Y (l)') }}</p>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($school->result_date)
                                                <div class="flex items-center gap-4 p-3 bg-green-50 rounded-lg">
                                                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                                        <i class="ri-megaphone-line text-green-600"></i>
                                                    </div>
                                                    <div>
                                                        <p class="font-medium">Công bố kết quả</p>
                                                        <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($school->result_date)->format('d/m/Y') }}</p>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Statistics -->
                @if(isset($school->admissionStats) && $school->admissionStats->count() > 0)
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h2 class="text-2xl font-bold mb-4">Thống kê tuyển sinh</h2>
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="border border-gray-200 p-3 text-left">Năm học</th>
                                        <th class="border border-gray-200 p-3 text-center">Chỉ tiêu</th>
                                        <th class="border border-gray-200 p-3 text-center">Đăng ký</th>
                                        <th class="border border-gray-200 p-3 text-center">Tỷ lệ chọi</th>
                                        <th class="border border-gray-200 p-3 text-center">Điểm chuẩn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($school->admissionStats->sortByDesc('year') as $stat)
                                        <tr class="{{ $loop->even ? 'bg-gray-50' : '' }}">
                                            <td class="border border-gray-200 p-3 font-medium">{{ $stat->year }}</td>
                                            <td class="border border-gray-200 p-3 text-center">{{ number_format($stat->quota) }}</td>
                                            <td class="border border-gray-200 p-3 text-center">{{ number_format($stat->applications) }}</td>
                                            <td class="border border-gray-200 p-3 text-center">
                                                @if($stat->quota > 0)
                                                    1:{{ round($stat->applications / $stat->quota, 1) }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td class="border border-gray-200 p-3 text-center font-bold text-primary">{{ $stat->cutoff_score }}/{{ $stat->max_score ?? 200 }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <p class="text-sm text-gray-600 mt-4">* Điểm chuẩn tính theo tổng điểm các môn thi (thang điểm {{ $school->admissionStats->first()->max_score ?? 200 }})</p>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Contact Info -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-bold mb-4">Thông tin liên hệ</h3>
                    <div class="space-y-3 text-sm">
                        @if($school->address)
                            <div class="flex items-start gap-2">
                                <i class="ri-map-pin-line text-primary mt-1"></i>
                                <div>
                                    <p class="font-medium">Địa chỉ</p>
                                    <p class="text-gray-600">{{ $school->address }}</p>
                                </div>
                            </div>
                        @endif
                        @if($school->phone)
                            <div class="flex items-start gap-2">
                                <i class="ri-phone-line text-primary mt-1"></i>
                                <div>
                                    <p class="font-medium">Điện thoại</p>
                                    <p class="text-gray-600">{{ $school->phone }}</p>
                                </div>
                            </div>
                        @endif
                        @if($school->email)
                            <div class="flex items-start gap-2">
                                <i class="ri-mail-line text-primary mt-1"></i>
                                <div>
                                    <p class="font-medium">Email</p>
                                    <p class="text-gray-600">{{ $school->email }}</p>
                                </div>
                            </div>
                        @endif
                        @if($school->website)
                            <div class="flex items-start gap-2">
                                <i class="ri-global-line text-primary mt-1"></i>
                                <div>
                                    <p class="font-medium">Website</p>
                                    <a href="{{ $school->website }}" target="_blank" class="text-primary hover:underline">{{ $school->website }}</a>
                                </div>
                            </div>
                        @endif
                        <div class="flex items-start gap-2">
                            <i class="ri-time-line text-primary mt-1"></i>
                            <div>
                                <p class="font-medium">Giờ làm việc</p>
                                <p class="text-gray-600">{{ $school->working_hours ?? '7:30 - 17:00 (Thứ 2 - Thứ 6)' }}</p>
                            </div>
                        </div>
                    </div>
                    <button class="w-full mt-4 py-2 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors text-sm" data-consultation-btn>
                        Liên hệ tư vấn
                    </button>
                </div>

                <!-- Quick Facts -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-bold mb-4">Thông tin cơ bản</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Loại hình:</span>
                            <span class="font-medium">
                                @if($school->schoolTypes->count() > 0)
                                    {{ $school->schoolTypes->pluck('name')->join(', ') }}
                                @else
                                    Chưa xác định
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Cấp học:</span>
                            <span class="font-medium">{{ $school->level->name ?? 'Chưa xác định' }}</span>
                        </div>
                        @if($school->founded_year)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Thành lập:</span>
                                <span class="font-medium">{{ $school->founded_year }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between">
                            <span class="text-gray-600">Số lớp:</span>
                            <span class="font-medium">{{ $school->total_classes ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Học sinh:</span>
                            <span class="font-medium">{{ number_format($school->total_students ?? 0) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Giáo viên:</span>
                            <span class="font-medium">{{ $school->total_teachers ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Hot News -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-bold mb-4">Tin nổi bật</h3>
                    <div class="space-y-3">
                        <a href="#" class="block p-3 bg-gray-50 rounded hover:bg-gray-100 transition-colors">
                            <h4 class="font-medium text-sm mb-1 line-clamp-2">Hướng dẫn đăng ký tuyển sinh online 2025</h4>
                            <div class="flex items-center text-xs text-gray-500">
                                <i class="ri-eye-line mr-1"></i>
                                <span>2,345 lượt xem</span>
                            </div>
                        </a>
                        <a href="#" class="block p-3 bg-gray-50 rounded hover:bg-gray-100 transition-colors">
                            <h4 class="font-medium text-sm mb-1 line-clamp-2">Kinh nghiệm chuẩn bị thi vào {{ $school->level->name ?? 'trường' }}</h4>
                            <div class="flex items-center text-xs text-gray-500">
                                <i class="ri-eye-line mr-1"></i>
                                <span>1,867 lượt xem</span>
                            </div>
                        </a>
                        <a href="#" class="block p-3 bg-gray-50 rounded hover:bg-gray-100 transition-colors">
                            <h4 class="font-medium text-sm mb-1 line-clamp-2">Lịch thi các trường {{ $school->level->name ?? '' }} {{ $school->province->name ?? '' }}</h4>
                            <div class="flex items-center text-xs text-gray-500">
                                <i class="ri-eye-line mr-1"></i>
                                <span>1,456 lượt xem</span>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Download Links -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-bold mb-4">Tài liệu quan trọng</h3>
                    <div class="space-y-3">
                        <a href="#" class="flex items-center gap-3 p-3 bg-blue-50 rounded hover:bg-blue-100 transition-colors" data-download-btn data-file-name="Thông báo tuyển sinh">
                            <i class="ri-download-line text-blue-600"></i>
                            <div>
                                <p class="font-medium text-sm">Thông báo tuyển sinh</p>
                                <p class="text-xs text-gray-600">PDF - 2.5MB</p>
                            </div>
                        </a>
                        <a href="#" class="flex items-center gap-3 p-3 bg-green-50 rounded hover:bg-green-100 transition-colors" data-download-btn data-file-name="Đơn đăng ký">
                            <i class="ri-download-line text-green-600"></i>
                            <div>
                                <p class="font-medium text-sm">Đơn đăng ký</p>
                                <p class="text-xs text-gray-600">DOC - 150KB</p>
                            </div>
                        </a>
                        <a href="#" class="flex items-center gap-3 p-3 bg-purple-50 rounded hover:bg-purple-100 transition-colors" data-download-btn data-file-name="Đề thi mẫu">
                            <i class="ri-download-line text-purple-600"></i>
                            <div>
                                <p class="font-medium text-sm">Đề thi mẫu</p>
                                <p class="text-xs text-gray-600">PDF - 5.2MB</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

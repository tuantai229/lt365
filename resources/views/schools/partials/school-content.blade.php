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
                        @if($school->content)
                            {!! $school->content !!}
                        @else
                            <p class="mb-4">{{ $school->name }} là một trường học uy tín với chất lượng giáo dục cao. Trường cam kết mang đến cho học sinh một môi trường học tập tốt nhất, phát triển toàn diện cả về kiến thức và kỹ năng.</p>
                            <p class="mb-4">Với đội ngũ giáo viên giàu kinh nghiệm và cơ sở vật chất hiện đại, trường tạo điều kiện tối ưu cho sự phát triển của học sinh.</p>
                            <p>Phương châm giáo dục của trường là "Học tập - Rèn luyện - Sáng tạo", giúp học sinh không chỉ có kiến thức vững vàng mà còn phát triển nhân cách và kỹ năng sống.</p>
                        @endif
                    </div>
                </div>

                <!-- Admission Info -->
                @if($school->admissionInfo)
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h2 class="text-2xl font-bold mb-4 text-primary">Thông tin tuyển sinh {{ $school->admissionInfo->year }}</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div class="p-4 bg-primary/5 rounded-lg">
                                <h3 class="font-bold text-primary mb-2">Chỉ tiêu tuyển sinh</h3>
                                <p class="text-2xl font-bold text-gray-800">{{ number_format($school->admissionInfo->total_students) }} học sinh</p>
                                @if($school->admissionInfo->number_of_classes)
                                    <p class="text-sm text-gray-600">{{ $school->admissionInfo->number_of_classes }} lớp × {{ $school->admissionInfo->students_per_class }} học sinh/lớp</p>
                                @endif
                            </div>
                            <div class="p-4 bg-green-50 rounded-lg">
                                <h3 class="font-bold text-green-700 mb-2">Học phí ước tính</h3>
                                @if($school->admissionInfo->estimated_tuition_fee > 0)
                                    <p class="text-lg font-bold text-gray-800">{{ number_format($school->admissionInfo->estimated_tuition_fee) }}đ/tháng</p>
                                    <p class="text-sm text-gray-600">{{ $school->admissionInfo->program_type }}</p>
                                @else
                                    <p class="text-lg font-bold text-gray-800">Miễn phí</p>
                                    <p class="text-sm text-gray-600">Trường công lập</p>
                                @endif
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <h3 class="font-bold text-lg mb-3">Lịch trình tuyển sinh</h3>
                                <div class="space-y-3">
                                    @if($school->admissionInfo->register_start_date)
                                    <div class="flex items-center gap-4 p-3 bg-blue-50 rounded-lg">
                                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                            <i class="ri-calendar-line text-blue-600"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium">Đăng ký hồ sơ</p>
                                            <p class="text-sm text-gray-600">
                                                {{ \Carbon\Carbon::parse($school->admissionInfo->register_start_date)->format('d/m/Y') }} 
                                                @if($school->admissionInfo->register_end_date) 
                                                    - {{ \Carbon\Carbon::parse($school->admissionInfo->register_end_date)->format('d/m/Y') }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    @endif
                                    @if($school->admissionInfo->exam_date)
                                        <div class="flex items-center gap-4 p-3 bg-yellow-50 rounded-lg">
                                            <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                                                <i class="ri-file-list-line text-yellow-600"></i>
                                            </div>
                                            <div>
                                                <p class="font-medium">Thi tuyển</p>
                                                <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($school->admissionInfo->exam_date)->format('d/m/Y (l)') }}</p>
                                            </div>
                                        </div>
                                    @endif
                                    @if($school->admissionInfo->result_announcement_date)
                                        <div class="flex items-center gap-4 p-3 bg-green-50 rounded-lg">
                                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                                <i class="ri-megaphone-line text-green-600"></i>
                                            </div>
                                            <div>
                                                <p class="font-medium">Công bố kết quả</p>
                                                <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($school->admissionInfo->result_announcement_date)->format('d/m/Y') }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
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
                                    @foreach($school->admissionStats->sortByDesc('academic_year') as $stat)
                                        <tr class="{{ $loop->even ? 'bg-gray-50' : '' }}">
                                            <td class="border border-gray-200 p-3 font-medium">{{ $stat->academic_year }}</td>
                                            <td class="border border-gray-200 p-3 text-center">{{ number_format($stat->target_quota) }}</td>
                                            <td class="border border-gray-200 p-3 text-center">{{ number_format($stat->registered_count) }}</td>
                                            <td class="border border-gray-200 p-3 text-center">
                                                @if($stat->target_quota > 0 && $stat->registered_count > 0)
                                                    1:{{ round($stat->registered_count / $stat->target_quota, 1) }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td class="border border-gray-200 p-3 text-center font-bold text-primary">{{ $stat->cutoff_score }}/{{ $stat->cutoff_score_max ?? 50 }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <p class="text-sm text-gray-600 mt-4">* Điểm chuẩn có thể thay đổi tùy theo phương thức xét tuyển.</p>
                    </div>
                @endif

                @include('schools.partials.school-news', ['schoolNews' => $schoolNews])
                @include('schools.partials.school-documents', ['schoolDocuments' => $schoolDocuments])
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
                    </div>
                    <button class="w-full mt-4 py-2 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors text-sm" data-consultation-btn>
                        Liên hệ tư vấn
                    </button>
                </div>

                <!-- Hot News -->
                @if($featuredNews->count() > 0)
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-bold mb-4">Tin nổi bật</h3>
                    <div class="space-y-3">
                        @foreach($featuredNews as $news)
                        <a href="{{ route('news.show', ['slug' => $news->slug, 'id' => $news->id]) }}" class="block p-3 bg-gray-50 rounded hover:bg-gray-100 transition-colors">
                            <h4 class="font-medium text-sm mb-1 line-clamp-2">{{ $news->name }}</h4>
                            <div class="flex items-center text-xs text-gray-500">
                                <i class="ri-eye-line mr-1"></i>
                                <span>{{ number_format($news->view_count) }} lượt xem</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</section>

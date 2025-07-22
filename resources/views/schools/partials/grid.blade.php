<!-- School List Section -->
<section class="py-8 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Results Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-800">
                    @if($schools->total() > 0)
                        Tìm thấy {{ $schools->total() }} trường học
                    @else
                        Không tìm thấy trường học nào
                    @endif
                </h2>
                @if($schools->total() > 0)
                    <p class="text-sm text-gray-600 mt-1">
                        Hiển thị {{ $schools->firstItem() ?? 0 }} - {{ $schools->lastItem() ?? 0 }} trong tổng số {{ $schools->total() }} kết quả
                    </p>
                @endif
            </div>
        </div>

        @if($schools->count() > 0)
            <div id="school-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($schools as $school)
                    @include('schools.partials.school-card', ['school' => $school])
                @endforeach
            </div>

            <!-- Pagination -->
            @if($schools->hasPages())
                <div class="mt-8">
                    {{ $schools->links('vendor.pagination.custom') }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="mb-6">
                    <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="ri-building-4-line text-4xl text-gray-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Không tìm thấy trường học nào</h3>
                    <p class="text-gray-600 mb-6">
                        @if(request('search'))
                            Không có trường học nào phù hợp với từ khóa "{{ request('search') }}"
                        @elseif(isset($level) || isset($province) || isset($schoolType))
                            Không có trường học nào phù hợp với bộ lọc đã chọn
                        @else
                            Hiện tại chưa có dữ liệu trường học nào
                        @endif
                    </p>
                    <div class="space-y-2">
                        <p class="text-sm text-gray-500">Thử:</p>
                        <ul class="text-sm text-gray-500 space-y-1">
                            <li>• Kiểm tra chính tả từ khóa tìm kiếm</li>
                            <li>• Sử dụng từ khóa khác</li>
                            <li>• Bỏ bớt điều kiện lọc</li>
                        </ul>
                    </div>
                    <a href="{{ route('schools.index') }}" class="inline-flex items-center gap-2 mt-6 px-6 py-3 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors duration-200">
                        <i class="ri-refresh-line"></i>
                        Xem tất cả trường học
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

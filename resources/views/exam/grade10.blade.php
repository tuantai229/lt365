@extends('layouts.app')

@section('title', 'Thi vào lớp 10 - Bước ngoặt quan trọng')

@section('content')
    <!-- Breadcrumb -->
    <div class="bg-gray-100 py-3">
        <div class="container mx-auto px-4">
            <div class="flex items-center text-sm text-gray-600">
                <a href="{{ route('home') }}" class="hover:text-primary">Trang chủ</a>
                <span class="mx-2">
                    <i class="ri-arrow-right-s-line"></i>
                </span>
                <a href="{{ route('exam.index') }}" class="hover:text-primary">Thi chuyển cấp</a>
                <span class="mx-2">
                    <i class="ri-arrow-right-s-line"></i>
                </span>
                <span class="text-primary font-medium">Thi vào lớp 10</span>
            </div>
        </div>
    </div>

    <!-- Hero Banner -->
    <section class="relative overflow-hidden bg-gray-100">
        <div class="container mx-auto px-4 py-6">
            <div class="relative w-full overflow-hidden rounded-lg shadow-lg" style="height: 450px; background-image: url('{{ asset('html/images/slide-lichthi.png') }}'); background-size: cover; background-position: center;">
                <div class="absolute inset-0 bg-gradient-to-r from-primary/80 to-transparent"></div>
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full container mx-auto px-4 md:px-10 flex">
                        <div class="w-1/2 text-white">
                            <h1 class="text-4xl font-bold mb-4">Thi vào lớp 10 - Bước ngoặt quan trọng</h1>
                            <p class="text-lg mb-6">Tổng hợp thông tin tuyển sinh, điểm chuẩn các trường THPT, đề thi các năm và chiến lược ôn thi hiệu quả cho kỳ thi vào lớp 10.</p>
                            <div class="flex gap-4">
                                <button class="px-6 py-3 bg-white text-primary font-medium rounded-button hover:bg-gray-100 transition-colors duration-200 whitespace-nowrap !rounded-button">Xem điểm chuẩn các trường</button>
                                <button class="px-6 py-3 bg-secondary text-white font-medium rounded-button hover:bg-secondary/90 transition-colors duration-200 whitespace-nowrap !rounded-button">Thi thử online</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('exam.partials.admission-info', ['grade' => 10])
    @include('exam.partials.featured-schools', ['grade' => 10])
    @include('exam.partials.documents', ['grade' => 10])
    {{-- @include('exam.partials.school-selection-advice', ['grade' => 10]) --}}
    @include('exam.partials.preparation-timeline-grade10')
    @include('exam.partials.faq-grade10')
    @include('exam.partials.cta', ['grade' => 10])
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/exam.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/exam.js') }}"></script>
    <script src="{{ asset('js/newsletter.js') }}" defer></script>
@endpush

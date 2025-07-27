@extends('layouts.app')

@section('title', 'Thi vào lớp 6 - Chinh phục trường chuyên, lớp chọn')

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
                <span class="text-primary font-medium">Thi vào lớp 6</span>
            </div>
        </div>
    </div>

    <!-- Hero Banner -->
    <section class="relative overflow-hidden bg-gray-100">
        <div class="container mx-auto px-4 py-6">
            <div class="relative w-full overflow-hidden rounded-lg shadow-lg" style="height: 450px; background-image: url('{{ asset('html/images/slide-giaovien.png') }}'); background-size: cover; background-position: center;">
                <div class="absolute inset-0 bg-gradient-to-r from-primary/80 to-transparent"></div>
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full container mx-auto px-4 md:px-10 flex">
                        <div class="w-1/2 text-white">
                            <h1 class="text-4xl font-bold mb-4">Thi vào lớp 6 - Chinh phục trường chuyên, lớp chọn</h1>
                            <p class="text-lg mb-6">Cung cấp thông tin mới nhất về các trường THCS chất lượng cao, phương án tuyển sinh, và bộ đề thi thử sát với cấu trúc thi thật.</p>
                            <div class="flex gap-4">
                                <button class="px-6 py-3 bg-white text-primary font-medium rounded-button hover:bg-gray-100 transition-colors duration-200 whitespace-nowrap !rounded-button">Xem danh sách trường</button>
                                <button class="px-6 py-3 bg-secondary text-white font-medium rounded-button hover:bg-secondary/90 transition-colors duration-200 whitespace-nowrap !rounded-button">Luyện đề thi online</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('exam.partials.admission-info', ['grade' => 6])
    @include('exam.partials.featured-schools', ['grade' => 6])
    @include('exam.partials.documents', ['grade' => 6])
    @include('exam.partials.school-selection-advice', ['grade' => 6])
    @include('exam.partials.preparation-timeline-grade6')
    @include('exam.partials.faq-grade6')
    @include('exam.partials.cta', ['grade' => 6])
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/exam.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/exam.js') }}"></script>
    <script src="{{ asset('js/newsletter.js') }}" defer></script>
@endpush

@extends('layouts.app')

@section('title', 'Thi chuyển cấp')

@section('breadcrumb')
    @include('layouts.partials.breadcrumb', [
        'items' => [
            ['name' => 'Trang chủ', 'url' => route('home')],
            ['name' => 'Thi chuyển cấp', 'url' => '#'],
        ]
    ])
@endsection

@section('content')
    @include('exam.partials.hero-banner')
    @include('exam.partials.levels')
    @include('exam.partials.timeline')
    @include('exam.partials.comparison-table')
    @include('exam.partials.preparation-steps')
    @include('exam.partials.free-documents')
    @include('exam.partials.faq')
    @include('exam.partials.cta-form')
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/exam.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/exam.js') }}"></script>
    <script src="{{ asset('js/cta-contact-form.js') }}" defer></script>
@endpush

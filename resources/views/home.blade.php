@extends('layouts.app')

@section('title', 'LT365 - Đồng hành cùng con vào trường chuyên')

@section('content')
    @include('home.hero-banner')
    @include('home.quick-transfer')
    @include('home.smart-search')
    @include('home.featured-documents')
    @include('home.news-schedule')
    @include('home.teachers-centers')
    @include('home.stats-reviews')
    @include('layouts.components.newsletter-form')
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/home.js') }}"></script>
@endpush

@extends('layouts.app')

@section('title', 'Tài liệu & Đề thi - Kho tài liệu ôn thi chuyển cấp | LT365')

@section('content')
    @include('documents.partials.hero')
    @include('documents.partials.filters')
    @include('documents.partials.grid')
    @include('partials.cta-request')
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Filter functionality
            const filterTags = document.querySelectorAll('.filter-tag');
            
            filterTags.forEach(tag => {
                tag.addEventListener('click', function() {
                    // Remove active state from all tags
                    filterTags.forEach(t => {
                        t.classList.remove('bg-primary', 'text-white');
                        t.classList.add('bg-gray-100', 'text-gray-700');
                    });
                    
                    // Add active state to clicked tag
                    this.classList.remove('bg-gray-100', 'text-gray-700');
                    this.classList.add('bg-primary', 'text-white');
                });
            });
        });
    </script>
@endpush

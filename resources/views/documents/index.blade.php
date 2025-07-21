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
        const levelFilter = document.getElementById('level-filter');
        const subjectFilter = document.getElementById('subject-filter');
        const typeFilter = document.getElementById('type-filter');
        const sortFilter = document.getElementById('sort-filter');

        function buildUrl() {
            let level = levelFilter.value;
            let subject = subjectFilter.value;
            let type = typeFilter.value;
            let sort = sortFilter.value;

            let parts = ['/tai-lieu'];
            if (type) parts.push(type);
            if (level) parts.push('cap-' + level);
            if (subject) parts.push('mon-' + subject);

            let url = parts.join('/');
            
            const queryParams = new URLSearchParams(window.location.search);
            
            if (sort) {
                queryParams.set('sort', sort);
            } else {
                queryParams.delete('sort');
            }
            
            // Remove filter if it exists, as it's handled by the URL path
            queryParams.delete('filter');

            const queryString = queryParams.toString();
            return queryString ? url + '?' + queryString : url;
        }

        function applyFilters() {
            window.location.href = buildUrl();
        }

        levelFilter.addEventListener('change', applyFilters);
        subjectFilter.addEventListener('change', applyFilters);
        typeFilter.addEventListener('change', applyFilters);
        sortFilter.addEventListener('change', applyFilters);
    });
</script>
@endpush

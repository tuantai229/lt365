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
        const filterForm = document.getElementById('document-filter-form');
        const sortFilter = document.getElementById('sort-filter');

        // Handle form submission
        filterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const level = document.getElementById('level-filter').value;
            const subject = document.getElementById('subject-filter').value;
            const type = document.getElementById('type-filter').value;
            
            let parts = ['/tai-lieu'];
            
            // Strict ordering to match web.php routes
            if (type) {
                parts.push(type);
            }
            if (level) {
                parts.push(`cap-${level}`);
            }
            if (subject) {
                parts.push(`mon-${subject}`);
            }

            let url = parts.join('/');
            
            // Preserve existing query parameters like 'sort' or 'filter'
            const queryParams = new URLSearchParams(window.location.search);
            
            // Clean up params that are now in the path
            queryParams.delete('level');
            queryParams.delete('subject');
            queryParams.delete('type');

            const queryString = queryParams.toString();
            window.location.href = queryString ? `${url}?${queryString}` : url;
        });

        // Handle sort filter change
        sortFilter.addEventListener('change', function() {
            const sortValue = this.value;
            const currentUrl = new URL(window.location.href);
            
            if (sortValue) {
                currentUrl.searchParams.set('sort', sortValue);
            } else {
                currentUrl.searchParams.delete('sort');
            }
            
            window.location.href = currentUrl.toString();
        });
    });
</script>
@endpush

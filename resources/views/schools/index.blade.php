@extends('layouts.app')

@section('title')
    @if(isset($level) && $level)
        Trường {{ $level->name }} - Danh sách trường {{ $level->name }} chất lượng | LT365
    @elseif(isset($province) && $province)
        Trường học tại {{ $province->name }} - Danh sách trường học {{ $province->name }} | LT365
    @elseif(isset($schoolType) && $schoolType)
        Trường {{ $schoolType->name }} - Danh sách trường {{ $schoolType->name }} | LT365
    @else
        Trường học - Danh sách trường học chất lượng cao trên toàn quốc | LT365
    @endif
@endsection

@section('content')
    @include('schools.partials.breadcrumb')
    @include('schools.partials.hero')
    @include('schools.partials.filters')
    @include('schools.partials.grid')
    @include('partials.cta-request')
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const levelFilter = document.getElementById('level-filter');
        const provinceFilter = document.getElementById('province-filter');
        const typeFilter = document.getElementById('type-filter');
        const sortFilter = document.getElementById('sort-filter');

        function buildUrl() {
            let level = levelFilter.value;
            let province = provinceFilter.value;
            let type = typeFilter.value;
            let sort = sortFilter.value;

            let parts = ['/truong-hoc'];
            
            if (level) parts.push(level);
            if (province) parts.push('tai-' + province);
            if (type) parts.push('he-' + type);

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
        provinceFilter.addEventListener('change', applyFilters);
        typeFilter.addEventListener('change', applyFilters);
        sortFilter.addEventListener('change', applyFilters);

        // Search functionality
        const searchButton = document.querySelector('.search-btn');
        const searchInput = document.querySelector('input[type="search"]');
        
        if (searchButton && searchInput) {
            searchButton.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Get current URL and add search parameter
                const currentUrl = new URL(window.location);
                if (searchInput.value.trim()) {
                    currentUrl.searchParams.set('search', searchInput.value.trim());
                } else {
                    currentUrl.searchParams.delete('search');
                }
                
                window.location.href = currentUrl.toString();
            });

            // Enter key search
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    searchButton.click();
                }
            });
        }

        // Heart/Favorite Toggle
        const heartButtons = document.querySelectorAll('[data-favorite-btn]');
        heartButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const icon = this.querySelector('i');
                const schoolId = this.getAttribute('data-school-id');
                
                if (icon.classList.contains('ri-heart-line')) {
                    icon.classList.remove('ri-heart-line');
                    icon.classList.add('ri-heart-fill');
                    this.classList.remove('text-gray-400', 'hover:text-red-500');
                    this.classList.add('text-red-500', 'hover:text-red-600');
                } else {
                    icon.classList.remove('ri-heart-fill');
                    icon.classList.add('ri-heart-line');
                    this.classList.remove('text-red-500', 'hover:text-red-600');
                    this.classList.add('text-gray-400', 'hover:text-red-500');
                }

                // TODO: Send AJAX request to toggle favorite
                console.log('Toggle favorite for school:', schoolId);
            });
        });
    });
</script>
@endpush

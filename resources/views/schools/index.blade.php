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
        const filterForm = document.getElementById('school-filter-form');
        
        filterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const level = document.getElementById('level-filter').value;
            const province = document.getElementById('province-filter').value;
            const type = document.getElementById('type-filter').value;
            const search = document.querySelector('input[name="search"]').value;
            
            let url = window.location.pathname;
            
            const queryParams = new URLSearchParams(window.location.search);
            
            if (search.trim()) {
                queryParams.set('search', search.trim());
            } else {
                queryParams.delete('search');
            }
            
            const queryString = queryParams.toString();
            window.location.href = queryString ? url + '?' + queryString : url;
        });

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

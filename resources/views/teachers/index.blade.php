@extends('layouts.app')

@section('title')
    @if(isset($level) && $level)
        Giáo viên {{ $level->name }} - Danh sách giáo viên luyện thi {{ $level->name }} | LT365
    @elseif(isset($province) && $province)
        Giáo viên tại {{ $province->name }} - Danh sách giáo viên luyện thi {{ $province->name }} | LT365
    @elseif(isset($subject) && $subject)
        Giáo viên {{ $subject->name }} - Danh sách giáo viên dạy {{ $subject->name }} | LT365
    @else
        Giáo viên luyện thi - Danh sách giáo viên uy tín trên toàn quốc | LT365
    @endif
@endsection

@section('content')
    @include('teachers.partials.breadcrumb')
    @include('teachers.partials.hero')
    @include('teachers.partials.filters')
    @include('teachers.partials.grid')
    @include('partials.cta-request')
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterForm = document.getElementById('teacher-filter-form');
        
        filterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const level = document.getElementById('level-filter').value;
            const province = document.getElementById('province-filter').value;
            const subject = document.getElementById('subject-filter').value;
            const search = document.querySelector('input[name="search"]').value;
            
            let parts = ['/giao-vien'];
            
            if (level) parts.push(level);
            if (subject) parts.push('mon-' + subject);
            if (province) parts.push('tai-' + province);
            
            let url = parts.join('/');
            
            const queryParams = new URLSearchParams();
            
            if (search.trim()) {
                queryParams.set('search', search.trim());
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
                const teacherId = this.getAttribute('data-teacher-id');
                
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
                console.log('Toggle favorite for teacher:', teacherId);
            });
        });
    });
</script>
@endpush

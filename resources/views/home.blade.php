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

@push('scripts')
<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.hero-slide');
    const indicators = document.querySelectorAll('.slide-indicator');
    const totalSlides = slides.length;

    function updateSlide(slideIndex) {
        // Remove active class from all slides and indicators
        slides.forEach((slide, index) => {
            slide.classList.remove('active', 'prev');
            if (index < slideIndex) {
                slide.classList.add('prev');
            } else if (index === slideIndex) {
                slide.classList.add('active');
            }
        });

        indicators.forEach((indicator, index) => {
            indicator.classList.toggle('active', index === slideIndex);
            indicator.style.opacity = index === slideIndex ? '1' : '0.5';
        });

        currentSlide = slideIndex;
    }

    function nextSlide() {
        const nextIndex = (currentSlide + 1) % totalSlides;
        updateSlide(nextIndex);
    }

    function previousSlide() {
        const prevIndex = (currentSlide - 1 + totalSlides) % totalSlides;
        updateSlide(prevIndex);
    }

    function goToSlide(slideIndex) {
        updateSlide(slideIndex);
    }

    // Auto-play slider
    setInterval(nextSlide, 5000);

    // Content slider functionality
    function slideContent(sliderId, direction) {
        const slider = document.getElementById(sliderId);
        const scrollAmount = 300; // Điều chỉnh theo độ rộng item
        
        if (direction === 'next') {
            slider.scrollLeft += scrollAmount;
        } else {
            slider.scrollLeft -= scrollAmount;
        }
        
        // Update button states
        updateSliderButtons(sliderId);
    }

    function updateSliderButtons(sliderId) {
        const slider = document.getElementById(sliderId);
        const prevBtn = document.getElementById(sliderId.replace('Slider', 'Prev'));
        const nextBtn = document.getElementById(sliderId.replace('Slider', 'Next'));
        
        if (prevBtn && nextBtn) {
            // Check if at start
            prevBtn.disabled = slider.scrollLeft <= 0;
            
            // Check if at end
            const maxScroll = slider.scrollWidth - slider.clientWidth;
            nextBtn.disabled = slider.scrollLeft >= maxScroll - 10; // -10 for tolerance
        }
    }

    // Initialize slider buttons on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateSliderButtons('centerSlider');
        updateSliderButtons('teacherSlider');
        updateSliderButtons('reviewSlider');
        
        // Add scroll event listeners to update buttons
        ['centerSlider', 'teacherSlider', 'reviewSlider'].forEach(sliderId => {
            const slider = document.getElementById(sliderId);
            if (slider) {
                slider.addEventListener('scroll', () => updateSliderButtons(sliderId));
            }
        });
    });
</script>
@endpush

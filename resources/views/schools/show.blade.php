@extends('layouts.app')

@section('title', $school->name . ' - Thông tin chi tiết trường học | LT365')

@section('content')
    @include('schools.partials.breadcrumb', ['school' => $school])
    @include('schools.partials.school-hero', ['school' => $school])
    @include('schools.partials.school-content', [
        'school' => $school, 
        'featuredNews' => $featuredNews,
        'schoolNews' => $schoolNews,
        'schoolDocuments' => $schoolDocuments
    ])
    @include('schools.partials.school-cta', ['school' => $school])
    @include('schools.partials.related-schools', ['relatedSchools' => $relatedSchools])
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Form submission handling
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (this.querySelector('textarea')) {
                    // Consultation form
                    alert('Cảm ơn bạn đã đăng ký! Chúng tôi sẽ liên hệ với bạn trong 24h.');
                } else {
                    // Email subscription form
                    alert('Cảm ơn bạn đã đăng ký nhận thông tin!');
                }
            });
        });

        // Gallery image click handling
        const galleryImages = document.querySelectorAll('[data-gallery-img]');
        galleryImages.forEach(img => {
            img.addEventListener('click', function() {
                // Simple lightbox effect
                const overlay = document.createElement('div');
                overlay.className = 'fixed inset-0 bg-black bg-opacity-75 z-50 flex items-center justify-center p-4';
                overlay.onclick = function() {
                    document.body.removeChild(overlay);
                };
                
                const enlargedImg = document.createElement('img');
                enlargedImg.src = this.src;
                enlargedImg.alt = this.alt;
                enlargedImg.className = 'max-w-full max-h-full object-contain rounded-lg';
                
                overlay.appendChild(enlargedImg);
                document.body.appendChild(overlay);
            });
        });

        // Download button click handling
        const downloadButtons = document.querySelectorAll('[data-download-btn]');
        downloadButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const fileName = this.getAttribute('data-file-name') || 'Tài liệu';
                alert(`Đang tải xuống: ${fileName}`);
            });
        });

        // Contact and consultation button handling
        const consultationButtons = document.querySelectorAll('[data-consultation-btn]');
        consultationButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                // Scroll to consultation form if exists, or show modal
                const consultationForm = document.querySelector('[data-consultation-form]');
                if (consultationForm) {
                    consultationForm.scrollIntoView({ behavior: 'smooth' });
                    consultationForm.querySelector('input, textarea')?.focus();
                } else {
                    alert('Chức năng tư vấn đang được phát triển. Vui lòng liên hệ hotline: 0987 654 321');
                }
            });
        });

        // Back to top functionality
        const backToTopButton = document.createElement('button');
        backToTopButton.innerHTML = '<i class="ri-arrow-up-line"></i>';
        backToTopButton.className = 'fixed bottom-6 right-6 w-12 h-12 bg-primary text-white rounded-full shadow-lg hover:bg-primary/90 transition-colors duration-200 z-40 opacity-0 pointer-events-none';
        backToTopButton.style.transition = 'opacity 0.3s ease';
        
        document.body.appendChild(backToTopButton);

        // Show/hide back to top button
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopButton.style.opacity = '1';
                backToTopButton.style.pointerEvents = 'auto';
            } else {
                backToTopButton.style.opacity = '0';
                backToTopButton.style.pointerEvents = 'none';
            }
        });

        // Back to top click
        backToTopButton.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Statistics table row highlighting
        const tableRows = document.querySelectorAll('tbody tr');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#f3f4f6';
                this.style.transition = 'background-color 0.2s ease';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.backgroundColor = this.classList.contains('bg-gray-50') ? '#f9fafb' : 'white';
            });
        });

        // Add fade-in animation for content sections
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all main content sections
        const sections = document.querySelectorAll('.bg-white.p-6, .bg-gradient-to-r');
        sections.forEach(section => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(20px)';
            section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(section);
        });
    });
</script>
@endpush

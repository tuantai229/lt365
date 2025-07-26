document.addEventListener('DOMContentLoaded', function() {
    // Hero Slider
    let currentSlide = 0;
    const slides = document.querySelectorAll('.hero-slide');
    const indicators = document.querySelectorAll('.slide-indicator');
    const totalSlides = slides.length;

    if (totalSlides > 0) {
        function updateSlide(slideIndex) {
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

        // Auto-play slider
        setInterval(nextSlide, 5000);

        // Event listeners for manual control (if you add prev/next buttons)
        document.querySelector('.hero-slider-wrapper .prev-btn').addEventListener('click', previousSlide);
        document.querySelector('.hero-slider-wrapper .next-btn').addEventListener('click', nextSlide);
        
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => updateSlide(index));
        });
        
        // Initialize first slide
        updateSlide(0);
    }

    // Content Sliders (for teachers, centers, etc.)
    function setupContentSlider(sliderId) {
        const slider = document.getElementById(sliderId);
        if (!slider) return;

        const prevBtn = document.querySelector(`[data-slider-prev="${sliderId}"]`);
        const nextBtn = document.querySelector(`[data-slider-next="${sliderId}"]`);
        const scrollAmount = 300;

        function updateButtons() {
            if (prevBtn) {
                prevBtn.disabled = slider.scrollLeft <= 0;
            }
            if (nextBtn) {
                const maxScroll = slider.scrollWidth - slider.clientWidth;
                nextBtn.disabled = slider.scrollLeft >= maxScroll - 10; // 10px tolerance
            }
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                slider.scrollLeft += scrollAmount;
            });
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                slider.scrollLeft -= scrollAmount;
            });
        }

        slider.addEventListener('scroll', updateButtons);
        
        // Initial check
        updateButtons();
    }

    ['centerSlider', 'teacherSlider', 'reviewSlider'].forEach(setupContentSlider);

    // Smart Search Forms
    const schoolForm = document.getElementById('smart-search-school-form');
    if (schoolForm) {
        schoolForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const level = document.getElementById('ss-school-level').value;
            const province = document.getElementById('ss-school-province').value;
            const type = document.getElementById('ss-school-type').value;
            
            let parts = ['/truong-hoc'];
            
            if (level) parts.push(level);
            if (province) parts.push('tai-' + province);
            if (type) parts.push('he-' + type);
            
            let url = parts.join('/');
            
            window.location.href = url;
        });
    }

    const documentForm = document.getElementById('smart-search-document-form');
    if (documentForm) {
        documentForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const level = document.getElementById('ss-doc-level').value;
            const subject = document.getElementById('ss-doc-subject').value;
            const type = document.getElementById('ss-doc-type').value;
            
            let parts = ['/tai-lieu'];
            
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
            
            window.location.href = url;
        });
    }
});

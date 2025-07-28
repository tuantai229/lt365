@php
    $userRating = $userRating ?? null;
    $type = $type ?? 'document';
    $typeId = $typeId ?? ($document->id ?? 0);
@endphp

<div class="rating-form" data-type="{{ $type }}" data-type-id="{{ $typeId }}">
    @auth
        <div class="mb-4">
            <h4 class="text-sm font-medium text-gray-700 mb-3">
                {{ $userRating ? 'Cập nhật đánh giá của bạn:' : 'Đánh giá tài liệu này:' }}
            </h4>
            
            <!-- Star Rating Input -->
            <div class="star-rating-input mb-3">
                <div class="flex items-center gap-1">
                    @for($i = 1; $i <= 5; $i++)
                        <button type="button" 
                                class="star-btn text-2xl text-gray-300 hover:text-yellow-400 transition-colors duration-200" 
                                data-rating="{{ $i }}">
                            <i class="ri-star-line"></i>
                        </button>
                    @endfor
                </div>
                <div class="rating-text text-sm text-gray-600 mt-1" style="display: none;">
                    <span class="rating-label"></span>
                </div>
            </div>

            <!-- Review Text Area -->
            <div class="review-input mb-4">
                <label for="rating-review" class="block text-sm font-medium text-gray-700 mb-2">
                    Nhận xét (tùy chọn):
                </label>
                <textarea id="rating-review" 
                          name="review"
                          rows="3" 
                          maxlength="1000"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary resize-none"
                          placeholder="Chia sẻ trải nghiệm của bạn về tài liệu này...">{{ $userRating->review ?? '' }}</textarea>
                <div class="text-xs text-gray-500 mt-1">
                    <span class="char-count">{{ strlen($userRating->review ?? '') }}</span>/1000 ký tự
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="rating-actions flex gap-3">
                <button type="button" 
                        class="submit-rating-btn px-4 py-2 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                        disabled>
                    <span class="btn-text">{{ $userRating ? 'Cập nhật đánh giá' : 'Gửi đánh giá' }}</span>
                    <i class="loading-icon ri-loader-4-line animate-spin ml-2" style="display: none;"></i>
                </button>
                
                @if($userRating)
                    <button type="button" 
                            class="delete-rating-btn px-4 py-2 bg-red-600 text-white rounded-button hover:bg-red-700 transition-colors">
                        Xóa đánh giá
                    </button>
                @endif
            </div>

            <!-- Success/Error Messages -->
            <div class="rating-messages mt-3">
                <div class="success-message bg-green-50 border border-green-200 text-green-700 px-3 py-2 rounded-md text-sm" style="display: none;">
                    <i class="ri-check-line mr-1"></i>
                    <span class="message-text"></span>
                </div>
                <div class="error-message bg-red-50 border border-red-200 text-red-700 px-3 py-2 rounded-md text-sm" style="display: none;">
                    <i class="ri-error-warning-line mr-1"></i>
                    <span class="message-text"></span>
                </div>
            </div>
        </div>
    @else
        <div class="auth-required bg-gray-50 border border-gray-200 rounded-md p-4 text-center">
            <p class="text-sm text-gray-600 mb-3">
                Bạn cần đăng nhập để có thể đánh giá tài liệu này
            </p>
            <a href="{{ route('login') }}" 
               class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors text-sm">
                <i class="ri-login-box-line mr-2"></i>
                Đăng nhập
            </a>
        </div>
    @endauth
</div>

<style>
    .rating-form .star-btn.active {
        color: #fbbf24; /* yellow-400 */
    }
    
    .rating-form .star-btn.active i::before {
        content: "\ef7b"; /* ri-star-fill */
    }
    
    .rating-form .star-btn:hover {
        transform: scale(1.1);
    }
    
    .rating-form .char-count {
        font-weight: 500;
    }
    
    .rating-form .rating-messages > div {
        animation: slideIn 0.3s ease-out;
    }
    
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ratingForm = document.querySelector('.rating-form');
    if (!ratingForm) return;

    const type = ratingForm.dataset.type;
    const typeId = ratingForm.dataset.typeId;
    const starButtons = ratingForm.querySelectorAll('.star-btn');
    const ratingText = ratingForm.querySelector('.rating-text');
    const ratingLabel = ratingForm.querySelector('.rating-label');
    const reviewTextarea = ratingForm.querySelector('#rating-review');
    const charCount = ratingForm.querySelector('.char-count');
    const submitBtn = ratingForm.querySelector('.submit-rating-btn');
    const deleteBtn = ratingForm.querySelector('.delete-rating-btn');
    const successMessage = ratingForm.querySelector('.success-message');
    const errorMessage = ratingForm.querySelector('.error-message');

    let currentRating = {{ $userRating->rating ?? 0 }};
    let isSubmitting = false;

    const ratingLabels = {
        1: 'Rất tệ',
        2: 'Tệ', 
        3: 'Bình thường',
        4: 'Tốt',
        5: 'Rất tốt'
    };

    // Initialize existing rating
    if (currentRating > 0) {
        updateStarDisplay(currentRating);
        updateSubmitButton();
    }

    // Star rating interactions
    starButtons.forEach((btn, index) => {
        btn.addEventListener('click', function() {
            currentRating = parseInt(this.dataset.rating);
            updateStarDisplay(currentRating);
            updateSubmitButton();
        });

        btn.addEventListener('mouseenter', function() {
            const hoverRating = parseInt(this.dataset.rating);
            updateStarDisplay(hoverRating, true);
        });
    });

    ratingForm.querySelector('.star-rating-input').addEventListener('mouseleave', function() {
        updateStarDisplay(currentRating);
    });

    // Update star display
    function updateStarDisplay(rating, isHover = false) {
        starButtons.forEach((btn, index) => {
            const btnRating = parseInt(btn.dataset.rating);
            if (btnRating <= rating) {
                btn.classList.add('active');
                btn.style.color = '#fbbf24';
            } else {
                btn.classList.remove('active');
                btn.style.color = isHover ? '#d1d5db' : '#d1d5db';
            }
        });

        if (rating > 0) {
            ratingLabel.textContent = ratingLabels[rating];
            ratingText.style.display = 'block';
        } else {
            ratingText.style.display = 'none';
        }
    }

    // Update submit button state
    function updateSubmitButton() {
        if (currentRating > 0) {
            submitBtn.disabled = false;
        } else {
            submitBtn.disabled = true;
        }
    }

    // Character count for review
    if (reviewTextarea && charCount) {
        reviewTextarea.addEventListener('input', function() {
            charCount.textContent = this.value.length;
        });
    }

    // Submit rating
    if (submitBtn) {
        submitBtn.addEventListener('click', async function() {
            if (isSubmitting || currentRating === 0) return;

            isSubmitting = true;
            showLoading(true);
            hideMessages();

            try {
                const url = `{{ $userRating ? '/api/ratings/update' : '/api/ratings/submit' }}`;
                const method = `{{ $userRating ? 'PUT' : 'POST' }}`;
                
                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        type: type,
                        type_id: parseInt(typeId),
                        rating: currentRating,
                        review: reviewTextarea?.value || null
                    })
                });

                const data = await response.json();

                if (data.success) {
                    showMessage('success', data.message);
                    // Update rating display if available
                    if (data.stats && window.updateRatingDisplay) {
                        window.updateRatingDisplay(data.stats);
                    }
                    // Update button text if it was first rating
                    if (!{{ $userRating ? 'true' : 'false' }}) {
                        submitBtn.querySelector('.btn-text').textContent = 'Cập nhật đánh giá';
                        // Add delete button
                        location.reload();
                    }
                } else {
                    showMessage('error', data.message || 'Có lỗi xảy ra khi gửi đánh giá');
                }
            } catch (error) {
                console.error('Rating error:', error);
                showMessage('error', 'Có lỗi xảy ra. Vui lòng thử lại sau.');
            }

            isSubmitting = false;
            showLoading(false);
        });
    }

    // Delete rating
    if (deleteBtn) {
        deleteBtn.addEventListener('click', async function() {
            if (!confirm('Bạn có chắc chắn muốn xóa đánh giá này?')) return;

            isSubmitting = true;
            showLoading(true);
            hideMessages();

            try {
                const response = await fetch('/api/ratings/delete', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        type: type,
                        type_id: parseInt(typeId)
                    })
                });

                const data = await response.json();

                if (data.success) {
                    showMessage('success', data.message);
                    // Reset form
                    currentRating = 0;
                    updateStarDisplay(0);
                    updateSubmitButton();
                    if (reviewTextarea) reviewTextarea.value = '';
                    if (charCount) charCount.textContent = '0';
                    // Update rating display if available
                    if (data.stats && window.updateRatingDisplay) {
                        window.updateRatingDisplay(data.stats);
                    }
                    // Reload to update form state
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showMessage('error', data.message || 'Có lỗi xảy ra khi xóa đánh giá');
                }
            } catch (error) {
                console.error('Delete rating error:', error);
                showMessage('error', 'Có lỗi xảy ra. Vui lòng thử lại sau.');
            }

            isSubmitting = false;
            showLoading(false);
        });
    }

    // Helper functions
    function showLoading(show) {
        const loadingIcon = submitBtn?.querySelector('.loading-icon');
        if (loadingIcon) {
            loadingIcon.style.display = show ? 'inline' : 'none';
        }
        if (submitBtn) {
            submitBtn.disabled = show;
        }
        if (deleteBtn) {
            deleteBtn.disabled = show;
        }
    }

    function showMessage(type, message) {
        hideMessages();
        const messageEl = type === 'success' ? successMessage : errorMessage;
        if (messageEl) {
            messageEl.querySelector('.message-text').textContent = message;
            messageEl.style.display = 'block';
            setTimeout(() => hideMessages(), 5000);
        }
    }

    function hideMessages() {
        if (successMessage) successMessage.style.display = 'none';
        if (errorMessage) errorMessage.style.display = 'none';
    }
});
</script>

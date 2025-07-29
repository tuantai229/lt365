@props(['type', 'typeId', 'parentId' => 0, 'placeholder' => 'Viết bình luận của bạn...'])

<div class="comment-form-container" data-parent-id="{{ $parentId }}">
    @auth
        <form class="comment-form" data-type="{{ $type }}" data-type-id="{{ $typeId }}" data-parent-id="{{ $parentId }}">
            @csrf
            <div class="flex space-x-3">
                <!-- User Avatar -->
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                        {{ strtoupper(substr(auth()->user()->full_name ?? 'A', 0, 2)) }}
                    </div>
                </div>

                <!-- Comment Input -->
                <div class="flex-1">
                    <div class="relative">
                        <textarea 
                            name="content" 
                            rows="3" 
                            placeholder="{{ $placeholder }}"
                            class="comment-textarea w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none transition-colors duration-200"
                            maxlength="1000"
                            required
                        ></textarea>
                        
                        <!-- Character Counter -->
                        <div class="absolute bottom-2 right-2 text-xs text-gray-400">
                            <span class="char-count">0</span>/1000
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-between mt-3">
                        <div class="text-sm text-gray-500">
                            <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Sử dụng ngôn ngữ văn minh, tích cực
                        </div>
                        
                        <div class="flex space-x-2">
                            @if($parentId > 0)
                                <button type="button" class="cancel-reply-btn px-4 py-2 text-sm text-gray-600 hover:text-gray-800 transition-colors duration-200">
                                    Hủy
                                </button>
                            @endif
                            <button type="submit" class="submit-btn px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-200">
                                <span class="btn-text">{{ $parentId > 0 ? 'Trả lời' : 'Bình luận' }}</span>
                                <span class="btn-loading hidden">
                                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Đang gửi...
                                </span>
                            </button>
                        </div>
                    </div>

                    <!-- Error Message -->
                    <div class="error-message hidden mt-2 p-3 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex">
                            <svg class="flex-shrink-0 h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div class="ml-3">
                                <p class="text-sm text-red-800 error-text"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @else
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
            <div class="flex items-center space-x-3">
                <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <div>
                    <p class="text-sm font-medium text-gray-900">Đăng nhập để bình luận</p>
                    <p class="text-sm text-gray-500">
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-medium">Đăng nhập</a> 
                        hoặc 
                        <a href="{{ route('register.show') }}" class="text-blue-600 hover:text-blue-700 font-medium">đăng ký</a> 
                        để tham gia thảo luận.
                    </p>
                </div>
            </div>
        </div>
    @endauth
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle comment forms
    document.querySelectorAll('.comment-form').forEach(form => {
        setupCommentForm(form);
    });

    function setupCommentForm(form) {
        const textarea = form.querySelector('.comment-textarea');
        const charCount = form.querySelector('.char-count');
        const submitBtn = form.querySelector('.submit-btn');
        const btnText = form.querySelector('.btn-text');
        const btnLoading = form.querySelector('.btn-loading');
        const errorMessage = form.querySelector('.error-message');
        const errorText = form.querySelector('.error-text');
        const cancelBtn = form.querySelector('.cancel-reply-btn');

        // Character counter
        if (textarea && charCount) {
            textarea.addEventListener('input', function() {
                const length = this.value.length;
                charCount.textContent = length;
                
                // Change color based on character count
                if (length > 900) {
                    charCount.parentElement.classList.add('text-red-500');
                    charCount.parentElement.classList.remove('text-gray-400');
                } else if (length > 800) {
                    charCount.parentElement.classList.add('text-yellow-500');
                    charCount.parentElement.classList.remove('text-gray-400', 'text-red-500');
                } else {
                    charCount.parentElement.classList.add('text-gray-400');
                    charCount.parentElement.classList.remove('text-yellow-500', 'text-red-500');
                }
            });
        }

        // Cancel reply button
        if (cancelBtn) {
            cancelBtn.addEventListener('click', function() {
                // Hide reply form and show main form
                const replyForm = form.closest('.reply-form-container');
                if (replyForm) {
                    replyForm.remove();
                }
            });
        }

        // Form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const content = textarea.value.trim();
            if (!content) {
                showError('Vui lòng nhập nội dung bình luận.');
                return;
            }

            if (content.length > 1000) {
                showError('Nội dung bình luận không được vượt quá 1000 ký tự.');
                return;
            }

            submitComment();
        });

        function submitComment() {
            setLoading(true);
            hideError();

            const formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            formData.append('type', form.dataset.type);
            formData.append('type_id', form.dataset.typeId);
            formData.append('content', textarea.value.trim());
            
            if (form.dataset.parentId && form.dataset.parentId !== '0') {
                formData.append('parent_id', form.dataset.parentId);
            }

            fetch('/api/comments', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Clear form
                    textarea.value = '';
                    if (charCount) charCount.textContent = '0';
                    
                    // Hide reply form if it's a reply
                    if (form.dataset.parentId !== '0') {
                        const replyForm = form.closest('.reply-form-container');
                        if (replyForm) {
                            replyForm.remove();
                        }
                    }

                    // Dispatch custom event to reload comments
                    document.dispatchEvent(new CustomEvent('commentAdded', {
                        detail: {
                            type: form.dataset.type,
                            typeId: form.dataset.typeId,
                            comment: data.data.comment
                        }
                    }));

                    // Show success message (optional)
                    showSuccess(data.message);
                } else {
                    showError(data.message || 'Có lỗi xảy ra khi gửi bình luận.');
                }
            })
            .catch(error => {
                console.error('Error submitting comment:', error);
                showError('Có lỗi xảy ra. Vui lòng thử lại.');
            })
            .finally(() => {
                setLoading(false);
            });
        }

        function setLoading(loading) {
            if (submitBtn) {
                submitBtn.disabled = loading;
                btnText.classList.toggle('hidden', loading);
                btnLoading.classList.toggle('hidden', !loading);
            }
        }

        function showError(message) {
            if (errorMessage && errorText) {
                errorText.textContent = message;
                errorMessage.classList.remove('hidden');
            }
        }

        function hideError() {
            if (errorMessage) {
                errorMessage.classList.add('hidden');
            }
        }

        function showSuccess(message) {
            // You can implement a toast notification system here
            console.log('Success:', message);
        }
    }
});
</script>
@endpush

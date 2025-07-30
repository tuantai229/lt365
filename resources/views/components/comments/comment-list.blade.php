@props(['type', 'typeId', 'showForm' => true])

<div class="comments-section" data-type="{{ $type }}" data-type-id="{{ $typeId }}">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-semibold text-gray-900">
            Bình luận (<span class="comments-count">0</span>)
        </h3>
    </div>

    <!-- Comment Form -->
    @if($showForm)
        <x-comments.comment-form :type="$type" :type-id="$typeId" />
    @endif

    <!-- Comments List -->
    <div class="comments-list mt-8">
        <div class="loading-state hidden">
            <div class="flex items-center justify-center py-8">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                <span class="ml-3 text-gray-600">Đang tải bình luận...</span>
            </div>
        </div>

        <div class="comments-container space-y-6">
            <!-- Comments will be loaded here via AJAX -->
        </div>

        <!-- Load More Button -->
        <div class="load-more-container hidden mt-6">
            <button type="button" class="load-more-btn w-full py-3 px-4 bg-gray-50 hover:bg-gray-100 border border-gray-200 rounded-lg text-gray-700 font-medium transition-colors duration-200">
                Xem thêm bình luận
            </button>
        </div>

        <!-- Empty State -->
        <div class="empty-state hidden">
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <h3 class="mt-4 text-sm font-medium text-gray-900">Chưa có bình luận nào</h3>
                <p class="mt-2 text-sm text-gray-500">Hãy là người đầu tiên bình luận về nội dung này.</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const commentsSection = document.querySelector('.comments-section');
    if (!commentsSection) return;

    const type = commentsSection.dataset.type;
    const typeId = commentsSection.dataset.typeId;
    const auth = {{ auth()->check() ? 'true' : 'false' }};
    const commentsContainer = commentsSection.querySelector('.comments-container');
    const loadingState = commentsSection.querySelector('.loading-state');
    const emptyState = commentsSection.querySelector('.empty-state');
    const loadMoreContainer = commentsSection.querySelector('.load-more-container');
    const loadMoreBtn = commentsSection.querySelector('.load-more-btn');
    const commentsCount = commentsSection.querySelector('.comments-count');

    let currentPage = 1;
    let hasMore = false;
    let loading = false;

    // Load initial comments
    loadComments();

    // Load more button event
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            if (!loading && hasMore) {
                currentPage++;
                loadComments(true);
            }
        });
    }

    // Listen for new comment events
    document.addEventListener('commentAdded', function(e) {
        if (e.detail.type === type && e.detail.typeId == typeId) {
            // Refresh comments list
            currentPage = 1;
            loadComments();
        }
    });

    function loadComments(append = false) {
        if (loading) return;
        
        loading = true;
        
        if (!append) {
            showLoading();
        } else {
            loadMoreBtn.disabled = true;
            loadMoreBtn.textContent = 'Đang tải...';
        }

        const url = currentPage === 1 ? '/api/comments' : '/api/comments/load-more';
        const params = new URLSearchParams({
            type: type,
            type_id: typeId,
            page: currentPage
        });

        fetch(`${url}?${params}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (!append) {
                        commentsContainer.innerHTML = '';
                        // Chỉ update count khi load lần đầu, không update khi load more
                        updateCommentsCount(data.data.total_count || data.data.comments.total);
                    }
                    
                    renderComments(data.data.comments.data, append);
                    
                    hasMore = data.data.has_more || data.data.comments.has_more_pages;
                    toggleLoadMoreButton();
                    
                    hideLoading();
                    toggleEmptyState();
                } else {
                    showError('Không thể tải bình luận');
                }
            })
            .catch(error => {
                console.error('Error loading comments:', error);
                showError('Có lỗi xảy ra khi tải bình luận');
            })
            .finally(() => {
                loading = false;
                if (loadMoreBtn) {
                    loadMoreBtn.disabled = false;
                    loadMoreBtn.textContent = 'Xem thêm bình luận';
                }
            });
    }

    function renderComments(comments, append = false) {
        comments.forEach(comment => {
            const commentElement = createCommentElement(comment);
            commentsContainer.appendChild(commentElement);
        });
    }

    function createCommentElement(comment) {
        const div = document.createElement('div');
        div.className = 'comment-wrapper mb-6';
        div.innerHTML = createCommentHTML(comment);
        return div;
    }

    function createCommentHTML(comment) {
        const createdAt = new Date(comment.created_at);
        const timeAgo = getTimeAgo(createdAt);
        const userInitials = comment.user?.full_name ? comment.user.full_name.substring(0, 2).toUpperCase() : 'A';
        const repliesHTML = comment.children && comment.children.length > 0 
            ? comment.children.map(reply => createReplyHTML(reply)).join('')
            : '';

        return `
            <div class="comment-item" data-comment-id="${comment.id}">
                <div class="flex space-x-3">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-blue-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                            ${userInitials}
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="bg-gray-50 rounded-lg px-4 py-3">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center space-x-2">
                                    <h4 class="text-sm font-medium text-gray-900">
                                        ${comment.user?.full_name || 'Người dùng ẩn danh'}
                                    </h4>
                                    <span class="text-xs text-gray-500">
                                        ${timeAgo}
                                    </span>
                                </div>
                            </div>
                            <div class="text-sm text-gray-700">
                                ${comment.content}
                            </div>
                        </div>
                        <div class="flex items-center space-x-4 mt-2 ml-4">
                            ${auth ? `
                                <button type="button" class="reply-btn text-xs text-gray-500 hover:text-blue-600 font-medium transition-colors duration-200" data-comment-id="${comment.id}">
                                    <svg class="inline w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                    </svg>
                                    Trả lời
                                </button>
                            ` : ''}
                        </div>
                        <div class="reply-form-container mt-3 hidden"></div>
                        ${repliesHTML ? `
                            <div class="replies-container mt-4 ml-6 space-y-4">
                                ${repliesHTML}
                            </div>
                        ` : ''}
                    </div>
                </div>
            </div>
        `;
    }

    function createReplyHTML(reply) {
        const createdAt = new Date(reply.created_at);
        const timeAgo = getTimeAgo(createdAt);
        const userInitials = reply.user?.full_name ? reply.user.full_name.substring(0, 2).toUpperCase() : 'A';
        
        return `
            <div class="reply-item" data-comment-id="${reply.id}">
                <div class="flex space-x-3">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-pink-600 rounded-full flex items-center justify-center text-white font-semibold text-xs">
                            ${userInitials}
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="bg-white border border-gray-200 rounded-lg px-3 py-2">
                            <div class="flex items-center space-x-2 mb-1">
                                <h5 class="text-sm font-medium text-gray-900">
                                    ${reply.user?.full_name || 'Người dùng ẩn danh'}
                                </h5>
                                <span class="text-xs text-gray-500">
                                    ${timeAgo}
                                </span>
                            </div>
                            <div class="text-sm text-gray-700">
                                ${reply.content}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    function getTimeAgo(date) {
        const now = new Date();
        const diffInSeconds = Math.floor((now - date) / 1000);
        
        if (diffInSeconds < 60) return 'vừa xong';
        if (diffInSeconds < 3600) return Math.floor(diffInSeconds / 60) + ' phút trước';
        if (diffInSeconds < 86400) return Math.floor(diffInSeconds / 3600) + ' giờ trước';
        if (diffInSeconds < 2592000) return Math.floor(diffInSeconds / 86400) + ' ngày trước';
        if (diffInSeconds < 31536000) return Math.floor(diffInSeconds / 2592000) + ' tháng trước';
        return Math.floor(diffInSeconds / 31536000) + ' năm trước';
    }

    function updateCommentsCount(count) {
        if (commentsCount) {
            commentsCount.textContent = count;
        }
    }

    function toggleLoadMoreButton() {
        if (loadMoreContainer) {
            loadMoreContainer.classList.toggle('hidden', !hasMore);
        }
    }

    function showLoading() {
        if (loadingState) loadingState.classList.remove('hidden');
        if (emptyState) emptyState.classList.add('hidden');
        if (commentsContainer) commentsContainer.classList.add('hidden');
    }

    function hideLoading() {
        if (loadingState) loadingState.classList.add('hidden');
        if (commentsContainer) commentsContainer.classList.remove('hidden');
    }

    function toggleEmptyState() {
        const hasComments = commentsContainer.children.length > 0;
        if (emptyState) {
            emptyState.classList.toggle('hidden', hasComments);
        }
    }

    function showError(message) {
        // You can implement a toast/alert system here
        console.error(message);
    }

    // Handle reply buttons
    document.addEventListener('click', function(e) {
        if (e.target.closest('.reply-btn')) {
            handleReplyClick(e.target.closest('.reply-btn'));
        }
    });

    function handleReplyClick(button) {
        const commentId = button.dataset.commentId;
        const commentItem = button.closest('.comment-item');
        const replyFormContainer = commentItem.querySelector('.reply-form-container');
        
        // Check if reply form is already shown
        if (!replyFormContainer.classList.contains('hidden')) {
            replyFormContainer.classList.add('hidden');
            replyFormContainer.innerHTML = '';
            return;
        }

        // Hide other reply forms
        document.querySelectorAll('.reply-form-container').forEach(container => {
            container.classList.add('hidden');
            container.innerHTML = '';
        });

        // Create reply form HTML
        const replyFormHTML = `
            <div class="reply-form-wrapper border-l-2 border-blue-200 pl-4">
                <div class="comment-form-container" data-parent-id="${commentId}">
                    <form class="comment-form" data-type="${type}" data-type-id="${typeId}" data-parent-id="${commentId}">
                        <div class="flex space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="relative">
                                    <textarea 
                                        name="content" 
                                        rows="3" 
                                        placeholder="Viết phản hồi của bạn..."
                                        class="comment-textarea w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none transition-colors duration-200"
                                        maxlength="1000"
                                        required
                                    ></textarea>
                                    <div class="absolute bottom-2 right-2 text-xs text-gray-400">
                                        <span class="char-count">0</span>/1000
                                    </div>
                                </div>
                                <div class="flex items-center justify-between mt-3">
                                    <div class="text-sm text-gray-500">
                                        <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Sử dụng ngôn ngữ văn minh, tích cực
                                    </div>
                                    <div class="flex space-x-2">
                                        <button type="button" class="cancel-reply-btn px-4 py-2 text-sm text-gray-600 hover:text-gray-800 transition-colors duration-200">
                                            Hủy
                                        </button>
                                        <button type="submit" class="submit-btn px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-200">
                                            <span class="btn-text">Trả lời</span>
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
                </div>
            </div>
        `;

        replyFormContainer.innerHTML = replyFormHTML;
        replyFormContainer.classList.remove('hidden');

        // Setup the new form
        const newForm = replyFormContainer.querySelector('.comment-form');
        setupReplyForm(newForm);

        // Focus on the textarea
        const textarea = replyFormContainer.querySelector('.comment-textarea');
        if (textarea) {
            textarea.focus();
        }
    }

    function setupReplyForm(form) {
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
                const replyFormContainer = form.closest('.reply-form-container');
                if (replyFormContainer) {
                    replyFormContainer.classList.add('hidden');
                    replyFormContainer.innerHTML = '';
                }
            });
        }

        // Form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const content = textarea.value.trim();
            if (!content) {
                showFormError('Vui lòng nhập nội dung bình luận.');
                return;
            }

            if (content.length > 1000) {
                showFormError('Nội dung bình luận không được vượt quá 1000 ký tự.');
                return;
            }

            submitReplyComment();
        });

        function submitReplyComment() {
            setFormLoading(true);
            hideFormError();

            const formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            formData.append('type', form.dataset.type);
            formData.append('type_id', form.dataset.typeId);
            formData.append('content', textarea.value.trim());
            formData.append('parent_id', form.dataset.parentId);

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
                    // Clear form and hide it
                    const replyFormContainer = form.closest('.reply-form-container');
                    if (replyFormContainer) {
                        replyFormContainer.classList.add('hidden');
                        replyFormContainer.innerHTML = '';
                    }

                    // Dispatch custom event to reload comments
                    document.dispatchEvent(new CustomEvent('commentAdded', {
                        detail: {
                            type: form.dataset.type,
                            typeId: form.dataset.typeId,
                            comment: data.data.comment
                        }
                    }));
                } else {
                    showFormError(data.message || 'Có lỗi xảy ra khi gửi bình luận.');
                }
            })
            .catch(error => {
                console.error('Error submitting comment:', error);
                showFormError('Có lỗi xảy ra. Vui lòng thử lại.');
            })
            .finally(() => {
                setFormLoading(false);
            });
        }

        function setFormLoading(loading) {
            if (submitBtn) {
                submitBtn.disabled = loading;
                btnText.classList.toggle('hidden', loading);
                btnLoading.classList.toggle('hidden', !loading);
            }
        }

        function showFormError(message) {
            if (errorMessage && errorText) {
                errorText.textContent = message;
                errorMessage.classList.remove('hidden');
            }
        }

        function hideFormError() {
            if (errorMessage) {
                errorMessage.classList.add('hidden');
            }
        }
    }
});
</script>
@endpush

@props(['comment', 'type', 'typeId'])

<div class="comment-item" data-comment-id="{{ $comment['id'] }}">
    <div class="flex space-x-3">
        <!-- User Avatar -->
        <div class="flex-shrink-0">
            <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-blue-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                {{ strtoupper(substr($comment['user']['full_name'] ?? 'A', 0, 2)) }}
            </div>
        </div>

        <!-- Comment Content -->
        <div class="flex-1 min-w-0">
            <div class="bg-gray-50 rounded-lg px-4 py-3">
                <!-- Comment Header -->
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center space-x-2">
                        <h4 class="text-sm font-medium text-gray-900">
                            {{ $comment['user']['full_name'] ?? 'Người dùng ẩn danh' }}
                        </h4>
                        <span class="text-xs text-gray-500">
                            {{ \Carbon\Carbon::parse($comment['created_at'])->diffForHumans() }}
                        </span>
                    </div>
                </div>

                <!-- Comment Text -->
                <div class="text-sm text-gray-700">
                    {{ $comment['content'] }}
                </div>
            </div>

            <!-- Comment Actions -->
            <div class="flex items-center space-x-4 mt-2 ml-4">
                @auth
                    <button type="button" class="reply-btn text-xs text-gray-500 hover:text-blue-600 font-medium transition-colors duration-200" data-comment-id="{{ $comment['id'] }}">
                        <svg class="inline w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                        </svg>
                        Trả lời
                    </button>
                @endauth
                
                <!-- Like/Reaction placeholder - can be implemented later -->
                <!--
                <button type="button" class="like-btn text-xs text-gray-500 hover:text-red-600 font-medium transition-colors duration-200">
                    <svg class="inline w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    Thích
                </button>
                -->
            </div>

            <!-- Reply Form Container -->
            <div class="reply-form-container mt-3 hidden"></div>

            <!-- Replies Container -->
            @if(isset($comment['children']) && count($comment['children']) > 0)
                <div class="replies-container mt-4 ml-6 space-y-4">
                    @foreach($comment['children'] as $reply)
                        <div class="reply-item" data-comment-id="{{ $reply['id'] }}">
                            <div class="flex space-x-3">
                                <!-- Reply User Avatar -->
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-pink-600 rounded-full flex items-center justify-center text-white font-semibold text-xs">
                                        {{ strtoupper(substr($reply['user']['full_name'] ?? 'A', 0, 2)) }}
                                    </div>
                                </div>

                                <!-- Reply Content -->
                                <div class="flex-1 min-w-0">
                                    <div class="bg-white border border-gray-200 rounded-lg px-3 py-2">
                                        <!-- Reply Header -->
                                        <div class="flex items-center space-x-2 mb-1">
                                            <h5 class="text-sm font-medium text-gray-900">
                                                {{ $reply['user']['full_name'] ?? 'Người dùng ẩn danh' }}
                                            </h5>
                                            <span class="text-xs text-gray-500">
                                                {{ \Carbon\Carbon::parse($reply['created_at'])->diffForHumans() }}
                                            </span>
                                        </div>

                                        <!-- Reply Text -->
                                        <div class="text-sm text-gray-700">
                                            {{ $reply['content'] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Show Replies Button (if there are more replies not loaded) -->
            @if(isset($comment['children_count']) && $comment['children_count'] > count($comment['children'] ?? []))
                <div class="mt-3 ml-6">
                    <button type="button" class="show-replies-btn text-xs text-blue-600 hover:text-blue-700 font-medium" data-comment-id="{{ $comment['id'] }}">
                        <svg class="inline w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                        Xem {{ $comment['children_count'] - count($comment['children'] ?? []) }} phản hồi khác
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle reply buttons
    document.addEventListener('click', function(e) {
        if (e.target.closest('.reply-btn')) {
            handleReplyClick(e.target.closest('.reply-btn'));
        }
        
        if (e.target.closest('.show-replies-btn')) {
            handleShowRepliesClick(e.target.closest('.show-replies-btn'));
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

        // Get comment section data
        const commentsSection = document.querySelector('.comments-section');
        const type = commentsSection.dataset.type;
        const typeId = commentsSection.dataset.typeId;

        // Create reply form
        const replyFormHTML = `
            <div class="reply-form-wrapper border-l-2 border-blue-200 pl-4">
                <x-comments.comment-form 
                    type="${type}" 
                    type-id="${typeId}" 
                    parent-id="${commentId}"
                    placeholder="Viết phản hồi của bạn..."
                />
            </div>
        `;

        replyFormContainer.innerHTML = replyFormHTML;
        replyFormContainer.classList.remove('hidden');

        // Focus on the textarea
        const textarea = replyFormContainer.querySelector('.comment-textarea');
        if (textarea) {
            textarea.focus();
        }

        // Setup the new form
        const newForm = replyFormContainer.querySelector('.comment-form');
        if (newForm && typeof setupCommentForm === 'function') {
            setupCommentForm(newForm);
        }
    }

    function handleShowRepliesClick(button) {
        const commentId = button.dataset.commentId;
        
        // Show loading state
        button.disabled = true;
        button.innerHTML = `
            <svg class="inline animate-spin w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Đang tải...
        `;

        // Load replies
        fetch(`/api/comments/${commentId}/replies`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const commentItem = button.closest('.comment-item');
                    const repliesContainer = commentItem.querySelector('.replies-container');
                    
                    if (repliesContainer) {
                        // Clear existing replies and add new ones
                        repliesContainer.innerHTML = '';
                        
                        data.data.replies.forEach(reply => {
                            const replyHTML = createReplyHTML(reply);
                            repliesContainer.insertAdjacentHTML('beforeend', replyHTML);
                        });
                    }
                    
                    // Hide the show replies button
                    button.style.display = 'none';
                } else {
                    console.error('Failed to load replies:', data.message);
                }
            })
            .catch(error => {
                console.error('Error loading replies:', error);
            })
            .finally(() => {
                button.disabled = false;
            });
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
});
</script>
@endpush

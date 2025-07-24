/**
 * Favorites functionality for all modules
 */
class FavoritesManager {
    constructor() {
        this.init();
    }

    init() {
        this.bindEvents();
        this.loadFavoriteStates();
    }

    bindEvents() {
        // Use event delegation to handle favorite buttons
        document.addEventListener('click', (e) => {
            const favoriteBtn = e.target.closest('[data-favorite-btn]');
            if (favoriteBtn) {
                e.preventDefault();
                this.toggleFavorite(favoriteBtn);
            }
        });
    }

    async loadFavoriteStates() {
        // Check if user is logged in
        if (!window.isUserLoggedIn) {
            return;
        }

        const favoriteButtons = document.querySelectorAll('[data-favorite-btn]');
        if (favoriteButtons.length === 0) {
            return;
        }

        // Group buttons by type
        const items = {};
        favoriteButtons.forEach(btn => {
            const type = this.getTypeFromButton(btn);
            const id = this.getIdFromButton(btn);
            
            if (!items[type]) {
                items[type] = [];
            }
            items[type].push(id);
        });

        try {
            const response = await fetch('/api/favorites/check', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({ items })
            });

            if (response.ok) {
                const data = await response.json();
                this.updateButtonStates(data.favorites);
            }
        } catch (error) {
            console.error('Error loading favorite states:', error);
        }
    }

    async toggleFavorite(button) {
        // Check if user is logged in
        if (!window.isUserLoggedIn) {
            this.showLoginPrompt();
            return;
        }

        const type = this.getTypeFromButton(button);
        const id = this.getIdFromButton(button);
        const isFavorited = button.classList.contains('favorited');

        // Optimistic UI update
        this.updateButtonState(button, !isFavorited);

        try {
            const response = await fetch('/api/favorites/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({
                    type: type,
                    type_id: id
                })
            });

            if (response.ok) {
                const data = await response.json();
                this.updateButtonState(button, data.favorited);
                
                // Show success message
                this.showMessage(data.favorited ? 'Đã thêm vào danh sách yêu thích' : 'Đã xóa khỏi danh sách yêu thích', 'success');
            } else {
                // Revert optimistic update on error
                this.updateButtonState(button, isFavorited);
                this.showMessage('Có lỗi xảy ra, vui lòng thử lại', 'error');
            }
        } catch (error) {
            // Revert optimistic update on error
            this.updateButtonState(button, isFavorited);
            this.showMessage('Có lỗi xảy ra, vui lòng thử lại', 'error');
            console.error('Error toggling favorite:', error);
        }
    }

    getTypeFromButton(button) {
        // Extract type from data attributes
        if (button.hasAttribute('data-school-id')) return 'school';
        if (button.hasAttribute('data-document-id')) return 'document';
        if (button.hasAttribute('data-news-id')) return 'news';
        if (button.hasAttribute('data-center-id')) return 'center';
        if (button.hasAttribute('data-teacher-id')) return 'teacher';
        return null;
    }

    getIdFromButton(button) {
        // Extract ID from data attributes
        if (button.hasAttribute('data-school-id')) return button.getAttribute('data-school-id');
        if (button.hasAttribute('data-document-id')) return button.getAttribute('data-document-id');
        if (button.hasAttribute('data-news-id')) return button.getAttribute('data-news-id');
        if (button.hasAttribute('data-center-id')) return button.getAttribute('data-center-id');
        if (button.hasAttribute('data-teacher-id')) return button.getAttribute('data-teacher-id');
        return null;
    }

    updateButtonStates(favorites) {
        favorites.forEach(favorite => {
            const buttons = document.querySelectorAll(`[data-${favorite.type}-id="${favorite.type_id}"]`);
            buttons.forEach(button => {
                this.updateButtonState(button, true);
            });
        });
    }

    updateButtonState(button, isFavorited) {
        const icon = button.querySelector('i');
        
        if (isFavorited) {
            button.classList.add('favorited');
            button.classList.remove('text-gray-400');
            button.classList.add('text-red-500');
            if (icon) {
                icon.classList.remove('ri-heart-line');
                icon.classList.add('ri-heart-fill');
            }
        } else {
            button.classList.remove('favorited');
            button.classList.remove('text-red-500');
            button.classList.add('text-gray-400');
            if (icon) {
                icon.classList.remove('ri-heart-fill');
                icon.classList.add('ri-heart-line');
            }
        }
    }

    showLoginPrompt() {
        this.showMessage('Vui lòng đăng nhập để sử dụng tính năng yêu thích', 'info');
        // You can redirect to login or show login modal here
        setTimeout(() => {
            window.location.href = '/auth/dang-nhap';
        }, 2000);
    }

    showMessage(message, type = 'info') {
        // Create toast notification
        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 z-50 px-4 py-3 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full`;
        
        // Set colors based on type
        switch (type) {
            case 'success':
                toast.className += ' bg-green-500 text-white';
                break;
            case 'error':
                toast.className += ' bg-red-500 text-white';
                break;
            case 'info':
            default:
                toast.className += ' bg-blue-500 text-white';
                break;
        }
        
        toast.textContent = message;
        document.body.appendChild(toast);
        
        // Animate in
        setTimeout(() => {
            toast.classList.remove('translate-x-full');
        }, 100);
        
        // Remove after 3 seconds
        setTimeout(() => {
            toast.classList.add('translate-x-full');
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 300);
        }, 3000);
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new FavoritesManager();
});

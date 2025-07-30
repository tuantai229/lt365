document.addEventListener('DOMContentLoaded', function () {
    // Share functionality
    const shareButtons = document.querySelectorAll('[data-share]');

    shareButtons.forEach(button => {
        button.addEventListener('click', function () {
            const platform = this.dataset.share;
            const url = window.location.href;
            const title = document.title;
            let shareUrl = '';

            switch (platform) {
                case 'facebook':
                    shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
                    break;
                case 'zalo':
                    // Zalo sharing is typically done via their SDK or a specific URL scheme that might not work on all devices.
                    // A common approach is to link to their sharing guide or a fallback.
                    // For web, the most reliable way is using the Zalo Share API, which requires setup.
                    // A simple link-based approach:
                    shareUrl = `https://zalo.me/share?u=${encodeURIComponent(url)}`;
                    break;
                case 'copy':
                    // Use Clipboard API if available (requires HTTPS)
                    if (navigator.clipboard && window.isSecureContext) {
                        navigator.clipboard.writeText(url).then(() => {
                            const originalText = this.innerHTML;
                            this.innerHTML = '<i class="ri-check-line"></i> Đã chép';
                            setTimeout(() => {
                                this.innerHTML = originalText;
                            }, 2000);
                        }).catch(err => {
                            console.error('Failed to copy: ', err);
                            alert('Không thể sao chép liên kết.');
                        });
                    } else {
                        // Fallback for non-secure contexts (HTTP)
                        const textArea = document.createElement("textarea");
                        textArea.value = url;
                        textArea.style.position = "fixed"; // Prevent scrolling to bottom of page in MS Edge.
                        textArea.style.top = "0";
                        textArea.style.left = "0";
                        textArea.style.opacity = "0";
                        document.body.appendChild(textArea);
                        textArea.focus();
                        textArea.select();
                        try {
                            document.execCommand('copy');
                            const originalText = this.innerHTML;
                            this.innerHTML = '<i class="ri-check-line"></i> Đã chép';
                            setTimeout(() => {
                                this.innerHTML = originalText;
                            }, 2000);
                        } catch (err) {
                            console.error('Fallback: Oops, unable to copy', err);
                            alert('Không thể sao chép liên kết.');
                        }
                        document.body.removeChild(textArea);
                    }
                    return; // Exit after handling copy
                case 'print':
                    window.print();
                    return; // Exit after handling print
            }

            if (shareUrl) {
                window.open(shareUrl, '_blank', 'width=600,height=400');
            }
        });
    });
});

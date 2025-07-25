document.addEventListener('DOMContentLoaded', function() {
    const newsletterForms = document.querySelectorAll('.newsletter-form');

    newsletterForms.forEach(form => {
        const emailInput = form.querySelector('.newsletter-email');
        const submitBtn = form.querySelector('.newsletter-submit-btn');
        const messageContainer = form.nextElementSibling; // Assumes message div is immediately after the form

        // Check if all elements are found
        if (!emailInput || !submitBtn || !messageContainer || !messageContainer.classList.contains('newsletter-message')) {
            console.warn('A newsletter form is missing required elements (email, submit button, or message container).', form);
            return;
        }
        
        const btnText = submitBtn.querySelector('.btn-text');
        const loadingSpinner = submitBtn.querySelector('.loading-spinner');
        const messageDiv = messageContainer.querySelector('div');

        function showMessage(message, isSuccess = true) {
            if (!messageDiv) return;
            messageDiv.textContent = message;
            messageDiv.className = `p-3 rounded-lg text-sm font-medium ${isSuccess ? 'bg-green-500/20 text-green-100 border border-green-500/30' : 'bg-red-500/20 text-red-100 border border-red-500/30'}`;
            messageContainer.classList.remove('hidden');
            
            if (isSuccess) {
                setTimeout(() => {
                    messageContainer.classList.add('hidden');
                }, 5000);
            }
        }

        function setLoading(loading) {
            if (!btnText || !loadingSpinner) return;
            if (loading) {
                submitBtn.disabled = true;
                btnText.classList.add('hidden');
                loadingSpinner.classList.remove('hidden');
            } else {
                submitBtn.disabled = false;
                btnText.classList.remove('hidden');
                loadingSpinner.classList.add('hidden');
            }
        }

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = emailInput.value.trim();
            
            if (!email) {
                showMessage('Vui lòng nhập địa chỉ email.', false);
                return;
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showMessage('Địa chỉ email không hợp lệ.', false);
                return;
            }

            setLoading(true);
            messageContainer.classList.add('hidden');

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || form.querySelector('[name="_token"]').value;
            const subscribeUrl = form.getAttribute('action');

            fetch(subscribeUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    email: email
                })
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showMessage(data.message, true);
                    emailInput.value = '';
                } else {
                    // This case might not be hit if using the .catch block for non-ok responses
                    showMessage(data.message || 'Đã có lỗi xảy ra.', false);
                }
            })
            .catch(errorData => {
                console.error('Error:', errorData);
                const message = errorData.message || 'Có lỗi xảy ra phía máy chủ. Vui lòng thử lại sau.';
                showMessage(message, false);
            })
            .finally(() => {
                setLoading(false);
            });
        });
    });
});

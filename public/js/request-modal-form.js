document.addEventListener('DOMContentLoaded', function() {
    const requestModalBtn = document.getElementById('requestModalBtn');
    const requestModal = document.getElementById('requestModal');
    const closeRequestModal = document.getElementById('closeRequestModal');
    const cancelRequest = document.getElementById('cancelRequest');
    const requestForm = document.getElementById('requestForm');
    const submitBtn = document.getElementById('requestSubmitBtn');
    const messageContainer = document.getElementById('request-message');

    if (!requestModalBtn || !requestModal || !requestForm) {
        return; // Elements not found, exit
    }

    const btnText = submitBtn.querySelector('.btn-text');
    const loadingSpinner = submitBtn.querySelector('.loading-spinner');
    const messageDiv = messageContainer.querySelector('div');

    // Open modal
    requestModalBtn.addEventListener('click', function() {
        requestModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    });

    // Close modal functions
    function closeModal() {
        requestModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        requestForm.reset();
        hideMessage();
    }

    // Close modal events
    closeRequestModal.addEventListener('click', closeModal);
    cancelRequest.addEventListener('click', closeModal);

    // Close modal when clicking outside
    requestModal.addEventListener('click', function(e) {
        if (e.target === requestModal) {
            closeModal();
        }
    });

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !requestModal.classList.contains('hidden')) {
            closeModal();
        }
    });

    // Message functions
    function showMessage(message, isSuccess = true) {
        if (!messageDiv) return;
        messageDiv.textContent = message;
        messageDiv.className = `p-3 rounded-lg text-sm font-medium ${isSuccess ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200'}`;
        messageContainer.classList.remove('hidden');
    }

    function hideMessage() {
        messageContainer.classList.add('hidden');
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

    // Form submission
    requestForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const nameInput = requestForm.querySelector('input[name="name"]');
        const emailInput = requestForm.querySelector('input[name="email"]');
        const phoneInput = requestForm.querySelector('input[name="phone"]');
        const contentInput = requestForm.querySelector('textarea[name="content"]');

        // Basic validation
        if (!nameInput.value.trim() || !emailInput.value.trim() || !phoneInput.value.trim() || !contentInput.value.trim()) {
            showMessage('Vui lòng điền đầy đủ tất cả các trường bắt buộc.', false);
            return;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailInput.value)) {
            showMessage('Địa chỉ email không hợp lệ.', false);
            return;
        }

        setLoading(true);
        hideMessage();

        // Create subject with name
        const subject = `Yêu cầu tìm tài liệu từ ${nameInput.value.trim()}`;

        const formData = {
            name: nameInput.value.trim(),
            email: emailInput.value.trim(),
            phone: phoneInput.value.trim(),
            subject: subject,
            content: contentInput.value.trim(),
        };

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || requestForm.querySelector('[name="_token"]').value;
        const actionUrl = requestForm.getAttribute('action');

        fetch(actionUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            body: JSON.stringify(formData)
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
                // Auto close modal after 2 seconds
                setTimeout(() => {
                    closeModal();
                }, 2000);
            } else {
                showMessage(data.message || 'Đã có lỗi xảy ra.', false);
            }
        })
        .catch(errorData => {
            console.error('Error:', errorData);
            let errorMessage = 'Có lỗi xảy ra. Vui lòng thử lại sau.';
            if (errorData && errorData.errors) {
                // Get the first error message from Laravel's validation response
                const firstErrorKey = Object.keys(errorData.errors)[0];
                errorMessage = errorData.errors[firstErrorKey][0];
            } else if (errorData && errorData.message) {
                errorMessage = errorData.message;
            }
            showMessage(errorMessage, false);
        })
        .finally(() => {
            setLoading(false);
        });
    });
});

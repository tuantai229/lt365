document.addEventListener('DOMContentLoaded', function() {
    const ctaForm = document.querySelector('.cta-contact-form');

    if (ctaForm) {
        const submitBtn = ctaForm.querySelector('.cta-submit-btn');
        const messageContainer = ctaForm.querySelector('.cta-message');
        
        if (!submitBtn || !messageContainer) {
            console.warn('CTA contact form is missing a submit button or a message container.');
            return;
        }

        const btnText = submitBtn.querySelector('.btn-text');
        const loadingSpinner = submitBtn.querySelector('.loading-spinner');
        const messageDiv = messageContainer.querySelector('div');

        function showMessage(message, isSuccess = true) {
            if (!messageDiv) return;
            messageDiv.textContent = message;
            messageDiv.className = `p-3 rounded-lg text-sm font-medium ${isSuccess ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200'}`;
            messageContainer.classList.remove('hidden');
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

        ctaForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const nameInput = ctaForm.querySelector('input[name="name"]');
            const emailInput = ctaForm.querySelector('input[name="email"]');
            const phoneInput = ctaForm.querySelector('input[name="phone"]');
            const selectedGradeInput = ctaForm.querySelector('input[name="grade"]:checked');
            const agreementCheckbox = ctaForm.querySelector('input[name="agree_terms"]');

            // --- Validation ---
            if (!nameInput.value.trim() || !emailInput.value.trim() || !phoneInput.value.trim()) {
                showMessage('Vui lòng điền đầy đủ họ tên, email và số điện thoại.', false);
                return;
            }
            if (!selectedGradeInput) {
                showMessage('Vui lòng chọn cấp học quan tâm.', false);
                return;
            }
            if (!agreementCheckbox.checked) {
                showMessage('Bạn phải đồng ý với điều khoản sử dụng và chính sách bảo mật.', false);
                return;
            }
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailInput.value)) {
                showMessage('Địa chỉ email không hợp lệ.', false);
                return;
            }

            setLoading(true);
            messageContainer.classList.add('hidden');

            const subject = `Đăng ký tư vấn từ trang Thi chuyển cấp của ${nameInput.value.trim()}`;
            const content = `Cấp học quan tâm: ${selectedGradeInput.value}`;

            const formData = {
                name: nameInput.value.trim(),
                email: emailInput.value.trim(),
                phone: phoneInput.value.trim(),
                subject: subject,
                content: content,
            };

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ctaForm.querySelector('[name="_token"]').value;
            const actionUrl = ctaForm.getAttribute('action');

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
                    ctaForm.reset(); // Reset form on success
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
    }
});

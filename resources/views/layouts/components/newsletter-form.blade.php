<section class="py-12 bg-gradient-to-r from-primary to-indigo-700 text-white">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-6">Đăng ký nhận tin tức tuyển sinh mới nhất</h2>
            <p class="text-lg mb-8 opacity-90">Cập nhật thông tin tuyển sinh, lịch thi và các quy định mới ngay khi có thông báo chính thức</p>
            
            <form id="newsletter-form" class="flex flex-col md:flex-row gap-4 mb-4 max-w-2xl mx-auto">
                @csrf
                <div class="flex-1">
                    <input type="email" 
                           name="email" 
                           id="newsletter-email"
                           placeholder="Nhập email của bạn" 
                           class="w-full p-3 rounded-button border-none focus:outline-none focus:ring-2 focus:ring-white/30 bg-white/10 text-white placeholder-white/70"
                           required>
                </div>
                <button type="submit" 
                        id="newsletter-submit-btn"
                        class="md:w-auto px-6 py-3 bg-white text-primary font-medium rounded-button hover:bg-gray-100 transition-colors duration-200 whitespace-nowrap !rounded-button">
                    <span class="btn-text">Đăng ký ngay</span>
                    <span class="loading-spinner hidden">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-primary inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Đang xử lý...
                    </span>
                </button>
            </form>
            
            <!-- Message display area -->
            <div id="newsletter-message" class="hidden mb-4">
                <div class="p-3 rounded-lg text-sm font-medium"></div>
            </div>
            
            <p class="text-sm opacity-80">15,000+ phụ huynh đã đăng ký nhận thông tin từ LT365</p>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('newsletter-form');
    const emailInput = document.getElementById('newsletter-email');
    const submitBtn = document.getElementById('newsletter-submit-btn');
    const btnText = submitBtn.querySelector('.btn-text');
    const loadingSpinner = submitBtn.querySelector('.loading-spinner');
    const messageContainer = document.getElementById('newsletter-message');
    const messageDiv = messageContainer.querySelector('div');

    function showMessage(message, isSuccess = true) {
        messageDiv.textContent = message;
        messageDiv.className = `p-3 rounded-lg text-sm font-medium ${isSuccess ? 'bg-green-500/20 text-green-100 border border-green-500/30' : 'bg-red-500/20 text-red-100 border border-red-500/30'}`;
        messageContainer.classList.remove('hidden');
        
        // Auto hide success messages after 5 seconds
        if (isSuccess) {
            setTimeout(() => {
                messageContainer.classList.add('hidden');
            }, 5000);
        }
    }

    function setLoading(loading) {
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

        // Basic email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            showMessage('Địa chỉ email không hợp lệ.', false);
            return;
        }

        setLoading(true);
        messageContainer.classList.add('hidden');

        fetch('{{ route("newsletter.subscribe") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || form.querySelector('[name="_token"]').value,
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                email: email
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showMessage(data.message, true);
                emailInput.value = ''; // Clear the input on success
            } else {
                showMessage(data.message, false);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showMessage('Có lỗi xảy ra. Vui lòng thử lại sau.', false);
        })
        .finally(() => {
            setLoading(false);
        });
    });
});
</script>

<!-- CTA Section -->
<section class="py-12 bg-primary text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">Không tìm thấy tài liệu phù hợp?</h2>
        <p class="text-lg mb-6 opacity-90">Để lại yêu cầu của bạn, chúng tôi sẽ tìm kiếm và gửi tài liệu phù hợp nhất</p>
        <button id="requestModalBtn" class="px-8 py-3 bg-white text-primary font-medium rounded-button hover:bg-gray-100 transition-colors duration-200">Gửi yêu cầu</button>
    </div>
</section>

<!-- Request Modal -->
<div id="requestModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6 relative">
            <button id="closeRequestModal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Gửi yêu cầu tìm tài liệu</h3>
            
            <form id="requestForm" action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label for="request_name" class="block text-sm font-medium text-gray-700 mb-1">
                        Họ và tên <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="request_name" name="name" required 
                           class="w-full px-3 py-2 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                </div>

                <div>
                    <label for="request_email" class="block text-sm font-medium text-gray-700 mb-1">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="request_email" name="email" required 
                           class="w-full px-3 py-2 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                </div>

                <div>
                    <label for="request_phone" class="block text-sm font-medium text-gray-700 mb-1">
                        Số điện thoại <span class="text-red-500">*</span>
                    </label>
                    <input type="tel" id="request_phone" name="phone" required 
                           class="w-full px-3 py-2 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                </div>

                <div>
                    <label for="request_content" class="block text-sm font-medium text-gray-700 mb-1">
                        Nội dung yêu cầu <span class="text-red-500">*</span>
                    </label>
                    <textarea id="request_content" name="content" rows="4" required 
                              placeholder="Mô tả chi tiết tài liệu bạn đang tìm kiếm..."
                              class="w-full px-3 py-2 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"></textarea>
                </div>

                <!-- Message display area -->
                <div id="request-message" class="hidden">
                    <div class="p-3 rounded-lg text-sm font-medium"></div>
                </div>

                <div class="flex space-x-3">
                    <button type="button" id="cancelRequest" 
                            class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-button hover:bg-gray-50 transition-colors">
                        Hủy
                    </button>
                    <button type="submit" id="requestSubmitBtn"
                            class="flex-1 px-4 py-2 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors font-medium">
                        <span class="btn-text">Gửi yêu cầu</span>
                        <span class="loading-spinner hidden">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Đang xử lý...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/request-modal-form.js') }}"></script>

@extends('layouts.app')

@section('title', 'Liên hệ - LT365 | Tư vấn thi chuyển cấp')
@section('description', 'Liên hệ với LT365 để được tư vấn miễn phí về thi chuyển cấp. Hotline: ' . ($general_settings['hotline'] ?? '') . '. Hỗ trợ 24/7 cho phụ huynh và học sinh.')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-primary to-indigo-700 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl font-bold mb-6">Liên hệ với chúng tôi</h1>
                <p class="text-lg opacity-90 mb-8">Đội ngũ chuyên gia giáo dục LT365 luôn sẵn sàng tư vấn miễn phí về lộ trình học tập và thi chuyển cấp cho con bạn</p>
                <div class="flex flex-col md:flex-row gap-6 justify-center items-center">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                            <i class="ri-phone-line text-2xl"></i>
                        </div>
                        <div class="text-left">
                            <p class="font-semibold">Hotline 24/7</p>
                            <p class="text-xl font-bold">{{ $general_settings['hotline'] ?? '' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                            <i class="ri-mail-line text-2xl"></i>
                        </div>
                        <div class="text-left">
                            <p class="font-semibold">Email hỗ trợ</p>
                            <p class="text-xl font-bold">{{ $general_settings['email'] ?? '' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div id="contact-form-section" class="bg-white rounded-lg shadow-lg p-8">
                    <h2 class="text-2xl font-bold mb-6 text-gray-900">Gửi yêu cầu tư vấn</h2>
                    <p class="text-gray-600 mb-6">Vui lòng điền thông tin bên dưới, chúng tôi sẽ liên hệ với bạn trong vòng 24 giờ</p>
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                            <strong class="font-bold">Thành công!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Họ và tên <span class="text-red-500">*</span></label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full p-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary @error('name') border-red-500 @enderror">
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Số điện thoại</label>
                                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" class="w-full p-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary @error('phone') border-red-500 @enderror">
                                @error('phone')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full p-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Nội dung tin nhắn</label>
                            <textarea id="content" name="content" rows="5" placeholder="Chia sẻ thắc mắc hoặc yêu cầu tư vấn cụ thể..." class="w-full p-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary resize-vertical @error('content') border-red-500 @enderror">{{ old('content') }}</textarea>
                            @error('content')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <button type="submit" class="w-full py-3 bg-primary text-white rounded-button hover:bg-primary/90 transition-colors duration-200 font-medium">
                            <i class="ri-send-plane-line mr-2"></i>
                            Gửi yêu cầu tư vấn
                        </button>
                        
                        <p class="text-xs text-gray-500 text-center">* Chúng tôi cam kết bảo mật thông tin cá nhân của bạn</p>
                    </form>
                </div>

                <!-- Contact Info & Quick Contact -->
                <div class="space-y-8">
                    <!-- Contact Information -->
                    <div class="bg-white rounded-lg shadow-lg p-8">
                        <h3 class="text-2xl font-bold mb-6 text-gray-900">Thông tin liên hệ</h3>
                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary flex-shrink-0">
                                    <i class="ri-phone-fill text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Hotline tư vấn</h4>
                                    <p class="text-primary font-bold text-lg">{{ $general_settings['hotline'] ?? '' }}</p>
                                    <p class="text-sm text-gray-600">{{ $general_settings['working_hours'] ?? '' }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary flex-shrink-0">
                                    <i class="ri-mail-fill text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Email</h4>
                                    <p class="text-primary font-bold">{{ $general_settings['email'] ?? '' }}</p>
                                    <p class="text-sm text-gray-600">Phản hồi trong vòng 24 giờ</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary flex-shrink-0">
                                    <i class="ri-map-pin-fill text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Địa chỉ văn phòng</h4>
                                    <p class="text-gray-700">{{ $general_settings['address'] ?? '' }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary flex-shrink-0">
                                    <i class="ri-time-fill text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Giờ làm việc</h4>
                                    <p class="text-gray-700">{{ $general_settings['working_hours'] ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Quick Contact -->
                    <div class="bg-white rounded-lg shadow-lg p-8">
                        <h3 class="text-2xl font-bold mb-6 text-gray-900">Liên hệ nhanh</h3>
                        <div class="space-y-4">
                            <a href="tel:{{ $general_settings['hotline'] ?? '' }}" class="flex items-center gap-3 p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors duration-200">
                                <i class="ri-phone-line text-blue-600 text-xl"></i>
                                <div>
                                    <p class="font-medium text-sm text-gray-700">Gọi ngay</p>
                                    <p class="text-blue-600 font-semibold">{{ $general_settings['hotline'] ?? '' }}</p>
                                </div>
                            </a>
                            
                            <a href="https://zalo.me/{{ $general_settings['hotline'] ?? '' }}" target="_blank" class="flex items-center gap-3 p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors duration-200">
                                <i class="ri-message-line text-green-600 text-xl"></i>
                                <div>
                                    <p class="font-medium text-sm text-gray-700">Chat Zalo</p>
                                    <p class="text-green-600 font-semibold">{{ $general_settings['hotline'] ?? '' }}</p>
                                </div>
                            </a>
                            
                            <a href="mailto:{{ $general_settings['email'] ?? '' }}" class="flex items-center gap-3 p-4 bg-red-50 rounded-lg hover:bg-red-100 transition-colors duration-200">
                                <i class="ri-mail-line text-red-600 text-xl"></i>
                                <div>
                                    <p class="font-medium text-sm text-gray-700">Gửi email</p>
                                    <p class="text-red-600 font-semibold text-sm">{{ $general_settings['email'] ?? '' }}</p>
                                </div>
                            </a>
                        </div>
                        
                        <!-- Social Media -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h4 class="font-semibold text-gray-900 mb-4">Theo dõi chúng tôi</h4>
                            <div class="flex gap-3">
                                @if(!empty($general_settings['facebook']))
                                <a href="{{ $general_settings['facebook'] }}" target="_blank" class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white hover:bg-blue-700 transition-colors duration-200">
                                    <i class="ri-facebook-fill"></i>
                                </a>
                                @endif
                                @if(!empty($general_settings['youtube']))
                                <a href="{{ $general_settings['youtube'] }}" target="_blank" class="w-10 h-10 rounded-full bg-red-600 flex items-center justify-center text-white hover:bg-red-700 transition-colors duration-200">
                                    <i class="ri-youtube-fill"></i>
                                </a>
                                @endif
                                @if(!empty($general_settings['instagram']))
                                <a href="{{ $general_settings['instagram'] }}" target="_blank" class="w-10 h-10 rounded-full bg-pink-600 flex items-center justify-center text-white hover:bg-pink-700 transition-colors duration-200">
                                    <i class="ri-instagram-fill"></i>
                                </a>
                                @endif
                                @if(!empty($general_settings['tiktok']))
                                <a href="{{ $general_settings['tiktok'] }}" target="_blank" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-white hover:bg-gray-900 transition-colors duration-200">
                                    <i class="ri-tiktok-fill"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold mb-4 text-gray-900">Câu hỏi thường gặp</h2>
                    <p class="text-lg text-gray-600">Những thắc mắc phổ biến từ phụ huynh và học sinh</p>
                </div>
                
                <div class="space-y-6">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-semibold mb-3 text-gray-900 flex items-center">
                            <i class="ri-question-line text-primary mr-2"></i>
                            Dịch vụ tư vấn của LT365 có mất phí không?
                        </h3>
                        <p class="text-gray-700">Tư vấn cơ bản qua điện thoại và email hoàn toàn miễn phí. Chúng tôi chỉ thu phí cho các dịch vụ tư vấn chuyên sâu, lập kế hoạch học tập cá nhân hóa.</p>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-semibold mb-3 text-gray-900 flex items-center">
                            <i class="ri-question-line text-primary mr-2"></i>
                            Chúng tôi tư vấn cho những cấp học nào?
                        </h3>
                        <p class="text-gray-700">LT365 chuyên tư vấn cho các kỳ thi chuyển cấp: Thi vào lớp 1, lớp 6 và lớp 10. Chúng tôi có đội ngũ chuyên gia giàu kinh nghiệm cho từng cấp học.</p>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-semibold mb-3 text-gray-900 flex items-center">
                            <i class="ri-question-line text-primary mr-2"></i>
                            Thời gian phản hồi tư vấn là bao lâu?
                        </h3>
                        <p class="text-gray-700">Chúng tôi cam kết phản hồi trong vòng 24 giờ làm việc. Đối với các trường hợp khẩn cấp, bạn có thể gọi trực tiếp hotline để được hỗ trợ ngay lập tức.</p>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-semibold mb-3 text-gray-900 flex items-center">
                            <i class="ri-question-line text-primary mr-2"></i>
                            LT365 có hỗ trợ tư vấn online không?
                        </h3>
                        <p class="text-gray-700">Có, chúng tôi hỗ trợ tư vấn qua nhiều kênh: điện thoại, email, Zalo, và họp online qua Zoom/Google Meet theo yêu cầu.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

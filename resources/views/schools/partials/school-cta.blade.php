<!-- CTA Section -->
<section class="py-12 bg-gradient-to-r from-primary to-indigo-700 text-white" data-consultation-form>
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-6">Quan tâm đến {{ $school->name }}?</h2>
            <p class="text-lg mb-8 opacity-90">Đăng ký nhận thông tin tuyển sinh và được tư vấn miễn phí về kỳ thi vào {{ $school->level->name ?? 'trường' }}</p>
            
            <form class="flex flex-col md:flex-row gap-4 mb-6 max-w-2xl mx-auto">
                <div class="flex-1">
                    <input type="email" placeholder="Email của bạn" class="w-full p-3 rounded-button border-none focus:outline-none focus:ring-2 focus:ring-white/30 bg-white/10 text-white placeholder-white/70">
                </div>
                <button type="submit" class="md:w-auto px-6 py-3 bg-white text-primary font-medium rounded-button hover:bg-gray-100 transition-colors duration-200 whitespace-nowrap !rounded-button">Đăng ký tư vấn</button>
            </form>
            
            <div class="flex items-center justify-center gap-8 text-sm opacity-90">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                        <i class="ri-phone-line text-xl"></i>
                    </div>
                    <span class="font-medium">Tư vấn miễn phí</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                        <i class="ri-file-download-line text-xl"></i>
                    </div>
                    <span class="font-medium">Tài liệu miễn phí</span>
                </div>
            </div>
        </div>
    </div>
</section>

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\RssController;

/*
|--------------------------------------------------------------------------
| Web Routes - LT365 Frontend
|--------------------------------------------------------------------------
| 
| Cấu trúc routes được thiết kế theo nguyên tắc SEO-friendly với:
| - URLs tiếng Việt có dấu 
| - Hierarchical structure cho filtering
| - Slug + ID cho chi tiết (.html extension)
| - Route model binding tối ưu performance
|
*/

// ===== 1. TRANG CHỦ =====
Route::get('/', [HomeController::class, 'index'])->name('home');

// ===== 2. LANDING PAGES THI CHUYỂN CẤP =====
Route::prefix('thi-chuyen-cap')->name('exam.')->group(function () {
   // Landing page tổng quan thi chuyển cấp
   Route::get('/', [ExamController::class, 'index'])->name('index');
   
   // Landing pages theo từng cấp học
   Route::get('/thi-vao-lop-1', [ExamController::class, 'grade1'])->name('grade1');
   Route::get('/thi-vao-lop-6', [ExamController::class, 'grade6'])->name('grade6'); 
   Route::get('/thi-vao-lop-10', [ExamController::class, 'grade10'])->name('grade10');
});

// ===== 3. MODULE TÀI LIỆU (BỘ LỌC ĐA TIÊU CHÍ) =====
Route::prefix('tai-lieu')->name('documents.')->group(function () {
   // Danh sách tất cả tài liệu
   Route::get('/', [DocumentController::class, 'index'])->name('index');
   
   // ===== FILTER 1 TIÊU CHÍ =====
   
   // Filter theo loại tài liệu
   // VD: /tai-lieu/de-thi, /tai-lieu/bai-tap, /tai-lieu/tai-lieu-on-tap
   Route::get('/{documentType:slug}', [DocumentController::class, 'byType'])
       ->name('by-type');
   
   // Filter theo cấp học (sử dụng slug thực tế từ DB)
   // VD: /tai-lieu/cap-lop-1, /tai-lieu/cap-tieu-hoc, /tai-lieu/cap-lop-10
   Route::get('/cap-{level:slug}', [DocumentController::class, 'byLevel'])
       ->name('by-level');
   
   // Filter theo môn học
   // VD: /tai-lieu/mon-toan-hoc, /tai-lieu/mon-tieng-anh, /tai-lieu/mon-vat-ly
   Route::get('/mon-{subject:slug}', [DocumentController::class, 'bySubject'])
       ->name('by-subject');
   
   // ===== FILTER 2 TIÊU CHÍ =====
   
   // Loại tài liệu + Cấp học
   // VD: /tai-lieu/de-thi/cap-lop-1, /tai-lieu/bai-tap/cap-tieu-hoc
   Route::get('/{documentType:slug}/cap-{level:slug}', [DocumentController::class, 'byTypeAndLevel'])
       ->name('by-type-level');
   
   // Loại tài liệu + Môn học
   // VD: /tai-lieu/de-thi/mon-toan-hoc, /tai-lieu/bai-giang/mon-vat-ly
   Route::get('/{documentType:slug}/mon-{subject:slug}', [DocumentController::class, 'byTypeAndSubject'])
       ->name('by-type-subject');
   
   // Cấp học + Môn học (không có loại tài liệu cụ thể)
   // VD: /tai-lieu/cap-lop-10/mon-toan-hoc, /tai-lieu/cap-tieu-hoc/mon-tieng-anh
   Route::get('/cap-{level:slug}/mon-{subject:slug}', [DocumentController::class, 'byLevelAndSubject'])
       ->name('by-level-subject');
   
   // ===== FILTER ĐẦY ĐỦ 3 TIÊU CHÍ =====
   
   // Loại tài liệu + Cấp học + Môn học
   // VD: /tai-lieu/de-thi/cap-lop-10/mon-toan-hoc
   Route::get('/{documentType:slug}/cap-{level:slug}/mon-{subject:slug}', [DocumentController::class, 'byAll'])
       ->name('by-all');
   
   // ===== CHI TIẾT TÀI LIỆU =====
   
   // Chi tiết tài liệu: slug + ID + .html extension
   // VD: /tai-lieu/de-thi-toan-hoc-lop-10-hoc-ky-1-2024-1234.html
   Route::get('/{slug}-{id}.html', [DocumentController::class, 'show'])
       ->name('show')
       ->where('id', '[0-9]+')
       ->where('slug', '[a-z0-9-]+');
   
   // Download tài liệu (yêu cầu đăng nhập)
   // VD: /tai-lieu/de-thi-toan-hoc-lop-10-hoc-ky-1-2024-1234/download
   Route::get('/{slug}-{id}/download', [DocumentController::class, 'download'])
       ->name('download')
       ->where('id', '[0-9]+')
       ->where('slug', '[a-z0-9-]+')
       ->middleware('auth');
});

// ===== 4. MODULE TRƯỜNG HỌC (BỘ LỌC ĐA TIÊU CHÍ) =====
Route::prefix('truong-hoc')->name('schools.')->group(function () {
   // Danh sách tất cả trường học
   Route::get('/', [SchoolController::class, 'index'])->name('index');
   
   // ===== FILTER 1 TIÊU CHÍ =====
   
   // Filter theo cấp học
   // VD: /truong-hoc/tieu-hoc, /truong-hoc/thcs, /truong-hoc/thpt
   Route::get('/{level:slug}', [SchoolController::class, 'byLevel'])
       ->name('by-level')
       ->where('level', 'tieu-hoc|thcs|thpt|mam-non');
   
   // Filter theo tỉnh thành
   // VD: /truong-hoc/tai-ha-noi, /truong-hoc/tai-da-nang, /truong-hoc/tai-tp-ho-chi-minh
   Route::get('/tai-{province:slug}', [SchoolController::class, 'byProvince'])
       ->name('by-province');
   
   // Filter theo loại trường
   // VD: /truong-hoc/he-cong-lap, /truong-hoc/he-tu-thuc, /truong-hoc/he-chat-luong-cao
   Route::get('/he-{schoolType:slug}', [SchoolController::class, 'byType'])
       ->name('by-type');
   
   // ===== FILTER 2 TIÊU CHÍ =====
   
   // Cấp học + Tỉnh thành
   // VD: /truong-hoc/tieu-hoc/tai-ha-noi, /truong-hoc/thpt/tai-da-nang
   Route::get('/{level:slug}/tai-{province:slug}', [SchoolController::class, 'byLevelAndProvince'])
       ->name('by-level-province')
       ->where('level', 'tieu-hoc|thcs|thpt|mam-non');
   
   // Cấp học + Loại trường
   // VD: /truong-hoc/tieu-hoc/he-cong-lap, /truong-hoc/thpt/he-tu-thuc
   Route::get('/{level:slug}/he-{schoolType:slug}', [SchoolController::class, 'byLevelAndType'])
       ->name('by-level-type')
       ->where('level', 'tieu-hoc|thcs|thpt|mam-non');
   
   // Tỉnh thành + Loại trường
   // VD: /truong-hoc/tai-ha-noi/he-cong-lap, /truong-hoc/tai-da-nang/he-tu-thuc
   Route::get('/tai-{province:slug}/he-{schoolType:slug}', [SchoolController::class, 'byProvinceAndType'])
       ->name('by-province-type');
   
   // ===== FILTER ĐẦY ĐỦ 3 TIÊU CHÍ =====
   
   // Cấp học + Tỉnh thành + Loại trường
   // VD: /truong-hoc/tieu-hoc/tai-ha-noi/he-cong-lap
   Route::get('/{level:slug}/tai-{province:slug}/he-{schoolType:slug}', [SchoolController::class, 'byAll'])
       ->name('by-all')
       ->where('level', 'tieu-hoc|thcs|thpt|mam-non');
   
   // ===== CHI TIẾT TRƯỜNG HỌC =====
   
   // Chi tiết trường học: slug + ID + .html
   // VD: /truong-hoc/tieu-hoc-newton-ha-noi-123.html
   Route::get('/{slug}-{id}.html', [SchoolController::class, 'show'])
       ->name('show')
       ->where('id', '[0-9]+')
       ->where('slug', '[a-z0-9-]+');
});

// ===== 5. MODULE TIN TỨC & TƯ VẤN =====
Route::prefix('tin-tuc')->name('news.')->group(function () {
   // Danh sách tất cả tin tức
   Route::get('/', [NewsController::class, 'index'])->name('index');
   
   // Filter theo danh mục tin tức
   // VD: /tin-tuc/tin-tuyen-sinh, /tin-tuc/tu-van-chon-truong, /tin-tuc/kinh-nghiem-thi-cu
   Route::get('/{category:slug}', [NewsController::class, 'byCategory'])
       ->name('by-category');
   
   // Chi tiết tin tức: slug + ID + .html
   // VD: /tin-tuc/thong-tin-tuyen-sinh-lop-10-nam-2024-567.html
   Route::get('/{slug}-{id}.html', [NewsController::class, 'show'])
       ->name('show')
       ->where('id', '[0-9]+')
       ->where('slug', '[a-z0-9-]+');
});

// ===== 6. MODULE TRUNG TÂM (BỘ LỌC ĐA TIÊU CHÍ) =====
Route::prefix('trung-tam')->name('centers.')->group(function () {
   // Danh sách tất cả trung tâm
   Route::get('/', [CenterController::class, 'index'])->name('index');
   
   // ===== FILTER 1 TIÊU CHÍ =====
   
   // Filter theo cấp học
   // VD: /trung-tam/tieu-hoc, /trung-tam/thcs, /trung-tam/thpt
   Route::get('/{level:slug}', [CenterController::class, 'byLevel'])
       ->name('by-level')
       ->where('level', 'tieu-hoc|thcs|thpt|mam-non');
   
   // Filter theo môn học
   // VD: /trung-tam/mon-toan-hoc, /trung-tam/mon-tieng-anh, /trung-tam/mon-vat-ly
   Route::get('/mon-{subject:slug}', [CenterController::class, 'bySubject'])
       ->name('by-subject');
   
   // Filter theo tỉnh thành
   // VD: /trung-tam/tai-ha-noi, /trung-tam/tai-da-nang, /trung-tam/tai-tp-ho-chi-minh
   Route::get('/tai-{province:slug}', [CenterController::class, 'byProvince'])
       ->name('by-province');
   
   // ===== FILTER 2 TIÊU CHÍ =====
   
   // Cấp học + Môn học
   // VD: /trung-tam/tieu-hoc/mon-toan-hoc, /trung-tam/thpt/mon-vat-ly
   Route::get('/{level:slug}/mon-{subject:slug}', [CenterController::class, 'byLevelAndSubject'])
       ->name('by-level-subject')
       ->where('level', 'tieu-hoc|thcs|thpt|mam-non');
   
   // Cấp học + Tỉnh thành
   // VD: /trung-tam/tieu-hoc/tai-ha-noi, /trung-tam/thpt/tai-da-nang
   Route::get('/{level:slug}/tai-{province:slug}', [CenterController::class, 'byLevelAndProvince'])
       ->name('by-level-province')
       ->where('level', 'tieu-hoc|thcs|thpt|mam-non');
   
   // Môn học + Tỉnh thành
   // VD: /trung-tam/mon-toan-hoc/tai-ha-noi, /trung-tam/mon-tieng-anh/tai-da-nang
   Route::get('/mon-{subject:slug}/tai-{province:slug}', [CenterController::class, 'bySubjectAndProvince'])
       ->name('by-subject-province');
   
   // ===== FILTER ĐẦY ĐỦ 3 TIÊU CHÍ =====
   
   // Cấp học + Môn học + Tỉnh thành
   // VD: /trung-tam/tieu-hoc/mon-toan-hoc/tai-ha-noi
   Route::get('/{level:slug}/mon-{subject:slug}/tai-{province:slug}', [CenterController::class, 'byAll'])
       ->name('by-all')
       ->where('level', 'tieu-hoc|thcs|thpt|mam-non');
   
   // ===== CHI TIẾT TRUNG TÂM =====
   
   // Chi tiết trung tâm: slug + ID + .html
   // VD: /trung-tam/trung-tam-luyen-thi-a-plus-ha-noi-89.html
   Route::get('/{slug}-{id}.html', [CenterController::class, 'show'])
       ->name('show')
       ->where('id', '[0-9]+')
       ->where('slug', '[a-z0-9-]+');
});

// ===== 7. MODULE GIÁO VIÊN (BỘ LỌC ĐA TIÊU CHÍ) =====
Route::prefix('giao-vien')->name('teachers.')->group(function () {
   // Danh sách tất cả giáo viên
   Route::get('/', [TeacherController::class, 'index'])->name('index');
   
   // ===== FILTER 1 TIÊU CHÍ =====
   
   // Filter theo cấp học
   // VD: /giao-vien/tieu-hoc, /giao-vien/thcs, /giao-vien/thpt
   Route::get('/{level:slug}', [TeacherController::class, 'byLevel'])
       ->name('by-level')
       ->where('level', 'tieu-hoc|thcs|thpt|mam-non');
   
   // Filter theo môn học
   // VD: /giao-vien/mon-toan-hoc, /giao-vien/mon-tieng-anh, /giao-vien/mon-vat-ly
   Route::get('/mon-{subject:slug}', [TeacherController::class, 'bySubject'])
       ->name('by-subject');
   
   // Filter theo tỉnh thành
   // VD: /giao-vien/tai-ha-noi, /giao-vien/tai-da-nang, /giao-vien/tai-tp-ho-chi-minh
   Route::get('/tai-{province:slug}', [TeacherController::class, 'byProvince'])
       ->name('by-province');
   
   // ===== FILTER 2 TIÊU CHÍ =====
   
   // Cấp học + Môn học
   // VD: /giao-vien/tieu-hoc/mon-toan-hoc, /giao-vien/thpt/mon-vat-ly
   Route::get('/{level:slug}/mon-{subject:slug}', [TeacherController::class, 'byLevelAndSubject'])
       ->name('by-level-subject')
       ->where('level', 'tieu-hoc|thcs|thpt|mam-non');
   
   // Cấp học + Tỉnh thành
   // VD: /giao-vien/tieu-hoc/tai-ha-noi, /giao-vien/thpt/tai-da-nang
   Route::get('/{level:slug}/tai-{province:slug}', [TeacherController::class, 'byLevelAndProvince'])
       ->name('by-level-province')
       ->where('level', 'tieu-hoc|thcs|thpt|mam-non');
   
   // Môn học + Tỉnh thành
   // VD: /giao-vien/mon-toan-hoc/tai-ha-noi, /giao-vien/mon-tieng-anh/tai-da-nang
   Route::get('/mon-{subject:slug}/tai-{province:slug}', [TeacherController::class, 'bySubjectAndProvince'])
       ->name('by-subject-province');
   
   // ===== FILTER ĐẦY ĐỦ 3 TIÊU CHÍ =====
   
   // Cấp học + Môn học + Tỉnh thành
   // VD: /giao-vien/tieu-hoc/mon-toan-hoc/tai-ha-noi
   Route::get('/{level:slug}/mon-{subject:slug}/tai-{province:slug}', [TeacherController::class, 'byAll'])
       ->name('by-all')
       ->where('level', 'tieu-hoc|thcs|thpt|mam-non');
   
   // ===== CHI TIẾT GIÁO VIÊN =====
   
   // Chi tiết giáo viên: slug + ID + .html
   // VD: /giao-vien/thay-nguyen-van-toan-giao-vien-toan-456.html
   Route::get('/{slug}-{id}.html', [TeacherController::class, 'show'])
       ->name('show')
       ->where('id', '[0-9]+')
       ->where('slug', '[a-z0-9-]+');
});

// ===== 8. TÌM KIẾM & LỌC =====

// Tìm kiếm tổng hợp
Route::get('/tim-kiem', [SearchController::class, 'index'])->name('search');

// API routes cho AJAX filtering & suggestions (tối ưu performance)
Route::prefix('api')->name('api.')->middleware(['throttle:api'])->group(function () {
   Route::get('/schools/filter', [SchoolController::class, 'filter'])->name('schools.filter');
   Route::get('/documents/filter', [DocumentController::class, 'filter'])->name('documents.filter');
   Route::get('/news/filter', [NewsController::class, 'filter'])->name('news.filter');
   Route::get('/centers/filter', [CenterController::class, 'filter'])->name('centers.filter');
   Route::get('/teachers/filter', [TeacherController::class, 'filter'])->name('teachers.filter');
   Route::get('/search/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');
});

// ===== 9. LIÊN HỆ =====
Route::prefix('lien-he')->name('contact.')->group(function () {
   Route::get('/', [ContactController::class, 'index'])->name('index');
   Route::post('/', [ContactController::class, 'store'])
       ->name('store')
       ->middleware(['throttle:contact']);
});

// ===== 10. USER AUTHENTICATION =====
Route::prefix('auth')->name('auth.')->group(function () {
   // Đăng nhập
   Route::get('/dang-nhap', [AuthController::class, 'showLogin'])->name('login');
   Route::post('/dang-nhap', [AuthController::class, 'login'])->name('login.post');
   
   // Đăng ký
   Route::get('/dang-ky', [AuthController::class, 'showRegister'])->name('register');
   Route::post('/dang-ky', [AuthController::class, 'register'])->name('register.post');
   
   // Đăng xuất
   Route::post('/dang-xuat', [AuthController::class, 'logout'])->name('logout');
   
   // Quên mật khẩu
   Route::get('/quen-mat-khau', [AuthController::class, 'showForgotPassword'])->name('forgot-password');
   Route::post('/quen-mat-khau', [AuthController::class, 'sendResetLink'])->name('forgot-password.post');
   Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('reset-password');
   Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password.post');
});

// ===== 11. USER DASHBOARD (Yêu cầu đăng nhập) =====
Route::middleware('auth')->prefix('tai-khoan')->name('user.')->group(function () {
   // Dashboard chính
   Route::get('/', [UserController::class, 'dashboard'])->name('dashboard');
   
   // Hồ sơ cá nhân
   Route::get('/ho-so', [UserController::class, 'profile'])->name('profile');
   Route::put('/ho-so', [UserController::class, 'updateProfile'])->name('profile.update');
   
   // Tài liệu đã tải
   Route::get('/tai-lieu-da-tai', [UserController::class, 'downloads'])->name('downloads');
   
   // Yêu thích
   Route::get('/yeu-thich', [UserController::class, 'favorites'])->name('favorites');
   Route::post('/yeu-thich/{type}/{id}', [UserController::class, 'toggleFavorite'])->name('favorites.toggle');
   
   // Đổi mật khẩu
   Route::get('/doi-mat-khau', [UserController::class, 'showChangePassword'])->name('change-password');
   Route::put('/doi-mat-khau', [UserController::class, 'changePassword'])->name('change-password.post');
});

// ===== 12. UTILITY ROUTES =====

// Newsletter subscription
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])
   ->name('newsletter.subscribe')
   ->middleware(['throttle:newsletter']);

// Sitemap cho SEO
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/sitemap/{type}.xml', [SitemapController::class, 'show'])
   ->name('sitemap.show')
   ->where('type', 'documents|schools|news|centers|teachers|pages');

// RSS feeds
Route::get('/rss', [RssController::class, 'index'])->name('rss');
Route::get('/rss/{category:slug}', [RssController::class, 'category'])->name('rss.category');

// ===== 13. TRANG TĨNH (Pages) =====
// Đặt cuối cùng để tránh conflict với các routes khác
Route::prefix('trang')->name('page.')->group(function () {
   // Trang tĩnh với .html extension
   // VD: /trang/chinh-sach-bao-mat.html, /trang/dieu-khoan-su-dung.html, /trang/huong-dan-thanh-toan.html
   Route::get('/{page:slug}.html', [PageController::class, 'show'])
       ->name('show')
       ->where('page', '[a-z0-9-]+');
});

/*
|--------------------------------------------------------------------------
| Route Model Binding Customization
|--------------------------------------------------------------------------
|
| Custom route model binding để tối ưu performance với ID lookup
| cho các routes có format {slug}-{id}.html
|
*/

// Custom binding cho documents với ID
Route::bind('document', function ($value) {
   // Extract ID từ slug-id format
   if (preg_match('/^(.+)-(\d+)$/', $value, $matches)) {
       $slug = $matches[1];
       $id = $matches[2];
       
       // Lookup by ID (fastest) và validate slug
       $document = \App\Models\Document::findOrFail($id);
       
       // Optional: Redirect nếu slug không khớp để đảm bảo canonical URL
       if ($document->slug !== $slug) {
           abort(301, '', ['Location' => route('documents.show', $document->slug . '-' . $document->id)]);
       }
       
       return $document;
   }
   
   abort(404);
});

// Tương tự cho các models khác
Route::bind('school', function ($value) {
   if (preg_match('/^(.+)-(\d+)$/', $value, $matches)) {
       return \App\Models\School::findOrFail($matches[2]);
   }
   abort(404);
});

Route::bind('news', function ($value) {
   if (preg_match('/^(.+)-(\d+)$/', $value, $matches)) {
       return \App\Models\News::findOrFail($matches[2]);
   }
   abort(404);
});

Route::bind('center', function ($value) {
   if (preg_match('/^(.+)-(\d+)$/', $value, $matches)) {
       return \App\Models\Center::findOrFail($matches[2]);
   }
   abort(404);
});

Route::bind('teacher', function ($value) {
   if (preg_match('/^(.+)-(\d+)$/', $value, $matches)) {
       return \App\Models\Teacher::findOrFail($matches[2]);
   }
   abort(404);
});

/*
|--------------------------------------------------------------------------
| Throttling Configuration
|--------------------------------------------------------------------------
|
| Định nghĩa rate limiting cho các endpoints khác nhau
|
*/

// Trong RouteServiceProvider hoặc middleware groups
// 'contact' => '5,1', // 5 requests per minute
// 'newsletter' => '3,1', // 3 requests per minute  
// 'api' => '100,1', // 100 requests per minute cho API calls
// 'search' => '30,1', // 30 searches per minute
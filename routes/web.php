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

    // CHI TIẾT & DOWNLOAD (Specific patterns, should be high priority)
    Route::get('/{slug}-{id}.html', [DocumentController::class, 'show'])
        ->name('show')
        ->where('id', '[0-9]+')->where('slug', '[a-z0-9-]+');

    Route::get('/{slug}-{id}/download', [DocumentController::class, 'download'])
        ->name('download')
        ->where('id', '[0-9]+')->where('slug', '[a-z0-9-]+')
        ->middleware('auth');

    // FILTER ĐẦY ĐỦ 3 TIÊU CHÍ
    Route::get('/{typeSlug}/cap-{levelSlug}/mon-{subjectSlug}', [DocumentController::class, 'byAll'])
        ->name('by-all');

    // FILTER 2 TIÊU CHÍ
    Route::get('/{typeSlug}/cap-{levelSlug}', [DocumentController::class, 'byTypeAndLevel'])
        ->name('by-type-level');
    Route::get('/{typeSlug}/mon-{subjectSlug}', [DocumentController::class, 'byTypeAndSubject'])
        ->name('by-type-subject');
    Route::get('/cap-{levelSlug}/mon-{subjectSlug}', [DocumentController::class, 'byLevelAndSubject'])
        ->name('by-level-subject');

    // FILTER 1 TIÊU CHÍ (Specific prefixes first)
    Route::get('/cap-{levelSlug}', [DocumentController::class, 'byLevel'])
        ->name('by-level');
    Route::get('/mon-{subjectSlug}', [DocumentController::class, 'bySubject'])
        ->name('by-subject');
    
    // FILTER 1 TIÊU CHÍ (Generic slug last)
    Route::get('/{typeSlug}', [DocumentController::class, 'byType'])
        ->name('by-type');
});

// ===== 4. MODULE TRƯỜNG HỌC (BỘ LỌC ĐA TIÊU CHÍ) =====
Route::prefix('truong-hoc')->name('schools.')->group(function () {
    // Danh sách tất cả trường học
    Route::get('/', [SchoolController::class, 'index'])->name('index');

    // CHI TIẾT TRƯỜNG HỌC (Specific patterns, should be high priority)
    Route::get('/{slug}-{id}.html', [SchoolController::class, 'show'])
        ->name('show')
        ->where('id', '[0-9]+')->where('slug', '[a-z0-9-]+');

    // FILTER ĐẦY ĐỦ 3 TIÊU CHÍ
    Route::get('/{levelSlug}/tai-{provinceSlug}/he-{schoolTypeSlug}', [SchoolController::class, 'byAll'])
        ->name('by-all');

    // FILTER 2 TIÊU CHÍ
    Route::get('/{levelSlug}/tai-{provinceSlug}', [SchoolController::class, 'byLevelAndProvince'])
        ->name('by-level-province');
    Route::get('/{levelSlug}/he-{schoolTypeSlug}', [SchoolController::class, 'byLevelAndType'])
        ->name('by-level-type');
    Route::get('/tai-{provinceSlug}/he-{schoolTypeSlug}', [SchoolController::class, 'byProvinceAndType'])
        ->name('by-province-type');

    // FILTER 1 TIÊU CHÍ (Specific prefixes first)
    Route::get('/tai-{provinceSlug}', [SchoolController::class, 'byProvince'])
        ->name('by-province');
    Route::get('/he-{schoolTypeSlug}', [SchoolController::class, 'byType'])
        ->name('by-type');
    
    // FILTER 1 TIÊU CHÍ (Generic slug last)
    Route::get('/{levelSlug}', [SchoolController::class, 'byLevel'])
        ->name('by-level');
});

// ===== 5. MODULE TIN TỨC & TƯ VẤN =====
Route::prefix('tin-tuc')->name('news.')->group(function () {
   // Danh sách tất cả tin tức
   Route::get('/', [NewsController::class, 'index'])->name('index');
   
   // Chi tiết tin tức: slug + ID + .html
   // VD: /tin-tuc/thong-tin-tuyen-sinh-lop-10-nam-2024-567.html
   Route::get('/{slug}-{id}.html', [NewsController::class, 'show'])
       ->name('show')
       ->where('id', '[0-9]+')
       ->where('slug', '[a-z0-9-]+');

   // Filter theo danh mục tin tức
   // VD: /tin-tuc/tin-tuyen-sinh, /tin-tuc/tu-van-chon-truong, /tin-tuc/kinh-nghiem-thi-cu
   Route::get('/{category:slug}', [NewsController::class, 'byCategory'])
       ->name('by-category');
});

// ===== 6. MODULE TRUNG TÂM (BỘ LỌC ĐA TIÊU CHÍ) =====
Route::prefix('trung-tam')->name('centers.')->group(function () {
    // Danh sách tất cả trung tâm
    Route::get('/', [CenterController::class, 'index'])->name('index');

    // CHI TIẾT TRUNG TÂM (Specific patterns, should be high priority)
    Route::get('/{slug}-{id}.html', [CenterController::class, 'show'])
        ->name('show')
        ->where('id', '[0-9]+')->where('slug', '[a-z0-9-]+');

    // FILTER ĐẦY ĐỦ 3 TIÊU CHÍ
    Route::get('/{levelSlug}/mon-{subjectSlug}/tai-{provinceSlug}', [CenterController::class, 'byAll'])
        ->name('by-all');

    // FILTER 2 TIÊU CHÍ
    Route::get('/{levelSlug}/mon-{subjectSlug}', [CenterController::class, 'byLevelAndSubject'])
        ->name('by-level-subject');
    Route::get('/{levelSlug}/tai-{provinceSlug}', [CenterController::class, 'byLevelAndProvince'])
        ->name('by-level-province');
    Route::get('/mon-{subjectSlug}/tai-{provinceSlug}', [CenterController::class, 'bySubjectAndProvince'])
        ->name('by-subject-province');

    // FILTER 1 TIÊU CHÍ (Specific prefixes first)
    Route::get('/mon-{subjectSlug}', [CenterController::class, 'bySubject'])
        ->name('by-subject');
    Route::get('/tai-{provinceSlug}', [CenterController::class, 'byProvince'])
        ->name('by-province');
    
    // FILTER 1 TIÊU CHÍ (Generic slug last)
    Route::get('/{levelSlug}', [CenterController::class, 'byLevel'])
        ->name('by-level');
});

// ===== 7. MODULE GIÁO VIÊN (BỘ LỌC ĐA TIÊU CHÍ) =====
Route::prefix('giao-vien')->name('teachers.')->group(function () {
    // Danh sách tất cả giáo viên
    Route::get('/', [TeacherController::class, 'index'])->name('index');

    // CHI TIẾT GIÁO VIÊN (Specific patterns, should be high priority)
    Route::get('/{slug}-{id}.html', [TeacherController::class, 'show'])
        ->name('show')
        ->where('id', '[0-9]+')->where('slug', '[a-z0-9-]+');

    // FILTER ĐẦY ĐỦ 3 TIÊU CHÍ
    Route::get('/{levelSlug}/mon-{subjectSlug}/tai-{provinceSlug}', [TeacherController::class, 'byAll'])
        ->name('by-all');

    // FILTER 2 TIÊU CHÍ
    Route::get('/{levelSlug}/mon-{subjectSlug}', [TeacherController::class, 'byLevelAndSubject'])
        ->name('by-level-subject');
    Route::get('/{levelSlug}/tai-{provinceSlug}', [TeacherController::class, 'byLevelAndProvince'])
        ->name('by-level-province');
    Route::get('/mon-{subjectSlug}/tai-{provinceSlug}', [TeacherController::class, 'bySubjectAndProvince'])
        ->name('by-subject-province');

    // FILTER 1 TIÊU CHÍ (Specific prefixes first)
    Route::get('/mon-{subjectSlug}', [TeacherController::class, 'bySubject'])
        ->name('by-subject');
    Route::get('/tai-{provinceSlug}', [TeacherController::class, 'byProvince'])
        ->name('by-province');
    
    // FILTER 1 TIÊU CHÍ (Generic slug last)
    Route::get('/{levelSlug}', [TeacherController::class, 'byLevel'])
        ->name('by-level');
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
   Route::get('/dang-nhap', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
   Route::post('/dang-nhap', [AuthController::class, 'login'])->name('login')->middleware('guest');
   
   // Đăng ký
   Route::get('/dang-ky', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
   Route::post('/dang-ky', [AuthController::class, 'register'])->name('register')->middleware('guest');
   
   // Email verification
   Route::get('/xac-thuc-email', [AuthController::class, 'verifyNotice'])->name('verify.notice');
   Route::get('/verify', [AuthController::class, 'verify'])->name('verify');
   Route::post('/xac-thuc-gui-lai', [AuthController::class, 'resendVerification'])->name('verify.resend');
   
   // Đăng xuất
   Route::post('/dang-xuat', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
});

// Alternative routes without auth prefix for shorter URLs
Route::get('/dang-nhap', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/dang-nhap', [AuthController::class, 'login'])->middleware('guest');
Route::get('/dang-ky', [AuthController::class, 'showRegister'])->name('register.show')->middleware('guest');
Route::post('/dang-ky', [AuthController::class, 'register'])->middleware('guest');
Route::get('/xac-thuc-email', [AuthController::class, 'verifyNotice'])->name('verify.notice.alt');
Route::post('/dang-xuat', [AuthController::class, 'logout'])->name('logout.alt')->middleware('auth');

// ===== 11. USER DASHBOARD (Yêu cầu đăng nhập và xác thực email) =====
Route::middleware(['auth', 'verified'])->prefix('tai-khoan')->name('user.')->group(function () {
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

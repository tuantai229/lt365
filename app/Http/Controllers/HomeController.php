<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\NewsCategory;
use App\Models\News;
use App\Models\Center;
use App\Models\Teacher;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Lấy tất cả cài đặt trang chủ
        $heroSlides = Setting::getHomeHeroSlides();
        $quickTransfer = Setting::getHomeQuickTransfer();
        $newsSchedule = Setting::getHomeNewsSchedule();
        $teachersCenters = Setting::getHomeTeachersCenters();
        $statsReviews = Setting::getHomeStatsReviews();

        // Lấy tin tức từ danh mục đã chọn
        $selectedNews = [];
        if (!empty($newsSchedule['selected_category_id'])) {
            $selectedNews = News::whereHas('categories', function($query) use ($newsSchedule) {
                $query->where('news_categories.id', $newsSchedule['selected_category_id']);
            })
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();
        }

        // Lấy danh sách trung tâm đã chọn
        $selectedCenters = [];
        if (!empty($teachersCenters['centers'])) {
            $selectedCenters = Center::whereIn('id', $teachersCenters['centers'])
                ->where('status', 1)
                ->get();
        }

        // Lấy danh sách giáo viên đã chọn
        $selectedTeachers = [];
        if (!empty($teachersCenters['teachers'])) {
            $selectedTeachers = Teacher::whereIn('id', $teachersCenters['teachers'])
                ->where('status', 1)
                ->get();
        }

        return view('home', compact(
            'heroSlides',
            'quickTransfer',
            'selectedNews',
            'selectedCenters',
            'selectedTeachers',
            'statsReviews'
        ));
    }
}

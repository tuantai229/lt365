<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\NewsCategory;
use App\Models\News;
use App\Models\Center;
use App\Models\Teacher;
use App\Models\Level;
use App\Models\Province;
use App\Models\SchoolType;
use App\Models\Subject;
use App\Models\DocumentType;
use App\Models\Document;
use App\Models\SchoolAdmission;
use Carbon\Carbon;

class HomeController extends Controller
{
    public $upcomingSchedules = [];
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Smart search data
        $schoolLevels = Level::active()->parentOnly()->ordered()->get();
        $documentLevels = Level::active()->ordered()->get();
        $provinces = Province::majorCities()->orderBy('name', 'asc')->get();
        $schoolTypes = SchoolType::active()->ordered()->get();
        $subjects = Subject::active()->ordered()->get();
        $documentTypes = DocumentType::active()->ordered()->get();

        // Featured documents
        $featuredDocumentLevels = Level::active()->where('parent_id', 0)->ordered()->get();
        $featuredDocuments = collect();
        $featuredDocuments['latest'] = Document::with(['level', 'subject', 'documentType', 'featuredImage'])->active()->latest()->limit(4)->get();
        foreach ($featuredDocumentLevels as $level) {
            $levelIds = $level->getAllChildrenIds();
            $levelIds[] = $level->id;
            $featuredDocuments[$level->slug] = Document::with(['level', 'subject', 'documentType', 'featuredImage'])
                ->active()
                ->whereIn('level_id', $levelIds)
                ->featured()
                ->limit(4)
                ->get();
        }

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
            ->limit(5)
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

        $this->getUpcomingSchedules();
        $upcomingSchedules = $this->upcomingSchedules;

        $data = compact(
            'heroSlides',
            'quickTransfer',
            'selectedNews',
            'selectedCenters',
            'selectedTeachers',
            'statsReviews',
            'schoolLevels',
            'documentLevels',
            'provinces',
            'schoolTypes',
            'subjects',
            'documentTypes',
            'featuredDocumentLevels',
            'featuredDocuments',
            'upcomingSchedules'
        );

        return $this->viewWithSeo('home', 'home', $data);
    }

    private function getUpcomingSchedules()
    {
        $today = Carbon::today();
        $admissions = SchoolAdmission::with('school')->get();
        $events = [];

        foreach ($admissions as $admission) {
            if ($admission->register_start_date && $today->lte($admission->register_start_date)) {
                $events[] = [
                    'date' => Carbon::parse($admission->register_start_date),
                    'title' => 'Bắt đầu đăng ký hồ sơ tuyển sinh',
                    'school' => $admission->school->name,
                    'school_slug' => $admission->school->slug,
                    'school_id' => $admission->school->id,
                ];
            }
            if ($admission->register_end_date && $today->lte($admission->register_end_date)) {
                $events[] = [
                    'date' => Carbon::parse($admission->register_end_date),
                    'title' => 'Kết thúc đăng ký hồ sơ tuyển sinh',
                    'school' => $admission->school->name,
                    'school_slug' => $admission->school->slug,
                    'school_id' => $admission->school->id,
                ];
            }
            if ($admission->exam_date && $today->lte($admission->exam_date)) {
                $events[] = [
                    'date' => Carbon::parse($admission->exam_date),
                    'title' => 'Thi tuyển sinh chính thức',
                    'school' => $admission->school->name,
                    'school_slug' => $admission->school->slug,
                    'school_id' => $admission->school->id,
                ];
            }
            if ($admission->result_announcement_date && $today->lte($admission->result_announcement_date)) {
                $events[] = [
                    'date' => Carbon::parse($admission->result_announcement_date),
                    'title' => 'Công bố kết quả tuyển sinh',
                    'school' => $admission->school->name,
                    'school_slug' => $admission->school->slug,
                    'school_id' => $admission->school->id,
                ];
            }
        }

        // Sort events by date
        usort($events, function ($a, $b) {
            return $a['date'] <=> $b['date'];
        });

        $this->upcomingSchedules = array_slice($events, 0, 5);
    }
}

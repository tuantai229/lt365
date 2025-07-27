<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\SchoolAdmission;
use Carbon\Carbon;

class ExamController extends Controller
{
    // Constants for level IDs
    const ELEMENTARY_LEVEL_ID = 2; // Tiểu học - Lớp 1
    const JUNIOR_HIGH_LEVEL_ID = 3; // Trung học cơ sở - Lớp 6
    const HIGH_SCHOOL_LEVEL_ID = 4; // Trung học phổ thông - Lớp 10

    /**
     * Display the main exam landing page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('exam.index');
    }

    /**
     * Display the landing page for grade 1 exams.
     *
     * @return \Illuminate\View\View
     */
    public function grade1()
    {
        $admissionNews = $this->getAdmissionNews(self::ELEMENTARY_LEVEL_ID);
        $upcomingSchedules = $this->getUpcomingSchedules(self::ELEMENTARY_LEVEL_ID);

        return view('exam.grade1', compact('admissionNews', 'upcomingSchedules'));
    }

    /**
     * Display the landing page for grade 6 exams.
     *
     * @return \Illuminate\View\View
     */
    public function grade6()
    {
        $admissionNews = $this->getAdmissionNews(self::JUNIOR_HIGH_LEVEL_ID);
        $upcomingSchedules = $this->getUpcomingSchedules(self::JUNIOR_HIGH_LEVEL_ID);

        return view('exam.grade6', compact('admissionNews', 'upcomingSchedules'));
    }

    /**
     * Display the landing page for grade 10 exams.
     *
     * @return \Illuminate\View\View
     */
    public function grade10()
    {
        $admissionNews = $this->getAdmissionNews(self::HIGH_SCHOOL_LEVEL_ID);
        $upcomingSchedules = $this->getUpcomingSchedules(self::HIGH_SCHOOL_LEVEL_ID);

        return view('exam.grade10', compact('admissionNews', 'upcomingSchedules'));
    }

    /**
     * Get admission news for specific level
     *
     * @param int $levelId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getAdmissionNews($levelId)
    {
        // Get the admission news category ID (assumes it's already set up)
        $admissionCategory = NewsCategory::where('slug', 'tin-tuyen-sinh')->first();
        
        if (!$admissionCategory) {
            return collect();
        }

        return News::with(['featuredImage', 'categories', 'school', 'school.level'])
            ->whereHas('categories', function($query) use ($admissionCategory) {
                $query->where('news_categories.id', $admissionCategory->id);
            })
            ->whereHas('school', function($query) use ($levelId) {
                $query->where('level_id', $levelId);
            })
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
    }

    /**
     * Get upcoming admission schedules for specific level
     *
     * @param int $levelId
     * @return array
     */
    private function getUpcomingSchedules($levelId)
    {
        $today = Carbon::today();
        $admissions = SchoolAdmission::with(['school', 'school.level'])
            ->whereHas('school', function($query) use ($levelId) {
                $query->where('level_id', $levelId);
            })
            ->get();
        
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

        return array_slice($events, 0, 5);
    }
}

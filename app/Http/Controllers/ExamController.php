<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\School;
use App\Models\SchoolAdmission;
use App\Models\Document;
use App\Models\Level;
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
        return $this->viewWithSeo('exam.index', 'exam.index');
    }

    /**
     * Display the landing page for grade 1 exams.
     *
     * @return \Illuminate\View\View
     */
    public function grade1()
    {
        $level = Level::find(self::ELEMENTARY_LEVEL_ID);
        $levelIds = $level ? $level->getAllChildrenIds() : [];
        $levelIds[] = self::ELEMENTARY_LEVEL_ID;

        $admissionNews = $this->getAdmissionNews($levelIds);
        $upcomingSchedules = $this->getUpcomingSchedules($levelIds);
        $featuredSchools = $this->getFeaturedSchools($levelIds);
        $documents = $this->getDocuments($levelIds);

        $data = compact('admissionNews', 'upcomingSchedules', 'featuredSchools', 'documents');
        $additionalData = ['total_documents' => Document::whereIn('level_id', $levelIds)->active()->count()];
        $data = array_merge($data, $additionalData);

        return $this->viewWithSeo('exam.grade1', 'exam.grade1', $data);
    }

    /**
     * Display the landing page for grade 6 exams.
     *
     * @return \Illuminate\View\View
     */
    public function grade6()
    {
        $level = Level::find(self::JUNIOR_HIGH_LEVEL_ID);
        $levelIds = $level ? $level->getAllChildrenIds() : [];
        $levelIds[] = self::JUNIOR_HIGH_LEVEL_ID;

        $admissionNews = $this->getAdmissionNews($levelIds);
        $upcomingSchedules = $this->getUpcomingSchedules($levelIds);
        $featuredSchools = $this->getFeaturedSchools($levelIds);
        $documents = $this->getDocuments($levelIds);

        $data = compact('admissionNews', 'upcomingSchedules', 'featuredSchools', 'documents');
        $additionalData = ['total_documents' => Document::whereIn('level_id', $levelIds)->active()->count()];
        $data = array_merge($data, $additionalData);

        return $this->viewWithSeo('exam.grade6', 'exam.grade6', $data);
    }

    /**
     * Display the landing page for grade 10 exams.
     *
     * @return \Illuminate\View\View
     */
    public function grade10()
    {
        $level = Level::find(self::HIGH_SCHOOL_LEVEL_ID);
        $levelIds = $level ? $level->getAllChildrenIds() : [];
        $levelIds[] = self::HIGH_SCHOOL_LEVEL_ID;

        $admissionNews = $this->getAdmissionNews($levelIds);
        $upcomingSchedules = $this->getUpcomingSchedules($levelIds);
        $featuredSchools = $this->getFeaturedSchools($levelIds);
        $documents = $this->getDocuments($levelIds);

        $data = compact('admissionNews', 'upcomingSchedules', 'featuredSchools', 'documents');
        $additionalData = ['total_documents' => Document::whereIn('level_id', $levelIds)->active()->count()];
        $data = array_merge($data, $additionalData);

        return $this->viewWithSeo('exam.grade10', 'exam.grade10', $data);
    }

    /**
     * Get admission news for specific level
     *
     * @param int $levelId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getAdmissionNews($levelIds)
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
            ->whereHas('school', function($query) use ($levelIds) {
                $query->whereIn('level_id', $levelIds);
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
    private function getUpcomingSchedules($levelIds)
    {
        $today = Carbon::today();
        $admissions = SchoolAdmission::with(['school', 'school.level'])
            ->whereHas('school', function($query) use ($levelIds) {
                $query->whereIn('level_id', $levelIds);
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

    /**
     * Get featured schools for specific level
     *
     * @param int $levelId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getFeaturedSchools($levelIds)
    {
        return School::with(['featuredImage', 'level', 'province', 'schoolTypes'])
            ->whereIn('level_id', $levelIds)
            ->where('is_featured', 1)
            ->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->get();
    }

    /**
     * Get latest and featured documents for specific level
     *
     * @param int $levelId
     * @return array
     */
    private function getDocuments($levelIds)
    {
        $documents = collect();

        // Get latest documents
        $documents['latest'] = Document::with(['featuredImage', 'documentType'])
            ->whereIn('level_id', $levelIds)
            ->where('status', 1)
            ->latest() // Orders by created_at desc
            ->limit(4)
            ->get();

        // Get featured documents (popular)
        $documents['featured'] = Document::with(['featuredImage', 'documentType'])
            ->whereIn('level_id', $levelIds)
            ->where('is_featured', 1)
            ->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->limit(4)
            ->get();
            
        return $documents;
    }
}

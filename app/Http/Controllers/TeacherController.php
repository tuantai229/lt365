<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Level;
use App\Models\Subject;
use App\Models\Province;
use App\Models\News;

class TeacherController extends Controller
{
    /**
     * Display a listing of all teachers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Teacher::with(['levels', 'subjects', 'province', 'commune', 'featuredImage'])->active();

        // Quick filters
        if ($request->has('filter')) {
            switch ($request->get('filter')) {
                case 'popular':
                    $query->where('sort_order', '<', 100);
                    break;
                case 'experienced':
                    $query->where('experience', '>=', 10);
                    break;
                case 'new':
                    $query->where('experience', '<', 5);
                    break;
            }
        }

        // Search by name
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->get('search') . '%');
        }
        
        $query->orderBy('sort_order', 'asc')->orderBy('name', 'asc');

        $teachers = $query->paginate(16)->withQueryString();
            
        $levels = Level::active()->parentOnly()->ordered()->get();
        $provinces = Province::majorCities()->orderBy('name', 'asc')->get();
        $subjects = Subject::active()->ordered()->get();

        return view('teachers.index', compact('teachers', 'levels', 'provinces', 'subjects'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug, $id)
    {
        $teacher = Teacher::with([
            'levels', 'subjects', 'province', 'commune', 'featuredImage', 'metaSeo'
        ])
        ->active()
        ->findOrFail($id);

        // Sidebar: Related teachers
        $relatedTeachers = Teacher::with(['featuredImage'])
            ->active()
            ->where('id', '!=', $teacher->id)
            ->where(function ($query) use ($teacher) {
                $query->where('province_id', $teacher->province_id)
                    ->orWhereHas('levels', function($q) use ($teacher) {
                        $q->whereIn('level_id', $teacher->levels->pluck('id'));
                    })
                    ->orWhereHas('subjects', function($q) use ($teacher) {
                        $q->whereIn('subject_id', $teacher->subjects->pluck('id'));
                    });
            })
            ->orderBy('sort_order', 'asc')->orderBy('name', 'asc')
            ->limit(5)
            ->get();

        // Featured News (related to education/teachers)
        $featuredNews = News::with('featuredImage')
            ->where('is_featured', 1)
            ->active()
            ->latest()
            ->limit(5)
            ->get();

        $data = compact(
            'teacher', 'relatedTeachers', 'featuredNews'
        );

        return $this->viewWithSeo('teachers.show', 'teachers.show', $data, $teacher);
    }

    public function byLevel(Request $request, $levelSlug)
    {
        $level = Level::where('slug', $levelSlug)->firstOrFail();
        $teachers = $this->getFilteredTeachers($request, [], $level);

        return view('teachers.index', [
            'teachers' => $teachers,
            'levels' => Level::active()->parentOnly()->ordered()->get(),
            'provinces' => Province::majorCities()->orderBy('name', 'asc')->get(),
            'subjects' => Subject::active()->ordered()->get(),
            'level' => $level,
        ]);
    }

    public function bySubject(Request $request, $subjectSlug)
    {
        $subject = Subject::where('slug', $subjectSlug)->firstOrFail();
        $teachers = $this->getFilteredTeachers($request, [], null, $subject);

        return view('teachers.index', [
            'teachers' => $teachers,
            'levels' => Level::active()->parentOnly()->ordered()->get(),
            'provinces' => Province::majorCities()->orderBy('name', 'asc')->get(),
            'subjects' => Subject::active()->ordered()->get(),
            'subject' => $subject,
        ]);
    }

    public function byProvince(Request $request, $provinceSlug)
    {
        $province = Province::where('slug', $provinceSlug)->firstOrFail();
        $filters = ['province_id' => $province->id];
        $teachers = $this->getFilteredTeachers($request, $filters);

        return view('teachers.index', [
            'teachers' => $teachers,
            'levels' => Level::active()->parentOnly()->ordered()->get(),
            'provinces' => Province::majorCities()->orderBy('name', 'asc')->get(),
            'subjects' => Subject::active()->ordered()->get(),
            'province' => $province,
        ]);
    }

    public function byLevelAndSubject(Request $request, $levelSlug, $subjectSlug)
    {
        $level = Level::where('slug', $levelSlug)->firstOrFail();
        $subject = Subject::where('slug', $subjectSlug)->firstOrFail();
        $teachers = $this->getFilteredTeachers($request, [], $level, $subject);

        return view('teachers.index', [
            'teachers' => $teachers,
            'levels' => Level::active()->parentOnly()->ordered()->get(),
            'provinces' => Province::majorCities()->orderBy('name', 'asc')->get(),
            'subjects' => Subject::active()->ordered()->get(),
            'level' => $level,
            'subject' => $subject,
        ]);
    }

    public function byLevelAndProvince(Request $request, $levelSlug, $provinceSlug)
    {
        $level = Level::where('slug', $levelSlug)->firstOrFail();
        $province = Province::where('slug', $provinceSlug)->firstOrFail();
        $filters = ['province_id' => $province->id];
        $teachers = $this->getFilteredTeachers($request, $filters, $level);

        return view('teachers.index', [
            'teachers' => $teachers,
            'levels' => Level::active()->parentOnly()->ordered()->get(),
            'provinces' => Province::majorCities()->orderBy('name', 'asc')->get(),
            'subjects' => Subject::active()->ordered()->get(),
            'level' => $level,
            'province' => $province,
        ]);
    }

    public function bySubjectAndProvince(Request $request, $subjectSlug, $provinceSlug)
    {
        $subject = Subject::where('slug', $subjectSlug)->firstOrFail();
        $province = Province::where('slug', $provinceSlug)->firstOrFail();
        $filters = ['province_id' => $province->id];
        $teachers = $this->getFilteredTeachers($request, $filters, null, $subject);

        return view('teachers.index', [
            'teachers' => $teachers,
            'levels' => Level::active()->parentOnly()->ordered()->get(),
            'provinces' => Province::majorCities()->orderBy('name', 'asc')->get(),
            'subjects' => Subject::active()->ordered()->get(),
            'subject' => $subject,
            'province' => $province,
        ]);
    }

    public function byAll(Request $request, $levelSlug, $subjectSlug, $provinceSlug)
    {
        $level = Level::where('slug', $levelSlug)->firstOrFail();
        $subject = Subject::where('slug', $subjectSlug)->firstOrFail();
        $province = Province::where('slug', $provinceSlug)->firstOrFail();
        $filters = ['province_id' => $province->id];
        $teachers = $this->getFilteredTeachers($request, $filters, $level, $subject);

        return view('teachers.index', [
            'teachers' => $teachers,
            'levels' => Level::active()->parentOnly()->ordered()->get(),
            'provinces' => Province::majorCities()->orderBy('name', 'asc')->get(),
            'subjects' => Subject::active()->ordered()->get(),
            'level' => $level,
            'subject' => $subject,
            'province' => $province,
        ]);
    }

    private function getFilteredTeachers(Request $request, array $filters, $level = null, $subject = null)
    {
        $query = Teacher::with(['levels', 'subjects', 'province', 'commune', 'featuredImage'])
            ->active()
            ->where($filters);

        // Filter by level if provided
        if ($level) {
            $levelIds = $level->getAllChildrenIds();
            $levelIds[] = $level->id;
            $query->whereHas('levels', function($q) use ($levelIds) {
                $q->whereIn('level_id', $levelIds);
            });
        }

        // Filter by subject if provided
        if ($subject) {
            $query->whereHas('subjects', function($q) use ($subject) {
                $q->where('subject_id', $subject->id);
            });
        }

        // Quick filters
        if ($request->has('filter')) {
            switch ($request->get('filter')) {
                case 'popular':
                    $query->where('sort_order', '<', 100);
                    break;
                case 'experienced':
                    $query->where('experience', '>=', 10);
                    break;
                case 'new':
                    $query->where('experience', '<', 5);
                    break;
            }
        }

        // Search by name
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->get('search') . '%');
        }
        
        $query->orderBy('sort_order', 'asc')->orderBy('name', 'asc');

        return $query->paginate(16)->withQueryString();
    }

    public function filter(Request $request)
    {
        // AJAX endpoint for filtering teachers
        // This will be implemented for real-time filtering
        return response()->json([]);
    }
}

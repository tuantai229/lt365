<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Center;
use App\Models\Level;
use App\Models\Subject;
use App\Models\Province;
use App\Models\News;

class CenterController extends Controller
{
    /**
     * Display a listing of all centers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Center::with(['levels', 'subjects', 'province', 'featuredImage'])->active();

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

        $centers = $query->paginate(15)->withQueryString();
            
        $levels = Level::active()->parentOnly()->ordered()->get();
        $provinces = Province::majorCities()->orderBy('name', 'asc')->get();
        $subjects = Subject::active()->ordered()->get();

        return view('centers.index', compact('centers', 'levels', 'provinces', 'subjects'));
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
        $center = Center::with([
            'levels', 'subjects', 'province', 'featuredImage'
        ])
        ->active()
        ->findOrFail($id);

        // Sidebar: Related centers
        $relatedCenters = Center::with(['featuredImage'])
            ->active()
            ->where('id', '!=', $center->id)
            ->where(function ($query) use ($center) {
                $query->where('province_id', $center->province_id)
                    ->orWhereHas('levels', function($q) use ($center) {
                        $q->whereIn('level_id', $center->levels->pluck('id'));
                    })
                    ->orWhereHas('subjects', function($q) use ($center) {
                        $q->whereIn('subject_id', $center->subjects->pluck('id'));
                    });
            })
            ->orderBy('sort_order', 'asc')->orderBy('name', 'asc')
            ->limit(5)
            ->get();

        // Featured News (related to education/centers)
        $featuredNews = News::with('featuredImage')
            ->where('is_featured', 1)
            ->active()
            ->latest()
            ->limit(5)
            ->get();

        return view('centers.show', compact(
            'center', 'relatedCenters', 'featuredNews'
        ));
    }

    public function byLevel(Request $request, $levelSlug)
    {
        $level = Level::where('slug', $levelSlug)->first();
        $centers = $this->getFilteredCenters($request, [], $level);

        return view('centers.index', [
            'centers' => $centers,
            'levels' => Level::active()->parentOnly()->ordered()->get(),
            'provinces' => Province::majorCities()->orderBy('name', 'asc')->get(),
            'subjects' => Subject::active()->ordered()->get(),
            'level' => $level,
        ]);
    }

    public function bySubject(Request $request, $subjectSlug)
    {
        $subject = Subject::where('slug', $subjectSlug)->first();
        $centers = $this->getFilteredCenters($request, [], null, $subject);

        return view('centers.index', [
            'centers' => $centers,
            'levels' => Level::active()->parentOnly()->ordered()->get(),
            'provinces' => Province::majorCities()->orderBy('name', 'asc')->get(),
            'subjects' => Subject::active()->ordered()->get(),
            'subject' => $subject,
        ]);
    }

    public function byProvince(Request $request, $provinceSlug)
    {
        $province = Province::where('slug', $provinceSlug)->first();
        $filters = $province ? ['province_id' => $province->id] : [];
        $centers = $this->getFilteredCenters($request, $filters);

        return view('centers.index', [
            'centers' => $centers,
            'levels' => Level::active()->parentOnly()->ordered()->get(),
            'provinces' => Province::majorCities()->orderBy('name', 'asc')->get(),
            'subjects' => Subject::active()->ordered()->get(),
            'province' => $province,
        ]);
    }

    public function byLevelAndSubject(Request $request, $levelSlug, $subjectSlug)
    {
        $level = Level::where('slug', $levelSlug)->first();
        $subject = Subject::where('slug', $subjectSlug)->first();
        $centers = $this->getFilteredCenters($request, [], $level, $subject);

        return view('centers.index', [
            'centers' => $centers,
            'levels' => Level::active()->parentOnly()->ordered()->get(),
            'provinces' => Province::majorCities()->orderBy('name', 'asc')->get(),
            'subjects' => Subject::active()->ordered()->get(),
            'level' => $level,
            'subject' => $subject,
        ]);
    }

    public function byLevelAndProvince(Request $request, $levelSlug, $provinceSlug)
    {
        $level = Level::where('slug', $levelSlug)->first();
        $province = Province::where('slug', $provinceSlug)->first();
        $filters = $province ? ['province_id' => $province->id] : [];
        $centers = $this->getFilteredCenters($request, $filters, $level);

        return view('centers.index', [
            'centers' => $centers,
            'levels' => Level::active()->parentOnly()->ordered()->get(),
            'provinces' => Province::majorCities()->orderBy('name', 'asc')->get(),
            'subjects' => Subject::active()->ordered()->get(),
            'level' => $level,
            'province' => $province,
        ]);
    }

    public function bySubjectAndProvince(Request $request, $subjectSlug, $provinceSlug)
    {
        $subject = Subject::where('slug', $subjectSlug)->first();
        $province = Province::where('slug', $provinceSlug)->first();
        $filters = $province ? ['province_id' => $province->id] : [];
        $centers = $this->getFilteredCenters($request, $filters, null, $subject);

        return view('centers.index', [
            'centers' => $centers,
            'levels' => Level::active()->parentOnly()->ordered()->get(),
            'provinces' => Province::majorCities()->orderBy('name', 'asc')->get(),
            'subjects' => Subject::active()->ordered()->get(),
            'subject' => $subject,
            'province' => $province,
        ]);
    }

    public function byAll(Request $request, $levelSlug, $subjectSlug, $provinceSlug)
    {
        $level = Level::where('slug', $levelSlug)->first();
        $subject = Subject::where('slug', $subjectSlug)->first();
        $province = Province::where('slug', $provinceSlug)->first();
        $filters = $province ? ['province_id' => $province->id] : [];
        $centers = $this->getFilteredCenters($request, $filters, $level, $subject);

        return view('centers.index', [
            'centers' => $centers,
            'levels' => Level::active()->parentOnly()->ordered()->get(),
            'provinces' => Province::majorCities()->orderBy('name', 'asc')->get(),
            'subjects' => Subject::active()->ordered()->get(),
            'level' => $level,
            'subject' => $subject,
            'province' => $province,
        ]);
    }

    private function getFilteredCenters(Request $request, array $filters, $level = null, $subject = null)
    {
        $query = Center::with(['levels', 'subjects', 'province', 'featuredImage'])
            ->active()
            ->where($filters);

        // Filter by level if provided
        if ($level) {
            $query->whereHas('levels', function($q) use ($level) {
                $q->where('level_id', $level->id);
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

        return $query->paginate(15)->withQueryString();
    }

    public function filter(Request $request)
    {
        // AJAX endpoint for filtering centers
        // This will be implemented for real-time filtering
        return response()->json([]);
    }
}

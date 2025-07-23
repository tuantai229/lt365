<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\SchoolType;
use App\Models\Level;
use App\Models\Province;
use App\Models\News;
use App\Models\Document;
use App\Models\SchoolAdmission;

class SchoolController extends Controller
{
    /**
     * Display a listing of all schools.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = School::with(['level', 'province', 'schoolTypes', 'featuredImage', 'latestAdmission'])->active();

        // Quick filters
        if ($request->has('filter')) {
            switch ($request->get('filter')) {
                case 'popular':
                    $query->where('sort_order', '<', 100);
                    break;
                case 'public':
                    $query->whereHas('schoolTypes', function($q) {
                        $q->where('slug', 'cong-lap');
                    });
                    break;
                case 'private':
                    $query->whereHas('schoolTypes', function($q) {
                        $q->where('slug', 'tu-thuc');
                    });
                    break;
            }
        }

        // Search by name
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->get('search') . '%');
        }
        
        $query->orderBy('sort_order', 'asc')->orderBy('name', 'asc');

        $schools = $query->paginate(15)->withQueryString();
            
        $levels = Level::active()->parentOnly()->ordered()->get();
        $provinces = Province::majorCities()->orderBy('name', 'asc')->get();
        $schoolTypes = SchoolType::active()->ordered()->get();

        return view('schools.index', compact('schools', 'levels', 'provinces', 'schoolTypes'));
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
        $school = School::with([
            'level', 'province', 'schoolTypes', 'admissionMethods',
            'admissionStats', 'featuredImage'
        ])
        ->active()
        ->findOrFail($id);

        // Get the latest admission info
        $school->admissionInfo = SchoolAdmission::where('school_id', $school->id)
            ->orderBy('year', 'desc')
            ->first();

        // Sidebar: Related schools
        $relatedSchools = School::with(['featuredImage'])
            ->active()
            ->where('id', '!=', $school->id)
            ->where(function ($query) use ($school) {
                $query->where('level_id', $school->level_id)
                    ->orWhere('province_id', $school->province_id);
            })
            ->orderBy('sort_order', 'asc')->orderBy('name', 'asc')
            ->limit(5)
            ->get();

        // Sidebar: Featured News
        $featuredNews = News::with('featuredImage')
            ->where('school_id', $school->id)
            ->where('is_featured', 1)
            ->active()
            ->latest()
            ->limit(5)
            ->get();

        // Tin tức về trường
        $schoolNews = News::with('featuredImage')
            ->where('school_id', $school->id)
            ->active()
            ->latest()
            ->limit(6)
            ->get();

        // Tài liệu thi tuyển
        $schoolDocuments = Document::with('featuredImage')
            ->where('school_id', $school->id)
            ->active()
            ->latest()
            ->limit(6)
            ->get();

        return view('schools.show', compact(
            'school', 'relatedSchools', 'featuredNews',
            'schoolNews', 'schoolDocuments'
        ));
    }

    public function byLevel(Request $request, $levelSlug)
    {
        $level = Level::where('slug', $levelSlug)->first();
        $filters = $level ? ['level_id' => $level->id] : [];
        $schools = $this->getFilteredSchools($request, $filters);

        return view('schools.index', [
            'schools' => $schools,
            'levels' => Level::active()->parentOnly()->ordered()->get(),
            'provinces' => Province::majorCities()->orderBy('name', 'asc')->get(),
            'schoolTypes' => SchoolType::active()->ordered()->get(),
            'level' => $level,
        ]);
    }

    public function byProvince(Request $request, $provinceSlug)
    {
        $province = Province::where('slug', $provinceSlug)->first();
        $filters = $province ? ['province_id' => $province->id] : [];
        $schools = $this->getFilteredSchools($request, $filters);

        return view('schools.index', [
            'schools' => $schools,
            'levels' => Level::active()->parentOnly()->ordered()->get(),
            'provinces' => Province::majorCities()->orderBy('name', 'asc')->get(),
            'schoolTypes' => SchoolType::active()->ordered()->get(),
            'province' => $province,
        ]);
    }

    public function byType(Request $request, $schoolTypeSlug)
    {
        $schoolType = SchoolType::where('slug', $schoolTypeSlug)->first();
        $filters = [];
        $schools = $this->getFilteredSchools($request, $filters, $schoolType);

        return view('schools.index', [
            'schools' => $schools,
            'levels' => Level::active()->parentOnly()->ordered()->get(),
            'provinces' => Province::majorCities()->orderBy('name', 'asc')->get(),
            'schoolTypes' => SchoolType::active()->ordered()->get(),
            'schoolType' => $schoolType,
        ]);
    }

    public function byLevelAndProvince(Request $request, $levelSlug, $provinceSlug)
    {
        $level = Level::where('slug', $levelSlug)->first();
        $province = Province::where('slug', $provinceSlug)->first();
        $filters = ($level && $province) ? [
            'level_id' => $level->id, 
            'province_id' => $province->id
        ] : [];
        $schools = $this->getFilteredSchools($request, $filters);

        return view('schools.index', [
            'schools' => $schools,
            'levels' => Level::active()->parentOnly()->ordered()->get(),
            'provinces' => Province::majorCities()->orderBy('name', 'asc')->get(),
            'schoolTypes' => SchoolType::active()->ordered()->get(),
            'level' => $level,
            'province' => $province,
        ]);
    }

    public function byLevelAndType(Request $request, $levelSlug, $schoolTypeSlug)
    {
        $level = Level::where('slug', $levelSlug)->first();
        $schoolType = SchoolType::where('slug', $schoolTypeSlug)->first();
        $filters = $level ? ['level_id' => $level->id] : [];
        $schools = $this->getFilteredSchools($request, $filters, $schoolType);

        return view('schools.index', [
            'schools' => $schools,
            'levels' => Level::active()->parentOnly()->ordered()->get(),
            'provinces' => Province::majorCities()->orderBy('name', 'asc')->get(),
            'schoolTypes' => SchoolType::active()->ordered()->get(),
            'level' => $level,
            'schoolType' => $schoolType,
        ]);
    }

    public function byProvinceAndType(Request $request, $provinceSlug, $schoolTypeSlug)
    {
        $province = Province::where('slug', $provinceSlug)->first();
        $schoolType = SchoolType::where('slug', $schoolTypeSlug)->first();
        $filters = $province ? ['province_id' => $province->id] : [];
        $schools = $this->getFilteredSchools($request, $filters, $schoolType);

        return view('schools.index', [
            'schools' => $schools,
            'levels' => Level::active()->parentOnly()->ordered()->get(),
            'provinces' => Province::majorCities()->orderBy('name', 'asc')->get(),
            'schoolTypes' => SchoolType::active()->ordered()->get(),
            'province' => $province,
            'schoolType' => $schoolType,
        ]);
    }

    public function byAll(Request $request, $levelSlug, $provinceSlug, $schoolTypeSlug)
    {
        $level = Level::where('slug', $levelSlug)->first();
        $province = Province::where('slug', $provinceSlug)->first();
        $schoolType = SchoolType::where('slug', $schoolTypeSlug)->first();
        $filters = ($level && $province) ? [
            'level_id' => $level->id,
            'province_id' => $province->id,
        ] : [];
        $schools = $this->getFilteredSchools($request, $filters, $schoolType);

        return view('schools.index', [
            'schools' => $schools,
            'levels' => Level::active()->parentOnly()->ordered()->get(),
            'provinces' => Province::majorCities()->orderBy('name', 'asc')->get(),
            'schoolTypes' => SchoolType::active()->ordered()->get(),
            'level' => $level,
            'province' => $province,
            'schoolType' => $schoolType,
        ]);
    }

    private function getFilteredSchools(Request $request, array $filters, $schoolType = null)
    {
        $query = School::with(['level', 'province', 'schoolTypes', 'featuredImage', 'latestAdmission'])
            ->active()
            ->where($filters);

        // Filter by school type if provided
        if ($schoolType) {
            $query->whereHas('schoolTypes', function($q) use ($schoolType) {
                $q->where('school_type_id', $schoolType->id);
            });
        }

        // Quick filters
        if ($request->has('filter')) {
            switch ($request->get('filter')) {
                case 'popular':
                    $query->where('sort_order', '<', 100);
                    break;
                case 'public':
                    $query->whereHas('schoolTypes', function($q) {
                        $q->where('slug', 'cong-lap');
                    });
                    break;
                case 'private':
                    $query->whereHas('schoolTypes', function($q) {
                        $q->where('slug', 'tu-thuc');
                    });
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
        // AJAX endpoint for filtering schools
        // This will be implemented for real-time filtering
        return response()->json([]);
    }
}

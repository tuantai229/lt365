<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Level;
use App\Models\Subject;
use App\Services\RatingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Document::with(['level', 'subject', 'documentType', 'featuredImage'])->active();

        // Quick filters
        if ($request->has('filter')) {
            switch ($request->get('filter')) {
                case 'popular':
                    $query->featured();
                    break;
                case 'free':
                    $query->free();
                    break;
                case 'paid':
                    $query->paid();
                    break;
            }
        }

        // Sorting
        if ($request->has('sort')) {
            switch ($request->get('sort')) {
                case 'downloads':
                    $query->orderBy('download_count', 'desc');
                    break;
                case 'name':
                    $query->orderBy('name', 'asc');
                    break;
                default:
                    $query->ordered();
                    break;
            }
        } else {
            $query->ordered();
        }

        $documents = $query->paginate(15)->withQueryString();
            
        $levels = Level::active()->ordered()->get();
        $subjects = Subject::active()->ordered()->get();
        $documentTypes = DocumentType::active()->ordered()->get();

        return view('documents.index', compact('documents', 'levels', 'subjects', 'documentTypes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug, $id, RatingService $ratingService)
    {
        $document = Document::with(['level', 'subject', 'documentType', 'difficultyLevel', 'school', 'tags', 'featuredImage'])
            ->active()
            ->findOrFail($id);

        // Rating data
        $ratingStats = $ratingService->getRatingStats('document', $document->id);
        $userRating = null;
        if (Auth::check()) {
            $userRating = $ratingService->getUserRating(Auth::user(), 'document', $document->id);
        }

        // Get ratings with pagination
        $ratings = \App\Models\Rating::with('user')
            ->where('type', 'document')
            ->where('type_id', $document->id)
            ->where('status', 1)
            ->whereNotNull('review')
            ->where('review', '!=', '')
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'ratings_page');

        // Sidebar: Related documents
        $relatedDocuments = Document::with(['featuredImage'])
            ->active()
            ->where('id', '!=', $document->id)
            ->where(function ($query) use ($document) {
                $query->where('level_id', $document->level_id)
                    ->orWhere('subject_id', $document->subject_id)
                    ->orWhere('document_type_id', $document->document_type_id);
            })
            ->ordered()
            ->limit(5)
            ->get();

        // Sidebar: Most downloaded documents
        $mostDownloaded = Document::with(['featuredImage'])
            ->active()
            ->where('id', '!=', $document->id)
            ->orderByDesc('download_count')
            ->limit(5)
            ->get();

        // Sidebar: Document categories
        $documentCategories = DocumentType::withCount('documents')->active()->ordered()->get();

        return view('documents.show', compact('document', 'relatedDocuments', 'mostDownloaded', 'documentCategories', 'ratingStats', 'userRating', 'ratings'));
    }

    public function byType(Request $request, $typeSlug)
    {
        $documentType = DocumentType::where('slug', $typeSlug)->first();
        $filters = $documentType ? ['document_type_id' => $documentType->id] : [];
        $documents = $this->getFilteredDocuments($request, $filters);
        
        return view('documents.index', [
            'documents' => $documents,
            'levels' => Level::active()->ordered()->get(),
            'subjects' => Subject::active()->ordered()->get(),
            'documentTypes' => DocumentType::active()->ordered()->get(),
            'documentType' => $documentType,
        ]);
    }

    public function byLevel(Request $request, $levelSlug)
    {
        $level = Level::where('slug', $levelSlug)->first();
        $filters = [];
        if ($level) {
            $levelIds = $level->getAllChildrenIds();
            $levelIds[] = $level->id;
            $filters['level_id'] = $levelIds;
        }
        $documents = $this->getFilteredDocuments($request, $filters);

        return view('documents.index', [
            'documents' => $documents,
            'levels' => Level::active()->ordered()->get(),
            'subjects' => Subject::active()->ordered()->get(),
            'documentTypes' => DocumentType::active()->ordered()->get(),
            'level' => $level,
        ]);
    }

    public function bySubject(Request $request, $subjectSlug)
    {
        $subject = Subject::where('slug', $subjectSlug)->first();
        $filters = $subject ? ['subject_id' => $subject->id] : [];
        $documents = $this->getFilteredDocuments($request, $filters);

        return view('documents.index', [
            'documents' => $documents,
            'levels' => Level::active()->ordered()->get(),
            'subjects' => Subject::active()->ordered()->get(),
            'documentTypes' => DocumentType::active()->ordered()->get(),
            'subject' => $subject,
        ]);
    }

    public function byTypeAndLevel(Request $request, $typeSlug, $levelSlug)
    {
        $documentType = DocumentType::where('slug', $typeSlug)->first();
        $level = Level::where('slug', $levelSlug)->first();
        $filters = [];
        if ($documentType) {
            $filters['document_type_id'] = $documentType->id;
        }
        if ($level) {
            $levelIds = $level->getAllChildrenIds();
            $levelIds[] = $level->id;
            $filters['level_id'] = $levelIds;
        }
        $documents = $this->getFilteredDocuments($request, $filters);

        return view('documents.index', [
            'documents' => $documents,
            'levels' => Level::active()->ordered()->get(),
            'subjects' => Subject::active()->ordered()->get(),
            'documentTypes' => DocumentType::active()->ordered()->get(),
            'documentType' => $documentType,
            'level' => $level,
        ]);
    }

    public function byTypeAndSubject(Request $request, $typeSlug, $subjectSlug)
    {
        $documentType = DocumentType::where('slug', $typeSlug)->first();
        $subject = Subject::where('slug', $subjectSlug)->first();
        $filters = ($documentType && $subject) ? ['document_type_id' => $documentType->id, 'subject_id' => $subject->id] : [];
        $documents = $this->getFilteredDocuments($request, $filters);

        return view('documents.index', [
            'documents' => $documents,
            'levels' => Level::active()->ordered()->get(),
            'subjects' => Subject::active()->ordered()->get(),
            'documentTypes' => DocumentType::active()->ordered()->get(),
            'documentType' => $documentType,
            'subject' => $subject,
        ]);
    }

    public function byLevelAndSubject(Request $request, $levelSlug, $subjectSlug)
    {
        $level = Level::where('slug', $levelSlug)->first();
        $subject = Subject::where('slug', $subjectSlug)->first();
        $filters = [];
        if ($level) {
            $levelIds = $level->getAllChildrenIds();
            $levelIds[] = $level->id;
            $filters['level_id'] = $levelIds;
        }
        if ($subject) {
            $filters['subject_id'] = $subject->id;
        }
        $documents = $this->getFilteredDocuments($request, $filters);

        return view('documents.index', [
            'documents' => $documents,
            'levels' => Level::active()->ordered()->get(),
            'subjects' => Subject::active()->ordered()->get(),
            'documentTypes' => DocumentType::active()->ordered()->get(),
            'level' => $level,
            'subject' => $subject,
        ]);
    }

    public function byAll(Request $request, $typeSlug, $levelSlug, $subjectSlug)
    {
        $documentType = DocumentType::where('slug', $typeSlug)->first();
        $level = Level::where('slug', $levelSlug)->first();
        $subject = Subject::where('slug', $subjectSlug)->first();
        $filters = [];
        if ($documentType) {
            $filters['document_type_id'] = $documentType->id;
        }
        if ($level) {
            $levelIds = $level->getAllChildrenIds();
            $levelIds[] = $level->id;
            $filters['level_id'] = $levelIds;
        }
        if ($subject) {
            $filters['subject_id'] = $subject->id;
        }
        $documents = $this->getFilteredDocuments($request, $filters);

        return view('documents.index', [
            'documents' => $documents,
            'levels' => Level::active()->ordered()->get(),
            'subjects' => Subject::active()->ordered()->get(),
            'documentTypes' => DocumentType::active()->ordered()->get(),
            'documentType' => $documentType,
            'level' => $level,
            'subject' => $subject,
        ]);
    }

    private function getFilteredDocuments(Request $request, array $filters)
    {
        $query = Document::with(['level', 'subject', 'documentType', 'featuredImage'])->active();

        foreach ($filters as $key => $value) {
            if (is_array($value)) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        // Quick filters
        if ($request->has('filter')) {
            switch ($request->get('filter')) {
                case 'popular':
                    $query->featured();
                    break;
                case 'free':
                    $query->free();
                    break;
                case 'paid':
                    $query->paid();
                    break;
            }
        }

        // Sorting
        if ($request->has('sort')) {
            switch ($request->get('sort')) {
                case 'downloads':
                    $query->orderBy('download_count', 'desc');
                    break;
                case 'name':
                    $query->orderBy('name', 'asc');
                    break;
                default:
                    $query->ordered();
                    break;
            }
        } else {
            $query->ordered();
        }

        return $query->paginate(15)->withQueryString();
    }

    public function download(Request $request, $slug, $id)
    {
        // Download logic will be implemented later
        return redirect()->back();
    }
}

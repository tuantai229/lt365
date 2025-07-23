# Hướng dẫn Implementation Search System cho LT365 - Đơn giản

## Tổng quan

Tài liệu này hướng dẫn implementation hệ thống tìm kiếm đơn giản cho website LT365. Chỉ có tính năng tìm kiếm cơ bản, không có filters, không có suggest.

## Yêu cầu

- Laravel 11
- Database đã có sẵn các bảng: documents, schools, centers, teachers, news, pages
- Route đã được định nghĩa: `Route::get('/tim-kiem', [SearchController::class, 'index'])->name('search');`
- Form search đã có ở header

## Phạm vi tìm kiếm

Hệ thống sẽ tìm kiếm trên 6 loại nội dung:
- **Documents**: Tài liệu học tập
- **Schools**: Thông tin trường học  
- **Centers**: Trung tâm dạy học
- **Teachers**: Hồ sơ giáo viên
- **News**: Tin tức giáo dục
- **Pages**: Trang thông tin tĩnh

## 1. Tạo SearchService

Tạo file `app/Services/SearchService.php`:

```php
<?php

namespace App\Services;

use App\Models\{Document, School, Center, Teacher, News, Page};
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchService
{
    protected $perPage = 20;

    public function search(string $query, int $page = 1)
    {
        if (empty(trim($query))) {
            return $this->getEmptyResults();
        }

        $results = $this->searchAll($query);
        return $this->paginateResults($results, $page);
    }

    private function searchAll(string $query)
    {
        $results = collect();

        // Search Documents
        $documents = $this->searchDocuments($query);
        $results = $results->merge($this->formatResults($documents, 'documents'));

        // Search Schools
        $schools = $this->searchSchools($query);
        $results = $results->merge($this->formatResults($schools, 'schools'));

        // Search Centers
        $centers = $this->searchCenters($query);
        $results = $results->merge($this->formatResults($centers, 'centers'));

        // Search Teachers
        $teachers = $this->searchTeachers($query);
        $results = $results->merge($this->formatResults($teachers, 'teachers'));

        // Search News
        $news = $this->searchNews($query);
        $results = $results->merge($this->formatResults($news, 'news'));

        // Search Pages
        $pages = $this->searchPages($query);
        $results = $results->merge($this->formatResults($pages, 'pages'));

        // Sort by relevance (featured first, then by name match)
        return $results->sortByDesc(function ($item) {
            return ($item['is_featured'] ? 1000 : 0) + $item['relevance_score'];
        });
    }

    private function searchDocuments(string $query, int $limit = 15)
    {
        return Document::where('status', 1)
            ->with(['level', 'subject', 'documentType', 'school'])
            ->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%")
                  ->orWhere('content', 'LIKE', "%{$query}%");
            })
            ->orderBy('is_featured', 'desc')
            ->orderBy('name')
            ->limit($limit)
            ->get();
    }

    private function searchSchools(string $query, int $limit = 15)
    {
        return School::where('status', 1)
            ->with(['level', 'province', 'commune'])
            ->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('tagline', 'LIKE', "%{$query}%")
                  ->orWhere('address', 'LIKE', "%{$query}%")
                  ->orWhere('content', 'LIKE', "%{$query}%");
            })
            ->orderBy('is_featured', 'desc')
            ->orderBy('name')
            ->limit($limit)
            ->get();
    }

    private function searchCenters(string $query, int $limit = 10)
    {
        return Center::where('status', 1)
            ->with(['levels', 'subjects', 'province', 'commune'])
            ->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('tagline', 'LIKE', "%{$query}%")
                  ->orWhere('address', 'LIKE', "%{$query}%")
                  ->orWhere('content', 'LIKE', "%{$query}%");
            })
            ->orderBy('name')
            ->limit($limit)
            ->get();
    }

    private function searchTeachers(string $query, int $limit = 10)
    {
        return Teacher::where('status', 1)
            ->with(['levels', 'subjects', 'province', 'commune'])
            ->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('tagline', 'LIKE', "%{$query}%")
                  ->orWhere('address', 'LIKE', "%{$query}%")
                  ->orWhere('content', 'LIKE', "%{$query}%");
            })
            ->orderBy('name')
            ->limit($limit)
            ->get();
    }

    private function searchNews(string $query, int $limit = 10)
    {
        return News::where('status', 1)
            ->with(['categories', 'school'])
            ->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('content', 'LIKE', "%{$query}%");
            })
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    private function searchPages(string $query, int $limit = 5)
    {
        return Page::where('status', 1)
            ->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('content', 'LIKE', "%{$query}%");
            })
            ->orderBy('name')
            ->limit($limit)
            ->get();
    }

    private function formatResults($items, string $category)
    {
        return $items->map(function ($item) use ($category) {
            return [
                'id' => $item->id,
                'title' => $item->name,
                'slug' => $item->slug,
                'category' => $category,
                'category_label' => $this->getCategoryLabel($category),
                'url' => $this->getItemUrl($item, $category),
                'image_url' => $this->getItemImage($item),
                'description' => $this->getItemDescription($item, $category),
                'meta_info' => $this->getItemMeta($item, $category),
                'is_featured' => $item->is_featured ?? false,
                'relevance_score' => $this->calculateRelevanceScore($item),
                'created_at' => $item->created_at,
            ];
        });
    }

    private function getCategoryLabel(string $category)
    {
        $labels = [
            'documents' => 'Tài liệu',
            'schools' => 'Trường học',
            'centers' => 'Trung tâm',
            'teachers' => 'Giáo viên',
            'news' => 'Tin tức',
            'pages' => 'Trang thông tin'
        ];

        return $labels[$category] ?? 'Khác';
    }

    private function getItemUrl($item, string $category)
    {
        $routes = [
            'documents' => 'documents.show',
            'schools' => 'schools.show',
            'centers' => 'centers.show',
            'teachers' => 'teachers.show',
            'news' => 'news.show',
            'pages' => 'pages.show'
        ];

        return route($routes[$category], $item->slug);
    }

    private function getItemImage($item)
    {
        if ($item->featured_image_id && $item->featuredImage) {
            return asset('storage/' . $item->featuredImage->path);
        }
        
        // Default images based on category
        $defaultImages = [
            'Document' => 'images/default-document.jpg',
            'School' => 'images/default-school.jpg',
            'Center' => 'images/default-center.jpg',
            'Teacher' => 'images/default-teacher.jpg',
            'News' => 'images/default-news.jpg',
            'Page' => 'images/default-page.jpg'
        ];
        
        $modelName = class_basename($item);
        return asset($defaultImages[$modelName] ?? 'images/default.jpg');
    }

    private function getItemDescription($item, string $category)
    {
        switch ($category) {
            case 'documents':
                return $item->description ?? $this->truncateHtml($item->content, 150);
            case 'schools':
            case 'centers':
            case 'teachers':
                return $item->tagline ?? $this->truncateHtml($item->content, 150);
            case 'news':
                return $this->truncateHtml($item->content, 150);
            case 'pages':
                return $this->truncateHtml($item->content, 150);
            default:
                return '';
        }
    }

    private function getItemMeta($item, string $category)
    {
        switch ($category) {
            case 'documents':
                return [
                    'level' => $item->level->name ?? '',
                    'subject' => $item->subject->name ?? '',
                    'type' => $item->documentType->name ?? '',
                    'year' => $item->year,
                    'download_count' => $item->download_count
                ];
            case 'schools':
                return [
                    'level' => $item->level->name ?? '',
                    'province' => $item->province->name ?? '',
                    'tuition_fee' => $item->tuition_fee > 0 ? number_format($item->tuition_fee) . ' VND' : 'Liên hệ'
                ];
            case 'centers':
                return [
                    'levels' => $item->levels->pluck('name')->implode(', '),
                    'subjects' => $item->subjects->pluck('name')->implode(', '),
                    'province' => $item->province->name ?? '',
                    'experience' => $item->experience . ' năm'
                ];
            case 'teachers':
                return [
                    'levels' => $item->levels->pluck('name')->implode(', '),
                    'subjects' => $item->subjects->pluck('name')->implode(', '),
                    'province' => $item->province->name ?? '',
                    'experience' => $item->experience . ' năm'
                ];
            case 'news':
                return [
                    'view_count' => $item->view_count,
                    'school' => $item->school->name ?? '',
                    'created_at' => $item->created_at->format('d/m/Y')
                ];
            default:
                return [];
        }
    }

    private function calculateRelevanceScore($item)
    {
        $score = 0;
        
        // Boost featured items
        if ($item->is_featured ?? false) {
            $score += 100;
        }
        
        // Boost items with high engagement
        if (isset($item->view_count)) {
            $score += min($item->view_count / 10, 50);
        }
        if (isset($item->download_count)) {
            $score += min($item->download_count / 5, 30);
        }
        
        return $score;
    }

    private function truncateHtml($html, $length = 150)
    {
        $text = strip_tags($html);
        return strlen($text) > $length ? substr($text, 0, $length) . '...' : $text;
    }

    private function paginateResults(Collection $results, int $page)
    {
        $total = $results->count();
        $items = $results->slice(($page - 1) * $this->perPage, $this->perPage)->values();

        return new LengthAwarePaginator(
            $items,
            $total,
            $this->perPage,
            $page,
            ['path' => request()->url(), 'pageName' => 'page']
        );
    }

    private function getEmptyResults()
    {
        return new LengthAwarePaginator(
            collect(),
            0,
            $this->perPage,
            1,
            ['path' => request()->url(), 'pageName' => 'page']
        );
    }
}
```

## 2. Tạo SearchController

Tạo file `app/Http/Controllers/SearchController.php`:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SearchService;

class SearchController extends Controller
{
    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function index(Request $request)
    {
        $query = $request->get('q', '');
        $page = $request->get('page', 1);

        // Perform search
        $results = $this->searchService->search($query, $page);

        return view('search.index', compact('results', 'query'));
    }
}
```

## 3. Tạo Search Results View

Tạo file `resources/views/search/index.blade.php` để hiển thị dữ liệu, lưu ý tham các views khác để cấu trúc và sử dụng các thư viện cho hợp lý.
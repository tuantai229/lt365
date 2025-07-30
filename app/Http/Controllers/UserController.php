<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\UserDownload;
use App\Models\UserFavorite;
use App\Models\Comment;
use App\Models\Document;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display the user's dashboard.
     */
    public function dashboard(): View
    {
        $user = Auth::user();

        // Eager load relationships for performance
        $user->load([
            'downloads' => fn($q) => $q->latest('downloaded_at')->limit(5)->with('document'),
            'favorites' => fn($q) => $q->latest()->limit(5),
            'comments' => fn($q) => $q->latest()->limit(5)->with('commentable'),
        ]);

        // Load favorited items for dashboard
        $this->loadFavoritedItems($user->favorites);
        $this->loadCommentableItems($user->comments);

        // Stats Cards
        $stats = [
            'downloads' => $user->downloads()->count(),
            'favorites' => $user->favorites()->count(),
            'comments' => $user->comments()->count(),
        ];

        // Combine activities into a timeline
        $downloads = $user->downloads->map(function ($item) {
            $url = $item->document ? route('documents.show', ['slug' => $item->document->slug, 'id' => $item->document->id]) : null;
            $title = $item->document ? $item->document->name : 'Tài liệu không xác định';
            
            return [
                'type' => 'download',
                'description' => 'Đã tải xuống tài liệu:',
                'model' => $item->document,
                'title' => $title,
                'url' => $url,
                'date' => $item->downloaded_at,
                'icon' => 'ri-download-2-line',
                'color' => 'text-blue-500 bg-blue-50',
            ];
        });

        $favorites = $user->favorites->map(function ($item) {
            $url = $this->generateItemUrl($item->type, $item->item);
            $title = $this->getItemTitle($item->type, $item->item);
            
            return [
                'type' => 'favorite',
                'description' => 'Đã yêu thích:',
                'model' => $item->item ?? null,
                'title' => $title,
                'url' => $url,
                'date' => $item->created_at,
                'icon' => 'ri-heart-line',
                'color' => 'text-red-500 bg-red-50',
            ];
        });

        $comments = $user->comments->map(function ($item) {
            $url = $this->generateCommentableUrl($item->commentable);
            $title = $this->getCommentableTitle($item->commentable);
            
            return [
                'type' => 'comment',
                'description' => 'Đã bình luận về:',
                'model' => $item->commentable,
                'title' => $title,
                'url' => $url,
                'content' => Str::limit($item->content, 50),
                'date' => $item->created_at,
                'icon' => 'ri-message-2-line',
                'color' => 'text-green-500 bg-green-50',
            ];
        });

        $activityTimeline = collect()
            ->merge($downloads)
            ->merge($favorites)
            ->merge($comments)
            ->sortByDesc('date')
            ->take(10); // Take the 10 most recent activities overall

        // Personalized Recommendations (placeholder logic)
        // For now, just get some popular/featured documents
        $recommendations = Document::where('is_featured', 1)
            ->orWhere('status', 1)
            ->latest()
            ->take(5)
            ->get();

        $data = compact(
            'user',
            'stats',
            'activityTimeline',
            'recommendations'
        );

        return $this->viewWithSeo('user.dashboard', 'user.dashboard', $data);
    }

    /**
     * Display the user's profile form.
     */
    public function profile(): View
    {
        return $this->viewWithSeo('user.profile', 'user.profile', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function updateProfile(Request $request): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:15'],
            'date_of_birth' => ['nullable', 'date', 'before:today'],
            'gender' => ['nullable', 'in:male,female,other'],
            'address' => ['nullable', 'string', 'max:500'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if it exists
            if ($user->avatar) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $path;
        }

        $user->update($validated);

        return back()->with('success', 'Hồ sơ đã được cập nhật thành công!');
    }

    /**
     * Display the user's downloaded documents.
     */
    public function downloads(): View
    {
        $downloads = Auth::user()
            ->downloads()
            ->with(['document.level', 'document.subject']) // Eager load document details
            ->latest('downloaded_at')
            ->paginate(10); // Paginate results

        return $this->viewWithSeo('user.downloads', 'user.downloads', compact('downloads'));
    }

    /**
     * Display the user's favorite items.
     */
    public function favorites(): View
    {
        $favorites = Auth::user()
            ->favorites()
            ->latest()
            ->paginate(10);

        // Load the actual favorited items
        $this->loadFavoritedItems($favorites->items());

        return $this->viewWithSeo('user.favorites', 'user.favorites', compact('favorites'));
    }

    /**
     * Toggle an item in the user's favorites.
     */
    public function toggleFavorite(Request $request, string $type, int $id): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();
        $modelClass = $this->getFavoritableModelClass($type);

        if (!$modelClass || !class_exists($modelClass)) {
            return response()->json(['error' => 'Loại không hợp lệ.'], 400);
        }

        $model = $modelClass::find($id);

        if (!$model) {
            return response()->json(['error' => 'Không tìm thấy đối tượng.'], 404);
        }

        $favorite = $user->favorites()
            ->where('type', $type)
            ->where('type_id', $id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            $status = 'removed';
        } else {
            $user->favorites()->create([
                'type' => $type,
                'type_id' => $id,
            ]);
            $status = 'added';
        }

        return response()->json([
            'status' => $status,
            'count' => $user->favorites()->count(),
        ]);
    }

    /**
     * Get the model class from a string type.
     */
    private function getFavoritableModelClass(string $type): ?string
    {
        $map = [
            'document' => Document::class,
            'school' => \App\Models\School::class,
            'news' => \App\Models\News::class,
            'center' => \App\Models\Center::class,
            'teacher' => \App\Models\Teacher::class,
        ];

        return $map[$type] ?? null;
    }

    /**
     * Load the actual favorited items (documents, news, etc.)
     */
    private function loadFavoritedItems($favorites)
    {
        $itemsByType = [];
        
        // Group items by type
        foreach ($favorites as $favorite) {
            if (!isset($itemsByType[$favorite->type])) {
                $itemsByType[$favorite->type] = [];
            }
            $itemsByType[$favorite->type][] = $favorite->type_id;
        }

        // Load items for each type
        foreach ($itemsByType as $type => $ids) {
            $items = $this->getItemsByType($type, $ids);
            
            // Attach items to favorites
            foreach ($favorites as $favorite) {
                if ($favorite->type === $type) {
                    $favorite->item = $items->firstWhere('id', $favorite->type_id);
                }
            }
        }
    }

    /**
     * Get items by type and IDs
     */
    private function getItemsByType(string $type, array $ids)
    {
        $modelClass = $this->getFavoritableModelClass($type);

        if (!$modelClass || !class_exists($modelClass)) {
            // Fallback for plural vs singular (e.g., 'documents' vs 'document')
            $singularType = \Illuminate\Support\Str::singular($type);
            $modelClass = $this->getFavoritableModelClass($singularType);

            if (!$modelClass || !class_exists($modelClass)) {
                return collect();
            }
        }

        $query = $modelClass::whereIn('id', $ids);

        // Eager load relationships based on model type for better performance
        if ($modelClass === Document::class) {
            $query->with(['subject', 'level']);
        } elseif ($modelClass === \App\Models\School::class) {
            $query->with(['province', 'level', 'schoolTypes']);
        } elseif ($modelClass === \App\Models\Center::class) {
            $query->with(['province', 'levels', 'subjects']);
        } elseif ($modelClass === \App\Models\Teacher::class) {
            $query->with(['province', 'commune', 'levels', 'subjects']);
        }

        return $query->get();
    }

    /**
     * Display the change password form.
     */
    public function showChangePassword(): View
    {
        return $this->viewWithSeo('user.change-password', 'user.change-password');
    }

    /**
     * Update the user's password.
     */
    public function changePassword(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
        ]);

        $request->user()->update([
            'password' => \Illuminate\Support\Facades\Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Mật khẩu đã được thay đổi thành công!');
    }

    /**
     * Generate URL for favorited item
     */
    private function generateItemUrl(string $type, $item): ?string
    {
        if (!$item) return null;

        switch ($type) {
            case 'document':
                return route('documents.show', ['slug' => $item->slug, 'id' => $item->id]);
            case 'news':
                return route('news.show', ['slug' => $item->slug, 'id' => $item->id]);
            case 'school':
                return route('schools.show', ['slug' => $item->slug, 'id' => $item->id]);
            case 'center':
                return route('centers.show', ['slug' => $item->slug, 'id' => $item->id]);
            case 'teacher':
                return route('teachers.show', ['slug' => $item->slug, 'id' => $item->id]);
            default:
                return null;
        }
    }

    /**
     * Get title for favorited item
     */
    private function getItemTitle(string $type, $item): ?string
    {
        if (!$item) return 'Không xác định';

        switch ($type) {
            case 'document':
                return $item->name ?? 'Tài liệu không xác định';
            case 'news':
                return $item->name ?? 'Tin tức không xác định';
            case 'school':
                return $item->name ?? 'Trường học không xác định';
            case 'center':
                return $item->name ?? 'Trung tâm không xác định';
            case 'teacher':
                return $item->name ?? 'Giáo viên không xác định';
            default:
                return 'Không xác định';
        }
    }

    /**
     * Generate URL for commentable item
     */
    private function generateCommentableUrl($commentable): ?string
    {
        if (!$commentable) return null;

        $className = get_class($commentable);
        
        switch ($className) {
            case 'App\\Models\\Document':
                return route('documents.show', ['slug' => $commentable->slug, 'id' => $commentable->id]);
            case 'App\\Models\\News':
                return route('news.show', ['slug' => $commentable->slug, 'id' => $commentable->id]);
            case 'App\\Models\\School':
                return route('schools.show', ['slug' => $commentable->slug, 'id' => $commentable->id]);
            case 'App\\Models\\Center':
                return route('centers.show', ['slug' => $commentable->slug, 'id' => $commentable->id]);
            case 'App\\Models\\Teacher':
                return route('teachers.show', ['slug' => $commentable->slug, 'id' => $commentable->id]);
            default:
                return null;
        }
    }

    /**
     * Get title for commentable item
     */
    private function getCommentableTitle($commentable): ?string
    {
        if (!$commentable) return 'Không xác định';

        $className = get_class($commentable);
        
        switch ($className) {
            case 'App\\Models\\Document':
                return $commentable->name ?? 'Tài liệu không xác định';
            case 'App\\Models\\News':
                return $commentable->name ?? 'Tin tức không xác định';
            case 'App\\Models\\School':
                return $commentable->name ?? 'Trường học không xác định';
            case 'App\\Models\\Center':
                return $commentable->name ?? 'Trung tâm không xác định';
            case 'App\\Models\\Teacher':
                return $commentable->name ?? 'Giáo viên không xác định';
            default:
                return 'Không xác định';
        }
    }

    /**
     * Load the actual commentable items (documents, news, etc.)
     */
    private function loadCommentableItems($comments)
    {
        $itemsByType = [];
        
        // Group items by type
        foreach ($comments as $comment) {
            if (!isset($itemsByType[$comment->type])) {
                $itemsByType[$comment->type] = [];
            }
            $itemsByType[$comment->type][] = $comment->type_id;
        }

        // Load items for each type
        foreach ($itemsByType as $type => $ids) {
            $items = $this->getItemsByType($type, $ids);
            
            // Attach items to comments
            foreach ($comments as $comment) {
                if ($comment->type === $type) {
                    $comment->commentable = $items->firstWhere('id', $comment->type_id);
                }
            }
        }
    }
}

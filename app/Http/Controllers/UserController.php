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
            'favorites' => fn($q) => $q->latest()->limit(5)->with('favoritable'),
            'comments' => fn($q) => $q->latest()->limit(5)->with('commentable'),
        ]);

        // Stats Cards
        $stats = [
            'downloads' => $user->downloads()->count(),
            'favorites' => $user->favorites()->count(),
            'comments' => $user->comments()->count(),
        ];

        // Combine activities into a timeline
        $downloads = $user->downloads->map(function ($item) {
            return [
                'type' => 'download',
                'description' => 'Đã tải xuống tài liệu:',
                'model' => $item->document,
                'date' => $item->downloaded_at,
                'icon' => 'ri-download-2-line',
                'color' => 'text-blue-500 bg-blue-50',
            ];
        });

        $favorites = $user->favorites->map(function ($item) {
            return [
                'type' => 'favorite',
                'description' => 'Đã yêu thích:',
                'model' => $item->favoritable,
                'date' => $item->created_at,
                'icon' => 'ri-heart-line',
                'color' => 'text-red-500 bg-red-50',
            ];
        });

        $comments = $user->comments->map(function ($item) {
            return [
                'type' => 'comment',
                'description' => 'Đã bình luận về:',
                'model' => $item->commentable,
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

        return view('user.dashboard', compact(
            'user',
            'stats',
            'activityTimeline',
            'recommendations'
        ));
    }

    /**
     * Display the user's profile form.
     */
    public function profile(): View
    {
        return view('user.profile', [
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

        return view('user.downloads', compact('downloads'));
    }

    /**
     * Display the user's favorite items.
     */
    public function favorites(): View
    {
        $favorites = Auth::user()
            ->favorites()
            ->with('favoritable') // Eager load the polymorphic relationship
            ->latest()
            ->paginate(10);

        return view('user.favorites', compact('favorites'));
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
            ->where('favoritable_type', $modelClass)
            ->where('favoritable_id', $id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            $status = 'removed';
        } else {
            $user->favorites()->create([
                'favoritable_type' => $modelClass,
                'favoritable_id' => $id,
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
     * Display the change password form.
     */
    public function showChangePassword(): View
    {
        return view('user.change-password');
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
}

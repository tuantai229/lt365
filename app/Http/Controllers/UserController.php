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
}

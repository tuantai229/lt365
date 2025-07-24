<?php

namespace App\Http\Controllers;

use App\Models\UserFavorite;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{
    /**
     * Toggle favorite status for an item
     */
    public function toggle(Request $request): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate([
            'type' => 'required|string|in:document,news,school,center,teacher',
            'type_id' => 'required|integer|min:1'
        ]);

        $userId = Auth::id();
        $type = $request->input('type');
        $typeId = $request->input('type_id');

        // Check if already favorited
        $existing = UserFavorite::where([
            'user_id' => $userId,
            'type' => $type,
            'type_id' => $typeId
        ])->first();

        if ($existing) {
            // Remove from favorites
            $existing->delete();
            return response()->json([
                'favorited' => false,
                'message' => 'Đã xóa khỏi danh sách yêu thích'
            ]);
        } else {
            // Add to favorites
            UserFavorite::create([
                'user_id' => $userId,
                'type' => $type,
                'type_id' => $typeId
            ]);
            return response()->json([
                'favorited' => true,
                'message' => 'Đã thêm vào danh sách yêu thích'
            ]);
        }
    }

    /**
     * Check favorite status for multiple items
     */
    public function check(Request $request): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json(['favorites' => []], 200);
        }

        $request->validate([
            'items' => 'required|array',
            'items.*' => 'array'
        ]);

        $userId = Auth::id();
        $items = $request->input('items');
        $favorites = [];

        // Build conditions for checking favorites
        $conditions = [];
        foreach ($items as $type => $ids) {
            if (is_array($ids) && !empty($ids)) {
                foreach ($ids as $id) {
                    $conditions[] = [
                        'user_id' => $userId,
                        'type' => $type,
                        'type_id' => (int)$id
                    ];
                }
            }
        }

        if (!empty($conditions)) {
            // Use a more efficient query to check all favorites at once
            $query = UserFavorite::where('user_id', $userId);
            
            $query->where(function ($q) use ($conditions) {
                foreach ($conditions as $condition) {
                    $q->orWhere(function ($subQ) use ($condition) {
                        $subQ->where('type', $condition['type'])
                             ->where('type_id', $condition['type_id']);
                    });
                }
            });

            $favorites = $query->select('type', 'type_id')->get()->toArray();
        }

        return response()->json(['favorites' => $favorites]);
    }

    /**
     * Get user's favorite items with pagination
     */
    public function index(Request $request): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $type = $request->input('type');
        $perPage = min($request->input('per_page', 15), 50); // Max 50 items per page

        $query = UserFavorite::where('user_id', Auth::id())
            ->with(['user'])
            ->orderBy('created_at', 'desc');

        if ($type && in_array($type, ['document', 'news', 'school', 'center', 'teacher'])) {
            $query->where('type', $type);
        }

        $favorites = $query->paginate($perPage);

        // Load the actual favorited items
        $this->loadFavoritedItems($favorites->items());

        return response()->json([
            'data' => $favorites->items(),
            'current_page' => $favorites->currentPage(),
            'last_page' => $favorites->lastPage(),
            'per_page' => $favorites->perPage(),
            'total' => $favorites->total()
        ]);
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
        switch ($type) {
            case 'document':
                return \App\Models\Document::whereIn('id', $ids)
                    ->with(['subject', 'level'])
                    ->get();
            
            case 'news':
                return \App\Models\News::whereIn('id', $ids)
                    ->with(['categories'])
                    ->get();
            
            case 'school':
                return \App\Models\School::whereIn('id', $ids)
                    ->with(['province', 'level', 'schoolTypes'])
                    ->get();
            
            case 'center':
                return \App\Models\Center::whereIn('id', $ids)
                    ->with(['province', 'levels', 'subjects'])
                    ->get();
            
            case 'teacher':
                return \App\Models\Teacher::whereIn('id', $ids)
                    ->with(['province', 'commune', 'levels', 'subjects'])
                    ->get();
            
            default:
                return collect();
        }
    }

    /**
     * Remove favorite
     */
    public function destroy(Request $request, $id): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $favorite = UserFavorite::where([
            'user_id' => Auth::id(),
            'id' => $id
        ])->first();

        if (!$favorite) {
            return response()->json(['error' => 'Favorite not found'], 404);
        }

        $favorite->delete();

        return response()->json([
            'message' => 'Đã xóa khỏi danh sách yêu thích'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Document;
use App\Models\News;
use App\Models\School;
use App\Models\Center;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class CommentController extends Controller
{
    /**
     * Get supported model types
     */
    private function getSupportedTypes(): array
    {
        return [
            'documents' => Document::class,
            'news' => News::class,
            'schools' => School::class,
            'centers' => Center::class,
            'teachers' => Teacher::class,
        ];
    }

    /**
     * Get model instance by type and id
     */
    private function getModel(string $type, int $typeId)
    {
        $supportedTypes = $this->getSupportedTypes();
        
        if (!array_key_exists($type, $supportedTypes)) {
            abort(400, 'Loại nội dung không được hỗ trợ.');
        }

        $modelClass = $supportedTypes[$type];
        return $modelClass::findOrFail($typeId);
    }

    /**
     * Get comments for a specific item
     */
    public function index(Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:documents,news,schools,centers,teachers',
            'type_id' => 'required|integer'
        ]);

        $type = $request->input('type');
        $typeId = $request->input('type_id');
        $model = $this->getModel($type, $typeId);

        $comments = Comment::where('type', $type)
            ->where('type_id', $typeId)
            ->where('status', 1)
            ->where('parent_id', 0)
            ->with(['user', 'children' => function($query) {
                $query->with('user')->where('status', 1)->latest();
            }])
            ->latest()
            ->paginate(10);

        $totalCount = Comment::where('type', $type)
            ->where('type_id', $typeId)
            ->where('status', 1)
            ->count();

        $parentCount = Comment::where('type', $type)
            ->where('type_id', $typeId)
            ->where('status', 1)
            ->where('parent_id', 0)
            ->count();

        return response()->json([
            'success' => true,
            'data' => [
                'comments' => [
                    'data' => $comments->items(),
                    'current_page' => $comments->currentPage(),
                    'last_page' => $comments->lastPage(),
                    'per_page' => $comments->perPage(),
                    'total' => $comments->total(),
                    'has_more_pages' => $comments->hasMorePages(),
                ],
                'total_count' => $totalCount,
                'parent_count' => $parentCount,
                'has_more' => $comments->hasMorePages(),
            ]
        ]);
    }

    /**
     * Store a new comment
     */
    public function store(Request $request)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng đăng nhập để bình luận.'
            ], 401);
        }

        // Rate limiting
        $key = 'comment:' . Auth::id();
        if (RateLimiter::tooManyAttempts($key, 2)) {
            $seconds = RateLimiter::availableIn($key);
            return response()->json([
                'success' => false,
                'message' => "Bạn đang bình luận quá nhanh. Vui lòng thử lại sau {$seconds} giây."
            ], 429);
        }

        // Validate request
        $request->validate([
            'type' => 'required|string|in:documents,news,schools,centers,teachers',
            'type_id' => 'required|integer',
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|integer|exists:comments,id'
        ], [
            'type.required' => 'Loại nội dung là bắt buộc.',
            'type.in' => 'Loại nội dung không hợp lệ.',
            'type_id.required' => 'ID nội dung là bắt buộc.',
            'type_id.integer' => 'ID nội dung phải là số nguyên.',
            'content.required' => 'Nội dung bình luận không được để trống.',
            'content.max' => 'Nội dung bình luận không được vượt quá 1000 ký tự.',
            'parent_id.exists' => 'Bình luận gốc không tồn tại.'
        ]);

        $type = $request->input('type');
        $typeId = $request->input('type_id');
        $parentId = $request->input('parent_id', 0);

        // Validate the model exists
        $model = $this->getModel($type, $typeId);

        // If replying to a comment, validate the parent comment belongs to this item
        if ($parentId > 0) {
            $parentComment = Comment::find($parentId);
            if (!$parentComment || $parentComment->type !== $type || $parentComment->type_id != $typeId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bình luận gốc không hợp lệ.',
                    'debug' => [
                        'parent_comment' => $parentComment ? [
                            'id' => $parentComment->id,
                            'type' => $parentComment->type,
                            'type_id' => $parentComment->type_id,
                            'parent_id' => $parentComment->parent_id,
                            'status' => $parentComment->status,
                        ] : null,
                        'request_data' => [
                            'type' => $type,
                            'type_id' => $typeId,
                            'parent_id' => $parentId,
                        ]
                    ]
                ], 400);
            }

            // Ensure we're replying to a parent comment, not a reply
            if ($parentComment->parent_id > 0) {
                $parentId = $parentComment->parent_id;
            }
        }

        try {
            // Create comment
            $comment = Comment::create([
                'user_id' => Auth::id(),
                'type' => $type,
                'type_id' => $typeId,
                'parent_id' => $parentId,
                'content' => $request->input('content'),
                'status' => 1,
            ]);

            // Load relationships
            $comment->load('user');

            // Increment rate limiter
            RateLimiter::hit($key, 60); // 1 minute window

            // Get updated counts
            $totalCount = Comment::where('type', $type)
                ->where('type_id', $typeId)
                ->where('status', 1)
                ->count();

            $parentCount = Comment::where('type', $type)
                ->where('type_id', $typeId)
                ->where('status', 1)
                ->where('parent_id', 0)
                ->count();

            return response()->json([
                'success' => true,
                'message' => 'Bình luận đã được thêm thành công.',
                'data' => [
                    'comment' => $comment,
                    'total_count' => $totalCount,
                    'parent_count' => $parentCount,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi thêm bình luận. Vui lòng thử lại.'
            ], 500);
        }
    }

    /**
     * Get replies for a specific comment
     */
    public function replies(Request $request, Comment $comment)
    {
        $replies = $comment->children()
            ->with('user')
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'replies' => $replies
            ]
        ]);
    }

    /**
     * Load more comments (for pagination)
     */
    public function loadMore(Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:documents,news,schools,centers,teachers',
            'type_id' => 'required|integer',
            'page' => 'nullable|integer|min:1'
        ]);

        $type = $request->input('type');
        $typeId = $request->input('type_id');
        $page = $request->input('page', 1);
        
        // Validate the model exists
        $model = $this->getModel($type, $typeId);
        
        $comments = Comment::where('type', $type)
            ->where('type_id', $typeId)
            ->where('status', 1)
            ->where('parent_id', 0)
            ->with(['user', 'children' => function($query) {
                $query->with('user')->where('status', 1)->latest();
            }])
            ->latest()
            ->paginate(10, ['*'], 'page', $page);

        return response()->json([
            'success' => true,
            'data' => [
                'comments' => [
                    'data' => $comments->items(),
                    'current_page' => $comments->currentPage(),
                    'last_page' => $comments->lastPage(),
                    'per_page' => $comments->perPage(),
                    'total' => $comments->total(),
                    'has_more_pages' => $comments->hasMorePages(),
                ],
                'has_more' => $comments->hasMorePages(),
                'next_page' => $comments->hasMorePages() ? $page + 1 : null,
            ]
        ]);
    }
}

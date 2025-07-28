<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RatingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    protected $ratingService;

    public function __construct(RatingService $ratingService)
    {
        $this->ratingService = $ratingService;
    }

    /**
     * Submit a rating for any ratable item
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function submit(Request $request): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn cần đăng nhập để đánh giá'
            ], 401);
        }

        $request->validate([
            'type' => 'required|string|in:document,school,center,teacher',
            'type_id' => 'required|integer|exists:' . $this->getTableName($request->type) . ',id',
            'rating' => 'required|integer|between:1,5',
            'review' => 'nullable|string|max:1000'
        ]);

        try {
            $user = Auth::user();

            $rating = $this->ratingService->submitRating(
                $user,
                $request->type,
                $request->type_id,
                $request->rating,
                $request->review
            );

            // Get updated rating stats
            $stats = $this->ratingService->getRatingStats($request->type, $request->type_id);

            return response()->json([
                'success' => true,
                'message' => 'Đánh giá của bạn đã được gửi thành công',
                'rating' => $rating,
                'stats' => $stats
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Update a rating for any ratable item
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn cần đăng nhập để cập nhật đánh giá'
            ], 401);
        }

        $request->validate([
            'type' => 'required|string|in:document,school,center,teacher',
            'type_id' => 'required|integer|exists:' . $this->getTableName($request->type) . ',id',
            'rating' => 'required|integer|between:1,5',
            'review' => 'nullable|string|max:1000'
        ]);

        try {
            $user = Auth::user();

            $rating = $this->ratingService->updateRating(
                $user,
                $request->type,
                $request->type_id,
                $request->rating,
                $request->review
            );

            // Get updated rating stats
            $stats = $this->ratingService->getRatingStats($request->type, $request->type_id);

            return response()->json([
                'success' => true,
                'message' => 'Đánh giá của bạn đã được cập nhật',
                'rating' => $rating,
                'stats' => $stats
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Get rating statistics for any ratable item
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getStats(Request $request): JsonResponse
    {
        $request->validate([
            'type' => 'required|string|in:document,school,center,teacher',
            'type_id' => 'required|integer|exists:' . $this->getTableName($request->type) . ',id',
        ]);

        try {
            $stats = $this->ratingService->getRatingStats($request->type, $request->type_id);
            
            $userRating = null;
            if (Auth::check()) {
                $userRating = $this->ratingService->getUserRating(Auth::user(), $request->type, $request->type_id);
            }

            return response()->json([
                'success' => true,
                'stats' => $stats,
                'userRating' => $userRating
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Get ratings with user details for any ratable item
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getRatings(Request $request): JsonResponse
    {
        $request->validate([
            'type' => 'required|string|in:document,school,center,teacher',
            'type_id' => 'required|integer|exists:' . $this->getTableName($request->type) . ',id',
            'limit' => 'nullable|integer|min:1|max:50'
        ]);

        try {
            $limit = $request->get('limit', 10);
            $ratings = $this->ratingService->getRatingsWithUsers($request->type, $request->type_id, $limit);

            return response()->json([
                'success' => true,
                'ratings' => $ratings
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Delete a rating
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn cần đăng nhập để xóa đánh giá'
            ], 401);
        }

        $request->validate([
            'type' => 'required|string|in:document,school,center,teacher',
            'type_id' => 'required|integer|exists:' . $this->getTableName($request->type) . ',id',
        ]);

        try {
            $user = Auth::user();
            $this->ratingService->deleteRating($user, $request->type, $request->type_id);

            // Get updated rating stats
            $stats = $this->ratingService->getRatingStats($request->type, $request->type_id);

            return response()->json([
                'success' => true,
                'message' => 'Đánh giá đã được xóa',
                'stats' => $stats
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Get table name for validation
     *
     * @param string $type
     * @return string
     */
    private function getTableName(string $type): string
    {
        return match($type) {
            'document' => 'documents',
            'school' => 'schools',
            'center' => 'centers',
            'teacher' => 'teachers',
            default => 'documents'
        };
    }
}

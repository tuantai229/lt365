<?php

namespace App\Services;

use App\Models\Rating;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RatingService
{
    /**
     * Submit a rating for a document
     *
     * @param User $user
     * @param string $type
     * @param int $typeId
     * @param int $rating
     * @param string|null $review
     * @return Rating
     * @throws \Exception
     */
    public function submitRating(User $user, string $type, int $typeId, int $rating, ?string $review = null): Rating
    {
        // Validate rating value
        if ($rating < 1 || $rating > 5) {
            throw new \Exception('Rating must be between 1 and 5');
        }

        // Check if user already rated this item
        $existingRating = Rating::where('user_id', $user->id)
            ->where('type', $type)
            ->where('type_id', $typeId)
            ->first();

        if ($existingRating) {
            throw new \Exception('You have already rated this item');
        }

        // Create new rating
        return Rating::create([
            'user_id' => $user->id,
            'type' => $type,
            'type_id' => $typeId,
            'rating' => $rating,
            'review' => $review,
            'status' => 1, // Active by default
        ]);
    }

    /**
     * Update an existing rating
     *
     * @param User $user
     * @param string $type
     * @param int $typeId
     * @param int $rating
     * @param string|null $review
     * @return Rating
     * @throws \Exception
     */
    public function updateRating(User $user, string $type, int $typeId, int $rating, ?string $review = null): Rating
    {
        // Validate rating value
        if ($rating < 1 || $rating > 5) {
            throw new \Exception('Rating must be between 1 and 5');
        }

        $existingRating = Rating::where('user_id', $user->id)
            ->where('type', $type)
            ->where('type_id', $typeId)
            ->first();

        if (!$existingRating) {
            throw new \Exception('Rating not found');
        }

        $existingRating->update([
            'rating' => $rating,
            'review' => $review,
        ]);

        return $existingRating;
    }

    /**
     * Get rating statistics for an item
     *
     * @param string $type
     * @param int $typeId
     * @return array
     */
    public function getRatingStats(string $type, int $typeId): array
    {
        $ratings = Rating::where('type', $type)
            ->where('type_id', $typeId)
            ->where('status', 1)
            ->get();

        if ($ratings->isEmpty()) {
            return [
                'average' => 0,
                'total' => 0,
                'breakdown' => [
                    5 => 0,
                    4 => 0,
                    3 => 0,
                    2 => 0,
                    1 => 0,
                ],
            ];
        }

        $total = $ratings->count();
        $sum = $ratings->sum('rating');
        $average = round($sum / $total, 1);

        // Get rating breakdown
        $breakdown = [];
        for ($i = 1; $i <= 5; $i++) {
            $breakdown[$i] = $ratings->where('rating', $i)->count();
        }

        return [
            'average' => $average,
            'total' => $total,
            'breakdown' => array_reverse($breakdown, true), // 5 to 1
        ];
    }

    /**
     * Get user's rating for an item
     *
     * @param User $user
     * @param string $type
     * @param int $typeId
     * @return Rating|null
     */
    public function getUserRating(User $user, string $type, int $typeId): ?Rating
    {
        return Rating::where('user_id', $user->id)
            ->where('type', $type)
            ->where('type_id', $typeId)
            ->first();
    }

    /**
     * Get all ratings for an item with user details
     *
     * @param string $type
     * @param int $typeId
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRatingsWithUsers(string $type, int $typeId, int $limit = 10)
    {
        return Rating::with('user')
            ->where('type', $type)
            ->where('type_id', $typeId)
            ->where('status', 1)
            ->whereNotNull('review')
            ->where('review', '!=', '')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Delete a rating
     *
     * @param User $user
     * @param string $type
     * @param int $typeId
     * @return bool
     * @throws \Exception
     */
    public function deleteRating(User $user, string $type, int $typeId): bool
    {
        $rating = Rating::where('user_id', $user->id)
            ->where('type', $type)
            ->where('type_id', $typeId)
            ->first();

        if (!$rating) {
            throw new \Exception('Rating not found');
        }

        return $rating->delete();
    }
}

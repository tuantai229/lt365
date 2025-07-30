<?php

namespace App\Http\Traits;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasComments
{
    /**
     * Get all comments for this model
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable')
            ->where('status', 1)
            ->orderBy('created_at', 'desc');
    }

    /**
     * Get parent comments (root level comments)
     */
    public function parentComments(): MorphMany
    {
        return $this->comments()->where('parent_id', 0);
    }

    /**
     * Get total comments count
     */
    public function getTotalCommentsCount(): int
    {
        return $this->comments()->count();
    }

    /**
     * Get parent comments count
     */
    public function getParentCommentsCount(): int
    {
        return $this->parentComments()->count();
    }

    /**
     * Add a comment to this model
     */
    public function addComment(int $userId, string $content, int $parentId = 0): Comment
    {
        return $this->comments()->create([
            'user_id' => $userId,
            'parent_id' => $parentId,
            'content' => $content,
            'status' => 1,
        ]);
    }

    /**
     * Check if user can comment on this model
     */
    public function canComment(): bool
    {
        return auth()->check();
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class UserFavorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'type_id',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'type_id' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function favoritable()
    {
        // Custom method to get the favorited item based on type
        switch ($this->type) {
            case 'document':
                return $this->belongsTo(Document::class, 'type_id');
            case 'news':
                return $this->belongsTo(News::class, 'type_id');
            case 'school':
                return $this->belongsTo(School::class, 'type_id');
            case 'center':
                return $this->belongsTo(Center::class, 'type_id');
            case 'teacher':
                return $this->belongsTo(Teacher::class, 'type_id');
            default:
                return null;
        }
    }

    // Helper methods để lấy đối tượng theo type
    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class, 'type_id');
    }

    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class, 'type_id');
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class, 'type_id');
    }

    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class, 'type_id');
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'type_id');
    }
}

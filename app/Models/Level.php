<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'parent_id' => 'integer',
        'status' => 'integer',
        'sort_order' => 'integer',
    ];

    // Quan hệ với cấp độ cha
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Level::class, 'parent_id');
    }

    // Quan hệ với các cấp độ con
    public function children(): HasMany
    {
        return $this->hasMany(Level::class, 'parent_id');
    }

    // Lấy tất cả ID của các cấp độ con (bao gồm cả các cấp con sâu hơn)
    public function getAllChildrenIds()
    {
        $ids = collect();
        $children = $this->children;
        while ($children->isNotEmpty()) {
            $ids = $ids->merge($children->pluck('id'));
            $children = Level::whereIn('parent_id', $children->pluck('id'))->get();
        }
        return $ids->all();
    }

    // Quan hệ với documents
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    // Quan hệ với schools
    public function schools(): HasMany
    {
        return $this->hasMany(School::class);
    }

    // Scope cho các level đang hoạt động
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // Scope sắp xếp theo thứ tự
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    // Scope cho các level cha
    public function scopeParentOnly($query)
    {
        return $query->where('parent_id', 0);
    }

    // Accessor để lấy trạng thái dạng text
    public function getStatusTextAttribute(): string
    {
        return $this->status ? 'Hoạt động' : 'Không hoạt động';
    }

    // Accessor để lấy tên đầy đủ (bao gồm cả parent)
    public function getFullNameAttribute(): string
    {
        if ($this->parent_id && $this->parent) {
            return $this->parent->name . ' - ' . $this->name;
        }
        return $this->name;
    }
}

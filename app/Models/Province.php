<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'status' => 'integer',
        'sort_order' => 'integer',
    ];

    public function communes(): HasMany
    {
        return $this->hasMany(Commune::class);
    }

    public function schools(): HasMany
    {
        return $this->hasMany(School::class);
    }

    public function centers(): HasMany
    {
        return $this->hasMany(Center::class);
    }

    public function teachers(): HasMany
    {
        return $this->hasMany(Teacher::class);
    }

    // Scope cho các tỉnh thành phố lớn
    public function scopeMajorCities($query)
    {
        return $query->whereIn('id', [1, 4, 20, 21, 29, 33]);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('name', 'asc');
    }
}

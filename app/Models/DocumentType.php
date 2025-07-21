<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class DocumentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'status' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected $attributes = [
        'status' => 0,
        'sort_order' => 9999,
    ];

    /**
     * Get documents for this document type
     */
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    /**
     * Get all of the subjects for the document type through the documents.
     */
    public function subjects(): HasManyThrough
    {
        return $this->hasManyThrough(Subject::class, Document::class, 'document_type_id', 'id', 'id', 'subject_id');
    }

    /**
     * Get all of the levels for the document type through the documents.
     */
    public function levels(): HasManyThrough
    {
        return $this->hasManyThrough(Level::class, Document::class, 'document_type_id', 'id', 'id', 'level_id');
    }

    /**
     * Scope to get only active document types
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Scope to order by sort_order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('name', 'asc');
    }
}

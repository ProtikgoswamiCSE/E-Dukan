<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomepageSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_name',
        'title',
        'description',
        'icon',
        'image',
        'content',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'content' => 'array',
        'is_active' => 'boolean'
    ];

    /**
     * Scope for active sections
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered sections
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    /**
     * Get sections by name
     */
    public function scopeBySection($query, $sectionName)
    {
        return $query->where('section_name', $sectionName);
    }
}

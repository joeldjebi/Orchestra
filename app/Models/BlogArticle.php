<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogArticle extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'headline',
        'content',
        'sidebar_title',
        'image',
        'layout',
        'order',
        'is_active',
    ];

    protected $casts = [
        'content' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Scope pour récupérer seulement les articles actifs
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope pour ordonner les articles
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    /**
     * Accessor pour formater le contenu
     */
    public function getFormattedContentAttribute()
    {
        return $this->content ?? [];
    }
}

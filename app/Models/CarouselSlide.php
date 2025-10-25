<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarouselSlide extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'items',
        'image',
        'alt',
        'order',
        'is_active',
    ];

    protected $casts = [
        'items' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Scope pour récupérer seulement les slides actifs
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope pour ordonner les slides
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    /**
     * Accessor pour formater les items
     */
    public function getFormattedItemsAttribute()
    {
        return $this->items ?? [];
    }

    /**
     * Mutator pour s'assurer que les items sont un tableau
     */
    public function setItemsAttribute($value)
    {
        if (is_string($value)) {
            $this->attributes['items'] = json_encode(explode("\n", $value));
        } else {
            $this->attributes['items'] = json_encode($value);
        }
    }
}

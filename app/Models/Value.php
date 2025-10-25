<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'icon',
        'details',
        'order',
        'is_active',
    ];

    protected $casts = [
        'details' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Scope pour récupérer seulement les valeurs actives
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope pour ordonner les valeurs
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    /**
     * Accessor pour formater les détails
     */
    public function getFormattedDetailsAttribute()
    {
        return $this->details ?? [];
    }
}

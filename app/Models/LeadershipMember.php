<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadershipMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'image',
        'description',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope pour récupérer seulement les membres actifs
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope pour ordonner les membres
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}

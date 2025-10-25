<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'address',
        'phone',
        'email',
        'office_hours',
        'image',
        'is_active',
    ];

    protected $casts = [
        'office_hours' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Scope pour récupérer seulement les infos actives
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Accessor pour formater les horaires
     */
    public function getFormattedOfficeHoursAttribute()
    {
        return $this->office_hours ?? [];
    }
}

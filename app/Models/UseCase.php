<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UseCase extends Model
{
    protected $fillable = [
        'title', 'description', 'icon_svg',
        'features_json', 'category', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'features_json' => 'array',
        'is_active'     => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}

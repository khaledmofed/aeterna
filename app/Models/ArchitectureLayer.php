<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArchitectureLayer extends Model
{
    protected $fillable = [
        'layer_number', 'name', 'slug', 'description',
        'icon_svg', 'features_json', 'sort_order', 'is_active',
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

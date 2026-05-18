<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoadmapStage extends Model
{
    protected $fillable = [
        'stage_number', 'name', 'timeframe', 'status',
        'milestones_json', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'milestones_json' => 'array',
        'is_active'       => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}

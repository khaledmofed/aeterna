<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class RoadmapStage extends Model
{
    use HasTranslations;

    public array $translatable = ['name', 'timeframe', 'milestones_json'];

    protected $fillable = [
        'stage_number', 'name', 'timeframe', 'status',
        'milestones_json', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}

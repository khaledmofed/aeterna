<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class UseCase extends Model
{
    use HasTranslations;

    public array $translatable = ['title', 'description', 'features_json'];

    protected $fillable = [
        'title', 'description', 'icon_svg',
        'features_json', 'category', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}

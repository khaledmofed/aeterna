<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class FooterLink extends Model
{
    use HasTranslations;

    public array $translatable = ['group_name', 'label'];

    protected $fillable = ['group_name', 'label', 'url', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('group_name')->orderBy('sort_order');
    }
}

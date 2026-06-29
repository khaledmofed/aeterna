<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Solution extends Model
{
    use HasTranslations;

    public array $translatable = ['challenge', 'current_state', 'aeterna_solution'];

    protected $fillable = ['challenge', 'current_state', 'aeterna_solution', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($q) { return $q->where('is_active', true); }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HeroSection extends Model
{
    use HasTranslations;

    public array $translatable = [
        'badge_text', 'headline', 'subheadline',
        'cta_primary_text', 'cta_secondary_text',
        'email_placeholder', 'email_cta',
        'stats_json',
    ];

    protected $fillable = [
        'badge_text', 'headline', 'subheadline',
        'cta_primary_text', 'cta_primary_url',
        'cta_secondary_text', 'cta_secondary_url',
        'stats_json', 'email_placeholder', 'email_cta', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}

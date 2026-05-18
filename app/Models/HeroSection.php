<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $fillable = [
        'badge_text', 'headline', 'subheadline',
        'cta_primary_text', 'cta_primary_url',
        'cta_secondary_text', 'cta_secondary_url',
        'stats_json', 'email_placeholder', 'email_cta', 'is_active',
    ];

    protected $casts = [
        'stats_json' => 'array',
        'is_active'  => 'boolean',
    ];
}

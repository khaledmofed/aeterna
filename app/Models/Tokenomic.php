<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Tokenomic extends Model
{
    use HasTranslations;

    public array $translatable = [
        'section_badge', 'section_title', 'section_subtitle',
        'allocation_json', 'stats_json', 'mechanics_json', 'flywheel_steps_json',
    ];

    protected $fillable = [
        'section_badge', 'section_title', 'section_subtitle',
        'token_name', 'token_ticker', 'token_supply',
        'lp_token_name', 'lp_token_description',
        'allocation_json', 'stats_json', 'mechanics_json', 'flywheel_steps_json',
    ];
}

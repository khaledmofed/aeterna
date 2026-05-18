<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tokenomic extends Model
{
    protected $fillable = [
        'section_badge', 'section_title', 'section_subtitle',
        'token_name', 'token_ticker', 'token_supply',
        'lp_token_name', 'lp_token_description',
        'allocation_json', 'stats_json', 'mechanics_json', 'flywheel_steps_json',
    ];

    protected $casts = [
        'allocation_json'     => 'array',
        'stats_json'          => 'array',
        'mechanics_json'      => 'array',
        'flywheel_steps_json' => 'array',
    ];
}

<?php

namespace Database\Seeders;

use App\Models\HeroSection;
use Illuminate\Database\Seeder;

class HeroSeeder extends Seeder
{
    public function run(): void
    {
        HeroSection::updateOrCreate(['id' => 1], [
            'badge_text'         => 'AI Native Layer 1 ; Now Live',
            'headline'           => 'Future is Chainless.',
            'subheadline'        => 'Building the infrastructure layer for a chainless, autonomous AI economy.',
            'cta_primary_text'   => 'Start Building',
            'cta_primary_url'    => '#',
            'cta_secondary_text' => 'Join Discord',
            'cta_secondary_url'  => 'https://discord.gg/rzJKbPSaaQ',
            'stats_json'         => [
                ['value' => '160K+', 'label' => 'TPS'],
                ['value' => '15+',   'label' => 'Chains Supported'],
                ['value' => '<100ms','label' => 'Finality'],
            ],
            'email_placeholder'  => 'Enter your email address',
            'email_cta'          => 'Stay Updated',
            'is_active'          => true,
        ]);
    }
}

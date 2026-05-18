<?php

namespace Database\Seeders;

use App\Models\FooterLink;
use Illuminate\Database\Seeder;

class FooterSeeder extends Seeder
{
    public function run(): void
    {
        $links = [
            // Developers
            ['group_name' => 'Developers', 'label' => 'Whitepaper',  'url' => '#',                              'sort_order' => 1],
            ['group_name' => 'Developers', 'label' => 'GitHub',      'url' => 'https://github.com/aeternaio',   'sort_order' => 2],
            ['group_name' => 'Developers', 'label' => 'Aeterna SDK', 'url' => '#',                              'sort_order' => 3],
            ['group_name' => 'Developers', 'label' => 'Faucet',      'url' => '#',                              'sort_order' => 4],
            // Ecosystem
            ['group_name' => 'Ecosystem',  'label' => 'Aeterna Subnet',    'url' => '#', 'sort_order' => 1],
            ['group_name' => 'Ecosystem',  'label' => 'Aeterna Inference', 'url' => '#', 'sort_order' => 2],
            ['group_name' => 'Ecosystem',  'label' => 'Aeterna Storage',   'url' => '#', 'sort_order' => 3],
            ['group_name' => 'Ecosystem',  'label' => 'Explorer',          'url' => '#', 'sort_order' => 4],
            // Community
            ['group_name' => 'Community', 'label' => 'Discord',   'url' => 'https://discord.gg/rzJKbPSaaQ',    'sort_order' => 1],
            ['group_name' => 'Community', 'label' => 'X/Twitter', 'url' => 'https://twitter.com/aeternaio',    'sort_order' => 2],
            ['group_name' => 'Community', 'label' => 'Telegram',  'url' => '#',                                'sort_order' => 3],
            ['group_name' => 'Community', 'label' => 'Blog',      'url' => '#',                                'sort_order' => 4],
            ['group_name' => 'Community', 'label' => 'Careers',   'url' => '#',                                'sort_order' => 5],
            // Legal
            ['group_name' => 'Legal', 'label' => 'Privacy Policy',   'url' => '#', 'sort_order' => 1],
            ['group_name' => 'Legal', 'label' => 'Terms of Service', 'url' => '#', 'sort_order' => 2],
        ];

        foreach ($links as $link) {
            FooterLink::updateOrCreate(
                ['group_name' => $link['group_name'], 'label' => $link['label']],
                array_merge($link, ['is_active' => true])
            );
        }
    }
}

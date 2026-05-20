<?php

namespace Database\Seeders;

use App\Models\Investor;
use Illuminate\Database\Seeder;

class InvestorsSeeder extends Seeder
{
    public function run(): void
    {
        $investors = [
            ['name' => 'Aeterna Foundation', 'logo_url' => '/site-assets/logo-wite.svg', 'website_url' => 'https://aeternaio.com',       'glow_color' => '#EBFF00', 'type' => 'lead',       'sort_order' => 1],
            ['name' => 'PT Mining Foundation','logo_url' => '/site-assets/pt-mining.png', 'website_url' => '#',                           'glow_color' => '#ffffff', 'type' => 'lead',       'sort_order' => 2],
            ['name' => 'VALOR',              'logo_url' => '/site-assets/valor.png',      'website_url' => '#',                           'glow_color' => '#ffffff', 'type' => 'lead',       'sort_order' => 3],
            ['name' => 'YZI Labs',            'logo_url' => 'https://static.yzilabs.com/yzi-lab/static/images/logo.png',                                                                              'website_url' => 'https://www.yzilabs.com',      'glow_color' => '#F0B90B', 'type' => 'strategic', 'sort_order' => 4],
            ['name' => 'OKX Ventures',        'logo_url' => 'https://www.okx.com/cdn/assets/imgs/221/187957948BD02D97.png',                                                                                  'website_url' => 'https://www.okx.com/ventures', 'glow_color' => '#2563EB', 'type' => 'strategic', 'sort_order' => 5],
            ['name' => 'HashKey Capital',     'logo_url' => 'https://hashkey.capital/static/images/logo.png',                                                                                                 'website_url' => 'https://hashkey.capital',      'glow_color' => '#16A34A', 'type' => 'strategic', 'sort_order' => 6],
            ['name' => 'Animoca Brands',      'logo_url' => 'https://cdn.prod.website-files.com/694b47ff8f3088ab9288889c/694b47ff8f3088ab928888ff_logo.svg',                                                  'website_url' => 'https://www.animocabrands.com','glow_color' => '#EF4444', 'type' => 'strategic', 'sort_order' => 7],
            ['name' => 'Pantera Capital',     'logo_url' => '',                                                                                                                                                'website_url' => 'https://panteracapital.com',   'glow_color' => '#9333EA', 'type' => 'strategic', 'sort_order' => 8],
            ['name' => 'Gate Ventures',       'logo_url' => '',                                                                                                                                                'website_url' => 'https://www.gate.io/ventures', 'glow_color' => '#0EA5E9', 'type' => 'strategic', 'sort_order' => 9],
        ];

        // Remove stale entries that were renamed
        Investor::where('name', 'Binance Labs')->delete();

        foreach ($investors as $investor) {
            Investor::updateOrCreate(['name' => $investor['name']], array_merge($investor, ['is_active' => true]));
        }
    }
}

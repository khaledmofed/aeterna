<?php

namespace Database\Seeders;

use App\Models\NavItem;
use Illuminate\Database\Seeder;

class NavSeeder extends Seeder
{
    public function run(): void
    {
        NavItem::truncate();

        $arch = NavItem::create(['label' => 'Architecture', 'url' => '#architecture', 'sort_order' => 1, 'is_active' => true]);
        NavItem::create(['label' => 'Solutions',   'url' => '#solutions',   'sort_order' => 2, 'is_active' => true]);
        NavItem::create(['label' => 'Exchange',    'url' => '#exchange',    'sort_order' => 3, 'is_active' => true]);
        NavItem::create(['label' => 'Use Cases',   'url' => '#use-cases',   'sort_order' => 4, 'is_active' => true]);

        $children = [
            ['label' => 'Infrastructure', 'url' => '#layer-infrastructure', 'sort_order' => 1],
            ['label' => 'AI Engine',       'url' => '#ai-core-engine',       'sort_order' => 2],
            ['label' => 'Abstraction',     'url' => '#chain-abstraction',    'sort_order' => 3],
            ['label' => 'Payment',         'url' => '#layer-payment',        'sort_order' => 4],
            ['label' => 'Aeterna DAG',     'url' => '#tech-consensus',       'sort_order' => 5],
            ['label' => 'Multi-VM',        'url' => '#tech-vm',              'sort_order' => 6],
        ];

        foreach ($children as $child) {
            NavItem::create(array_merge($child, ['parent_id' => $arch->id, 'is_active' => true]));
        }
    }
}

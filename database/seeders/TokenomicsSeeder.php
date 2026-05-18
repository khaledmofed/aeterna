<?php

namespace Database\Seeders;

use App\Models\Tokenomic;
use Illuminate\Database\Seeder;

class TokenomicsSeeder extends Seeder
{
    public function run(): void
    {
        Tokenomic::updateOrCreate(['id' => 1], [
            'section_badge'    => 'Token Economics',
            'section_title'    => 'AETHER Tokenomics',
            'section_subtitle' => 'A deflationary economic model designed for sustainable growth, community ownership, and long-term value accrual.',
            'token_name'       => 'AETHER',
            'token_ticker'     => 'ATA',
            'token_supply'     => '1,000,000,000 ATA',
            'lp_token_name'    => 'AIA',
            'lp_token_description' => 'AIA is the liquidity provider token for the Aeterna DEX. LP providers receive AIA tokens representing their share of liquidity pools, earning trading fees and protocol incentives.',
            'allocation_json'  => [
                ['label' => 'Ecosystem & Rewards', 'percentage' => 30, 'color' => '#EBFF00'],
                ['label' => 'Foundation Reserve',  'percentage' => 25, 'color' => '#ffffff'],
                ['label' => 'Public Sale',          'percentage' => 20, 'color' => '#888888'],
                ['label' => 'Team & Advisors',      'percentage' => 15, 'color' => '#555555'],
                ['label' => 'Strategic Reserve',    'percentage' => 10, 'color' => '#333333'],
            ],
            'stats_json' => [
                ['value' => '160K+',   'label' => 'TPS',            'description' => 'Transactions per second'],
                ['value' => '15+',     'label' => 'Chains',         'description' => 'Connected blockchains'],
                ['value' => '<100ms',  'label' => 'Finality',       'description' => 'Transaction confirmation'],
                ['value' => '0.02%',   'label' => 'Protocol Fee',   'description' => 'Minimum DEX fee'],
            ],
            'mechanics_json' => [
                ['title' => 'Resource Credit System',       'description' => 'Stake AETHER to earn resource credits proportional to your stake. Use the network without per-transaction fees — ideal for high-frequency AI agents.', 'icon_svg' => '<path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2z"/><path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/>'],
                ['title' => 'Community Buyback & Burn',     'description' => '90% of all protocol revenue is used to buy back and permanently burn AETHER, reducing supply over time. 10% flows to active stakers.', 'icon_svg' => '<path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"/>'],
                ['title' => 'Anti-Sell Pressure Mechanism', 'description' => 'Early unstaking incurs a 5–10% penalty that is immediately burned, discouraging short-term speculation and rewarding long-term holders.', 'icon_svg' => '<path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/>'],
                ['title' => 'Liquid Staking (lstAETHER)',   'description' => 'Stake AETHER and receive lstAETHER — a liquid, yield-bearing token you can use across DeFi while still earning staking rewards.', 'icon_svg' => '<path d="M7 16.3c2.2 0 4-1.83 4-4.05 0-1.16-.57-2.26-1.71-3.19S7.29 6.75 7 5.3c-.29 1.45-1.14 2.84-2.29 3.76S3 11.1 3 12.25c0 2.22 1.8 4.05 4 4.05z"/><path d="M12.56 6.6A10.97 10.97 0 0 0 14 3.02c.5 2.5 2 4.9 4 6.5s3 3.5 3 5.5a6.98 6.98 0 0 1-11.91 4.97"/>'],
            ],
            'flywheel_steps_json' => [
                'Network Usage Grows',
                'Protocol Revenue Generated (0.02–0.1% fees)',
                'Revenue Flows to Treasury',
                'Treasury Executes Buyback',
                '90% of Bought AETHER Burned',
                '10% Distributed to Stakers',
                'Reduced Supply + Staker Yield',
                'Increased Staking Demand',
                'More Network Security & Usage',
            ],
        ]);
    }
}

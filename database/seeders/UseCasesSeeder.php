<?php

namespace Database\Seeders;

use App\Models\UseCase;
use Illuminate\Database\Seeder;

class UseCasesSeeder extends Seeder
{
    public function run(): void
    {
        $cases = [
            [
                'title'       => 'D-Commerce',
                'description' => 'Decentralized e-commerce infrastructure that eliminates platform intermediaries. Sellers keep 99.9% of revenue with fees of only 0.02–0.1%, versus traditional 15–40% platform cuts.',
                'icon_svg'    => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" /></svg>',
                'features_json' => [
                    ['title' => 'Near-Zero Platform Fees',     'description' => '0.02–0.1% vs traditional 15–40% ; sellers keep 99.9% of every sale'],
                    ['title' => 'AI-Powered Storefront',       'description' => 'AI agents manage inventory, pricing, and customer service autonomously'],
                    ['title' => 'Instant Global Payments',     'description' => 'Cross-chain payments in any token, settled in under 100ms'],
                    ['title' => 'Buyer Protection Protocol',   'description' => 'Programmable escrow with automatic dispute resolution'],
                    ['title' => 'Tokenized Loyalty Points',    'description' => 'Interoperable rewards that work across all D-Commerce stores'],
                    ['title' => 'Decentralized Reviews',       'description' => 'Tamper-proof review system with cryptographic attestations'],
                ],
                'category'    => 'commerce',
                'sort_order'  => 1,
                'is_active'   => true,
            ],
            [
                'title'       => 'Tokenized Real Estate',
                'description' => 'Fractional ownership of global real estate through ERC-1155 property NFTs. Invest in prime real estate with as little as $10, powered by AI property management.',
                'icon_svg'    => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" /></svg>',
                'features_json' => [
                    ['title' => '$10 Minimum Investment',     'description' => 'Fractional ownership from $10 ; democratizing access to global real estate markets'],
                    ['title' => 'ERC-1155 Property NFTs',     'description' => 'Each property is tokenized as an ERC-1155 NFT with legally binding ownership rights'],
                    ['title' => 'AI Property Management',     'description' => 'AI agents handle tenant management, maintenance requests, and rental collection'],
                    ['title' => 'Automated Rent Distribution','description' => 'Rental income distributed automatically to all fractional owners in real-time'],
                    ['title' => 'Global Property Access',     'description' => 'Invest in properties across 50+ countries from a single Universal Address'],
                    ['title' => 'Liquidity via DEX',          'description' => 'Trade your property fractions 24/7 on Aeterna DEX with instant settlement'],
                ],
                'category'    => 'rwa',
                'sort_order'  => 2,
                'is_active'   => true,
            ],
            [
                'title'       => 'Open UBI',
                'description' => 'Sustainable Universal Basic Income through network participation. Earn by contributing data, attention, and compute ; a new economic model for the AI age.',
                'icon_svg'    => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>',
                'features_json' => [
                    ['title' => 'Data Labor Economy',         'description' => 'Earn AETHER by contributing your data to AI training ; your data, your profit'],
                    ['title' => 'Attention Economy Layer',    'description' => 'Get paid for your attention and engagement on the Aeterna network'],
                    ['title' => 'Network Effect Rewards',     'description' => 'Earn more as you bring more participants into the ecosystem'],
                    ['title' => 'Compute Contribution',       'description' => 'Rent out your device compute to AI agents and earn passive income'],
                    ['title' => 'Governance Participation',   'description' => 'Vote on protocol decisions and earn rewards for active DAO participation'],
                    ['title' => 'Social Proof of Work',       'description' => 'Verifiable proof that your contributions are fairly compensated via ZK-proofs'],
                ],
                'category'    => 'ubi',
                'sort_order'  => 3,
                'is_active'   => true,
            ],
            [
                'title'       => 'AI Service Economy',
                'description' => 'A marketplace for AI agents to monetize services autonomously. Deploy AI agents that earn revenue 24/7 without human intervention using the x402 payment protocol.',
                'icon_svg'    => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z" /></svg>',
                'features_json' => [
                    ['title' => 'Autonomous Agent Monetization', 'description' => 'Deploy AI agents that sell services, pay for resources, and earn revenue independently'],
                    ['title' => 'x402 Micropayments',           'description' => 'Pay-per-use AI services with sub-cent micropayments via the x402 protocol'],
                    ['title' => 'Agent Marketplace',            'description' => 'Discover, hire, and orchestrate specialized AI agents from the Aeterna marketplace'],
                    ['title' => 'Service Composition',          'description' => 'Chain multiple AI agents together for complex workflows with automatic payment routing'],
                    ['title' => 'Reputation System',            'description' => 'On-chain reputation scores ensure quality and accountability for all AI agents'],
                    ['title' => 'Revenue Splitting',            'description' => 'Automatic revenue splitting between agent creators, operators, and token holders'],
                ],
                'category'    => 'ai',
                'sort_order'  => 4,
                'is_active'   => true,
            ],
        ];

        foreach ($cases as $case) {
            UseCase::updateOrCreate(['title' => $case['title']], $case);
        }
    }
}

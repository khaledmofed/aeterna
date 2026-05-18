<?php

namespace Database\Seeders;

use App\Models\ArchitectureLayer;
use Illuminate\Database\Seeder;

class ArchitectureSeeder extends Seeder
{
    public function run(): void
    {
        $svg = fn(string $paths) =>
            '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">'.$paths.'</svg>';

        $layers = [
            [
                'layer_number' => 1,
                'name'         => 'Infrastructure Layer',
                'slug'         => 'layer-infrastructure',
                'description'  => 'The foundational bedrock of Aeterna — a high-performance Layer 1 built with Rust for maximum throughput, security, and determinism.',
                'icon_svg'     => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5.25 14.25h13.5m-13.5 0a3 3 0 01-3-3m3 3a3 3 0 100 6h13.5a3 3 0 100-6m-13.5 0v-1.5m13.5 1.5v-1.5m0 0a3 3 0 01-3-3M5.25 14.25a3 3 0 013-3m3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423m2.291-5.843 1.105-4.423A1.875 1.875 0 0116.128 3H7.872a1.875 1.875 0 00-1.819 1.42L4.948 8.843" /></svg>',
                'features_json' => [
                    ['title' => 'Aeterna Core',          'description' => 'Rust-based execution engine with 160K+ TPS throughput and sub-100ms finality.',               'icon_svg' => $svg('<path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"/>')],
                    ['title' => 'Aeterna DAG',           'description' => 'Directed Acyclic Graph consensus for parallel transaction processing without bottlenecks.',    'icon_svg' => $svg('<line x1="6" x2="6" y1="3" y2="15"/><circle cx="18" cy="6" r="3"/><circle cx="6" cy="18" r="3"/><path d="M18 9a9 9 0 0 1-9 9"/>')],
                    ['title' => 'BFT Consensus',         'description' => 'Byzantine Fault Tolerant consensus ensuring network integrity with 2/3 honest validator threshold.', 'icon_svg' => $svg('<path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/>')],
                    ['title' => 'Data Availability',    'description' => 'Modular DA layer ensuring data is always available for verification without full node requirements.', 'icon_svg' => $svg('<path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"/><path d="M12 22V12"/><path d="m3.3 7 7.703 4.734a2 2 0 0 0 1.994 0L20.7 7"/>')],
                    ['title' => 'Multi-VM Support',      'description' => 'Native support for Rust VM, Move, WASM, and EVM — deploy any smart contract language.',        'icon_svg' => $svg('<path d="M12 20v2"/><path d="M12 2v2"/><path d="M17 20v2"/><path d="M17 2v2"/><path d="M2 12h2"/><path d="M2 17h2"/><path d="M2 7h2"/><path d="M20 12h2"/><path d="M20 17h2"/><path d="M20 7h2"/><path d="M7 20v2"/><path d="M7 2v2"/><rect x="4" y="4" width="16" height="16" rx="2"/><rect x="8" y="8" width="8" height="8" rx="1"/>')],
                    ['title' => 'Decentralized Storage', 'description' => 'On-chain and off-chain storage solutions integrated directly into the protocol layer.',         'icon_svg' => $svg('<line x1="22" x2="2" y1="12" y2="12"/><path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/><line x1="6" x2="6.01" y1="16" y2="16"/><line x1="10" x2="10.01" y1="16" y2="16"/>')],
                ],
                'sort_order'   => 1,
            ],
            [
                'layer_number' => 2,
                'name'         => 'AI Engine Layer',
                'slug'         => 'ai-core-engine',
                'description'  => 'The world\'s first fully on-chain AI execution layer — bringing verifiable, incentivized intelligence directly into blockchain consensus.',
                'icon_svg'     => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z" /></svg>',
                'features_json' => [
                    ['title' => 'On-chain Orchestrator', 'description' => 'Coordinates AI agent swarms directly on-chain with verifiable execution traces.',                'icon_svg' => $svg('<path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/>')],
                    ['title' => 'Aeterna Inference',     'description' => 'Verifiable AI reasoning with cryptographic proofs — every AI decision is auditable on-chain.',  'icon_svg' => $svg('<path d="M12 18V5"/><path d="M15 13a4.17 4.17 0 0 1-3-4 4.17 4.17 0 0 1-3 4"/><path d="M17.598 6.5A3 3 0 1 0 12 5a3 3 0 1 0-5.598 1.5"/><path d="M17.997 5.125a4 4 0 0 1 2.526 5.77"/><path d="M18 18a4 4 0 0 0 2-7.464"/><path d="M19.967 17.483A4 4 0 1 1 12 18a4 4 0 1 1-7.967-.517"/><path d="M6 18a4 4 0 0 1-2-7.464"/><path d="M6.003 5.125a4 4 0 0 0-2.526 5.77"/>')],
                    ['title' => 'Aeterna Subnet',        'description' => 'Incentivized marketplace for AI model providers — earn rewards for contributing compute.',        'icon_svg' => $svg('<circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/>')],
                    ['title' => 'Aeterna Memory',        'description' => 'Long-term on-chain memory for AI agents — persistent context across sessions and chains.',       'icon_svg' => $svg('<ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M3 5V19A9 3 0 0 0 21 19V5"/><path d="M3 12A9 3 0 0 0 21 12"/>')],
                    ['title' => 'A2A Protocol',          'description' => 'Agent-to-Agent communication protocol enabling autonomous multi-agent collaboration.',             'icon_svg' => $svg('<path d="M4.9 19.1C1 15.2 1 8.8 4.9 4.9"/><path d="M7.8 16.2c-2.3-2.3-2.3-6.1 0-8.5"/><circle cx="12" cy="12" r="2"/><path d="M16.2 7.8c2.3 2.3 2.3 6.1 0 8.5"/><path d="M19.1 4.9C23 8.8 23 15.1 19.1 19"/>')],
                    ['title' => 'Verifiable Compute',   'description' => 'ZK-proof backed AI computation ensuring trustless, tamper-proof AI execution.',                   'icon_svg' => $svg('<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/>')],
                ],
                'sort_order'   => 2,
            ],
            [
                'layer_number' => 3,
                'name'         => 'Chain Abstraction Layer',
                'slug'         => 'chain-abstraction',
                'description'  => 'One address. Every chain. Aeterna\'s chain abstraction layer eliminates the complexity of multi-chain interactions through intent-based execution.',
                'icon_svg'     => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" /></svg>',
                'features_json' => [
                    ['title' => 'Universal Address',      'description' => 'A single address that works across 15+ blockchains — no more managing multiple wallets.',         'icon_svg' => $svg('<path d="m15.5 7.5 2.3 2.3a1 1 0 0 0 1.4 0l2.1-2.1a1 1 0 0 0 0-1.4L19 4"/><path d="m21 2-9.6 9.6"/><circle cx="7.5" cy="15.5" r="5.5"/>')],
                    ['title' => 'Solver Network',         'description' => '100% on-chain Dutch auction solver network ensuring best execution with zero MEV.',               'icon_svg' => $svg('<path d="m16 16 3-8 3 8c-.87.65-1.92 1-3 1s-2.13-.35-3-1z"/><path d="m2 16 3-8 3 8c-.87.65-1.92 1-3 1s-2.13-.35-3-1z"/><path d="M7 21h10"/><path d="M12 3v18"/><path d="M3 7h2c2 0 5-1 7-2 2 1 5 2 7 2h2"/>')],
                    ['title' => 'No-MPC Key Derivation',  'description' => 'Multi-curve key derivation without trusted MPC parties — true self-custody across chains.',       'icon_svg' => $svg('<rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>')],
                    ['title' => 'Intent Engine',          'description' => 'Express what you want, not how to do it. The Intent Engine finds the optimal execution path.',    'icon_svg' => $svg('<circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/>')],
                    ['title' => '15+ Chain Support',      'description' => 'Native connectivity to Ethereum, Solana, Bitcoin, BNB Chain, Arbitrum, and 10+ more.',            'icon_svg' => $svg('<circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/>')],
                    ['title' => 'Cross-chain Liquidity',  'description' => 'Unified liquidity pools spanning all connected chains for optimal swap rates.',                    'icon_svg' => $svg('<path d="M7 16.3c2.2 0 4-1.83 4-4.05 0-1.16-.57-2.26-1.71-3.19S7.29 6.75 7 5.3c-.29 1.45-1.14 2.84-2.29 3.76S3 11.1 3 12.25c0 2.22 1.8 4.05 4 4.05z"/><path d="M12.56 6.6A10.97 10.97 0 0 0 14 3.02c.5 2.5 2 4.9 4 6.5s3 3.5 3 5.5a6.98 6.98 0 0 1-11.91 4.97"/>')],
                ],
                'sort_order'   => 3,
            ],
            [
                'layer_number' => 4,
                'name'         => 'Payment & Trust Layer',
                'slug'         => 'layer-payment',
                'description'  => 'AI-native payment infrastructure for the autonomous economy — micropayments, gas abstraction, and programmable trust for AI agents.',
                'icon_svg'     => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" /></svg>',
                'features_json' => [
                    ['title' => 'Aeterna AP2',        'description' => 'Intent-based authorization protocol — like a shopping cart for blockchain transactions.',            'icon_svg' => $svg('<circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/>')],
                    ['title' => 'x402 Protocol',      'description' => 'HTTP 402-inspired AI-native micropayment standard for autonomous agent transactions.',             'icon_svg' => $svg('<rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/>')],
                    ['title' => 'Paymaster',           'description' => 'Gas abstraction layer — pay fees in any token or let dApps sponsor transactions entirely.',          'icon_svg' => $svg('<path d="M3 22V3h10v19"/><path d="M3 8h10"/><path d="M13 5h2a2 2 0 0 1 2 2v3a2 2 0 0 0 2 2h0a2 2 0 0 1 2 2v6.5a1.5 1.5 0 0 1-3 0V12h-5"/>')],
                    ['title' => 'Resource Credits',   'description' => 'Stake AETHER to earn resource credits — use the network without paying per-transaction fees.',       'icon_svg' => $svg('<path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2z"/><path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/>')],
                    ['title' => 'Streaming Payments', 'description' => 'Real-time payment streams for AI agents — pay by the millisecond for compute resources.',           'icon_svg' => $svg('<path d="M2 6c.6.5 1.2 1 2.5 1C7 7 7 5 9.5 5c2.6 0 2.4 2 5 2 2.5 0 2.5-2 5-2 1.3 0 1.9.5 2.5 1"/><path d="M2 12c.6.5 1.2 1 2.5 1 2.5 0 2.5-2 5-2 2.6 0 2.4 2 5 2 2.5 0 2.5-2 5-2 1.3 0 1.9.5 2.5 1"/><path d="M2 18c.6.5 1.2 1 2.5 1 2.5 0 2.5-2 5-2 2.6 0 2.4 2 5 2 2.5 0 2.5-2 5-2 1.3 0 1.9.5 2.5 1"/>')],
                    ['title' => 'Privacy Payments',   'description' => 'Optional RingCT and ZK-proof privacy for sensitive business transactions.',                         'icon_svg' => $svg('<path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" x2="22" y1="2" y2="22"/>')],
                ],
                'sort_order'   => 4,
            ],
        ];

        foreach ($layers as $layer) {
            ArchitectureLayer::updateOrCreate(
                ['slug' => $layer['slug']],
                $layer
            );
        }
    }
}

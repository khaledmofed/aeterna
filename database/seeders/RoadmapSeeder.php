<?php

namespace Database\Seeders;

use App\Models\RoadmapStage;
use Illuminate\Database\Seeder;

class RoadmapSeeder extends Seeder
{
    public function run(): void
    {
        $stages = [
            [
                'stage_number'    => 1,
                'name'            => 'Foundation',
                'timeframe'       => 'Year 1 ; Q1 & Q2',
                'status'          => 'active',
                'milestones_json' => [
                    'Aeterna Core mainnet launch',
                    'BFT consensus deployment',
                    'Basic chain abstraction (5 chains)',
                    'AETHER token generation event',
                    'Resource credit system activation',
                    'Universal Address v1 (EVM chains)',
                    'DEX beta launch',
                    'Validator onboarding program',
                ],
                'sort_order' => 1,
                'is_active'  => true,
            ],
            [
                'stage_number'    => 2,
                'name'            => 'AI Integration',
                'timeframe'       => 'Year 1 ; Q3 & Q4',
                'status'          => 'upcoming',
                'milestones_json' => [
                    'Aeterna Inference mainnet (verifiable AI)',
                    'Aeterna Subnet incentive marketplace launch',
                    'A2A protocol (Agent-to-Agent communication)',
                    'Multi-VM support (EVM, Move, WASM)',
                    'AI agent SDK public release',
                    'Aeterna Memory (long-term agent memory)',
                    'x402 micropayment protocol',
                    'DEX full launch with AI market making',
                ],
                'sort_order' => 2,
                'is_active'  => true,
            ],
            [
                'stage_number'    => 3,
                'name'            => 'Chain Abstraction',
                'timeframe'       => 'Year 2 ; Q1 & Q2',
                'status'          => 'upcoming',
                'milestones_json' => [
                    'Full Universal Address (15+ chains)',
                    'No-MPC multi-curve key derivation',
                    'Decentralized Solver Network v2',
                    'Intent Engine with AI optimization',
                    'Cross-chain liquidity unification',
                    'Paymaster gas abstraction live',
                    'RingCT privacy transactions',
                    'Institutional API launch',
                ],
                'sort_order' => 3,
                'is_active'  => true,
            ],
            [
                'stage_number'    => 4,
                'name'            => 'Ecosystem Expansion',
                'timeframe'       => 'Year 2 ; Q3+',
                'status'          => 'upcoming',
                'milestones_json' => [
                    'Aeterna DAG v2 upgrade',
                    'ZK-SNARK privacy layer integration',
                    'Bulletproofs for confidential transactions',
                    'Enterprise solutions & SDK',
                    'D-Commerce platform launch',
                    'Tokenized Real Estate protocol',
                    'Open UBI distribution system',
                    'Full decentralized governance (DAO)',
                ],
                'sort_order' => 4,
                'is_active'  => true,
            ],
        ];

        foreach ($stages as $stage) {
            RoadmapStage::updateOrCreate(
                ['stage_number' => $stage['stage_number']],
                $stage
            );
        }
    }
}

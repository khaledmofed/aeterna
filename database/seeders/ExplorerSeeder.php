<?php

namespace Database\Seeders;

use App\Models\ExplorerPage;
use Illuminate\Database\Seeder;

class ExplorerSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'slug'         => 'dashboard',
                'title'        => 'Network Overview',
                'description'  => 'TPS / finality / epoch, latest blocks & tx, AI subsystem activity strip.',
                'tag'          => 'Core + AI',
                'icon_svg'     => '<rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/>',
                'sort_order'   => 1,
                'is_active'    => true,
                'content_json' => [
                    'hero_stats' => [
                        ['label' => 'TPS',                  'value' => '284,109',  'sub' => '+12.4% in 1h',         'accent' => true],
                        ['label' => 'Finality',             'value' => '412 ms',   'sub' => 'Mysticeti DAG'],
                        ['label' => 'Current Epoch',        'value' => '1,847',    'sub' => 'ending in 4h 12m'],
                        ['label' => 'Total Transactions',   'value' => '9.42B',    'sub' => '+284K in 1h'],
                        ['label' => 'Active Agents',        'value' => '38,204',   'sub' => '+1.2% in 1h'],
                    ],
                    'recent_checkpoints' => [
                        ['seq' => '#48,209,117', 'txns' => 284, 'validators' => '12/14', 'ago' => '2s ago'],
                        ['seq' => '#48,209,116', 'txns' => 193, 'validators' => '13/14', 'ago' => '4s ago'],
                        ['seq' => '#48,209,115', 'txns' => 512, 'validators' => '11/14', 'ago' => '6s ago'],
                        ['seq' => '#48,209,114', 'txns' => 307, 'validators' => '14/14', 'ago' => '8s ago'],
                        ['seq' => '#48,209,113', 'txns' => 421, 'validators' => '12/14', 'ago' => '10s ago'],
                    ],
                    'recent_transactions' => [
                        ['hash' => '7Fa3C2b9...', 'type' => 'Skill Royalty',        'gas' => '4,182 ATA', 'status' => 'success'],
                        ['hash' => '3aB7e98c...', 'type' => 'Inference Channel',    'gas' => '1,204 ATA', 'status' => 'success'],
                        ['hash' => '9fE2c83b...', 'type' => 'Cross-chain Intent',   'gas' => '8,402 ATA', 'status' => 'pending'],
                        ['hash' => 'A6b2D9f1...', 'type' => 'Capsule Evolve',       'gas' => '2,118 ATA', 'status' => 'success'],
                        ['hash' => '4cA7e8C4...', 'type' => 'Agent Hook Tick',      'gas' => '412 ATA',   'status' => 'success'],
                    ],
                    'ai_subsystems' => [
                        ['label' => 'Context Capsules',    'value' => '1.92M',  'sub' => '+8,402 evolved'],
                        ['label' => 'Skills Minted',       'value' => '74,118', 'sub' => '$12.4K royalties'],
                        ['label' => 'Inference Channels',  'value' => '2,841',  'sub' => 'currently open'],
                        ['label' => 'Cross-chain Intents', 'value' => '9,207',  'sub' => '99.4% success'],
                        ['label' => 'Agent Hook Ticks',    'value' => '1,847',  'sub' => 'one per checkpoint'],
                    ],
                ],
            ],
            [
                'slug'         => 'checkpoint',
                'title'        => 'Checkpoint Detail',
                'description'  => 'Overview key-values + the transactions contained in the checkpoint.',
                'tag'          => 'Core',
                'icon_svg'     => '<path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>',
                'sort_order'   => 2,
                'is_active'    => true,
                'content_json' => [
                    'overview' => [
                        'checkpoint'      => '#48,209,117',
                        'sequence'        => 'Epoch 1,847',
                        'status'          => 'Committed',
                        'digest'          => '7Fa3C2b9E1d4A6c8F5b2D9f14cA7e8C4a61fD2',
                        'previous_digest' => '3aB7e98cF59fE2c83bA6b2D9f14cA7e8C4a61f',
                        'timestamp'       => '2026-05-18 02:14:09.412 UTC',
                        'tx_count'        => 284,
                        'gas_computation' => '1,204,118 ATA',
                        'gas_storage'     => '88,402 ATA',
                        'validator_sigs'  => '12 of 14 (aggregated BLS)',
                    ],
                    'transactions' => [
                        ['digest' => '7Fa3C2b9...', 'type' => 'Skill Royalty',           'sender' => '0x9f2a...', 'gas' => '4,182 ATA', 'status' => 'success'],
                        ['digest' => '3aB7e98c...', 'type' => 'Inference Channel Open',  'sender' => '0x71ce...', 'gas' => '1,204 ATA', 'status' => 'success'],
                        ['digest' => '9fE2c83b...', 'type' => 'Cross-chain Intent',      'sender' => '0x4d2f...', 'gas' => '8,402 ATA', 'status' => 'pending'],
                        ['digest' => 'A6b2D9f1...', 'type' => 'Capsule Evolve',          'sender' => '0x9f2a...', 'gas' => '2,118 ATA', 'status' => 'success'],
                        ['digest' => '4cA7e8C4...', 'type' => 'Agent Hook Tick',         'sender' => '0xab12...', 'gas' => '412 ATA',   'status' => 'success'],
                        ['digest' => 'F59fE2c8...', 'type' => 'PTB Transfer',            'sender' => '0x71ce...', 'gas' => '892 ATA',   'status' => 'success'],
                    ],
                ],
            ],
            [
                'slug'         => 'transaction',
                'title'        => 'Transaction (PTB)',
                'description'  => 'PTB command sequence timeline + object changes & events, OCC-annotated.',
                'tag'          => 'Core + AI',
                'icon_svg'     => '<path d="m16 3 4 4-4 4"/><path d="M20 7H4"/><path d="m8 21-4-4 4-4"/><path d="M4 17h16"/>',
                'sort_order'   => 3,
                'is_active'    => true,
                'content_json' => [
                    'overview' => [
                        'id'            => '7Fa3C2b9E14cA7e8C4a61fD23aB7e98cF59fE2c8',
                        'status'        => 'success',
                        'sender'        => '0x9f2a3b81…c41d7e02',
                        'checkpoint'    => '#48,209,117',
                        'timestamp'     => '2026-05-18 02:14:09.412 UTC',
                        'gas_total'     => '4,182 ATA',
                        'gas_computation' => '3,100 ATA',
                        'gas_storage'   => '1,082 ATA',
                        'execution'     => 'OCC parallel · lane: AI · 0 conflicts',
                    ],
                    'commands' => [
                        ['n' => 1, 'label' => 'SplitCoins',     'desc' => 'Split coins allocation for royalty (1,200 ATA)'],
                        ['n' => 2, 'label' => 'MoveCall',       'desc' => 'Pay royalty via skill contract'],
                        ['n' => 3, 'label' => 'MoveCall',       'desc' => 'Record citation in agent contract'],
                        ['n' => 4, 'label' => 'TransferObjects', 'desc' => 'Transfer receipt objects to sender'],
                    ],
                    'object_changes' => [
                        'mutated' => [
                            ['label' => 'Skill object', 'addr' => '0x4d2f…8c5a'],
                            ['label' => 'Agent object', 'addr' => '0x71ce…2af5'],
                        ],
                        'created' => [
                            ['label' => 'RoyaltyReceipt', 'addr' => '0xab12…9d3e'],
                        ],
                    ],
                    'events' => [
                        ['name' => 'RoyaltyPaid',       'desc' => '1,200 ATA distributed to beneficiary 0x55a1…'],
                        ['name' => 'CitationRecorded',  'desc' => 'Weight value of 0.42 assigned'],
                    ],
                ],
            ],
            [
                'slug'         => 'agent',
                'title'        => 'Agent Detail',
                'description'  => 'Reputation, skill portfolio with derived_from lineage, citation revenue.',
                'tag'          => 'AI Native',
                'icon_svg'     => '<path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/>',
                'sort_order'   => 4,
                'is_active'    => true,
                'content_json' => [
                    'identity' => [
                        'name'                 => 'Atlas-7 Research Agent',
                        'address'              => '0x71ce4d2f8c5a…2af5',
                        'owner'                => '0x9f2a…c41d',
                        'reputation'           => 94.2,
                        'total_skills'         => 24,
                        'self_evolved'         => 6,
                        'lifetime_royalties'   => '42.8K ATA',
                        'royalties_24h'        => '88 ATA',
                        'active_collaborations' => 7,
                        'total_citations'      => 1204,
                    ],
                    'skills' => [
                        ['name' => 'deep-research-v3',      'invocations' => '4,128',  'royalties' => '8.2K ATA',  'rep' => 96, 'evolved' => false],
                        ['name' => 'pdf-extract-pipeline',  'invocations' => '12,004', 'royalties' => '18.4K ATA', 'rep' => 91, 'evolved' => false],
                        ['name' => 'citation-synthesis-v2', 'invocations' => '902',    'royalties' => '3.8K ATA',  'rep' => 88, 'evolved' => true, 'parent' => 'deep-research-v3'],
                        ['name' => 'multi-hop-qa',          'invocations' => '311',    'royalties' => '1.2K ATA',  'rep' => 82, 'evolved' => true, 'parent' => 'deep-research-v3'],
                    ],
                    'collaborations' => [
                        ['partner' => 'LegalReview-DAO', 'share' => '18% revenue share', 'type' => 'team'],
                        ['partner' => 'Orion-3',         'share' => 'citation peer',      'type' => 'agent'],
                        ['partner' => 'Nova-1',          'share' => 'citation peer',      'type' => 'agent'],
                    ],
                ],
            ],
            [
                'slug'         => 'crosschain',
                'title'        => 'Cross-chain Account',
                'description'  => 'Derived BTC/ETH/Sol/Cosmos/TON addresses, intents, MPC signatures.',
                'tag'          => 'AI Native',
                'icon_svg'     => '<path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>',
                'sort_order'   => 5,
                'is_active'    => true,
                'content_json' => [
                    'account' => [
                        'address'     => '0x9f2a3b817e02…c41d',
                        'total_value' => '$184,209.42',
                        'tss_nodes'   => 31,
                        'scheme'      => 'threshold signature (no single key)',
                    ],
                    'chains' => [
                        ['chain' => 'Bitcoin',  'address' => 'bc1qael…x8f2',     'balance' => '1.842 BTC',   'value' => '$128.4K', 'trust' => 'MPC trust root'],
                        ['chain' => 'Ethereum', 'address' => '0x4d2f…8c5a',      'balance' => '12.04 ETH',   'value' => '$41.2K',  'trust' => 'ZK Vault root'],
                        ['chain' => 'Solana',   'address' => '7Fa3…9bE1',        'balance' => '284 SOL',     'value' => '$9.8K',   'trust' => 'MPC trust root'],
                        ['chain' => 'Cosmos',   'address' => 'cosmos1…4cA7',     'balance' => '1,204 ATOM',  'value' => '$4.1K',   'trust' => 'ZK Vault root'],
                        ['chain' => 'TON',      'address' => 'EQAb…9d3e',        'balance' => '892 TON',     'value' => '$0.9K',   'trust' => 'MPC trust root'],
                    ],
                    'intents' => [
                        ['desc' => '0.5 BTC → 8,200 USDC',            'solver' => 'ETHPOL', 'route' => '2-hop',    'fee' => '0.04%', 'time' => '412ms',  'status' => 'settled'],
                        ['desc' => 'ETH swap + AI inference + TON exec','solver' => 'POL',    'route' => '4 ops',    'fee' => '0.02%', 'time' => '891ms',  'status' => 'settled'],
                        ['desc' => '1,000 ATOM → SOL',                  'solver' => 'POL',    'route' => 'searching','fee' => '—',     'time' => '—',      'status' => 'routing'],
                    ],
                    'mpc_activity' => [
                        ['tx' => 'Bitcoin tx 1.842 BTC',  'approval' => '31/31 TSS',         'attestation' => 'TEE',     'status' => 'signed'],
                        ['tx' => 'Ethereum contract call', 'approval' => 'ZK Vault proof',    'attestation' => 'ZK',      'status' => 'signed'],
                        ['tx' => '12 BTC large tx',        'approval' => 'challenge period',  'attestation' => 'watcher', 'status' => 'challenge', 'remaining' => '2h 11m'],
                    ],
                ],
            ],
            [
                'slug'         => 'skills',
                'title'        => 'Skill Market + Capsule Lineage',
                'description'  => 'Skill economy table + Capsule evolution timeline (compress/fork/merge/forget).',
                'tag'          => 'AI Native',
                'icon_svg'     => '<path d="M12 2H2v10l9.29 9.29c.94.94 2.48.94 3.42 0l6.58-6.58c.94-.94.94-2.48 0-3.42L12 2Z"/><path d="M7 7h.01"/>',
                'sort_order'   => 6,
                'is_active'    => true,
                'content_json' => [
                    'market' => [
                        ['name' => 'deep-research-v3',     'creator' => '0x9f2a…c41d', 'calls' => '4,128',  'royalties' => '8.2K ATA',  'rep' => 96],
                        ['name' => 'pdf-extract-pipeline', 'creator' => '0x71ce…2af5', 'calls' => '12,004', 'royalties' => '18.4K ATA', 'rep' => 91],
                        ['name' => 'sql-codegen-pro',      'creator' => '0x4d2f…8c5a', 'calls' => '9,820',  'royalties' => '14.1K ATA', 'rep' => 94],
                        ['name' => 'citation-synthesis-v2','creator' => '0x9f2a…c41d', 'calls' => '902',    'royalties' => '3.8K ATA',  'rep' => 88],
                        ['name' => 'vision-ocr-multi',     'creator' => '0xab12…9d3e', 'calls' => '6,440',  'royalties' => '9.7K ATA',  'rep' => 89],
                        ['name' => 'multi-hop-qa',         'creator' => '0x9f2a…c41d', 'calls' => '311',    'royalties' => '1.2K ATA',  'rep' => 82],
                    ],
                    'capsule' => [
                        'address'  => '0x33f2…a1b8',
                        'owner'    => '0x9f2a…c41d',
                        'versions' => 8,
                        'encryption' => 'seal',
                        'timeline' => [
                            ['event' => 'Genesis',     'desc' => 'Initial creation — 2.1 MB stored on Walrus',                        'color' => '#9FE870'],
                            ['event' => 'Compression', 'desc' => '5-layer compaction → 0.4 MB',                                        'color' => '#EBFF00'],
                            ['event' => 'Forking',     'desc' => 'Generated child capsule 0x77a9…',                                    'color' => '#60a5fa'],
                            ['event' => 'Merging',     'desc' => 'Integrated 0x12be… with royalty distribution established',           'color' => '#a78bfa'],
                            ['event' => 'Forgetting',  'desc' => 'Node #4 deletion validated via cryptographic proof',                 'color' => '#f87171'],
                        ],
                    ],
                ],
            ],
            [
                'slug'         => 'account',
                'title'        => 'Account Detail',
                'description'  => 'Balance, owned objects & tx history decoded into AI-native semantics.',
                'tag'          => 'Core + AI',
                'icon_svg'     => '<rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/>',
                'sort_order'   => 7,
                'is_active'    => true,
                'content_json' => [
                    'identity' => [
                        'address'               => '0x9f2a…c41d',
                        'ata_balance'           => '42,801.42',
                        'lifetime_royalties'    => '13.2K ATA',
                        'status'                => 'Sponsored-tx enabled',
                        'first_activity'        => 'Epoch 412',
                        'tx_count'              => '8,204',
                        'cross_chain_deployments' => 5,
                        'object_count'          => 148,
                        'object_types'          => 12,
                    ],
                    'objects' => [
                        ['type' => 'Agents',    'count' => 3,  'detail' => 'Primary: Atlas-7'],
                        ['type' => 'Capsules',  'count' => 11, 'detail' => '2.4 MB on Walrus'],
                        ['type' => 'ATA Coins', 'count' => 1,  'detail' => '42,801 ATA'],
                        ['type' => 'Skills',    'count' => 1,  'detail' => 'deep-research-v3'],
                    ],
                    'transactions' => [
                        ['type' => 'Skill Royalty',        'amount' => '-1,200 ATA', 'ago' => '2s ago',  'status' => 'success'],
                        ['type' => 'Citation Royalty',     'amount' => '+120 ATA',   'ago' => '5m ago',  'status' => 'success'],
                        ['type' => 'Cross-chain Intent',   'amount' => '-0.5 BTC',   'ago' => '1h ago',  'status' => 'success'],
                        ['type' => 'Capsule Compression',  'amount' => '—',          'ago' => '3h ago',  'status' => 'success'],
                    ],
                ],
            ],
            [
                'slug'         => 'validators',
                'title'        => 'Validators & Network',
                'description'  => 'Network stats + validator set table (stake / voting % / APY / status).',
                'tag'          => 'Core',
                'icon_svg'     => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
                'sort_order'   => 8,
                'is_active'    => true,
                'content_json' => [
                    'network' => [
                        'epoch'               => '1,847',
                        'consensus'           => 'Mysticeti DAG',
                        'active_validators'   => 112,
                        'candidate_validators'=> 118,
                        'total_stake'         => '2.84B ATA',
                        'epoch_progress'      => '78%',
                        'epoch_ends'          => '4h 12m',
                        'avg_apy'             => '4.82%',
                        'apy_change'          => '+0.1% vs prev',
                    ],
                    'validators' => [
                        ['name' => 'Aeterna Foundation', 'stake' => '284.1M ATA', 'voting' => '10.01%', 'apy' => '4.91%', 'status' => 'active'],
                        ['name' => 'Mysten East',        'stake' => '198.4M ATA', 'voting' => '6.98%',  'apy' => '4.84%', 'status' => 'active'],
                        ['name' => 'Stake.fish',         'stake' => '176.2M ATA', 'voting' => '6.20%',  'apy' => '4.79%', 'status' => 'active'],
                        ['name' => 'Figment',            'stake' => '152.8M ATA', 'voting' => '5.38%',  'apy' => '4.76%', 'status' => 'active'],
                        ['name' => 'Chorus One',         'stake' => '141.0M ATA', 'voting' => '4.96%',  'apy' => '4.74%', 'status' => 'low_stake'],
                    ],
                ],
            ],
        ];

        foreach ($pages as $page) {
            ExplorerPage::firstOrCreate(['slug' => $page['slug']], $page);
        }
    }
}

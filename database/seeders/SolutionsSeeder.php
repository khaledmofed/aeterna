<?php

namespace Database\Seeders;

use App\Models\Solution;
use Illuminate\Database\Seeder;

class SolutionsSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['challenge' => 'Fragmented user experience', 'current_state' => 'Managing multiple wallets, addresses, and gas tokens',   'aeterna_solution' => 'Universal Address controls 15+ chains',               'sort_order' => 1],
            ['challenge' => 'AI integration',             'current_state' => 'No native AI support; centralized inference',             'aeterna_solution' => 'Decentralized AgentCore + verifiable reasoning',        'sort_order' => 2],
            ['challenge' => 'High fees',                  'current_state' => 'Gas costs hinder daily operations',                      'aeterna_solution' => 'Resource credits enable near-zero fees',                 'sort_order' => 3],
            ['challenge' => 'Cross-chain complexity',     'current_state' => 'Bridges require trust assumptions',                      'aeterna_solution' => 'State-machine-level chain abstraction',                  'sort_order' => 4],
            ['challenge' => 'Scalability',                'current_state' => 'Traditional BFT limited to ~10K TPS',                   'aeterna_solution' => 'DAG consensus reaches 160K+ TPS',                       'sort_order' => 5],
        ];

        foreach ($rows as $row) {
            Solution::updateOrCreate(
                ['challenge' => $row['challenge']],
                array_merge($row, ['is_active' => true])
            );
        }
    }
}

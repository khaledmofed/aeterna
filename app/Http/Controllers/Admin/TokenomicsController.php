<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tokenomic;
use Illuminate\Http\Request;

class TokenomicsController extends Controller
{
    public function edit()
    {
        $tokenomics = Tokenomic::firstOrNew(['id' => 1]);
        return view('admin.tokenomics.edit', compact('tokenomics'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'section_badge'        => 'nullable|string|max:100',
            'section_title'        => 'nullable|string|max:500',
            'section_subtitle'     => 'nullable|string',
            'token_name'           => 'nullable|string|max:50',
            'token_ticker'         => 'nullable|string|max:10',
            'token_supply'         => 'nullable|string|max:100',
            'lp_token_name'        => 'nullable|string|max:50',
            'lp_token_description' => 'nullable|string',
        ]);

        $allocation = [];
        foreach (($request->allocation ?? []) as $item) {
            if (!empty($item['label'])) $allocation[] = $item;
        }
        $stats = [];
        foreach (($request->stats ?? []) as $item) {
            if (!empty($item['value'])) $stats[] = $item;
        }
        $mechanics = [];
        foreach (($request->mechanics ?? []) as $item) {
            if (!empty($item['title'])) $mechanics[] = $item;
        }
        $flywheel = array_filter($request->flywheel_steps ?? []);

        Tokenomic::updateOrCreate(['id' => 1], array_merge($validated, [
            'allocation_json'     => $allocation,
            'stats_json'          => $stats,
            'mechanics_json'      => $mechanics,
            'flywheel_steps_json' => array_values($flywheel),
        ]));

        return redirect()->route('admin.tokenomics')->with('success', 'Tokenomics updated.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    public function edit()
    {
        $hero = HeroSection::firstOrNew(['id' => 1]);
        return view('admin.hero.edit', compact('hero'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'badge_text'         => 'nullable|string|max:255',
            'headline'           => 'nullable|string|max:500',
            'subheadline'        => 'nullable|string',
            'cta_primary_text'   => 'nullable|string|max:100',
            'cta_primary_url'    => 'nullable|string|max:255',
            'cta_secondary_text' => 'nullable|string|max:100',
            'cta_secondary_url'  => 'nullable|string|max:255',
            'email_placeholder'  => 'nullable|string|max:255',
            'email_cta'          => 'nullable|string|max:100',
            'is_active'          => 'boolean',
            'stats'              => 'nullable|array',
            'stats.*.value'      => 'nullable|string',
            'stats.*.label'      => 'nullable|string',
        ]);

        $stats = [];
        if (!empty($request->stats)) {
            foreach ($request->stats as $stat) {
                if (!empty($stat['value']) || !empty($stat['label'])) {
                    $stats[] = $stat;
                }
            }
        }
        $validated['stats_json'] = $stats;
        $validated['is_active']  = $request->boolean('is_active');
        unset($validated['stats']);

        HeroSection::updateOrCreate(['id' => 1], $validated);

        return redirect()->route('admin.hero')->with('success', 'Hero section updated.');
    }
}

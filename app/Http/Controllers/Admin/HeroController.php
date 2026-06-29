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
            'badge_text'           => 'nullable|array',
            'badge_text.*'         => 'nullable|string',
            'headline'             => 'nullable|array',
            'headline.*'           => 'nullable|string',
            'subheadline'          => 'nullable|array',
            'subheadline.*'        => 'nullable|string',
            'cta_primary_text'     => 'nullable|array',
            'cta_primary_text.*'   => 'nullable|string',
            'cta_primary_url'      => 'nullable|string|max:255',
            'cta_secondary_text'   => 'nullable|array',
            'cta_secondary_text.*' => 'nullable|string',
            'cta_secondary_url'    => 'nullable|string|max:255',
            'email_placeholder'    => 'nullable|array',
            'email_placeholder.*'  => 'nullable|string',
            'email_cta'            => 'nullable|array',
            'email_cta.*'          => 'nullable|string',
            'is_active'            => 'boolean',
            'stats'                => 'nullable|array',
            'stats.*.value'        => 'nullable|string',
            'stats.*.label'        => 'nullable|string',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        unset($validated['stats']);

        $hero = HeroSection::updateOrCreate(['id' => 1], $validated);

        // Build per-locale stats_json
        $locales = ['en', 'ja', 'ko', 'es', 'zh-TW', 'vi'];
        $enStatValues = [];
        foreach ($request->input('stats.en', []) as $i => $item) {
            $enStatValues[$i] = $item['value'] ?? '';
        }

        $statsByLocale = [];
        foreach ($locales as $locale) {
            $items = $request->input("stats.$locale", []);
            $built = [];
            foreach ($items as $i => $item) {
                if (!empty($item['label'])) {
                    $built[] = [
                        'value' => $locale === 'en' ? ($item['value'] ?? '') : ($enStatValues[$i] ?? ''),
                        'label' => $item['label'],
                    ];
                }
            }
            if ($built) $statsByLocale[$locale] = json_encode($built, JSON_UNESCAPED_UNICODE);
        }

        if ($statsByLocale) {
            $existing = [];
            foreach ($locales as $l) { $existing[$l] = $hero->getTranslation('stats_json', $l, false) ?? '[]'; }
            $hero->setTranslations('stats_json', array_merge($existing, $statsByLocale));
            $hero->save();
        }

        return redirect()->route('admin.hero')->with('success', 'Hero section updated.');
    }
}

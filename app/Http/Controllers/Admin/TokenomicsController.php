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
            'section_badge'        => 'nullable|array',
            'section_badge.*'      => 'nullable|string',
            'section_title'        => 'nullable|array',
            'section_title.*'      => 'nullable|string',
            'section_subtitle'     => 'nullable|array',
            'section_subtitle.*'   => 'nullable|string',
            'token_name'           => 'nullable|string|max:50',
            'token_ticker'         => 'nullable|string|max:10',
            'token_supply'         => 'nullable|string|max:100',
            'lp_token_name'        => 'nullable|string|max:50',
            'lp_token_description' => 'nullable|string',
        ]);

        $t = Tokenomic::updateOrCreate(['id' => 1], $validated);

        $locales = ['en', 'ja', 'ko', 'es', 'zh-TW', 'vi'];

        $enAllocMeta  = [];
        $enStatValues = [];
        $enMechIcons  = [];
        foreach ($request->input('allocation.en', []) as $i => $item) {
            $enAllocMeta[$i] = ['percentage' => $item['percentage'] ?? 0, 'color' => $item['color'] ?? '#9fe870'];
        }
        foreach ($request->input('stats.en', []) as $i => $item) {
            $enStatValues[$i] = $item['value'] ?? '';
        }
        foreach ($request->input('mechanics.en', []) as $i => $item) {
            $enMechIcons[$i] = $item['icon_svg'] ?? '';
        }

        $allocationByLocale = [];
        $statsByLocale      = [];
        $flywheelByLocale   = [];
        $mechanicsByLocale  = [];

        foreach ($locales as $locale) {
            $allocItems = $request->input("allocation.$locale", []);
            $built = [];
            foreach ($allocItems as $i => $item) {
                if (!empty($item['label'])) {
                    $built[] = array_merge($enAllocMeta[$i] ?? [], ['label' => $item['label']]);
                }
            }
            if ($built) $allocationByLocale[$locale] = json_encode($built, JSON_UNESCAPED_UNICODE);

            $statItems = $request->input("stats.$locale", []);
            $built = [];
            foreach ($statItems as $i => $item) {
                if (!empty($item['label'])) {
                    $built[] = [
                        'value'       => $locale === 'en' ? ($item['value'] ?? '') : ($enStatValues[$i] ?? ''),
                        'label'       => $item['label'],
                        'description' => $item['description'] ?? '',
                    ];
                }
            }
            if ($built) $statsByLocale[$locale] = json_encode($built, JSON_UNESCAPED_UNICODE);

            $flyItems = $request->input("flywheel_steps.$locale", []);
            $built = array_values(array_filter($flyItems));
            if ($built) $flywheelByLocale[$locale] = json_encode($built, JSON_UNESCAPED_UNICODE);

            $mechItems = $request->input("mechanics.$locale", []);
            $built = [];
            foreach ($mechItems as $i => $item) {
                if (!empty($item['title'])) {
                    $built[] = [
                        'title'       => $item['title'],
                        'description' => $item['description'] ?? '',
                        'icon_svg'    => $locale === 'en' ? ($item['icon_svg'] ?? '') : ($enMechIcons[$i] ?? ''),
                    ];
                }
            }
            if ($built) $mechanicsByLocale[$locale] = json_encode($built, JSON_UNESCAPED_UNICODE);
        }

        foreach ([
            'allocation_json'     => $allocationByLocale,
            'stats_json'          => $statsByLocale,
            'flywheel_steps_json' => $flywheelByLocale,
            'mechanics_json'      => $mechanicsByLocale,
        ] as $field => $byLocale) {
            if (!$byLocale) continue;
            $existing = [];
            foreach ($locales as $l) { $existing[$l] = $t->getTranslation($field, $l, false) ?? '[]'; }
            $t->setTranslations($field, array_merge($existing, $byLocale));
        }
        $t->save();

        return redirect()->route('admin.tokenomics')->with('success', 'Tokenomics updated.');
    }
}

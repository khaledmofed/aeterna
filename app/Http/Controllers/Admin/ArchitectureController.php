<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArchitectureLayer;
use Illuminate\Http\Request;

class ArchitectureController extends Controller
{
    public function index()
    {
        $layers = ArchitectureLayer::orderBy('sort_order')->get();
        return view('admin.architecture.index', compact('layers'));
    }

    public function edit(ArchitectureLayer $architecture)
    {
        return view('admin.architecture.edit', ['layer' => $architecture]);
    }

    public function update(Request $request, ArchitectureLayer $architecture)
    {
        $validated = $request->validate([
            'name'          => 'required|array',
            'name.en'       => 'required|string',
            'name.*'        => 'nullable|string',
            'description'   => 'nullable|array',
            'description.*' => 'nullable|string',
            'icon_svg'      => 'nullable|string',
            'is_active'     => 'boolean',
        ]);

        $architecture->update([
            'name'        => $validated['name'],
            'description' => $validated['description'] ?? null,
            'icon_svg'    => $validated['icon_svg'] ?? null,
            'is_active'   => $request->boolean('is_active'),
        ]);

        $featuresInput = $request->input('features', []);
        $locales = ['en', 'ja', 'ko', 'es', 'zh-TW', 'vi'];

        $enIconMap = [];
        foreach ($featuresInput['en'] ?? [] as $i => $item) {
            $enIconMap[$i] = $item['icon_svg'] ?? '';
        }

        $featuresByLocale = [];
        foreach ($locales as $locale) {
            $items = $featuresInput[$locale] ?? [];
            $built = [];
            foreach ($items as $i => $item) {
                if (!empty($item['title'])) {
                    $built[] = [
                        'title'       => $item['title'],
                        'description' => $item['description'] ?? '',
                        'icon_svg'    => $locale === 'en' ? ($item['icon_svg'] ?? '') : ($enIconMap[$i] ?? ''),
                    ];
                }
            }
            if ($built) {
                $featuresByLocale[$locale] = json_encode($built, JSON_UNESCAPED_UNICODE);
            }
        }

        if ($featuresByLocale) {
            $existing = [];
            foreach ($locales as $locale) {
                $existing[$locale] = $architecture->getTranslation('features_json', $locale, false) ?? '[]';
            }
            $architecture->setTranslations('features_json', array_merge($existing, $featuresByLocale));
            $architecture->save();
        }

        return redirect()->route('admin.architecture.index')->with('success', 'Layer updated.');
    }
}

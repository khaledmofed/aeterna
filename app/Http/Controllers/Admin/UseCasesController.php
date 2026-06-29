<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UseCase;
use Illuminate\Http\Request;

class UseCasesController extends Controller
{
    public function index()
    {
        $useCases = UseCase::orderBy('sort_order')->get();
        return view('admin.use-cases.index', compact('useCases'));
    }

    public function create()
    {
        return view('admin.use-cases.form');
    }

    public function store(Request $request)
    {
        $validated = $this->validateCase($request);
        $useCase = UseCase::create($validated);
        $this->saveFeatures($request, $useCase);
        return redirect()->route('admin.use-cases.index')->with('success', 'Use case created.');
    }

    public function edit(UseCase $useCase)
    {
        return view('admin.use-cases.form', compact('useCase'));
    }

    public function update(Request $request, UseCase $useCase)
    {
        $validated = $this->validateCase($request);
        $useCase->update($validated);
        $this->saveFeatures($request, $useCase);
        return redirect()->route('admin.use-cases.index')->with('success', 'Use case updated.');
    }

    public function destroy(UseCase $useCase)
    {
        $useCase->delete();
        return redirect()->route('admin.use-cases.index')->with('success', 'Use case deleted.');
    }

    private function validateCase(Request $request): array
    {
        $v = $request->validate([
            'title'        => 'required|array',
            'title.en'     => 'required|string',
            'title.*'      => 'nullable|string',
            'description'  => 'nullable|array',
            'description.*'=> 'nullable|string',
            'icon_svg'     => 'nullable|string',
            'category'     => 'nullable|string|max:50',
            'sort_order'   => 'integer',
            'is_active'    => 'boolean',
        ]);
        $v['is_active'] = $request->boolean('is_active');
        return $v;
    }

    private function saveFeatures(Request $request, UseCase $useCase): void
    {
        $locales = ['en', 'ja', 'ko', 'es', 'zh-TW', 'vi'];
        $input = $request->input('features', []);

        // Legacy flat array fallback
        if (isset($input[0])) {
            $built = [];
            foreach ($input as $f) {
                if (!empty($f['title'])) $built[] = $f;
            }
            $useCase->setTranslations('features_json', ['en' => json_encode($built, JSON_UNESCAPED_UNICODE)]);
            $useCase->save();
            return;
        }

        $featuresByLocale = [];
        foreach ($locales as $locale) {
            $items = $input[$locale] ?? [];
            $built = [];
            foreach ($items as $i => $item) {
                if (!empty($item['title'])) {
                    $built[] = ['title' => $item['title'], 'description' => $item['description'] ?? ''];
                }
            }
            if ($built) {
                $featuresByLocale[$locale] = json_encode($built, JSON_UNESCAPED_UNICODE);
            }
        }
        if ($featuresByLocale) {
            $existing = [];
            foreach ($locales as $l) { $existing[$l] = $useCase->getTranslation('features_json', $l, false) ?? '[]'; }
            $useCase->setTranslations('features_json', array_merge($existing, $featuresByLocale));
            $useCase->save();
        }
    }
}

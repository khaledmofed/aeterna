<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoadmapStage;
use Illuminate\Http\Request;

class RoadmapController extends Controller
{
    public function index()
    {
        $stages = RoadmapStage::orderBy('sort_order')->get();
        return view('admin.roadmap.index', compact('stages'));
    }

    public function create()
    {
        return view('admin.roadmap.form');
    }

    public function store(Request $request)
    {
        $validated = $this->validateStage($request);
        $stage = RoadmapStage::create($validated);
        $this->saveMilestones($request, $stage);
        return redirect()->route('admin.roadmap.index')->with('success', 'Stage created.');
    }

    public function edit(RoadmapStage $roadmap)
    {
        return view('admin.roadmap.form', ['stage' => $roadmap]);
    }

    public function update(Request $request, RoadmapStage $roadmap)
    {
        $validated = $this->validateStage($request);
        $roadmap->update($validated);
        $this->saveMilestones($request, $roadmap);
        return redirect()->route('admin.roadmap.index')->with('success', 'Stage updated.');
    }

    public function destroy(RoadmapStage $roadmap)
    {
        $roadmap->delete();
        return redirect()->route('admin.roadmap.index')->with('success', 'Stage deleted.');
    }

    private function validateStage(Request $request): array
    {
        $v = $request->validate([
            'stage_number'  => 'required|integer',
            'name'          => 'required|array',
            'name.en'       => 'required|string',
            'name.*'        => 'nullable|string',
            'timeframe'     => 'nullable|array',
            'timeframe.*'   => 'nullable|string',
            'status'        => 'required|in:completed,active,upcoming',
            'sort_order'    => 'integer',
            'is_active'     => 'boolean',
        ]);
        $v['is_active'] = $request->boolean('is_active');
        return $v;
    }

    private function saveMilestones(Request $request, RoadmapStage $stage): void
    {
        $locales = ['en', 'ja', 'ko', 'es', 'zh-TW', 'vi'];
        $input = $request->input('milestones', []);

        if (is_string($input)) {
            // legacy single textarea fallback
            $stage->setTranslations('milestones_json', [
                'en' => json_encode(array_values(array_filter(array_map('trim', explode("\n", $input)))), JSON_UNESCAPED_UNICODE),
            ]);
            $stage->save();
            return;
        }

        $byLocale = [];
        foreach ($locales as $locale) {
            $raw = $input[$locale] ?? '';
            $items = array_values(array_filter(array_map('trim', explode("\n", $raw))));
            if ($items) {
                $byLocale[$locale] = json_encode($items, JSON_UNESCAPED_UNICODE);
            }
        }
        if ($byLocale) {
            $existing = [];
            foreach ($locales as $l) { $existing[$l] = $stage->getTranslation('milestones_json', $l, false) ?? '[]'; }
            $stage->setTranslations('milestones_json', array_merge($existing, $byLocale));
            $stage->save();
        }
    }
}

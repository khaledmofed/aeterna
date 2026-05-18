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
        $validated['milestones_json'] = $this->parseMilestones($request->milestones);
        RoadmapStage::create($validated);
        return redirect()->route('admin.roadmap.index')->with('success', 'Stage created.');
    }

    public function edit(RoadmapStage $roadmap)
    {
        return view('admin.roadmap.form', ['stage' => $roadmap]);
    }

    public function update(Request $request, RoadmapStage $roadmap)
    {
        $validated = $this->validateStage($request);
        $validated['milestones_json'] = $this->parseMilestones($request->milestones);
        $roadmap->update($validated);
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
            'stage_number' => 'required|integer',
            'name'         => 'required|string|max:100',
            'timeframe'    => 'nullable|string|max:100',
            'status'       => 'required|in:completed,active,upcoming',
            'sort_order'   => 'integer',
            'is_active'    => 'boolean',
        ]);
        $v['is_active'] = $request->boolean('is_active');
        return $v;
    }

    private function parseMilestones(?string $raw): array
    {
        if (empty($raw)) return [];
        return array_values(array_filter(array_map('trim', explode("\n", $raw))));
    }
}

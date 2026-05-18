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
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string',
            'icon_svg'    => 'nullable|string',
            'is_active'   => 'boolean',
            'features'              => 'nullable|array',
            'features.*.title'      => 'nullable|string|max:200',
            'features.*.description'=> 'nullable|string',
            'features.*.icon_svg'   => 'nullable|string',
        ]);

        $features = [];
        if (!empty($request->features)) {
            foreach ($request->features as $feature) {
                if (!empty($feature['title'])) {
                    $features[] = $feature;
                }
            }
        }

        $architecture->update([
            'name'          => $validated['name'],
            'description'   => $validated['description'] ?? null,
            'icon_svg'      => $validated['icon_svg'] ?? null,
            'features_json' => $features,
            'is_active'     => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.architecture.index')->with('success', 'Layer updated.');
    }
}
